<?php

namespace App\Services;

use App\Config\CsvConfig;
use App\Models\BatchJobModel;
use App\Models\TicketModel;

class BatchProcessorService
{
    private $config;
    private $batchJobModel;

    public function __construct()
    {
        $this->config = new CsvConfig();
        $this->batchJobModel = new BatchJobModel();
    }

    public function startBatchUpload($filePath, $userId = null)
    {
        $jobId = $this->createBatchJob($filePath, $userId);
        $this->processInBackground($jobId, $filePath);
        return $jobId;
    }

    private function createBatchJob($filePath, $userId)
    {
        $fileSize = filesize($filePath);
        $estimatedRows = $this->estimateRowCount($filePath);

        $jobData = [
            'file_path' => $filePath,
            'file_size' => $fileSize,
            'estimated_rows' => $estimatedRows,
            'status' => 'pending',
            'processed_rows' => 0,
            'failed_rows' => 0,
            'user_id' => $userId
        ];

        return $this->batchJobModel->createJob($jobData);
    }

    private function estimateRowCount($filePath)
    {
        $handle = fopen($filePath, 'r');
        $lineCount = 0;

        while (!feof($handle)) {
            if (fgets($handle)) {
                $lineCount++;
            }
        }

        fclose($handle);
        return max(0, $lineCount - 1);
    }

    public function processInBackground($jobId, $filePath)
    {
        ini_set('memory_limit', $this->config->memoryLimit);
        set_time_limit($this->config->maxExecutionTime);

        try {
            $this->batchJobModel->updateStatus($jobId, 'processing');

            $ticketModel = new TicketModel();
            $currentCount = $ticketModel->getTotalRecords();
            $ticketModel->truncateTable();

            log_message('info', "Truncated {$currentCount} old records before batch processing");

            $this->processCsvInBatches($filePath, $jobId);
            $this->batchJobModel->updateStatus($jobId, 'completed');
        } catch (\Exception $e) {
            $this->batchJobModel->updateStatus($jobId, 'failed', $e->getMessage());
            log_message('error', 'Batch processing failed: ' . $e->getMessage());

            if (file_exists($filePath)) {
                unlink($filePath);
                log_message('info', "Cleaned up uploaded file after error: {$filePath}");
            }
        }
    }

    private function processCsvInBatches($filePath, $jobId)
    {
        $this->batchJobModel->updateStatus($jobId, 'processing');

        $handle = fopen($filePath, 'r');
        if (!$handle) {
            throw new \Exception('Failed to open file for batch processing');
        }

        $header = fgetcsv($handle);
        if (!$header) {
            fclose($handle);
            throw new \Exception('Invalid CSV file - no header found');
        }

        $ticketModel = new TicketModel();
        $allowedFields = $ticketModel->getAllowedFields();
        $csvProcessor = new CsvProcessorService();

        $batch = [];
        $batchNumber = 1;
        $totalProcessed = 0;
        $totalFailed = 0;
        $totalLines = $this->estimateRowCount($filePath);
        $totalBatches = ceil($totalLines / $this->config->batchSize);

        while (($row = fgetcsv($handle)) !== false) {
            try {
                $processedRow = $this->processRowWithHeader($row, $header, $allowedFields, $csvProcessor);
                if (!empty($processedRow)) {
                    $batch[] = $processedRow;
                }
            } catch (\Exception $e) {
                $totalFailed++;
                log_message('error', 'Failed to process row: ' . $e->getMessage());
            }

            if (count($batch) >= $this->config->batchSize) {
                $insertedCount = $this->processBatch($batch, $jobId, $batchNumber, $totalBatches);
                $totalProcessed += $insertedCount;

                $batch = [];
                $batchNumber++;

                $this->batchJobModel->updateProgress($jobId, $totalProcessed, $totalFailed);

                if ($batchNumber % 10 === 0) {
                    gc_collect_cycles();
                }
            }
        }

        if (!empty($batch)) {
            $insertedCount = $this->processBatch($batch, $jobId, $batchNumber, $totalBatches);
            $totalProcessed += $insertedCount;
        }

        fclose($handle);

        $this->batchJobModel->updateStatus($jobId, 'completed');
        $this->batchJobModel->updateProgress($jobId, $totalProcessed, $totalFailed);

        if (file_exists($filePath)) {
            unlink($filePath);
            log_message('info', "Cleaned up uploaded file: {$filePath}");
        }

        log_message('info', "Batch processing completed. Total processed: {$totalProcessed}, Failed: {$totalFailed}");
    }

    private function processRowWithHeader($row, $header, $allowedFields, $csvProcessor)
    {
        $cleanRow = [];

        foreach ($row as $i => $value) {
            if (isset($header[$i])) {
                $columnName = $header[$i];

                if (in_array($columnName, $allowedFields)) {
                    $cleanValue = $csvProcessor->cleanValue($value, $columnName);
                    $cleanRow[$columnName] = $cleanValue;
                }
            }
        }

        return $cleanRow;
    }

    private function processBatch($batchData, $jobId, $currentBatch, $totalBatches)
    {
        try {
            $ticketModel = new TicketModel();

            if (!empty($batchData)) {
                $insertedCount = $ticketModel->batchInsert($batchData);
                log_message('info', "Batch {$currentBatch}/{$totalBatches}: Inserted {$insertedCount} records");
                return $insertedCount;
            }

            return 0;
        } catch (\Exception $e) {
            log_message('error', "Batch {$currentBatch} failed: " . $e->getMessage());
            return 0;
        }
    }

    public function getJobStatus($jobId)
    {
        return $this->batchJobModel->getJob($jobId);
    }
}
