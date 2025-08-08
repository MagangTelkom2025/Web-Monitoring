<?= $this->extend('layout/app/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line"></i>
                        Progress Upload CSV
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                            <i class="fas fa-expand"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h5>File sedang diproses, mohon tunggu...</h5>
                    </div>

                    <div class="alert alert-<?= $job['status'] === 'completed' ? 'success' : ($job['status'] === 'failed' ? 'danger' : ($job['status'] === 'processing' ? 'info' : 'warning')) ?>" id="statusContainer">
                        <?php if ($job['status'] === 'processing'): ?>
                            <div class="spinner-border spinner-border-sm me-2" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        <?php endif; ?>
                        <strong><i class="fas fa-info-circle"></i> Status:</strong>
                        <span id="status"><?= ucfirst($job['status']) ?></span>

                        <?php if (!empty($job['error_message'])): ?>
                            <div class="mt-2">
                                <strong><i class="fas fa-exclamation-triangle"></i> Error:</strong>
                                <?= esc($job['error_message']) ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="progress mb-4" style="height: 30px;">
                        <div class="progress-bar progress-bar-striped <?= $job['status'] === 'processing' ? 'progress-bar-animated' : '' ?> <?= $job['status'] === 'completed' ? 'bg-success' : ($job['status'] === 'failed' ? 'bg-danger' : '') ?>"
                            id="progressBar"
                            role="progressbar"
                            style="width: <?= $job['status'] === 'completed' ? '100' : ($job['estimated_rows'] > 0 ? round(($job['processed_rows'] / $job['estimated_rows']) * 100, 2) : 0) ?>%;"
                            aria-valuenow="<?= $job['status'] === 'completed' ? 100 : ($job['estimated_rows'] > 0 ? round(($job['processed_rows'] / $job['estimated_rows']) * 100, 2) : 0) ?>"
                            aria-valuemin="0"
                            aria-valuemax="100">
                            <span id="progressText"><?= $job['status'] === 'completed' ? '100' : ($job['estimated_rows'] > 0 ? round(($job['processed_rows'] / $job['estimated_rows']) * 100) : 0) ?>%</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-info">
                                    <i class="fas fa-file"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Ukuran File</span>
                                    <span class="info-box-number" id="fileSize">
                                        <?= number_format($job['file_size'] / 1024 / 1024, 2) ?> MB
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning">
                                    <i class="fas fa-list"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Estimasi Baris</span>
                                    <span class="info-box-number" id="estimatedRows">
                                        <?= number_format($job['estimated_rows']) ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-success">
                                    <i class="fas fa-check"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Baris Diproses</span>
                                    <span class="info-box-number" id="processedRows">
                                        <?= number_format($job['processed_rows']) ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger">
                                    <i class="fas fa-times"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Baris Gagal</span>
                                    <span class="info-box-number" id="failedRows">
                                        <?= number_format($job['failed_rows']) ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="/ticket" class="btn btn-primary me-2">
                            <i class="fas fa-list"></i>
                            Lihat Data Ticket
                        </a>
                        <a href="/tickets/upload" class="btn btn-outline-primary">
                            <i class="fas fa-upload"></i>
                            Upload Lagi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jobId = <?= $job['id'] ?>;
        let updateInterval;

        function updateProgress() {
            fetch(`/ticket/upload-status/${jobId}`)
                .then(response => response.json())
                .then(data => {
                    const progressBar = document.getElementById('progressBar');
                    const progress = data.estimated_rows > 0 ?
                        Math.min((data.processed_rows / data.estimated_rows) * 100, 100) : 0;

                    progressBar.style.width = progress + '%';
                    progressBar.setAttribute('aria-valuenow', progress);
                    document.getElementById('progressText').textContent = Math.round(progress) + '%';

                    document.getElementById('status').textContent = data.status;
                    document.getElementById('processedRows').textContent = new Intl.NumberFormat('id-ID').format(data.processed_rows);
                    document.getElementById('failedRows').textContent = new Intl.NumberFormat('id-ID').format(data.failed_rows);

                    const container = document.getElementById('statusContainer');
                    let alertClass = 'alert-info';

                    switch (data.status) {
                        case 'completed':
                            alertClass = 'alert-success';
                            progressBar.classList.remove('progress-bar-animated', 'progress-bar-striped');
                            progressBar.classList.add('bg-success');
                            break;
                        case 'failed':
                            alertClass = 'alert-danger';
                            progressBar.classList.remove('progress-bar-animated', 'progress-bar-striped');
                            progressBar.classList.add('bg-danger');
                            break;
                        case 'processing':
                            alertClass = 'alert-info';
                            break;
                        default:
                            alertClass = 'alert-warning';
                    }

                    container.className = 'alert ' + alertClass;

                    if (data.status === 'completed') {
                        clearInterval(updateInterval);
                        progressBar.style.width = '100%';
                        progressBar.setAttribute('aria-valuenow', 100);
                        document.getElementById('progressText').textContent = '100%';
                        container.innerHTML = '<strong><i class="fas fa-check-circle"></i> Status:</strong> Upload berhasil diselesaikan!';

                        Swal.fire({
                            icon: 'success',
                            title: 'Upload Selesai!',
                            text: 'Data berhasil diupload ke sistem.',
                            showCancelButton: true,
                            confirmButtonText: 'Lihat Daftar Ticket',
                            cancelButtonText: 'Tetap di Sini',
                            confirmButtonColor: '#28a745'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/ticket';
                            }
                        });
                    } else if (data.status === 'failed') {
                        clearInterval(updateInterval);
                        container.innerHTML = '<strong><i class="fas fa-exclamation-circle"></i> Status:</strong> Upload gagal - ' + (data.error_message || 'Terjadi kesalahan');
                    }
                })
                .catch(error => {
                    console.error('Error updating progress:', error);
                });
        }

        if ('<?= $job['status'] ?>' === 'processing' || '<?= $job['status'] ?>' === 'pending') {
            updateInterval = setInterval(updateProgress, 3000);
            updateProgress();
        }
    });
</script>

<?= $this->endSection() ?>