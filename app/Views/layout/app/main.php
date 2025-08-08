<!doctype html>
<html lang="en">

<?= $this->include('partials/head') ?>

<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg sidebar-mini sidebar-collapse bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        
        <?= $this->include('layout/header') ?>

        <?= $this->include('layout/sidebar') ?>

        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->

                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->
            <!--begin::App Content-->
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <?= $this->renderSection('content') ?>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content-->
        </main>
        <!--end::App Main-->
        <?= $this->include('layout/footer') ?>
    </div>
    <!--end::App Wrapper-->

    <?= $this->include('partials/script') ?>

</body>
<!--end::Body-->

</html>