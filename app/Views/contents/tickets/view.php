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
<!-- Filter Section -->
<div class="row mb-3">
    <div class="col-md-3">
        <input type="date" id="dateFilter" class="form-control" placeholder="Tanggal">
    </div>
    <div class="col-md-3">
        <select id="mainCategoryFilter" class="form-select">
            <option value="">-- Pilih Main Category --</option>
            <?php foreach ((new \App\Models\TicketModel())->select('mainCategory')->distinct()->findAll() as $row): ?>
                <option value="<?= esc($row['mainCategory']) ?>"><?= esc($row['mainCategory']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-3">
        <select id="categoryFilter" class="form-select" disabled>
            <option value="">-- Pilih Category --</option>
        </select>
    </div>
    <div class="col-md-3">
        <select id="witelFilter" class="form-select">
            <option value="">-- Pilih Witel --</option>
            <?php foreach ((new \App\Models\TicketModel())->select('witel')->distinct()->findAll() as $row): ?>
                <option value="<?= esc($row['witel']) ?>"><?= esc($row['witel']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
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
    var table = $('#ticketTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url('tickets/ajaxList') ?>',
            data: function (d) {
                d.mainCategory = $('#mainCategoryFilter').val();
                d.category = $('#categoryFilter').val();
                d.witel = $('#witelFilter').val();
                d.date = $('#dateFilter').val();
            }
        },
        columns: [
            { data: 'date_start_interaction' },
            { data: 'mainCategory' },
            { data: 'category' },
            { data: 'witel' }
        ]
    });

    $('#mainCategoryFilter').on('change', function () {
        var mainCategory = $(this).val();
        $('#categoryFilter').prop('disabled', !mainCategory);
        $('#categoryFilter').html('<option value="">-- Pilih Category --</option>');
        if (mainCategory) {
            $.get('<?= base_url('tickets/getCategoriesByMain') ?>', {mainCategory: mainCategory}, function(res) {
                res.forEach(function(cat) {
                    $('#categoryFilter').append('<option value="'+cat+'">'+cat+'</option>');
                });
            }, 'json');
        }
        table.ajax.reload();
    });

    $('#categoryFilter, #witelFilter, #dateFilter').on('change', function () {
        table.ajax.reload();
    });
});
</script>

<?= $this->endSection() ?>
