<?= $this->extend('main/index'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-sm d-flex align-items-stretch">
        <div class="card w-100 border border-2">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title fw-semibold">Daftar Kegiatan <?= $kelompok['nama_kelompok'] ?></h5>
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page"><a href="/kegiatan">Kegiatan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Daftar Kegiatan</li>
                        </ol>
                    </nav>
                    <a href="/kegiatan/tambah/<?= $kelompok['id_kelompok'] ?>" class="btn btn-sm btn-primary">Tambah Kegiatan</a>
                    <a href="/kegiatan/export/<?= $kelompok['id_kelompok'] ?>" class="btn btn-sm btn-success">Export Kegiatan</a>
                </div>
                <h3 class="bg-primary rounded p-2 text-light"><i class="ti ti-checklist"></i></h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm d-flex align-items-stretch">
        <div class="card w-100 border border-2">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-striped text-nowrap mb-0 align-middle" id="table2">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">No</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Nama Kegiatan</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Aksi</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kegiatan as $key => $value) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $value['nama_kegiatan'] ?></td>
                                    <td>
                                        <a href="/kegiatan/detail/<?= $value['id_kegiatan'] ?>" class="btn btn-sm btn-success"><i class="ti ti-eye fs-4"></i></a>
                                        <?php if (session()->get('id_akses') != 4) : ?>
                                            <a href="/kegiatan/edit/<?= $value['id_kegiatan'] ?>" class="btn btn-sm btn-warning"><i class="ti ti-edit fs-4"></i></a>
                                            <form action="/kegiatan/hapus/<?= $value['id_kegiatan'] ?>" method="post" class="d-inline-block" id="formHapus<?= $value['id_kegiatan'] ?>">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="tombolHapus(event, <?= $value['id_kegiatan'] ?>)">
                                                    <i class="ti ti-trash fs-4"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>


                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <a href="/kegiatan" class="btn btn-sm btn-dark ms-auto">Kembali</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>