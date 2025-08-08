<?php

namespace App\Models;

use CodeIgniter\Model;

class BatchJobModel extends Model
{
    protected $table = 'batch_jobs';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useTimestamps = false;

    protected $allowedFields = [
        'file_path',
        'file_size',
        'estimated_rows',
        'processed_rows',
        'failed_rows',
        'status',
        'error_message',
        'user_id',
        'created_at',
        'updated_at'
    ];

    protected $validationRules = [
        'file_path' => 'required',
        'file_size' => 'required|numeric',
        'status' => 'required|in_list[pending,processing,completed,failed]'
    ];

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function createJob($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->insert($data, true);
    }

    public function updateProgress($jobId, $processedRows, $failedRows = 0)
    {
        return $this->update($jobId, [
            'processed_rows' => $processedRows,
            'failed_rows' => $failedRows,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function updateStatus($jobId, $status, $errorMessage = null)
    {
        $data = [
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($errorMessage) {
            $data['error_message'] = $errorMessage;
        }

        return $this->update($jobId, $data);
    }

    public function getJob($jobId)
    {
        return $this->find($jobId);
    }

    public function getJobsByStatus($status)
    {
        return $this->where('status', $status)->findAll();
    }

    public function getJobsByUserId($userId)
    {
        return $this->where('user_id', $userId)->orderBy('created_at', 'DESC')->findAll();
    }

    public function getRecentJobs($limit = 10)
    {
        return $this->orderBy('created_at', 'DESC')->findAll($limit);
    }
}
