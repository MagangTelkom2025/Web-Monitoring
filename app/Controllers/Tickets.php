<?php

namespace App\Controllers;

use App\Models\TicketModel;
use CodeIgniter\Controller;

class Tickets extends Controller
{

public function index()
{
    $model = new TicketModel();
    $data['tickets'] = $model
        ->select('date_start_interaction, mainCategory, category, witel')
        ->findAll();

    // kirim data ke ticket.php
    return view('ticket', $data);
}



    public function uploadForm()
    {
        return view('tickets/upload');
    }

   public function upload()
{
    ini_set('memory_limit', '3G');

        $file = $this->request->getFile('file');

    // Validasi ukuran file (misal: 50MB)
    if ($file->getSize() > 2048  * 1024 * 1024) { // 50MB
        return redirect()->back()->with('error', 'Ukuran file maksimal 2GB!');
    }

    if (!$file->isValid() || $file->hasMoved()) {
        return redirect()->back()->with('error', 'Upload gagal!');
    }

    if ($file->getExtension() !== 'csv') {
        return redirect()->back()->with('error', 'File harus CSV!');
    }

    $path   = $file->getTempName();
    $handle = fopen($path, 'r');

    if ($handle === false) {
        return redirect()->back()->with('error', 'Gagal membaca file CSV!');
    }

    $model  = new TicketModel();
    $header = fgetcsv($handle);

    $bigIntColumns = ['priority_id']; // sesuaikan dengan DB

    $batchInsert = [];
    $batchUpdate = [];

    while (($row = fgetcsv($handle)) !== false) {
        $cleanRow = [];

        foreach ($row as $i => $value) {
            if ($value === null) {
                $value = '';
            }

            // Bersihkan karakter tidak perlu
            $value = trim($value, "'\"");
            $value = str_replace(',', '', $value);
            $value = trim($value);

            // Hilangkan .0 di akhir angka
            if (preg_match('/^\d+\.0$/', $value)) {
                $value = preg_replace('/\.0$/', '', $value);
            }

            // Jika kolom BIGINT dan nilainya 0 → ubah jadi '-'
            if (isset($header[$i]) && in_array($header[$i], $bigIntColumns)) {
                if ($value === '0') {
                    $value = '-';
                }
            }

            // Format datetime (tanggal + jam)
            if (preg_match('/^\d{1,2}[\/\.\-]\d{1,2}[\/\.\-]\d{2,4}\s+\d{1,2}[\.\:]\d{1,2}[\.\:]\d{1,2}$/', $value)) {
                $cleanValue = preg_replace('/(\d{1,2})\.(\d{1,2})\.(\d{1,2})$/', '$1:$2:$3', $value);
                $cleanValue = preg_replace('/[\.\-]/', '/', $cleanValue);

                $dateTime = date_create_from_format('d/m/Y H:i:s', $cleanValue)
                         ?: date_create_from_format('m/d/Y H:i:s', $cleanValue)
                         ?: date_create_from_format('d/m/y H:i:s', $cleanValue)
                         ?: date_create_from_format('m/d/y H:i:s', $cleanValue);

                if ($dateTime) {
                    $value = $dateTime->format('Y-m-d H:i:s');
                }
            }
            // Format tanggal tanpa jam
            elseif (preg_match('/^\d{1,2}[\/\.\-]\d{1,2}[\/\.\-]\d{2,4}$/', $value)) {
                $cleanDate = str_replace(['.', '-'], '/', $value);
                $date = date_create_from_format('d/m/Y', $cleanDate)
                     ?: date_create_from_format('m/d/Y', $cleanDate)
                     ?: date_create_from_format('d/m/y', $cleanDate)
                     ?: date_create_from_format('m/d/y', $cleanDate);

                if ($date) {
                    $value = $date->format('Y-m-d');
                }
            }

            $cleanRow[$header[$i]] = $value;
        }

        // Simpan ke array insert/update
        if (!empty($cleanRow['ticket_id'])) {
            $existing = $model->where('ticket_id', $cleanRow['ticket_id'])->first();

            if ($existing) {
                $cleanRow[$model->primaryKey] = $existing[$model->primaryKey];
                $batchUpdate[] = $cleanRow;
            } else {
                $batchInsert[] = $cleanRow;
            }
        }
    }

   fclose($handle);

    $batchSize = 1000; // jumlah baris per batch

    // Batch insert
    if (!empty($batchInsert)) {
        foreach (array_chunk($batchInsert, $batchSize) as $chunk) {
            $model->insertBatch($chunk);
        }
    }

    // Batch update
    if (!empty($batchUpdate)) {
        foreach (array_chunk($batchUpdate, $batchSize) as $chunk) {
            $model->updateBatch($chunk, $model->primaryKey);
        }
    }

    return redirect()->to('/ticket')->with('success', 'Data berhasil diupload (Batch)');
}
}