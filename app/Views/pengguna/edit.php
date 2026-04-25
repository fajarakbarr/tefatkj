<?= $this->extend('main/index'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-sm d-flex align-items-stretch">
        <div class="card w-100 border border-2">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold">Form Edit Pengguna</h5>
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/pengguna">Pengguna</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>

                <form action="/pengguna/update/<?= $pengguna['id_pengguna'] ?>" method="post" id="formEdit">
                    <?= csrf_field() ?>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control <?= isset(session()->get('errors')['kode_pengguna']) ? 'is-invalid' : '' ?>" name="kode_pengguna" id="kode_pengguna" placeholder="Pengguna" value="<?= $pengguna['kode_pengguna'] ?>" autocomplete="off">
                        <?php if (isset(session()->get('errors')['kode_pengguna'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->get('errors')['kode_pengguna'] ?>
                            </div>
                        <?php endif; ?>
                        <label for="kode_pengguna">Kode Pengguna</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control <?= isset(session()->get('errors')['nama_pengguna']) ? 'is-invalid' : '' ?>" name="nama_pengguna" id="nama_pengguna" placeholder="Pengguna" value="<?= $pengguna['nama_pengguna'] ?>" autocomplete="off">
                        <?php if (isset(session()->get('errors')['nama_pengguna'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->get('errors')['nama_pengguna'] ?>
                            </div>
                        <?php endif; ?>
                        <label for="nama_pengguna">Nama Pengguna</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control <?= isset(session()->get('errors')['password_pengguna']) ? 'is-invalid' : '' ?>" name="password_pengguna" id="password_pengguna" placeholder="Pengguna" autocomplete="off">
                        <?php if (isset(session()->get('errors')['password_pengguna'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->get('errors')['password_pengguna'] ?>
                            </div>
                        <?php endif; ?>
                        <label for="password_pengguna">Password Pengguna - Kosongkan Bila Tidak Ada Perubahan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="id_akses" value="Admin" autocomplete="off" disabled>
                        <label for="id_akses">Akses Pengguna</label>
                    </div>
                    <div class="text-end">
                        <a href="/pengguna" class="btn btn-sm btn-dark">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>