<?= $this->extend('main/index'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-sm d-flex align-items-stretch">
        <div class="card w-100 border border-2">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold">Form Tambah Hak Akses</h5>
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/akses">Hak Akses</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </nav>

                <form action="/akses/simpan" method="post" id="formTambah">
                    <?= csrf_field() ?>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control <?= isset(session()->get('errors')['ket_akses']) ? 'is-invalid' : '' ?>" name="ket_akses" id="ket_akses" placeholder="Keterangan Hak Akses" value="<?= old('ket_akses') ?>" autocomplete="off">
                        <?php if (isset(session()->get('errors')['ket_akses'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->get('errors')['ket_akses'] ?>
                            </div>
                        <?php endif; ?>
                        <label for="ket_akses">Keterangan Hak Akses</label>
                    </div>
                    <div class="text-end">
                        <a href="/akses" class="btn btn-sm btn-dark">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>