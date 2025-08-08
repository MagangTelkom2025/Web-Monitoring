<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-primary shadow">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="../index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img
                src="../assets/images/logo-telkomsel-baru-grey.png"
                alt="Telkomsel"
                class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <!-- <span class="brand-text fw-light">Telkomsel</span> -->
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="navigation"
                aria-label="Main Navigation"
                data-accordion="false"
                id="navigation">
                <li class="nav-item">
                    <a href="<?= base_url('/dashboard') ?>" class="nav-link">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/ticket') ?>" class="nav-link">
                        <i class="nav-icon bi bi-ticket"></i>
                        <p>Data Ticket</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/tickets/upload') ?>" class="nav-link">
                        <i class="nav-icon bi bi-cloud-upload"></i>
                        <p>Upload Ticket CSV</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/absen') ?>" class="nav-link">
                        <i class="nav-icon bi bi-calendar-check"></i>
                        <p>Absen</p>
                    </a>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->