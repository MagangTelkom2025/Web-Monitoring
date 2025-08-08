<?= $this->extend('layout/app/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-cloud-upload-alt"></i>
                        Upload File CSV Ticket
                    </h3>
                    <div class="card-tools">
                        <a href="/ticket" class="btn btn-outline-primary btn-sm me-2">
                            <i class="fas fa-list"></i>
                            Lihat Data Ticket
                        </a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                            <i class="fas fa-expand"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-light border">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            <div>
                                <strong>Upload CSV ke Sistem</strong><br>
                                <small class="text-muted">Halaman ini khusus untuk mengupload file CSV ticket. Setelah upload selesai, data dapat dilihat di halaman "Data Ticket".</small>
                            </div>
                        </div>
                    </div>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i>
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i>
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <div class="alert alert-info">
                        <h5><i class="fas fa-info-circle"></i> Informasi Upload:</h5>
                        <ul class="mb-0">
                            <li>File maksimal <strong>1GB</strong></li>
                            <li>File harus berformat <strong>CSV</strong></li>
                            <li>File besar (>10MB) akan diproses secara <strong>batch</strong></li>
                            <li>Anda akan mendapat notifikasi progress untuk file besar</li>
                        </ul>
                    </div>

                    <form action="/tickets/upload" method="post" enctype="multipart/form-data" id="uploadForm">
                        <div class="mb-3">
                            <label for="file" class="form-label">
                                <i class="fas fa-file-csv"></i>
                                Pilih File CSV:
                            </label>
                            <input type="file" class="form-control" name="file" id="file" accept=".csv" required>
                            <div class="form-text">Pilih file CSV yang akan diupload ke sistem</div>
                        </div>

                        <div class="card mt-3" id="fileInfo" style="display: none;">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <i class="fas fa-file-alt"></i>
                                    Informasi File
                                </h6>
                                <div id="fileName" class="mb-2"></div>
                                <div id="fileSize" class="mb-2"></div>
                                <div id="processingType"></div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                <span id="submitText">
                                    <i class="fas fa-upload"></i>
                                    Upload File
                                </span>
                                <span id="loadingText" style="display: none;">
                                    <i class="fas fa-spinner fa-spin"></i>
                                    Uploading...
                                </span>
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <small class="text-muted">
                            <i class="fas fa-info-circle"></i>
                            Setelah upload selesai, data dapat dilihat di halaman "Data Ticket"
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('file');
        const fileInfo = document.getElementById('fileInfo');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        const processingType = document.getElementById('processingType');
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const loadingText = document.getElementById('loadingText');
        const uploadForm = document.getElementById('uploadForm');

        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (file) {
                fileInfo.style.display = 'block';
                fileName.innerHTML = '<strong><i class="fas fa-file"></i> File:</strong> ' + file.name;

                const sizeInMB = (file.size / 1024 / 1024).toFixed(2);
                fileSize.innerHTML = '<strong><i class="fas fa-hdd"></i> Ukuran:</strong> ' + sizeInMB + ' MB';

                if (file.size > 10 * 1024 * 1024) { // > 10MB
                    processingType.innerHTML = '<strong><i class="fas fa-cogs"></i> Metode:</strong> <span class="badge bg-primary">Batch Processing (Background)</span>';
                } else {
                    processingType.innerHTML = '<strong><i class="fas fa-bolt"></i> Metode:</strong> <span class="badge bg-success">Direct Processing</span>';
                }

                // Validate file size (1GB limit)
                if (file.size > 1024 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Terlalu Besar!',
                        text: 'File maksimal 1GB.',
                        confirmButtonColor: '#dc3545'
                    });
                    fileInput.value = '';
                    fileInfo.style.display = 'none';
                }

                // Validate file type
                if (!file.name.toLowerCase().endsWith('.csv')) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Format File Salah!',
                        text: 'File harus berformat CSV!',
                        confirmButtonColor: '#dc3545'
                    });
                    fileInput.value = '';
                    fileInfo.style.display = 'none';
                }
            } else {
                fileInfo.style.display = 'none';
            }
        });

        uploadForm.addEventListener('submit', function(e) {
            const file = fileInput.files[0];

            if (!file) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Pilih File!',
                    text: 'Pilih file CSV terlebih dahulu!',
                    confirmButtonColor: '#ffc107'
                });
                return;
            }

            // Show loading state
            submitBtn.disabled = true;
            submitText.style.display = 'none';
            loadingText.style.display = 'inline';

            // For large files, change text
            if (file.size > 10 * 1024 * 1024) {
                loadingText.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memulai batch processing...';
            }
        });
    });
</script>

<?= $this->endSection() ?>