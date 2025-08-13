<?= $this->extend('layout/app/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Ticket</h1>
        <?php if (session()->get('role') === 'admin'): ?>
            <button class="btn btn-danger" onclick="window.location.href='<?= base_url('tickets/upload') ?>'">
                Upload
            </button>
        <?php endif; ?>
    </div>

    <table id="ticketTable" class="table table-bordered">
        <thead>
            <tr>
                <th>Date Start Interaction</th>
                <th>Main Category</th>
                <th>Category</th>
                <th>Witel</th>
            </tr>
        </thead>
    </table>
</div>

<!-- jQuery & DataTables -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script>
$(document).ready(function () {
    $('#ticketTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '<?= base_url('tickets/ajaxList') ?>',
        columns: [
            { data: 'date_start_interaction' },
            { data: 'mainCategory' },
            { data: 'category' },
            { data: 'witel' }
        ]
    });
});
</script>

<?= $this->endSection() ?>
