<?= $this->extend('main/index'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-sm d-flex align-items-stretch">
        <div class="card w-100 border border-2">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold">Form Tambah Kegiatan <?= $kelompok['nama_kelompok'] ?></h5>
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="/kegiatan">Kegiatan</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="/kegiatan/daftar/<?= $kelompok['id_kelompok'] ?>">Daftar Kegiatan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Kegiatan </li>
                    </ol>
                </nav>

                <form action="/kegiatan/simpan" method="post" id="formTambah" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control <?= isset(session()->get('errors')['nama_kegiatan']) ? 'is-invalid' : '' ?>" name="nama_kegiatan" id="nama_kegiatan" placeholder="Keterangan Hak Akses" value="<?= old('nama_kegiatan') ?>" autocomplete="off">
                        <?php if (isset(session()->get('errors')['nama_kegiatan'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->get('errors')['nama_kegiatan'] ?>
                            </div>
                        <?php endif; ?>
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                    </div>
                    <input type="hidden" name="id_kelompok" value="<?= $kelompok['id_kelompok'] ?>">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control <?= isset(session()->get('errors')['tanggal']) ? 'is-invalid' : '' ?>" name="tanggal" id="tanggal" placeholder="Keterangan Hak Akses" value="<?= old('tanggal') ?>" autocomplete="off">
                        <?php if (isset(session()->get('errors')['tanggal'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->get('errors')['tanggal'] ?>
                            </div>
                        <?php endif; ?>
                        <label for="tanggal">Tanggal Kegiatan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control <?= isset(session()->get('errors')['tempat']) ? 'is-invalid' : '' ?>" name="tempat" id="tempat" placeholder="Keterangan Hak Akses" value="<?= old('tempat') ?>" autocomplete="off">
                        <?php if (isset(session()->get('errors')['tempat'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->get('errors')['tempat'] ?>
                            </div>
                        <?php endif; ?>
                        <label for="tempat">Tempat Kegiatan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control <?= isset(session()->get('errors')['alamat']) ? 'is-invalid' : '' ?>" name="alamat" id="alamat" placeholder="Keterangan Hak Akses" value="<?= old('alamat') ?>" autocomplete="off">
                        <?php if (isset(session()->get('errors')['alamat'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->get('errors')['alamat'] ?>
                            </div>
                        <?php endif; ?>
                        <label for="alamat">Alamat Kegiatan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control <?= isset(session()->get('errors')['jenis_pelayanan']) ? 'is-invalid' : '' ?>" name="jenis_pelayanan" id="jenis_pelayanan" placeholder="Keterangan Hak Akses" value="<?= old('jenis_pelayanan') ?>" autocomplete="off">
                        <?php if (isset(session()->get('errors')['jenis_pelayanan'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->get('errors')['jenis_pelayanan'] ?>
                            </div>
                        <?php endif; ?>
                        <label for="jenis_pelayanan">Jenis Pelayanan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control <?= isset(session()->get('errors')['hasil']) ? 'is-invalid' : '' ?>" name="hasil" id="hasil" placeholder="Keterangan Hak Akses" value="<?= old('hasil') ?>" autocomplete="off">
                        <?php if (isset(session()->get('errors')['hasil'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->get('errors')['hasil'] ?>
                            </div>
                        <?php endif; ?>
                        <label for="hasil">Hasil Kegiatan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select <?= isset(session()->get('errors')['id_tahun_ajaran']) ? 'is-invalid' : '' ?>" id="floatingSelect" name="id_tahun_ajaran" aria-label="Floating label select example">
                            <option value="">Pilih Tahun Ajaran</option>
                            <?php foreach ($tahun_ajaran as $key => $value) : ?>
                                <option value="<?= $value['id_tahun_ajaran'] ?>"><?= $value['tahun_ajaran'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset(session()->get('errors')['id_tahun_ajaran'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->get('errors')['id_tahun_ajaran'] ?>
                            </div>
                        <?php endif; ?>
                        <label for="id_tahun_ajaran">Tahun Ajaran</label>
                    </div>
                    <div class="mb-3">
                        <label for="dokumentasi" class="form-label">Dokumentasi Kegiatan</label>
                        <input type="file" class="form-control <?= isset(session()->get('errors')['dokumentasi']) ? 'is-invalid' : '' ?>" name="dokumentasi" id="dokumentasi" autocomplete="off">
                        <?php if (isset(session()->get('errors')['dokumentasi'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->get('errors')['dokumentasi'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <img id="preview" src="#" alt="Preview Gambar" style="display:none; max-width:300px; padding:5px;">
                    </div>
                    <div class="text-end">
                        <a href="/kegiatan/daftar/<?= $kelompok['id_kelompok'] ?>" class="btn btn-sm btn-dark">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>