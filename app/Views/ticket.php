<?= $this->extend('layout/app/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Welcome Section -->
            <div class="mb-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="mb-1 fw-bold text-dark">Data Monitoring Ticket</h2>
                        <p class="text-muted mb-0">Kelola dan pantau data monitoring dengan mudah dan efisien</p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="d-flex flex-wrap gap-2 justify-content-md-end">
                            <a href="/tickets/upload" class="btn btn-dark btn-sm">
                                <i class="fas fa-upload me-2"></i>Upload Data
                            </a>
                            <button type="button" class="btn btn-outline-dark btn-sm" id="refreshData">
                                <i class="fas fa-sync-alt me-2" id="refreshIcon"></i>
                                <span id="refreshText">Refresh</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class="card border">
                <div class="card-header bg-white border-bottom py-3">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="card-title mb-0 fw-semibold text-dark">Tabel Data Monitoring</h5>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <small class="text-muted">Data terbaru akan dimuat secara otomatis</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show border mx-3 mt-3" role="alert">
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show border mx-3 mt-3" role="alert">
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Loading indicator -->
                    <div id="loadingIndicator" class="text-center py-5" style="display: none;">
                        <div class="spinner-border text-dark" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="mt-3">
                            <p class="text-dark mb-0 fw-medium">Memuat Data Monitoring</p>
                            <small class="text-muted">Mohon tunggu sebentar...</small>
                        </div>
                    </div>

                    <!-- Table Container -->
                    <div class="table-responsive p-3">
                        <table class="table table-hover mb-0 align-middle" id="ticketTable">
                            <thead>
                                <tr>
                                    <th class="fw-semibold text-dark py-3 px-3 border-bottom" style="width: 20%;">TANGGAL MULAI</th>
                                    <th class="fw-semibold text-dark py-3 px-3 border-bottom" style="width: 25%;">KATEGORI UTAMA</th>
                                    <th class="fw-semibold text-dark py-3 px-3 border-bottom" style="width: 35%;">KATEGORI</th>
                                    <th class="fw-semibold text-dark py-3 px-3 border-bottom" style="width: 25%;">WITEL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data akan dimuat via AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize DataTable with server-side processing
        if (typeof $ !== 'undefined' && typeof $.fn.DataTable === 'function') {
            const table = document.getElementById('ticketTable');

            if (table) {
                // Show loading indicator initially
                document.getElementById('loadingIndicator').style.display = 'block';

                $('#ticketTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '/ticket/datatable',
                        type: 'POST',
                        error: function(xhr, error, thrown) {
                            console.error('DataTables AJAX error:', error, thrown);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Loading Data',
                                text: 'Failed to load ticket data. Please refresh the page.',
                                confirmButtonText: 'Refresh',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        }
                    },
                    columns: [{
                            data: 'date_start_interaction',
                            name: 'date_start_interaction',
                            title: 'TANGGAL MULAI'
                        },
                        {
                            data: 'mainCategory',
                            name: 'mainCategory',
                            title: 'KATEGORI UTAMA'
                        },
                        {
                            data: 'category',
                            name: 'category',
                            title: 'KATEGORI'
                        },
                        {
                            data: 'witel',
                            name: 'witel',
                            title: 'WITEL'
                        }
                    ],
                    responsive: true,
                    autoWidth: false,
                    lengthChange: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    paging: true,
                    pageLength: 25,
                    lengthMenu: [
                        [10, 25, 50, 100],
                        [10, 25, 50, 100]
                    ],
                    dom: 'lfrtip', // Remove 'B' for buttons
                    language: {
                        search: "Cari:",
                        searchPlaceholder: "Cari data monitoring...",
                        lengthMenu: "Tampilkan _MENU_ data per halaman",
                        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        infoEmpty: "Tidak ada data tersedia",
                        infoFiltered: "(difilter dari _MAX_ total data)",
                        paginate: {
                            first: "Pertama",
                            last: "Terakhir",
                            next: "Selanjutnya",
                            previous: "Sebelumnya"
                        },
                        emptyTable: "Tidak ada data monitoring tersedia",
                        zeroRecords: "Tidak ada data yang cocok dengan pencarian",
                        processing: '<div class="d-flex justify-content-center align-items-center py-3"><div class="spinner-border text-dark me-3" role="status"></div><span class="text-dark">Memuat data...</span></div>',
                        loadingRecords: "Memuat data monitoring..."
                    },
                    order: [
                        [0, 'desc']
                    ], // Sort by date descending
                    initComplete: function() {
                        // Hide loading indicator when table is initialized
                        document.getElementById('loadingIndicator').style.display = 'none';
                    },
                    drawCallback: function() {
                        // Re-initialize tooltips after each draw
                        if (typeof bootstrap !== 'undefined') {
                            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                                return new bootstrap.Tooltip(tooltipTriggerEl);
                            });
                        }
                        // Hide loading indicator
                        document.getElementById('loadingIndicator').style.display = 'none';
                    },
                    preDrawCallback: function() {
                        // Show consistent loading when sorting/filtering
                        const loadingIndicator = document.getElementById('loadingIndicator');
                        if (loadingIndicator) {
                            loadingIndicator.style.display = 'block';
                            loadingIndicator.innerHTML = `
                                <div class="d-flex justify-content-center align-items-center py-3">
                                    <div class="spinner-border spinner-border-sm text-dark me-3" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <span class="text-muted">Memuat data...</span>
                                </div>
                            `;
                        }
                        return true;
                    }
                });

                // Add click event listeners for table headers to show consistent loading
                $('#ticketTable thead th').on('click', function() {
                    // Check if this column is sortable
                    if ($(this).hasClass('sorting') || $(this).hasClass('sorting_asc') || $(this).hasClass('sorting_desc')) {
                        // Show loading indicator with consistent styling
                        const loadingIndicator = document.getElementById('loadingIndicator');
                        if (loadingIndicator) {
                            loadingIndicator.style.display = 'block';
                            loadingIndicator.innerHTML = `
                                <div class="d-flex justify-content-center align-items-center py-3">
                                    <div class="spinner-border spinner-border-sm text-dark me-3" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <span class="text-muted">Mengurutkan data...</span>
                                </div>
                            `;
                        }
                    }
                });

                // Add event listener for search to show consistent loading
                $('#ticketTable_filter input').on('keyup', function() {
                    const loadingIndicator = document.getElementById('loadingIndicator');
                    if (loadingIndicator && this.value.length > 0) {
                        loadingIndicator.style.display = 'block';
                        loadingIndicator.innerHTML = `
                            <div class="d-flex justify-content-center align-items-center py-3">
                                <div class="spinner-border spinner-border-sm text-dark me-3" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <span class="text-muted">Mencari data...</span>
                            </div>
                        `;
                    }
                });

                // Add event listener for pagination to show consistent loading
                $('#ticketTable').on('page.dt', function() {
                    const loadingIndicator = document.getElementById('loadingIndicator');
                    if (loadingIndicator) {
                        loadingIndicator.style.display = 'block';
                        loadingIndicator.innerHTML = `
                            <div class="d-flex justify-content-center align-items-center py-3">
                                <div class="spinner-border spinner-border-sm text-dark me-3" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <span class="text-muted">Memuat halaman...</span>
                            </div>
                        `;
                    }
                });
            }
        } else {
            console.log('DataTables library not loaded');
        }

        // Refresh functionality with smooth animation
        document.getElementById('refreshData')?.addEventListener('click', function() {
            const button = this;
            const icon = document.getElementById('refreshIcon');
            const text = document.getElementById('refreshText');

            // Disable button to prevent multiple clicks
            button.disabled = true;
            button.classList.add('disabled');

            // Add spinning animation to icon
            icon.classList.add('fa-spin');
            text.textContent = 'Memuat...';

            // Show gentle loading indicator
            const loadingIndicator = document.getElementById('loadingIndicator');
            if (loadingIndicator) {
                loadingIndicator.style.display = 'block';
                loadingIndicator.innerHTML = `
                    <div class="d-flex justify-content-center align-items-center py-3">
                        <div class="spinner-border spinner-border-sm text-dark me-3" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <span class="text-muted">Memperbarui data...</span>
                    </div>
                `;
            }

            if (typeof $ !== 'undefined' && $.fn.DataTable.isDataTable('#ticketTable')) {
                $('#ticketTable').DataTable().ajax.reload(function() {
                    // Success callback - restore button state
                    setTimeout(() => {
                        button.disabled = false;
                        button.classList.remove('disabled');
                        icon.classList.remove('fa-spin');
                        text.textContent = 'Refresh';

                        if (loadingIndicator) {
                            loadingIndicator.style.display = 'none';
                        }

                        // Show subtle success feedback
                        showRefreshFeedback('success', 'Data berhasil diperbarui');
                    }, 500); // Small delay for smooth transition
                }, false);
            } else {
                // Fallback to page reload with delay
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }
        });

        // Function to show refresh feedback
        function showRefreshFeedback(type, message) {
            const feedback = document.createElement('div');
            feedback.className = `alert alert-${type === 'success' ? 'success' : 'info'} alert-dismissible fade show position-fixed`;
            feedback.style.cssText = `
                top: 20px; 
                right: 20px; 
                z-index: 1055; 
                min-width: 300px;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                border: none;
            `;
            feedback.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;

            document.body.appendChild(feedback);

            // Auto remove after 3 seconds
            setTimeout(() => {
                if (feedback.parentNode) {
                    feedback.remove();
                }
            }, 3000);
        }

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