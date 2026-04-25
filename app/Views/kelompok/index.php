<?= $this->extend('main/index'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-sm d-flex align-items-stretch">
        <div class="card w-100 border border-2">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title fw-semibold">Daftar Kelompok</h5>
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Kelompok</li>
                        </ol>
                    </nav>
                    <a href="/kelompok/tambah" class="btn btn-sm btn-primary">Tambah Kelompok</a>
                </div>
                <h3 class="bg-primary rounded p-2 text-light"><i class="ti ti-box-multiple"></i></h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm d-flex align-items-stretch">
        <div class="card w-100 border border-2">
            <div class="card-body p-4">
                <div class="w-25">
                    <form action="/kelompok" method="get">
                        <select class="form-select border border-2" id="dselect" name="id_tahun_ajaran" aria-label="Default select example" onchange="form.submit()">
                            <option value="">Pilih Tahun Ajaran</option>
                            <option value="all">Semua Tahun Ajaran</option>
                            <?php if (isset($tahunAktif)) : ?>
                                <?php foreach ($tahunAjaran as $key => $value) : ?>
                                    <option value="<?= $value['id_tahun_ajaran'] ?>" <?= $value['id_tahun_ajaran'] == $tahunAktif ? 'selected' : '' ?>><?= $value['tahun_ajaran'] ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <?php foreach ($tahunAjaran as $key => $value) : ?>
                                    <option value="<?= $value['id_tahun_ajaran'] ?>"><?= $value['tahun_ajaran'] ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped text-nowrap mb-0 align-middle" id="table2">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">No</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Nama Kelompok</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Tahun Ajaran</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Aksi</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kelompok as $key => $value) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $value['nama_kelompok'] ?></td>
                                    <td><?= $value['tahun_ajaran'] ?></td>
                                    <td>

                                        <a href="/kelompok/edit/<?= $value['id_kelompok'] ?>" class="btn btn-sm btn-warning"><i class="ti ti-edit fs-4"></i></a>
                                        <form action="/kelompok/hapus/<?= $value['id_kelompok'] ?>" method="post" class="d-inline-block" id="formHapus<?= $value['id_kelompok'] ?>">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="tombolHapus(event, <?= $value['id_kelompok'] ?>)">
                                                <i class="ti ti-trash fs-4"></i>
                                            </button>
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