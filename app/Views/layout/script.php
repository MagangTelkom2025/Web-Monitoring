<!--   Core JS Files   -->
<script src="<?php echo base_url('assets/js/core/popper.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/core/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/perfect-scrollbar.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/smooth-scrollbar.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/chartjs.min.js'); ?>"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>

<script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll,
                },
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('fileInput');
        const dropZone = document.getElementById('dropZone');
        const dropZoneContent = document.getElementById('dropZoneContent');
        const fileInfo = document.getElementById('fileInfo');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        const uploadBtn = document.getElementById('uploadBtn');
        const uploadForm = document.getElementById('uploadForm');
        const uploadBtnText = document.getElementById('uploadBtnText');
        const uploadSpinner = document.getElementById('uploadSpinner');
        const progressContainer = document.getElementById('progressContainer');
        const progressBar = document.getElementById('progressBar');
        const progressPercent = document.getElementById('progressPercent');

        // File input change handler
        fileInput.addEventListener('change', function(e) {
            handleFile(e.target.files[0]);
        });

        // Drag and drop handlers
        dropZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            dropZone.classList.add('dragover');
        });

        dropZone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            dropZone.classList.remove('dragover');
        });

        dropZone.addEventListener('drop', function(e) {
            e.preventDefault();
            dropZone.classList.remove('dragover');

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                handleFile(files[0]);
            }
        });

        function handleFile(file) {
            if (file) {
                // Validate file type
                if (!file.name.toLowerCase().endsWith('.csv')) {
                    alert('Please select a CSV file.');
                    return;
                }

                // Validate file size (10MB)
                // if (file.size > 10 * 1024 * 1024) {
                //   alert('File size must be less than 10MB.');
                // return;
                //}

                // Show file info with animation
                dropZoneContent.style.display = 'none';
                fileInfo.classList.remove('d-none');
                fileName.textContent = file.name;
                fileSize.textContent = formatFileSize(file.size);
                uploadBtn.disabled = false;
            }
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Form submit handler with progress simulation
        uploadForm.addEventListener('submit', function(e) {
            uploadBtnText.classList.add('d-none');
            uploadSpinner.classList.remove('d-none');
            uploadBtn.disabled = true;
            progressContainer.classList.remove('d-none');

            // Simulate progress
            let progress = 0;
            const interval = setInterval(() => {
                progress += Math.random() * 15;
                if (progress > 95) progress = 95;

                progressBar.style.width = progress + '%';
                progressPercent.textContent = Math.round(progress);

                if (progress >= 95) {
                    clearInterval(interval);
                }
            }, 200);
        });

        // Global functions
        window.resetForm = function() {
            fileInput.value = '';
            dropZoneContent.style.display = 'block';
            fileInfo.classList.add('d-none');
            uploadBtn.disabled = true;
            uploadBtnText.classList.remove('d-none');
            uploadSpinner.classList.add('d-none');
            progressContainer.classList.add('d-none');
            progressBar.style.width = '0%';
            progressPercent.textContent = '0';
        }

        window.refreshHistory = function() {
            // Add refresh functionality here
            console.log('Refreshing history...');
        }
    });
</script>
<!--end::OverlayScrollbars Configure-->

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?php echo base_url('assets/js/material-dashboard.min.js?v=3.2.0'); ?>"></script>


<!--end::Script-->