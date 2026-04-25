<?= $this->extend('main/index'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-sm d-flex align-items-stretch">
        <div class="card w-100 border border-2">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold">Form Edit Guru</h5>
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/guru">Guru</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>

                <form action="/guru/update/<?= $guru['id_guru'] ?>" method="post" id="formEdit">
                    <?= csrf_field() ?>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control <?= isset(session()->get('errors')['nik']) ? 'is-invalid' : '' ?>" name="nik" id="nik" placeholder="Guru" value="<?= $guru['nik'] ?>" autocomplete="off">
                        <?php if (isset(session()->get('errors')['nik'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->get('errors')['nik'] ?>
                            </div>
                        <?php endif; ?>
                        <label for="nik">NIK</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control <?= isset(session()->get('errors')['nama_guru']) ? 'is-invalid' : '' ?>" name="nama_guru" id="nama_guru" placeholder="Guru" value="<?= $guru['nama_guru'] ?>" autocomplete="off">
                        <?php if (isset(session()->get('errors')['nama_guru'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->get('errors')['nama_guru'] ?>
                            </div>
                        <?php endif; ?>
                        <label for="nama_guru">Nama</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="password_guru" id="password_guru" placeholder="Kosongkan Bila Tidak Ada Perubahan" autocomplete="off">
                        <label for="password_guru">Kosongkan Password Bila Tidak Ada Perubahan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="id_akses" value="Guru" autocomplete="off" disabled>
                        <label for="id_akses">Akses Guru</label>
                    </div>
                    <div class="text-end">
                        <a href="/guru" class="btn btn-sm btn-dark">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>