<?= $this->extend('layout/app/main') ?>

<?= $this->section('content') ?>
<div>
    <h1>Upload File CSV</h1>
    <form action="<?= base_url('tickets/upload') ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="file" accept=".csv" required>
        <button type="submit">Upload</button>
    </form>
</div>
<?= $this->endSection() ?>