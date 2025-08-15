<?= $this->extend('layout/app/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Absen</h1>
        <?php if (session()->get('role') === 'admin'): ?>
            <button class="btn btn-danger" onclick="window.location.href='<?= base_url('absen/upload') ?>'">
                Upload
            </button>
        <?php endif; ?>
    </div>

    <!-- Grafik Absen Valid -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h5>Valid Absen by Witel</h5>
            <canvas id="chartByWitel" height="150"></canvas>
        </div>
        <div class="col-md-6">
            <h5>Valid Absen by Main Category</h5>
            <canvas id="chartByMainCategory" height="150"></canvas>
        </div>
    </div>

    <!-- Filter -->
    <div class="row mb-3">
        <div class="col-md-3">
            <input type="date" id="dateFilter" class="form-control">
        </div>
        <div class="col-md-3">
            <select id="witelFilter" class="form-select">
                <option value="">-- Pilih Witel --</option>
                <!-- <option value="Witel 1">Witel 1</option>
                <option value="Witel 2">Witel 2</option>
                <option value="Witel 3">Witel 3</option> -->
            </select>
        </div>
    </div>

    <!-- Tabel AUX -->
    <h5>Tabel AUX</h5>
    <table id="auxTable" class="table table-bordered mb-5">
        <thead>
            <tr>
                <th>Waktu</th>
                <th>Nama</th>
                <th>State</th>
                <th>Reason</th>
            </tr>
        </thead>
        <tbody>
            <!-- Contoh data statis -->
            <!-- <tr>
                <td>08:00</td>
                <td>Budi</td>
                <td>Break</td>
                <td>Rest</td>
            </tr>
            <tr>
                <td>09:15</td>
                <td>Ani</td>
                <td>Available</td>
                <td>-</td>
            </tr> -->
        </tbody>
    </table>

    <!-- Tabel Agent Status -->
    <h5>Tabel Agent Status</h5>
    <table id="agentStatusTable" class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Channel</th>
                <th>Queue Count</th>
                <th>Has AUX</th>
                <th>Presensi</th>
                <th>Bucket</th>
            </tr>
        </thead>
        <tbody>
            <!-- Contoh data statis -->
            <!-- <tr>
                <td>Budi</td>
                <td>Voice</td>
                <td>3</td>
                <td>Yes</td>
                <td>Hadir</td>
                <td>A</td>
            </tr>
            <tr>
                <td>Ani</td>
                <td>Chat</td>
                <td>1</td>
                <td>No</td>
                <td>Tidak Hadir</td>
                <td>B</td>
            </tr> -->
        </tbody>
    </table>

    <!-- Tombol Anomali -->
    <div class="mt-3">
        <button id="resolveAnomali" class="btn btn-warning">Resolve Anomali</button>
        <button id="mapNama" class="btn btn-info">Map Nama</button>
    </div>
</div>

<!-- jQuery, DataTables, Chart.js -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $(document).ready(function() {
        // Init DataTables
        $('#auxTable').DataTable();
        $('#agentStatusTable').DataTable();

        // Init Chart.js
        const chartByWitel = new Chart(document.getElementById('chartByWitel'), {
            type: 'bar',
            data: {
                labels: ['Witel 1', 'Witel 2', 'Witel 3'],
                datasets: [{
                    label: 'Jumlah Absen Valid',
                    data: [12, 19, 7],
                    backgroundColor: 'rgba(54, 162, 235, 0.6)'
                }]
            }
        });

        const chartByMainCategory = new Chart(document.getElementById('chartByMainCategory'), {
            type: 'bar',
            data: {
                labels: ['Category A', 'Category B', 'Category C'],
                datasets: [{
                    label: 'Jumlah Absen Valid',
                    data: [5, 9, 14],
                    backgroundColor: 'rgba(255, 99, 132, 0.6)'
                }]
            }
        });

        // Filter (demo)
        $('#witelFilter, #dateFilter').on('change', function() {
            alert('Filter diubah: Witel=' + $('#witelFilter').val() + ', Date=' + $('#dateFilter').val());
        });

        // Tombol aksi
        $('#resolveAnomali').click(function() {
            alert('Resolve Anomali diklik!');
        });
        $('#mapNama').click(function() {
            alert('Map Nama diklik!');
        });
    });
</script>

<?= $this->endSection() ?>