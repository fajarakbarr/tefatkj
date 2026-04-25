<?= $this->extend('main/index'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-sm d-flex align-items-stretch">
        <div class="card w-100 border border-2">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title fw-semibold">Daftar Hak Akses</h5>
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Hak Akses</li>
                        </ol>
                    </nav>
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
                <!-- <a href="/akses/tambah" class="btn btn-sm btn-primary">Tambah Data</a> -->
                <div class="table-responsive">
                    <table class="table table-striped text-nowrap mb-0 align-middle" id="table2">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">No</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Keterangan</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Status</h6>
                                </th>
                                <!-- <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Aksi</h6>
                                </th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($akses as $key => $value) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $value['ket_akses'] ?></td>
                                    <td><?= $value['status_akses'] == 1 ? 'Aktif' : 'Pasif' ?></td>
                                    <!-- <td>
                                        <a href="/akses/edit/<?= $value['id_akses'] ?>" class="btn btn-sm btn-warning"><i class="ti ti-edit fs-4"></i></a>
                                        <form action="/akses/toggle/<?= $value['id_akses'] ?>" method="post" class="d-inline-block" id="tombolToggle">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm <?= $value['status_akses'] == 1 ? 'btn-danger' : 'btn-success' ?>">
                                                <i class="ti ti-power fs-4"></i>
                                            </button>
                                        </form>
                                    </td> -->
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