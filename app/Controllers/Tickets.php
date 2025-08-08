<?php

namespace App\Controllers;

use App\Models\TicketModel;
use App\Services\CsvProcessorService;
use App\Services\BatchProcessorService;
use App\Config\CsvConfig;
use CodeIgniter\Controller;

class Tickets extends Controller
{
    protected $ticketModel;
    protected $csvProcessor;
    protected $batchProcessor;
    protected $config;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
        $this->csvProcessor = new CsvProcessorService();
        $this->batchProcessor = new BatchProcessorService();
        $this->config = new CsvConfig();
    }

    public function index()
    {
        return view('ticket', ['tickets' => []]);
    }

    public function getDataTable()
    {
        $request = \Config\Services::request();

        // DataTables parameters
        $draw = $request->getPost('draw');
        $start = $request->getPost('start') ?? 0;
        $length = $request->getPost('length') ?? 25;
        $searchValue = $request->getPost('search')['value'] ?? '';
        $orderColumn = $request->getPost('order')[0]['column'] ?? 1;
        $orderDir = $request->getPost('order')[0]['dir'] ?? 'desc';

        // Column mapping
        $columns = [
            0 => 'date_start_interaction',
            1 => 'mainCategory',
            2 => 'category',
            3 => 'witel'
        ];

        $orderByColumn = $columns[$orderColumn] ?? 'date_start_interaction';

        // Build query
        $builder = $this->ticketModel
            ->select('date_start_interaction, mainCategory, category, witel');

        // Apply search filter
        if (!empty($searchValue)) {
            $builder->groupStart()
                ->like('date_start_interaction', $searchValue)
                ->orLike('mainCategory', $searchValue)
                ->orLike('category', $searchValue)
                ->orLike('witel', $searchValue)
                ->groupEnd();
        }

        // Get total records
        $totalRecords = $this->ticketModel->countAllResults(false);
        $filteredRecords = $builder->countAllResults(false);

        // Apply ordering and pagination
        $data = $builder
            ->orderBy($orderByColumn, $orderDir)
            ->limit($length, $start)
            ->get()
            ->getResultArray();

        // Format data for DataTables
        $formattedData = [];
        foreach ($data as $row) {
            $formattedData[] = [
                'date_start_interaction' => '<div class="text-start">
                    <div class="fw-medium text-dark mb-1">' . date('d/m/Y', strtotime($row['date_start_interaction'])) . '</div>
                    <small class="text-muted">' . date('H:i', strtotime($row['date_start_interaction'])) . '</small>
                </div>',
                'mainCategory' => '<div class="text-start">
                    <span class="fw-medium text-dark">' . esc($row['mainCategory'] ?? 'N/A') . '</span>
                </div>',
                'category' => '<div class="text-start">
                    <span class="text-dark" style="line-height: 1.4;">' . esc($row['category'] ?? 'N/A') . '</span>
                </div>',
                'witel' => '<div class="text-start">
                    <span class="fw-medium text-dark">' . esc($row['witel'] ?? 'N/A') . '</span>
                </div>'
            ];
        }

        return $this->response->setJSON([
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $formattedData
        ]);
    }


    public function uploadForm()
    {
        return view('tickets/upload');
    }

    public function upload()
    {
        try {
            $file = $this->validateFile();

            if ($file->getSize() > $this->config->largFileThreshold) {
                return $this->handleLargeFileUpload($file);
            } else {
                return $this->handleSmallFileUpload($file);
            }
        } catch (\InvalidArgumentException $e) {
            return redirect()->back()->with('error', 'Format file tidak valid: ' . $e->getMessage());
        } catch (\Exception $e) {
            log_message('error', 'Upload error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat upload. Silakan coba lagi.');
        }
    }

    private function handleLargeFileUpload($file)
    {
        if (!is_dir(WRITEPATH . 'uploads')) {
            mkdir(WRITEPATH . 'uploads', 0755, true);
        }

        $fileName = 'upload_' . time() . '_' . $file->getName();
        $filePath = WRITEPATH . 'uploads/' . $fileName;

        if (!$file->move(WRITEPATH . 'uploads/', $fileName)) {
            throw new \Exception('Gagal menyimpan file!');
        }

        $jobId = $this->batchProcessor->startBatchUpload($filePath, session('user_id'));

        return redirect()->to('/ticket/upload-progress/' . $jobId)->with(
            'success',
            'File besar terdeteksi (' . number_format($file->getSize() / 1024 / 1024, 2) . ' MB). Upload sedang diproses di background.'
        );
    }

    private function handleSmallFileUpload($file)
    {
        try {
            if (!is_dir(WRITEPATH . 'uploads')) {
                mkdir(WRITEPATH . 'uploads', 0755, true);
            }

            $fileName = 'upload_' . time() . '_' . $file->getName();
            $filePath = WRITEPATH . 'uploads/' . $fileName;

            if (!$file->move(WRITEPATH . 'uploads/', $fileName)) {
                throw new \Exception('Gagal menyimpan file!');
            }

            $processedData = $this->csvProcessor->processFile($filePath);

            if (empty($processedData)) {
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                return redirect()->back()->with('error', 'File CSV kosong atau tidak valid');
            }

            $currentCount = $this->ticketModel->getTotalRecords();
            $this->ticketModel->truncateTable();
            $savedCount = $this->ticketModel->batchInsert($processedData);

            if (file_exists($filePath)) {
                unlink($filePath);
            }

            return redirect()->to('/ticket')->with(
                'success',
                "Data berhasil di-replace! {$savedCount} ticket baru telah dimuat. Data lama ({$currentCount} records) telah dihapus."
            );
        } catch (\Exception $e) {
            if (isset($filePath) && file_exists($filePath)) {
                unlink($filePath);
            }
            log_message('error', 'Small file upload error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function validateFile()
    {
        $file = $this->request->getFile('file');

        if (!$file->isValid() || $file->hasMoved()) {
            throw new \Exception('Upload gagal!');
        }

        if (!in_array($file->getExtension(), $this->config->allowedExtensions)) {
            throw new \Exception('File harus CSV!');
        }

        if ($file->getSize() > $this->config->maxFileSize) {
            throw new \Exception('File terlalu besar! Maksimal ' . number_format($this->config->maxFileSize / 1024 / 1024, 0) . 'MB.');
        }

        if ($file->getSize() == 0) {
            throw new \Exception('File kosong!');
        }

        return $file;
    }

    public function uploadProgress($jobId)
    {
        $job = $this->batchProcessor->getJobStatus($jobId);

        if (!$job) {
            return redirect()->to('/ticket')->with('error', 'Job tidak ditemukan');
        }

        $data['job'] = $job;
        return view('tickets/upload_progress', $data);
    }

    public function getUploadStatus($jobId)
    {
        $job = $this->batchProcessor->getJobStatus($jobId);
        return $this->response->setJSON($job);
    }
}
