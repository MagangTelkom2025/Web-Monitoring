<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="flex-grow-1">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?= esc($title) ?></li>
            </ol>
        </nav>
        <div class="d-flex align-items-center ms-auto">
            <!-- User Dropdown -->
            <div class="nav-item dropdown pe-3 d-flex align-items-center">
                <a href="#" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <?= esc(session()->get('username') ?? 'admin') ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                    <li>
                        <!-- Logout -->
                        <a href="<?= base_url('logout') ?>" class="nav-link text-body font-weight-bold px-0">
                            <i class="fas fa-right-from-bracket text-sm opacity-10"></i>
                            Log out
                        </a>
                    </li>
                    <!-- Tambahkan item lain jika diperlukan -->
                </ul>
            </div>
            <!-- Settings -->
            <div class="nav-item px-3 d-flex align-items-center">
                <a href="#" class="nav-link text-body p-0">
                    <i class="fas fa-cog text-sm opacity-10"></i>
                </a>
            </div>
        </div>
    </div>
</nav>