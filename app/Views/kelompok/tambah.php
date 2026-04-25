<?= $this->extend('main/index'); ?>

<?= $this->section('content'); ?>
<?php if (session()->get('error') == true) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><?= session()->get('error') ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>

<div class="row">
    <div class="col-sm d-flex align-items-stretch">
        <div class="card w-100 border border-2">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold">Form Tambah Kelompok</h5>
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/tahunAjaran">Kelompok</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </nav>

                <form action="/kelompok/simpan" method="post" id="formTambah">
                    <?= csrf_field() ?>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control <?= isset(session()->get('errors')['nama_kelompok']) ? 'is-invalid' : '' ?>" name="nama_kelompok" id="nama_kelompok" placeholder="Kelompok" value="<?= old('nama_kelompok') ?>" autocomplete="off">
                        <?php if (isset(session()->get('errors')['nama_kelompok'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->get('errors')['nama_kelompok'] ?>
                            </div>
                        <?php endif; ?>
                        <label for="nama_kelompok">Nama Kelompok</label>
                    </div>
                    <div class="mb-3">
                        <select class="form-select <?= isset(session()->get('errors')['id_tahun_ajaran']) ? 'is-invalid' : '' ?>" id="dselect" name="id_tahun_ajaran" aria-label="Floating label select example">
                            <option value="">Pilih Tahun Ajaran</option>
                            <?php foreach ($tahun_ajaran as $key => $value) : ?>
                                <option value="<?= $value['id_tahun_ajaran'] ?>" <?= $value['id_tahun_ajaran'] == old('id_tahun_ajaran') ? 'selected' : '' ?>><?= $value['tahun_ajaran'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset(session()->get('errors')['id_tahun_ajaran'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->get('errors')['id_tahun_ajaran'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="text-end">
                        <a href="/kelompok" class="btn btn-sm btn-dark">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>