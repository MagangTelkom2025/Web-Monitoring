<?= $this->extend('layout/app/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <h1 class="h3 mb-4">Absen</h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <p>Welcome to the Absen page!</p>
                    <button class="btn btn-danger" onclick="window.location.href='<?= base_url('absen/uploadaux') ?>'">
                        Upload
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>