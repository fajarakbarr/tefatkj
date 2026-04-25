<aside class="left-sidebar background-sidebar">
    <!-- Sidebar scroll-->
    <div class="brand-logo d-flex">
        <!-- <img src="/assets/images/logos/dark-logo.svg" width="180" alt="" /> -->
        <img src="/assets/images/backgrounds/hero.webp" alt="" width="50%" class="mt-2 ms-5">
        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
        </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul id="sidebarnav" class=" mb-5">
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu text-light">Home</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link text-light" href="/index" aria-expanded="false" id="sidebar">
                    <span>
                        <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>

            <?php if (session()->get('id_akses') == 1) : ?>
                <!-- Data Master -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu text-light">DATA MASTER</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link text-light <?= isset($aksesSidebar) ? 'active-sidebar' : '' ?>" href="/akses" aria-expanded="false">
                        <span>
                            <i class="ti ti-list-check"></i>
                        </span>
                        <span class="hide-menu">Hak Akses</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link text-light <?= isset($tahunAjaranSidebar) ? 'active-sidebar' : '' ?>" href="/tahunAjaran" aria-expanded="false">
                        <span>
                            <i class="ti ti-calendar"></i>
                        </span>
                        <span class="hide-menu">Tahun Ajaran</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link text-light <?= isset($penggunaSidebar) ? 'active-sidebar' : '' ?>" href="/pengguna" aria-expanded="false">
                        <span>
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">Daftar Pengguna</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link text-light <?= isset($guruSidebar) ? 'active-sidebar' : '' ?>" href="/guru" aria-expanded="false">
                        <span>
                            <i class="ti ti-user-plus"></i>
                        </span>
                        <span class="hide-menu">Daftar Guru</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link text-light <?= isset($siswaSidebar) ? 'active-sidebar' : '' ?>" href="/siswa" aria-expanded="false">
                        <span>
                            <i class="ti ti-user-plus"></i>
                        </span>
                        <span class="hide-menu">Daftar Siswa</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (session()->get('id_akses') == 1 || session()->get('id_akses') == 2) : ?>
                <!-- Data PKWU -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu text-light">DATA PKWU</span>
                </li>
                <?php if (session()->get('id_akses') != 4) : ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link text-light <?= isset($kelompokSidebar) ? 'active-sidebar' : '' ?>" href="/kelompok" aria-expanded="false">
                            <span>
                                <i class="ti ti-box-multiple"></i>
                            </span>
                            <span class="hide-menu">Daftar Kelompok</span>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="sidebar-item">
                    <a class="sidebar-link text-light <?= isset($anggotaSidebar) ? 'active-sidebar' : '' ?>" href="/anggota" aria-expanded="false">
                        <span>
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">Daftar Anggota</span>
                    </a>
                </li>
            <?php endif; ?>
            <li class="sidebar-item">
                <a class="sidebar-link text-light <?= isset($kegiatanSidebar) ? 'active-sidebar' : '' ?>" href="/kegiatan" aria-expanded="false">
                    <span>
                        <i class="ti ti-checklist"></i>
                    </span>
                    <span class="hide-menu">Daftar Kegiatan</span>
                </a>
            </li>
        </ul>
    </nav>
    <!-- End Sidebar navigation -->
    <!-- End Sidebar scroll-->
</aside>