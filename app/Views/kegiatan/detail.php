<?= $this->extend('main/index'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-sm d-flex align-items-stretch">
        <div class="card w-100 border border-2">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold">Form Detail Kegiatan <?= $kegiatan['nama_kelompok'] ?></h5>
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page"><a href="/kegiatan">Kegiatan</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="/kegiatan/daftar/<?= $kegiatan['id_kelompok'] ?>">Daftar Kegiatan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Kegiatan </li>
                    </ol>
                </nav>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="nama_kegiatan" id="nama_kegiatan" value="<?= $kegiatan['nama_kegiatan'] ?>" autocomplete="off">
                    <label for="nama_kegiatan">Nama Kegiatan</label>
                </div>
                <input type="hidden" name="id_kelompok" value="<?= $kegiatan['id_kelompok'] ?>">
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?= date('Y-m-d', strtotime($kegiatan['tanggal'])) ?>" autocomplete="off">
                    <label for="tanggal">Tanggal Kegiatan</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="tempat" id="tempat" value="<?= $kegiatan['tempat'] ?>" autocomplete="off">
                    <label for="tempat">Tempat Kegiatan</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="alamat" id="alamat" value="<?= $kegiatan['alamat'] ?>" autocomplete="off">
                    <label for="alamat">Alamat Kegiatan</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="jenis_pelayanan" id="jenis_pelayanan" value="<?= $kegiatan['jenis_pelayanan'] ?>" autocomplete="off">
                    <label for="jenis_pelayanan">Jenis Pelayanan</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="hasil" id="hasil" value="<?= $kegiatan['hasil'] ?>" autocomplete="off">
                    <label for="hasil">Hasil Kegiatan</label>
                </div>
                <div class="mb-3">
                    <label for="dokumentasi" class="form-label">Dokumentasi Kegiatan</label><br>
                    <img id="preview" src="/assets/images/dokumentasi/<?= $kegiatan['dokumentasi'] ?>" alt="Preview Gambar" style=" max-width:300px; padding:5px;">
                </div>
                <div class="text-end">
                    <a href="/kegiatan/daftar/<?= $kegiatan['id_kelompok'] ?>" class="btn btn-sm btn-dark">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>