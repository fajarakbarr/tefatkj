<?= $this->extend('cms/index'); ?>

<?= $this->section('content'); ?>
<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-bg fixed-top">
    <div class="container">
        <a class="navbar-brand text-light" href="#">
            <img src="/assets/images/backgrounds/hero.webp" alt="Logo" width="40" class="d-inline-block me-2">
            TESLAR</a>
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-light" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#portofolio">Portofolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light btn-dashboard" href="/dashboard"><i class="ti ti-layout-dashboard me-2 fs-6"></i>Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- PORTOFOLIO -->
<section class="portofolio-section scroll-section fade-init portofolioDetail" id="portofolio">
    <div class="container">
        <div class="row portofolio-content">
            <div class="col-12">
                <h2 class="portofolio-judul">PORTOFOLIO</h2>
                <p class="portofolio-subjudul">Galeri Portofolio Jurusan Teknik Komputer dan Jaringan <br> SMK Negeri 2 Pekalongan</p>

                <form action="/portofolioDetail" method="get" class="portofolio-filter" id="formPortofolio">
                    <p>Tahun Ajaran</p>
                    <i class="ti ti-filter" style="font-size: 1.5rem;"></i>
                    <select class="form-select" aria-label="Default select example" style="width: 200px;" onclick="border()" name="tahun" onchange="byTahun()">
                        <option value="all">Semua Tahun Ajaran</option>
                        <?php if (!empty($tahunAjaran)) : ?>
                            <?php foreach ($tahunAjaran as $key => $value) : ?>
                                <option value="<?= $value['id_tahun_ajaran'] ?>" <?= $tahun == $value['id_tahun_ajaran'] ? "selected" : '' ?>><?= $value['tahun_ajaran'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </form>

                <?php if (!empty($portofolio_total)) : ?>
                    <div class="portofolioWrapper">
                        <?php foreach ($portofolio_total as $key => $value) : ?>
                            <div class="card card-portofolio">
                                <img src="/assets/images/dokumentasi/<?= $value['dokumentasi'] ?>" class="card-img-top card-dokumentasi" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title card-title-portofolio"><?= esc($value['nama_kegiatan']) ?></h5>
                                    <p class="card-text"><i class="ti ti-calendar me-1"></i><?= date('d-M-Y', strtotime($value['tanggal'])) ?> - <i class="ti ti-building me-1"></i><?= $value['tempat'] ?></p>
                                    <p class="card-text"><?= $value['jenis_pelayanan'] ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                <?php else : ?>
                    <div class="card portofolio-kosong">
                        <div class="card-body">
                            Belum Ada Portofolio.
                        </div>
                    </div>
                <?php endif; ?>

            </div>
            <!-- ANCOR KONTAK -->
            <!-- <div id="kontak" class="scroll-section"></div> -->
        </div>
    </div>
</section>

<!-- FOOTER -->
<section class="footer">
    <div class="copyright">
        <div class="footer-line"></div>
        <p><a href="">© 2026 SMK Negeri 2 Pekalongan</a></p>
    </div>
</section>
<?= $this->endSection(); ?>