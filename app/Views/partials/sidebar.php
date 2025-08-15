<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href="<?php echo base_url('/'); ?>">
            <img src="<?php echo base_url('assets/images/logo.png'); ?>" class="navbar-brand-img" width="26" height="26" alt="main_logo">
            <span class="ms-1 text-sm text-dark">Telkomsel Infomedia</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <?php $uri = service('uri'); ?>
            <li class="nav-item">
                <a class="nav-link<?= ($uri->getSegment(1) == 'dashboard' && $uri->getSegment(2) == '') ? ' active bg-gradient-light text-dark' : ' text-dark' ?>" href="<?= base_url('dashboard'); ?>">
                    <i class="fas fa-solid fa-house text-sm opacity-10"></i>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Content</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link<?= ($uri->getSegment(1) == 'ticket' && $uri->getSegment(2) == '') ? ' active bg-gradient-light text-dark' : ' text-dark' ?>" href="<?= base_url('ticket'); ?>">
                    <i class="fas fa-solid fa-ticket text-sm opacity-10"></i>
                    <span class="nav-link-text ms-1">Service Ticket</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?= ($uri->getSegment(1) == 'absen' && $uri->getSegment(2) == '') ? ' active bg-gradient-light text-dark' : ' text-dark' ?>" href="<?= base_url('absen'); ?>">
                    <i class="fas fa-solid fa-ticket text-sm opacity-10"></i>
                    <span class="nav-link-text ms-1">AUX</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Account Pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link<?= ($uri->getSegment(1) == 'profile' && $uri->getSegment(2) == '') ? ' active bg-gradient-light text-dark' : ' text-dark' ?>" href="<?= base_url('profile'); ?>">
                    <i class="fas fa-solid fa-user text-sm opacity-10"></i>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        <div class="mx-3">
            <!-- bottom content sidebar -->
        </div>
    </div>
</aside>