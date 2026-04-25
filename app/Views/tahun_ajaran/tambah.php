<?= $this->extend('main/index'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-sm d-flex align-items-stretch">
        <div class="card w-100 border border-2">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold">Form Tambah Tahun ajaran</h5>
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/tahunAjaran">Tahun ajaran</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </nav>

                <form action="/tahunAjaran/simpan" method="post" id="formTambah">
                    <?= csrf_field() ?>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control <?= isset(session()->get('errors')['tahun_ajaran']) ? 'is-invalid' : '' ?>" name="tahun_ajaran" id="tahun_ajaran" placeholder="Tahun Ajaran" value="<?= old('tahun_ajaran') ?>" autocomplete="off">
                        <?php if (isset(session()->get('errors')['tahun_ajaran'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->get('errors')['tahun_ajaran'] ?>
                            </div>
                        <?php endif; ?>
                        <label for="tahun_ajaran">Tahun Ajaran</label>
                    </div>
                    <div class="text-end">
                        <a href="/tahunAjaran" class="btn btn-sm btn-dark">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>