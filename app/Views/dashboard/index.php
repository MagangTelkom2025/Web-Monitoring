<?= $this->extend('layout/app/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="row">
        <div class="col-12">
            <!-- Main Welcome Header -->
            <div class="mb-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="mb-1 fw-bold text-dark">
                            Selamat Datang di Web Monitoring Telkom
                        </h2>
                        <p class="text-muted mb-0">
                            Halo <strong class="text-dark"><?= esc($username) ?></strong>! Platform monitoring untuk mengelola data ticket service dengan mudah dan efisien
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="text-muted">
                            <small class="d-block">
                                <i class="fas fa-calendar-day me-1"></i>
                                <?= $current_date ?>
                            </small>
                            <small class="d-block">
                                <i class="fas fa-clock me-1"></i>
                                <?= $current_time ?> WIB
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border h-100">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-cloud-upload-alt fa-3x text-dark"></i>
                    </div>
                    <h5 class="card-title fw-semibold text-dark mb-2">Upload Data CSV</h5>
                    <p class="card-text text-muted mb-3">Upload file CSV ticket untuk diproses ke dalam sistem monitoring</p>
                    <a href="/tickets/upload" class="btn btn-dark btn-sm">
                        <i class="fas fa-upload me-2"></i>Upload CSV
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border h-100">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-table fa-3x text-dark"></i>
                    </div>
                    <h5 class="card-title fw-semibold text-dark mb-2">Data Monitoring</h5>
                    <p class="card-text text-muted mb-3">Lihat dan kelola semua data ticket yang telah diupload</p>
                    <a href="/ticket" class="btn btn-dark btn-sm">
                        <i class="fas fa-eye me-2"></i>Lihat Data
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border h-100">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-chart-bar fa-3x text-muted"></i>
                    </div>
                    <h5 class="card-title fw-semibold text-dark mb-2">Report & Analytics</h5>
                    <p class="card-text text-muted mb-3">Analisis data dan laporan performa layanan customer</p>
                    <button class="btn btn-outline-secondary btn-sm" disabled>
                        <i class="fas fa-chart-line me-2"></i>Coming Soon
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border h-100">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-cogs fa-3x text-muted"></i>
                    </div>
                    <h5 class="card-title fw-semibold text-dark mb-2">Settings</h5>
                    <p class="card-text text-muted mb-3">Konfigurasi sistem dan pengaturan pengguna</p>
                    <button class="btn btn-outline-secondary btn-sm" disabled>
                        <i class="fas fa-cog me-2"></i>Coming Soon
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Information Cards -->
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card border">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="card-title mb-0 fw-semibold text-dark">
                        <i class="fas fa-info-circle me-2"></i>
                        Tentang Sistem
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="fw-semibold text-dark mb-3">Fitur Utama:</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-check text-dark me-2"></i>
                                    <span class="text-dark">Upload CSV file hingga 1GB</span>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-dark me-2"></i>
                                    <span class="text-dark">Batch processing untuk file besar</span>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-dark me-2"></i>
                                    <span class="text-dark">Real-time progress tracking</span>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-dark me-2"></i>
                                    <span class="text-dark">Advanced data filtering & search</span>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-dark me-2"></i>
                                    <span class="text-dark">Server-side data processing</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-semibold text-dark mb-3">Format Data:</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-file-csv text-dark me-2"></i>
                                    <span class="text-dark">CSV format</span>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-database text-dark me-2"></i>
                                    <span class="text-dark">Data ticket service</span>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-users text-dark me-2"></i>
                                    <span class="text-dark">Customer information</span>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-map-marker-alt text-dark me-2"></i>
                                    <span class="text-dark">Regional data (Witel)</span>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-tags text-dark me-2"></i>
                                    <span class="text-dark">Category & Status</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="card-title mb-0 fw-semibold text-dark">
                        <i class="fas fa-question-circle me-2"></i>
                        Bantuan
                    </h5>
                </div>
                <div class="card-body p-4">
                    <p class="mb-3 text-dark">Butuh bantuan menggunakan sistem ini?</p>
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-secondary btn-sm" disabled>
                            <i class="fas fa-book me-2"></i>Panduan User
                        </button>
                        <button class="btn btn-outline-secondary btn-sm" disabled>
                            <i class="fas fa-video me-2"></i>Video Tutorial
                        </button>
                        <button class="btn btn-outline-secondary btn-sm" disabled>
                            <i class="fas fa-headset me-2"></i>Support Team
                        </button>
                    </div>
                    <hr class="my-3">
                    <small class="text-muted">
                        <i class="fas fa-code me-1"></i>
                        Web Monitoring System v1.0<br>
                        <i class="fas fa-calendar me-1"></i>
                        © 2025 Telkom Indonesia
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update waktu setiap menit
        setInterval(function() {
            const now = new Date();
            const time = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                timeZone: 'Asia/Jakarta'
            });
            const timeElement = document.querySelector('[data-time]');
            if (timeElement) {
                timeElement.textContent = time + ' WIB';
            }
        }, 60000);

        // Initialize tooltips
        if (typeof bootstrap !== 'undefined') {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }
    });
</script>

<?= $this->endSection() ?>