<?php

namespace App\Services;

use App\Config\CsvConfig;

class CsvProcessorService
{
    private $config;

    public function __construct()
    {
        $this->config = new CsvConfig();
    }

    public function processFile($filePath)
    {
        if (!file_exists($filePath)) {
            throw new \InvalidArgumentException('File tidak ditemukan: ' . $filePath);
        }

        $handle = fopen($filePath, 'r');

        if ($handle === false) {
            throw new \Exception('Gagal membaca file CSV!');
        }

        $header = fgetcsv($handle);

        if ($header === false || empty($header)) {
            fclose($handle);
            throw new \InvalidArgumentException('File CSV tidak memiliki header yang valid');
        }

        $processedData = [];
        $lineNumber = 1;

        while (($row = fgetcsv($handle)) !== false) {
            $lineNumber++;
            try {
                $processedData[] = $this->processRow($row, $header);
            } catch (\Exception $e) {
                log_message('warning', "Error processing CSV line {$lineNumber}: " . $e->getMessage());
            }
        }

        fclose($handle);
        return $processedData;
    }

    private function processRow($row, $header)
    {
        $cleanRow = [];
        $ticketModel = new \App\Models\TicketModel();
        $allowedFields = $ticketModel->getAllowedFields();

        foreach ($row as $i => $value) {
            if (isset($header[$i])) {
                $columnName = $header[$i];

                if (in_array($columnName, $allowedFields)) {
                    $cleanValue = $this->cleanValue($value, $columnName);
                    $cleanRow[$columnName] = $cleanValue;
                }
            }
        }

        return $cleanRow;
    }

    // Public method for BatchProcessor
    public function cleanValue($value, $columnName)
    {
        if ($value === null || $value === '') return '';

        $value = trim($value, "'\"");
        $value = trim($value);

        if ($columnName === 'ticket_id') {
            $value = str_replace(',', '', $value);
            $value = preg_replace('/\.0$/', '', $value);
            return $value;
        }

        if (preg_match('/^\d{1,3}(,\d{3})*(\.\d+)?$/', $value)) {
            $value = str_replace(',', '', $value);
        }

        if (preg_match('/^\d+\.0$/', $value)) {
            $value = preg_replace('/\.0$/', '', $value);
        }

        if (in_array($columnName, $this->config->bigIntColumns) && $value === '0') {
            return '-';
        }

        return $this->convertDateTime($value);
    }

    private function convertDateTime($value)
    {
        if (preg_match('/^\d{1,2}[\/\.\-]\d{1,2}[\/\.\-]\d{2,4}\s+\d{1,2}[\.\:]\d{1,2}[\.\:]\d{1,2}$/', $value)) {
            $cleanValue = preg_replace('/(\d{1,2})\.(\d{1,2})\.(\d{1,2})$/', '$1:$2:$3', $value);
            $cleanValue = preg_replace('/[\.\-]/', '/', $cleanValue);

            $formats = $this->config->dateFormats['datetime'];

            foreach ($formats as $format) {
                $dateTime = date_create_from_format($format, $cleanValue);
                if ($dateTime) {
                    return $dateTime->format('Y-m-d H:i:s');
                }
            }
        } elseif (preg_match('/^\d{1,2}[\/\.\-]\d{1,2}[\/\.\-]\d{2,4}$/', $value)) {
            $cleanDate = str_replace(['.', '-'], '/', $value);
            $formats = $this->config->dateFormats['date'];

            foreach ($formats as $format) {
                $date = date_create_from_format($format, $cleanDate);
                if ($date) {
                    return $date->format('Y-m-d');
                }
            }
        }

        return $value;
    }
}
