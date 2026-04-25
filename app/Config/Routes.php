<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// CMS
$routes->get('/', 'Home::cms',);
$routes->get('/index', 'Home::index', ['filter' => ['auth']]);
$routes->get('/portofolioDetail', 'Home::portofolio');
// Backward-compatible endpoint that redirects old POST filter submissions to the GET URL.
$routes->post('/portofolioByTahun', 'Home::portofolioByTahun');
$routes->get('/dashboard', 'AuthController::index');

$routes->post('/ubahPassword/(:segment)', 'Home::ubahPassword/$1', ['filter' => ['auth']],);

// LOGIN
$routes->group('auth', static function ($routes) {
    $routes->get('/', 'AuthController::index');
    $routes->post('login', 'AuthController::login', ['filter' => 'rateLimit']);
    $routes->get('logout', 'AuthController::logout');
});

// USER ADMIN
// HAK AKSES
$routes->group('akses', ['filter' => ['auth', 'id_akses:1']], static function ($routes) {
    $routes->get('/', 'AksesController::index');
    $routes->get('tambah', 'AksesController::tambah');
    $routes->post('simpan', 'AksesController::simpan');
    $routes->get('edit/(:segment)', 'AksesController::edit/$1');
    $routes->post('update/(:segment)', 'AksesController::update/$1');
    $routes->post('toggle/(:segment)', 'AksesController::toggle/$1');
});

// TAHUN AJARAN
$routes->group('tahunAjaran', ['filter' => ['auth', 'id_akses:1']], static function ($routes) {
    $routes->get('/', 'TahunAjaranController::index');
    $routes->get('tambah', 'TahunAjaranController::tambah');
    $routes->post('simpan', 'TahunAjaranController::simpan');
    $routes->get('edit/(:segment)', 'TahunAjaranController::edit/$1');
    $routes->post('update/(:segment)', 'TahunAjaranController::update/$1');
    // $routes->post('toggle/(:segment)', 'TahunAjaranController::toggle/$1');
    $routes->post('hapus/(:segment)', 'TahunAjaranController::hapus/$1');
});

// PENGGUNA
$routes->group('pengguna', ['filter' => ['auth', 'id_akses:1']], static function ($routes) {
    $routes->get('/', 'PenggunaController::index');
    $routes->get('tambah', 'PenggunaController::tambah');
    $routes->post('simpan', 'PenggunaController::simpan');
    $routes->get('edit/(:segment)', 'PenggunaController::edit/$1');
    $routes->post('update/(:segment)', 'PenggunaController::update/$1');
    $routes->post('toggle/(:segment)', 'PenggunaController::toggle/$1');
    $routes->post('deleteMultiple', 'PenggunaController::deleteMultiple');
    $routes->post('statusMultiple', 'PenggunaController::statusMultiple');
    $routes->post('hapus/(:segment)', 'PenggunaController::hapus/$1');
});

// GURU
$routes->group('guru', ['filter' => ['auth', 'id_akses:1']], static function ($routes) {
    $routes->get('/', 'GuruController::index');
    $routes->get('tambah', 'GuruController::tambah');
    $routes->post('simpan', 'GuruController::simpan');
    $routes->get('edit/(:segment)', 'GuruController::edit/$1');
    $routes->post('update/(:segment)', 'GuruController::update/$1');
    // $routes->post('hapus/(:segment)', 'GuruController::hapus/$1');
});

// SISWA
$routes->group('siswa', ['filter' => ['auth', 'id_akses:1']], static function ($routes) {
    $routes->get('/', 'SiswaController::index');
    $routes->get('tambah', 'SiswaController::tambah');
    $routes->post('simpan', 'SiswaController::simpan');
    $routes->get('edit/(:segment)', 'SiswaController::edit/$1');
    $routes->post('update/(:segment)', 'SiswaController::update/$1');
    $routes->post('import', 'SiswaController::import');
    // $routes->post('tahun', 'SiswaController::tahun');
    // $routes->post('hapus/(:segment)', 'SiswaController::hapus/$1');
});

// KELOMPOK
$routes->group('kelompok', ['filter' => ['auth', 'id_akses:1,2']], static function ($routes) {
    $routes->get('/', 'KelompokController::index');
    $routes->get('tambah', 'KelompokController::tambah');
    $routes->post('simpan', 'KelompokController::simpan');
    $routes->get('edit/(:segment)', 'KelompokController::edit/$1');
    $routes->post('update/(:segment)', 'KelompokController::update/$1');
    $routes->post('import', 'KelompokController::import');
    $routes->post('hapus/(:segment)', 'KelompokController::hapus/$1');
    // $routes->post('tahun', 'KelompokController::tahun');
});

// ANGGOTA
$routes->group('anggota', ['filter' => ['auth', 'id_akses:1,2']], static function ($routes) {
    $routes->get('/', 'AnggotaController::index');
    $routes->get('kelola/(:segment)', 'AnggotaController::kelola/$1');
    $routes->post('simpan/(:segment)', 'AnggotaController::simpan/$1');
    $routes->post('update/(:segment)', 'AnggotaController::update/$1');
    $routes->post('import', 'AnggotaController::import');
    $routes->post('hapus/(:segment)', 'AnggotaController::hapus/$1');
    // $routes->post('tahun', 'AnggotaController::tahun');
});

// KEGIATAN
$routes->group('kegiatan', ['filter' => ['auth']], static function ($routes) {
    $routes->get('/', 'KegiatanController::index');
    $routes->get('daftar/(:segment)', 'KegiatanController::daftar/$1');
    $routes->get('tambah/(:segment)', 'KegiatanController::tambah/$1');
    $routes->post('simpan', 'KegiatanController::simpan');
    $routes->get('edit/(:segment)', 'KegiatanController::edit/$1');
    $routes->post('update/(:segment)', 'KegiatanController::update/$1');
    $routes->get('detail/(:segment)', 'KegiatanController::detail/$1');
    $routes->post('hapus/(:segment)', 'KegiatanController::hapus/$1');
    $routes->get('export/(:segment)', 'KegiatanController::export/$1');
    $routes->post('tahun', 'KegiatanController::tahun');
});
