<?= $this->extend('layout/app/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-primary">
                <i class="bi bi-cloud-upload-fill me-2"></i>Upload Absen Manager
            </h1>
            <p class="text-muted mb-0">Kelola file CSV absen dengan mudah</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 bg-light px-3 py-2 rounded">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('absen') ?>" class="text-decoration-none">
                        <i class="bi bi-house-fill"></i> Absen
                    </a>
                </li>
                <li class="breadcrumb-item active">Upload</li>
            </ol>
        </nav>
    </div>

    <div class="row g-4">
        <!-- Upload Section (Left Side - 60%) -->
        <div class="col-lg-7">
            <div class="card h-100 shadow-md border-0">
                <div class="card-header bg-light border-0">
                    <h5 class="card-title mb-0 text-black">
                        <i class="bi bi-upload me-2"></i>Upload File CSV
                    </h5>
                </div>

                <div class="card-body">
                    <!-- Flash Messages -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Upload Form -->
                    <form action="<?= base_url('absen/uploadaux') ?>" method="post" enctype="multipart/form-data" id="uploadForm">
                        <?= csrf_field() ?>

                        <!-- Progress Bar (Hidden by default) -->
                        <div id="progressContainer" class="mb-4 d-none">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <small class="text-muted">Progress Upload</small>
                                <small class="text-muted"><span id="progressPercent">0</span>%</small>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div id="progressBar" class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                    role="progressbar" style="width: 0%"></div>
                            </div>
                        </div>

                        <!-- File Drop Zone -->
                        <div class="mb-4">
                            <div class="upload-zone border-2 border-dashed rounded-4 p-5 text-center position-relative"
                                id="dropZone" style="border-color: #e9ecef; transition: all 0.3s ease; background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);">

                                <input type="file"
                                    name="file"
                                    id="fileInput"
                                    accept=".csv"
                                    required
                                    class="position-absolute w-100 h-100 opacity-0"
                                    style="cursor: pointer; top: 0; left: 0;">

                                <div id="dropZoneContent">
                                    <div class="upload-icon mb-3">
                                        <i class="bi bi-cloud-upload text-primary" style="font-size: 4rem; opacity: 0.7;"></i>
                                    </div>
                                    <h4 class="text-dark mb-2">Drag & Drop File CSV</h4>
                                    <p class="text-muted mb-3">atau <span class="text-primary fw-semibold">klik untuk memilih file</span></p>
                                    <div class="upload-specs">
                                        <span class="badge bg-light text-dark me-2">
                                            <i class="bi bi-file-earmark-text me-1"></i>CSV Only
                                        </span>
                                        <span class="badge bg-light text-dark">
                                            <i class="bi bi-hdd me-1"></i>Max 10MB
                                        </span>
                                    </div>
                                </div>

                                <div id="fileInfo" class="d-none">
                                    <div class="text-success mb-3">
                                        <i class="bi bi-file-earmark-check" style="font-size: 3rem;"></i>
                                    </div>
                                    <h5 class="text-success mb-2" id="fileName"></h5>
                                    <p class="text-muted mb-3" id="fileSize"></p>
                                    <div class="file-details">
                                        <span class="badge bg-success-subtle text-success">
                                            <i class="bi bi-check-circle me-1"></i>Ready to Upload
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Upload Actions -->
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary btn-lg flex-fill" id="uploadBtn" disabled>
                                <span id="uploadBtnText">
                                    <i class="bi bi-upload me-2"></i>Upload File
                                </span>
                                <span id="uploadSpinner" class="d-none">
                                    <span class="spinner-border spinner-border-sm me-2"></span>
                                    Uploading...
                                </span>
                            </button>
                            <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </div>
                    </form>

                    <!-- File Requirements -->
                    <div class="mt-4 pt-4 border-top">
                        <h6 class="text-muted mb-3">
                            <i class="bi bi-info-circle-fill me-2"></i>Persyaratan File
                        </h6>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 32px; height: 32px;">
                                            <i class="bi bi-file-earmark-text"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 text-dark">Format CSV</h6>
                                        <small class="text-muted">Ekstensi .csv</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 32px; height: 32px;">
                                            <i class="bi bi-hdd"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 text-dark">Max 10MB</h6>
                                        <small class="text-muted">Ukuran file</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 p-3 bg-light rounded">
                            <small class="text-muted">
                                <strong>Kolom yang diperlukan:</strong> Date Start Interaction, Main Category, Category, Witel
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- History Section (Right Side - 40%) -->
        <div class="col-lg-5">
            <div class="card h-100 shadow-md border-0">
                <div class="card-header bg-light border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 text-dark">
                            <i class="bi bi-clock-history me-2"></i>History Upload
                        </h5>
                        <button class="btn btn-sm btn-outline-secondary" onclick="refreshHistory()">
                            <i class="bi bi-arrow-clockwise"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body p-0">
                    <!-- Stats Cards -->
                    <div class="p-3 border-bottom bg-gradient" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                        <div class="row g-3">
                            <div class="col-4 text-center">
                                <div class="text-primary h4 mb-1">12</div>
                                <small class="text-muted">Total Upload</small>
                            </div>
                            <div class="col-4 text-center">
                                <div class="text-success h4 mb-1">10</div>
                                <small class="text-muted">Berhasil</small>
                            </div>
                            <div class="col-4 text-center">
                                <div class="text-danger h4 mb-1">2</div>
                                <small class="text-muted">Gagal</small>
                            </div>
                        </div>
                    </div>

                    <!-- History List -->
                    <div class="history-list" style="max-height: 400px; overflow-y: auto;">
                        <!-- Sample History Items -->
                        <div class="history-item p-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                                            style="width: 24px; height: 24px; font-size: 10px;">
                                            <i class="bi bi-check"></i>
                                        </div>
                                        <h6 class="mb-0 text-truncate">absen_data_2025.csv</h6>
                                    </div>
                                    <div class="text-muted small">
                                        <i class="bi bi-calendar3 me-1"></i>15 Agu 2025, 14:30
                                    </div>
                                    <div class="text-muted small">
                                        <i class="bi bi-database me-1"></i>1,245 records
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>Detail</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>Download</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="history-item p-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                                            style="width: 24px; height: 24px; font-size: 10px;">
                                            <i class="bi bi-x"></i>
                                        </div>
                                        <h6 class="mb-0 text-truncate">invalid_format.csv</h6>
                                    </div>
                                    <div class="text-muted small">
                                        <i class="bi bi-calendar3 me-1"></i>14 Agu 2025, 09:15
                                    </div>
                                    <div class="text-danger small">
                                        <i class="bi bi-exclamation-triangle me-1"></i>Format tidak valid
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>Detail</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-arrow-clockwise me-2"></i>Retry</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="history-item p-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                                            style="width: 24px; height: 24px; font-size: 10px;">
                                            <i class="bi bi-check"></i>
                                        </div>
                                        <h6 class="mb-0 text-truncate">monthly_report_juli.csv</h6>
                                    </div>
                                    <div class="text-muted small">
                                        <i class="bi bi-calendar3 me-1"></i>13 Agu 2025, 16:45
                                    </div>
                                    <div class="text-muted small">
                                        <i class="bi bi-database me-1"></i>852 records
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>Detail</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>Download</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- View All History -->
                    <div class="p-3 text-center border-top bg-light">
                        <a href="#" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye me-1"></i>Lihat Semua History
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>