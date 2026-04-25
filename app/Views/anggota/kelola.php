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
                <h5 class="card-title fw-semibold">Kelola Anggota <?= $kelompok['nama_kelompok'] ?></h5>
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/anggota">Anggota</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kelola <?= $kelompok['nama_kelompok'] ?></li>
                    </ol>
                </nav>

                <form action="/anggota/simpan/<?= $kelompok['id_kelompok'] ?>" method="post" id="formTambah" class="form-container">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="id_siswa" class="form-label">Ketua Kelompok</label>
                        <select class="form-select <?= isset(session()->get('errors')['id_siswa']) ? 'is-invalid' : '' ?>" id="dselect" name="id_siswa[]" aria-label="Floating label select example">
                            <option value="">Pilih Ketua</option>
                            <?php foreach ($ketua as $key => $value) : ?>
                                <option value="<?= $value['id_siswa'] ?>" <?= $value['id_siswa'] == old('id_siswa') ? 'selected' : '' ?>><?= $value['nama_siswa'] ?> - <?= $value['nis'] ?> - <?= $value['tahun_ajaran'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input type="hidden" name="id_akses[]" value="3">
                    </div>
                    <?php for ($i = 1; $i < 11; $i++) : ?>
                        <div class="mb-3">
                            <label for="id_siswa" class="form-label">Anggota Ke <?= $i ?></label>
                            <select class="form-select <?= isset(session()->get('errors')['id_siswa']) ? 'is-invalid' : '' ?>" id="dselect<?= $i ?>" name="id_siswa[]" aria-label="Floating label select example">
                                <option value="">Pilih Anggota</option>
                                <?php foreach ($anggota as $key => $value) : ?>
                                    <option value="<?= $value['id_siswa'] ?>" <?= $value['id_siswa'] == old('id_siswa') ? 'selected' : '' ?>><?= $value['nama_siswa'] ?> - <?= $value['nis'] ?> - <?= $value['tahun_ajaran'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="id_akses[]" value="4">
                        </div>
                    <?php endfor; ?>
                    <div class="text-end">
                        <a href="/anggota" class="btn btn-sm btn-dark">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>