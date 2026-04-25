<?= $this->extend('main/index'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-sm d-flex align-items-stretch">
        <div class="card w-100 border border-2">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title fw-semibold">Daftar Guru</h5>
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Guru</li>
                        </ol>
                    </nav>
                    <a href="/guru/tambah" class="btn btn-sm btn-primary">Tambah Guru</a>
                </div>
                <h3 class="bg-primary rounded p-2 text-light"><i class="ti ti-user-plus"></i></h3>
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
                                    <h6 class="fw-semibold mb-0">NIK</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Nama</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Aksi</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($guru as $key => $value) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $value['nik'] ?></td>
                                    <td><?= $value['nama_guru'] ?></td>
                                    <td>
                                        <a href="/guru/edit/<?= $value['id_guru'] ?>" class="btn btn-sm btn-warning"><i class="ti ti-edit fs-4"></i></a>
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