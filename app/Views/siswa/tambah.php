<?= $this->extend('main/index'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-sm d-flex align-items-stretch">
        <div class="card w-100 border border-2">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold">Form Tambah Siswa</h5>
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/siswa">Siswa</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </nav>

                <form action="/siswa/simpan" method="post" id="formTambah">
                    <?= csrf_field() ?>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control <?= isset(session()->get('errors')['nis']) ? 'is-invalid' : '' ?>" name="nis" id="nis" placeholder="Siswa" value="<?= old('nis') ?>" autocomplete="off">
                        <?php if (isset(session()->get('errors')['nis'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->get('errors')['nis'] ?>
                            </div>
                        <?php endif; ?>
                        <label for="nis">NIS</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control <?= isset(session()->get('errors')['nama_siswa']) ? 'is-invalid' : '' ?>" name="nama_siswa" id="nama_siswa" placeholder="Siswa" value="<?= old('nama_siswa') ?>" autocomplete="off">
                        <?php if (isset(session()->get('errors')['nama_siswa'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->get('errors')['nama_siswa'] ?>
                            </div>
                        <?php endif; ?>
                        <label for="nama_siswa">Nama</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select <?= isset(session()->get('errors')['kelas']) ? 'is-invalid' : '' ?>" id="floatingSelect" name="kelas" aria-label="Floating label select example">
                            <option value="">Pilih Kelas</option>
                            <option value="1">TKJ-1</option>
                            <option value="2">TKJ-2</option>
                        </select>
                        <?php if (isset(session()->get('errors')['kelas'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->get('errors')['kelas'] ?>
                            </div>
                        <?php endif; ?>
                        <label for="kelas">Kelas</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control <?= isset(session()->get('errors')['password_siswa']) ? 'is-invalid' : '' ?>" name="password_siswa" id="password_siswa" placeholder="Password" value="<?= old('password_siswa') ?>" autocomplete="off">
                        <?php if (isset(session()->get('errors')['password_siswa'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->get('errors')['password_siswa'] ?>
                            </div>
                        <?php endif; ?>
                        <label for="password_siswa">Password</label>
                    </div>
                    <div class="mb-3">
                        <select class="form-select <?= isset(session()->get('errors')['id_tahun_ajaran']) ? 'is-invalid' : '' ?>" id="dselect" name="id_tahun_ajaran" aria-label="Floating label select example">
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
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select <?= isset(session()->get('errors')['id_akses']) ? 'is-invalid' : '' ?>" id="floatingSelect" name="id_akses" aria-label="Floating label select example">
                            <option value="">Pilih Akses</option>
                            <option value="3">Ketua</option>
                            <option value="4">Anggota</option>
                        </select>
                        <?php if (isset(session()->get('errors')['id_akses'])) : ?>
                            <div class="invalid-feedback">
                                <?= session()->get('errors')['id_akses'] ?>
                            </div>
                        <?php endif; ?>
                        <label for="id_akses">Akses</label>
                    </div>
                    <div class="text-end">
                        <a href="/siswa" class="btn btn-sm btn-dark">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>