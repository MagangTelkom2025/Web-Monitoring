<!doctype html>
<html lang="en">

<?= $this->include('layout/head') ?>

<!--begin::Body-->

<body class="g-sidenav-show  bg-gray-100">

    <?= $this->include('partials/sidebar') ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <?= $this->include('partials/header') ?>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
        </div>
        <?= $this->include('partials/footer') ?>
    </main>

    <?= $this->include('layout/script') ?>

</body>
<!--end::Body-->

</html>