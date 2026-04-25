<?= $this->extend('main/index'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-sm d-flex align-items-stretch">
        <div class="card w-100 border border-2">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title fw-semibold">Daftar Kelompok</h5>
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Anggota</li>
                        </ol>
                    </nav>
                </div>
                <h3 class="bg-primary rounded p-2 text-light"><i class="ti ti-users"></i></h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm d-flex align-items-stretch">
        <div class="card w-100 border border-2">
            <div class="card-body p-4">
                <div class="w-25 mb-3">
                    <form action="/anggota" method="get">
                        <select class="form-select border border-2" id="dselect" name="id_tahun_ajaran" aria-label="Default select example" onchange="form.submit()">
                            <option value="">Pilih Tahun Ajaran</option>
                            <option value="all">Semua Tahun Ajaran</option>
                            <?php if (isset($tahunAktif)) : ?>
                                <?php foreach ($tahunAjaran as $key => $value) : ?>
                                    <option value="<?= $value['id_tahun_ajaran'] ?>" <?= $value['id_tahun_ajaran'] == $tahunAktif ? 'selected' : '' ?>><?= $value['tahun_ajaran'] ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <?php foreach ($tahunAjaran as $key => $value) : ?>
                                    <option value="<?= $value['id_tahun_ajaran'] ?>"><?= $value['tahun_ajaran'] ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </form>
                </div>
                <div class="row">
                    <?php foreach ($kelompok as $key => $value) : ?>
                        <div class="col-md-3">
                            <div class="card shadow bg-primary bg-opacity-25">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $value['nama_kelompok'] ?></h5>
                                    <p class="card-text"><?= $value['tahun_ajaran'] ?></p>
                                    <a href="/anggota/kelola/<?= $value['id_kelompok'] ?>" class="btn btn-sm btn-primary">Kelola Anggota</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>