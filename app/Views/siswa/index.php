<?= $this->extend('main/index'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-sm d-flex align-items-stretch">
        <div class="card w-100 border border-2">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title fw-semibold">Daftar Siswa</h5>
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Siswa</li>
                        </ol>
                    </nav>
                    <?php if (isset(session()->get('errors')['excel_file'])) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?= session()->get('errors')['excel_file'] ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->get('errors') != null) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?= session()->get('errors') ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <a href="/siswa/tambah" class="btn btn-sm btn-primary">Tambah Siswa</a>
                    <a href="/assets/files/import/contohfile.xlsx" class="btn btn-sm btn-primary">Contoh File Import</a>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#importSiswa">
                        Import Siswa
                    </button>
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
                <div class="w-25">
                    <form action="/siswa" method="get">
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
                                    <h6 class="fw-semibold mb-0">NIS</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Nama</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Kelas</h6>
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
                            foreach ($siswa as $key => $value) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $value['nis'] ?></td>
                                    <td><?= $value['nama_siswa'] ?></td>
                                    <td><?= $value['kelas'] == '1' ? 'TKJ-1' : 'TKJ-2' ?></td>
                                    <td><?= $value['tahun_ajaran'] ?></td>
                                    <td>
                                        <a href="/siswa/edit/<?= $value['id_siswa'] ?>" class="btn btn-sm btn-warning"><i class="ti ti-edit fs-4"></i></a>
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

<!-- Modal -->
<div class="modal fade" id="importSiswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Import Siswa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/siswa/import" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="excel_file" class="form-label">Masukan File</label>
                        <input class="form-control" name="excel_file" type="file" id="excel_file">
                        <?php if (isset(session()->get('errors')['excel_file'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->get('errors')['excel_file'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary">Import</button>
                    <button type="button" class="btn btn-sm btn-dark" data-bs-dismiss="modal">Kembali</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>