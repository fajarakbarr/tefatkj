<?= $this->extend('main/index'); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="h-25 d-flex align-items-center justify-content-center">
        <h2 class="fw-bold">SELAMAT DATANG, <?= strtoupper(session()->get('nama_pengguna')) ?></h2>
    </div>
</div>
<?= $this->endSection(); ?>