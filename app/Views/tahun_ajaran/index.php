<?= $this->extend('main/index'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-sm d-flex align-items-stretch">
        <div class="card w-100 border border-2">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title fw-semibold">Daftar Tahun Ajaran</h5>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Tahun Ajaran</li>
                        </ol>
                    </nav>
                    <a href="/tahunAjaran/tambah" class="btn btn-sm btn-primary">Tambah Tahun Ajaran</a>
                </div>
                <h3 class="bg-primary rounded p-2 text-light"><i class="ti ti-list-check"></i></h3>
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
                                    <h6 class="fw-semibold mb-0">Tahun Ajaran</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Status</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Aksi</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($tahun_ajaran as $key => $value) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $value['tahun_ajaran'] ?></td>
                                    <td><?= $value['status_tahun_ajaran'] == 1 ? 'Aktif' : 'Pasif' ?></td>
                                    <td>

                                        <a href="/tahunAjaran/edit/<?= $value['id_tahun_ajaran'] ?>" class="btn btn-sm btn-warning"><i class="ti ti-edit fs-4"></i></a>
                                        <form action="/tahunAjaran/hapus/<?= $value['id_tahun_ajaran'] ?>" method="post" class="d-inline-block" id="formHapus<?= $value['id_tahun_ajaran'] ?>">
                                            <?= csrf_field() ?>
                                            <!-- <button type="submit" class="btn btn-sm btn-danger" onclick="tombolHapus(event, <?= $value['id_tahun_ajaran'] ?>)">
                                                <i class="ti ti-trash fs-4"></i>
                                            </button> -->
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>