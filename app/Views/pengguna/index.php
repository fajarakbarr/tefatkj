<?= $this->extend('main/index'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-sm d-flex align-items-stretch">
        <div class="card w-100 border border-2">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title fw-semibold">Daftar Pengguna</h5>
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Pengguna</li>
                        </ol>
                    </nav>
                    <a href="/pengguna/tambah" class="btn btn-sm btn-primary">Tambah Admin</a>
                    <button id="deleteSelected" class="btn btn-sm btn-danger">Hapus Terpilih</button>
                    <button id="statusSelected" class="btn btn-sm btn-warning">Ubah Status Terpilih</button>
                </div>
                <h3 class="bg-primary rounded p-2 text-light"><i class="ti ti-users"></i></h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm d-flex align-items-stretch">
        <div class="card w-100 border border-2">
            <div class="card-body p-4">
                <input type="hidden" id="csrf_token" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                <div class="table-responsive">
                    <table class="table table-striped text-nowrap mb-0 align-middle" id="table3">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0"><input type="checkbox" id="checkAll"></h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">No</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Kode</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Nama</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Akses</h6>
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
                            foreach ($pengguna as $key => $value) : ?>
                                <?php $status = ($value['status_pengguna'] == 1) ? 'Menonakatifkan' : 'Mengaktifkan' ?>
                                <tr>
                                    <td>
                                        <?php if ($value['id_akses'] != '1') : ?>
                                            <!-- <input type="checkbox" class="checkItem" value="<?= $value['id_pengguna']; ?>"> -->
                                            <input type="checkbox" class="checkItem" data-id_pengguna="<?= $value['id_pengguna'] ?>">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $no++ ?></td>
                                    <td><?= $value['kode_pengguna'] ?></td>
                                    <td><?= $value['nama_pengguna'] ?></td>
                                    <td><?= $value['ket_akses'] ?></td>
                                    <td><?= $value['status_pengguna'] == 1 ? 'Aktif' : 'Pasif' ?></td>
                                    <td>
                                        <?php if ($value['id_akses'] == '1') : ?>
                                            <a href="/pengguna/edit/<?= $value['id_pengguna'] ?>" class="btn btn-sm btn-warning"><i class="ti ti-edit fs-4"></i></a>
                                        <?php endif; ?>
                                        <form action="/pengguna/toggle/<?= $value['id_pengguna'] ?>" method="post" class="d-inline-block" id="formToggle<?= $value['id_pengguna'] ?>">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm <?= $value['status_pengguna'] == 1 ? 'btn-danger' : 'btn-success' ?>" onclick="tombolToggle(event, <?= $value['id_pengguna'] ?>)">
                                                <i class="ti ti-power fs-4"></i>
                                            </button>
                                        </form>
                                        <?php if ($value['id_akses'] != '1') : ?>
                                            <form action="/pengguna/hapus/<?= $value['id_pengguna'] ?>" method="post" class="d-inline-block" id="formHapus<?= $value['id_pengguna'] ?>">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="tombolHapus(event, <?= $value['id_pengguna'] ?>)">
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
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>