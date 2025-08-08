<?php

namespace App\Config;

use CodeIgniter\Config\BaseConfig;

class CsvConfig extends BaseConfig
{
    public $bigIntColumns = ['priority_id'];

    public $maxFileSize = 1024 * 1024 * 1024; // 1GB

    public $allowedExtensions = ['csv'];

    // Batch processing settings
    public $batchSize = 1000; // Process 1000 rows per batch
    public $chunkSize = 8192; // 8KB chunks for file reading
    public $maxExecutionTime = 300; // 5 minutes per batch
    public $memoryLimit = '512M';
    public $largFileThreshold = 10 * 1024 * 1024; // 10MB threshold for batch processing (lowered from 50MB)

    public $dateFormats = [
        'datetime' => ['d/m/Y H:i:s', 'm/d/Y H:i:s', 'd/m/y H:i:s', 'm/d/y H:i:s'],
        'date' => ['d/m/Y', 'm/d/Y', 'd/m/y', 'm/d/y']
    ];
}
