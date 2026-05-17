<?= $this->extend('main/index'); ?>

<?= $this->section('content'); ?>
<?php
$idAkses = (int) session()->get('id_akses');

$menuSections = [
    [
        'title' => 'Home',
        'menus' => [
            [
                'label' => 'Dashboard',
                'href' => '/index',
                'icon' => 'ti ti-layout-dashboard',
                'description' => 'Lihat ringkasan halaman utama admin.',
            ],
        ],
    ],
];

if ($idAkses === 1) {
    $menuSections[] = [
        'title' => 'Data Master',
        'menus' => [
            [
                'label' => 'Hak Akses',
                'href' => '/akses',
                'icon' => 'ti ti-list-check',
                'description' => 'Kelola jenis hak akses pengguna.',
            ],
            [
                'label' => 'Tahun Ajaran',
                'href' => '/tahunAjaran',
                'icon' => 'ti ti-calendar',
                'description' => 'Atur data tahun ajaran yang aktif.',
            ],
            [
                'label' => 'Daftar Pengguna',
                'href' => '/pengguna',
                'icon' => 'ti ti-users',
                'description' => 'Lihat dan kelola seluruh akun pengguna.',
            ],
            [
                'label' => 'Daftar Guru',
                'href' => '/guru',
                'icon' => 'ti ti-user-plus',
                'description' => 'Kelola data guru pembimbing.',
            ],
            [
                'label' => 'Daftar Siswa',
                'href' => '/siswa',
                'icon' => 'ti ti-user-plus',
                'description' => 'Kelola data siswa yang terdaftar.',
            ],
        ],
    ];
}

if ($idAkses === 1 || $idAkses === 2) {
    $menuSections[] = [
        'title' => 'Data PKWU',
        'menus' => [
            [
                'label' => 'Daftar Kelompok',
                'href' => '/kelompok',
                'icon' => 'ti ti-box-multiple',
                'description' => 'Atur data kelompok kegiatan PKWU.',
            ],
            [
                'label' => 'Daftar Anggota',
                'href' => '/anggota',
                'icon' => 'ti ti-users',
                'description' => 'Kelola anggota pada setiap kelompok.',
            ],
        ],
    ];
}

$menuSections[] = [
    'title' => 'Aktivitas',
    'menus' => [
        [
            'label' => 'Daftar Kegiatan',
            'href' => '/kegiatan',
            'icon' => 'ti ti-checklist',
            'description' => 'Pantau dan kelola daftar kegiatan PKWU.',
        ],
    ],
];
?>

<div class="dashboard-quick-menu">
    <div class="dashboard-welcome card border-0 shadow-sm">
        <div class="card-body p-4 p-lg-5">
            <span class="dashboard-welcome-badge">Dashboard Admin</span>
            <h2 class="dashboard-welcome-title">Selamat Datang, <?= strtoupper(session()->get('nama_pengguna')) ?></h2>
            <p class="dashboard-welcome-text mb-0">Gunakan menu cepat di bawah ini untuk membuka seluruh halaman utama sesuai hak akses Anda.</p>
        </div>
    </div>

    <div class="dashboard-menu-sections">
        <?php foreach ($menuSections as $section) : ?>
            <section class="dashboard-menu-section">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                    <div>
                        <h3 class="dashboard-section-title mb-1"><?= esc($section['title']) ?></h3>
                        <p class="dashboard-section-subtitle mb-0">Akses cepat ke menu <?= strtolower(esc($section['title'])) ?>.</p>
                    </div>
                </div>

                <div class="dashboard-card-grid">
                    <?php foreach ($section['menus'] as $menu) : ?>
                        <a href="<?= esc($menu['href']) ?>" class="dashboard-menu-card">
                            <div class="dashboard-menu-icon">
                                <i class="<?= esc($menu['icon']) ?>"></i>
                            </div>
                            <div class="dashboard-menu-content">
                                <h4 class="dashboard-menu-title"><?= esc($menu['label']) ?></h4>
                                <p class="dashboard-menu-description"><?= esc($menu['description']) ?></p>
                            </div>
                            <span class="dashboard-menu-arrow">
                                <i class="ti ti-arrow-right"></i>
                            </span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection(); ?>
