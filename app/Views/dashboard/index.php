<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4 py-6">
    <div class="row">
        <div class="col-12">
            <h1 class="text-2xl font-bold text-[#1b0e0e] mb-4">Dashboard</h1>
            <div class="bg-white rounded-lg shadow-sm p-6">
                <p class="text-gray-600">Welcome to the Telkom Monitor Dashboard</p>

                <!-- Interactive Charts Section -->
                <?= $this->include('dashboard/charts') ?>

                <!-- Filters Section -->
                <?= $this->include('dashboard/filters') ?>

                <!-- Ticket Table Section -->
                <?= $this->include('dashboard/ticket_table') ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Chart.js CDN dengan versi spesifik -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

<!-- Script debugging untuk chart -->
<script>
    // Cek status Chart.js
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM fully loaded');
        if (typeof Chart === 'undefined') {
            console.error('Chart.js tidak dimuat dengan benar');

            // Coba muat Chart.js secara manual jika gagal
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js';
            script.onload = function() {
                console.log('Chart.js berhasil dimuat secara manual');
                if (typeof initCharts === 'function') {
                    initCharts();
                }
            };
            document.head.appendChild(script);
        } else {
            console.log('Chart.js berhasil dimuat dengan versi:', Chart.version);
            // Inisialisasi chart ketika DOM sudah siap
            if (typeof initCharts === 'function') {
                setTimeout(initCharts, 100);
            }
        }
    });
</script>

<!-- Include chart_scripts setelah debugging script -->
<?= $this->include('dashboard/chart_scripts') ?>
<?= $this->endSection() ?>