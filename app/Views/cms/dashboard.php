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
                    <a class="nav-link text-light" href="#beranda">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#portofolio">Portofolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#kontak">Kontak</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light btn-dashboard" href="/dashboard"><i class="ti ti-layout-dashboard me-2 fs-6"></i>Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- HERO -->
<section class="hero-section scroll-section fade-init" id="beranda">
    <!-- <div class="blue-area"> -->
    <div class="silhouette-bg"></div>
    <!-- </div> -->

    <div class="container hero-container">
        <div class="row hero-content">
            <div class="col-md-6 colom-1">
                <h5 class="hero-text"><i class="ti ti-access-point me-2"></i>SMK NEGERI 2 PEKALONGAN</h5>
                <h1 class="hero-judul">TESLAR</h1>
                <h1 class="hero-subjudul">TEFA SMEA LAN NETWORKING</h1>
                <p class="text-light hero-deskripsi">TESLAR adalah sistem informasi yang dirancang sebagai Ekosistem Integrasi Digital yang menggabungkan fungsi Galeri Portofolio Dinamis dengan Unit Layanan Profesional berstandar industri. Sistem ini menjadi manifestasi nyata dari kurikulum berbasis produksi yang diterapkan di jurusan Teknik Komputer dan Jaringan pada SMK Negeri 2 Pekalongan.</p>

                <!-- colom proyek baru -->
                <div class="col-proyek">
                    <div class="col-proyek-1">
                        <p class="total-proyek"><?= $kegiatan ?></p>
                        <p class="proyek">Proyek Selesai</p>
                    </div>
                    <div class="col-proyek-2">
                        <p class="total-angkatan"><?= $siswa ?></p>
                        <p class="angkatan">Total Siswa Angkatan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 colom-2">
                <img src="/assets/images/backgrounds/hero.webp" class="hero-gambar" alt="">
                <p><i class="ti ti-ripple me-1"></i>Dinamis</p>
                <p><i class="ti ti-briefcase me-1"></i>Professional</p>
                <p><i class="ti ti-settings me-1"></i>Terintergarsi</p>
            </div>

        </div>
        <!-- <div id="portofolio"></div> -->
    </div>
</section>

<!-- PORTOFOLIO -->
<section class="portofolio-section scroll-section fade-init" id="portofolio">
    <div class="container">
        <div class="row portofolio-content">
            <div class="col-12">
                <h2 class="portofolio-judul">PORTOFOLIO</h2>
                <p class="portofolio-subjudul">Galeri Portofolio Jurusan Teknik Komputer dan Jaringan <br> SMK Negeri 2 Pekalongan</p>

                <?php if (!empty($portofolio_total)) : ?>
                    <div class="swiper mySwiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <?php foreach ($portofolio_total as $key => $value) : ?>
                                <div class="swiper-slide" id="portofolioWrapper">
                                    <div class="card card-portofolio">
                                        <img src="/assets/images/dokumentasi/<?= $value['dokumentasi'] ?>" class="card-img-top card-dokumentasi" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title card-title-portofolio"><?= esc($value['nama_kegiatan']) ?></h5>
                                            <p class="card-text"><i class="ti ti-calendar me-1"></i><?= date('d-M-Y', strtotime($value['tanggal'])) ?> - <i class="ti ti-building me-1"></i><?= $value['tempat'] ?></p>
                                            <p class="card-text"><?= $value['jenis_pelayanan'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                <?php else : ?>
                    <div class="card portofolio-kosong">
                        <div class="card-body">
                            Belum Ada Portofolio.
                        </div>
                    </div>
                <?php endif; ?>

                <div class="portofolio-wrapper">
                    <a href="/portofolioDetail" class="btn-portofolio">
                        <i class="ti ti-arrow-right"></i>Lihat Portofolio Lebih Detail
                    </a>
                </div>
            </div>
            <!-- ANCOR KONTAK -->
            <!-- <div id="kontak" class="scroll-section"></div> -->
        </div>
    </div>
</section>

<!-- KONTAK -->
<section class="kontak-section scroll-section fade-init" id="kontak">
    <div class="container">
        <div class="row kontak-content">
            <div class="col-12">
                <h2 class=" kontak-judul">KONTAK KAMI</h2>
                <p class=" kontak-subjudul">Jika Anda memiliki pertanyaan atau membutuhkan bantuan, jangan ragu untuk menghubungi kami.</p>
                <!-- MAPS -->
                <div class="maps">
                    <iframe class="maps-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.045691356385!2d109.66205657475676!3d-6.8851305931138285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70251b5e1a6f57%3A0x73eb625318184632!2sSMK%20Negeri%202%20Pekalongan!5e0!3m2!1sen!2sid!4v1775653612800!5m2!1sen!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <!-- INFORMASI KONTAK -->
                <div class="card">
                    <div class="card-body card-body-kontak">
                        <p class="kontak-icon"><i class="ti ti-info-circle me-2"></i>Informasi Kontak</p>
                        <div class="row">
                            <div class="col">
                                <div class="kontak-maps">
                                    <p><i class="ti ti-map-pin me-2 icon-info"></i></p>
                                    <p>Jl. Perintis Kemerdekaan No. 29, Pasirkratonkramat Kota Pekalongan</p>
                                </div>
                                <div class="kontak-wa">
                                    <p><i class="ti ti-brand-whatsapp me-2 icon-info"></i></p>
                                    <p>+62 823-1306-1395</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<section class="footer-section">
    <div class="container">
        <div class="row footer-content">
            <div class="col-md">
                <img src="/assets/images/backgrounds/hero.webp" width="100" alt="" srcset="">
                <p class="footer-judul">TESLAR</p>
                <p class="footer-subjudul">TEFA SMEA LAN NETWORKING</p>
                <p class="footer-deskripsi">TESLAR adalah sistem informasi yang dirancang sebagai Ekosistem Integrasi Digital yang menggabungkan fungsi Galeri Portofolio Dinamis dengan Unit Layanan Profesional berstandar industri. Sistem ini menjadi manifestasi nyata dari kurikulum berbasis produksi yang diterapkan di jurusan Teknik Komputer dan Jaringan pada SMK Negeri 2 Pekalongan.</p>
            </div>
            <div class="col-md">
                <h2 class="layanan">Layanan Pengaduan</h2>
                <p><i class="ti ti-building-skyscraper me-2"></i>SMK Negeri 2 Pekalongan</p>
                <p><i class="ti ti-map-pin me-2"></i>Jl. Perintis Kemerdekaan No. 29, Pasirkratonkramat Kota Pekalongan</p>
                <p><i class="ti ti-brand-whatsapp me-2"></i>+62 823-1306-1395</p>
                <!-- SOSMED -->
                <h2 class="sosmed">Ikuti Kami</h2>
                <a href="https://www.instagram.com/officialsmkn2pekalongan?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="instagram"><i class="ti ti-brand-instagram me-2"></i></a>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="footer-line"></div>
        <p><a href="https://www.instagram.com/fajarakbarrr_/?hl=en" target="_blank">© 2026 SMK Negeri 2 Pekalongan</a></p>
    </div>
</section>
<?= $this->endSection(); ?>