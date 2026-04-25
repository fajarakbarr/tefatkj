<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TESLAR</title>
    <link rel="shortcut icon" type="image/png" href="/assets/images/backgrounds/hero.webp" />
    <link rel="stylesheet" href="/assets/css/styles.min.css" />
    <!-- My CSS -->
    <link rel="stylesheet" href="/assets/css/mycss.css">
    <!-- CSS DataTables -->
    <link rel="stylesheet" href="/assets/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="/assets/css/responsive.dataTables.min.css" />
    <!-- CSS SweetAlert -->
    <link rel="stylesheet" href="/assets/css/sweetalert2.min.css">
    <!-- CSS Dselect -->
    <link rel="stylesheet" href="/assets/css/dselect.min.css">

    <!-- poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body style="background-color: rgb(230, 230, 230);">
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <?= $this->include('layout/sidebar'); ?>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper vh-100">
            <!--  Header Start -->
            <?= $this->include('layout/header'); ?>
            <!--  Header End -->
            <!-- Content Start -->
            <div class="container-fluid">
                <?= $this->renderSection('content'); ?>
            </div>
            <!-- Content End -->
        </div>
    </div>

    <!-- Modal Ubah Password Di Header -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/ubahPassword/<?= session()->get('id_pengguna') ?>" method="post" id="formUbah">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="password_baru" placeholder="Password Baru" required>
                            <label for="floatingInput">Password Baru</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-dark" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-sm btn-primary">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Js Bawaan -->
    <script src="/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/sidebarmenu.js"></script>
    <script src="/assets/js/app.min.js"></script>
    <!-- <script src="/assets/libs/apexcharts/dist/apexcharts.min.js"></script> -->
    <script src="/assets/libs/simplebar/dist/simplebar.js"></script>
    <!-- <script src="/assets/js/dashboard.js"></script> -->

    <!-- Js DataTables -->
    <script src="/assets/js/dataTables.js"></script>
    <script src="/assets/js/dataTables.bootstrap5.js"></script>
    <script src="/assets/js/dataTables.responsive.js"></script>
    <script src="/assets/js/responsive.bootstrap5.js"></script>
    <script>
        DataTable.type('num', 'className', 'dt-body-left');
        DataTable.type('num-fmt', 'className', 'dt-body-left');
        DataTable.type('date', 'className', 'dt-body-left');
        $('#table').DataTable({
            ordering: false,
            responsive: true,
        });
        $('#table2').DataTable({
            responsive: true,
        });
    </script>
    <!-- Js SweetAlert -->
    <script src="/assets/js/sweetalert2.all.min.js"></script>
    <!-- Js Dselect -->
    <script src="/assets/js/dselect.min.js"></script>
    <script>
        const config = {
            search: true, // Toggle search feature. Default: false
            creatable: false, // Creatable selection. Default: false
            clearable: false, // Clearable selection. Default: false
            maxHeight: '360px', // Max height for showing scrollbar. Default: 360px
            size: '', // Can be "sm" or "lg". Default ''
        };
        dselect(document.querySelector('#dselect'), config);
        for (let i = 1; i < 11; i++) {
            dselect(document.querySelector('#dselect' + i), config);
        }
    </script>

    <!-- MY JS -->
    <script src="myjs.js"></script>

    <!-- Script Tambah -->
    <script>
        document.getElementById('formTambah').addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Apakah Anda Yakin Akan Menambah Data?',
                text: "Data akan disimpan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, simpan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit();
                }
            });
        });
    </script>

    <!-- Script Edit -->
    <script>
        document.getElementById('formEdit').addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Apakah Anda Yakin Akan Mengubah Data?',
                text: "Perubahan akan disimpan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, simpan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit();
                }
            });
        });
    </script>

    <!-- Script Ubah -->
    <script>
        document.getElementById('formUbah').addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Apakah Anda Yakin Akan Mengubah Password?',
                text: "Perubahan akan disimpan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, simpan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit();
                }
            });
        });
    </script>

    <!-- script toggle -->
    <script>
        function tombolToggle(event, id) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda Yakin Akan Mengubah Status Data?',
                text: "Perubahan akan disimpan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, simpan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika user menekan "Ya", submit form secara manual
                    document.getElementById("formToggle" + id).submit();
                }
            });
        }
    </script>

    <!-- script hapus -->
    <script>
        function tombolHapus(event, id) {
            event.preventDefault();

            Swal.fire({
                title: 'Apakah Anda Yakin Akan Menghapus Data?',
                text: "Perubahan akan disimpan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("formHapus" + id).submit();
                }
            });
        }
    </script>

    <!-- Script Berhasil -->
    <?php if (session()->get('berhasil')) : ?>
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "<?= session()->get('berhasil') ?>",
                icon: "success"
            });
        </script>
    <?php endif ?>

    <!-- Script gagal -->
    <?php if (session()->get('gagal')) : ?>
        <script>
            Swal.fire({
                title: "Gagal",
                text: "<?= session()->get('gagal') ?>",
                icon: "warning"
            });
        </script>
    <?php endif ?>

    <!-- Script multiple delete -->
    <script>
        $(document).ready(function() {
            if ($.fn.DataTable.isDataTable('#table3')) {
                $('#table3').DataTable().destroy();
            }

            let table = $('#table3').DataTable({
                columnDefs: [{
                    targets: 0,
                    orderable: false
                }],
                responsive: true
            });
            // array penyimpan data terpilih
            let selectedPengguna = [];
            // =========================
            // CHECKBOX ITEM
            // =========================
            $(document).on('change', '.checkItem', function() {
                let data = {
                    id_pengguna: $(this).data('id_pengguna'),
                };

                if ($(this).is(':checked')) {
                    if (!selectedPengguna.some(item => item.id_pengguna == data.id_pengguna)) {
                        selectedPengguna.push(data);
                    }
                } else {
                    selectedPengguna = selectedPengguna.filter(item => item.id_pengguna != data.id_pengguna);
                }
            });

            // =========================
            // CHECK ALL
            // =========================
            $('#checkAll').click(function() {
                let checked = this.checked;
                $('.checkItem').each(function() {
                    $(this).prop('checked', checked).trigger('change');
                });
            });

            // =========================
            // SINKRONISASI PAGINATION
            // =========================
            table.on('draw', function() {
                $('.checkItem').each(function() {
                    let id = $(this).data('id_pengguna');
                    if (selectedPengguna.some(item => item.id_pengguna == id)) {
                        $(this).prop('checked', true);
                    }
                });
            });

            // deleted selected
            $('#deleteSelected').click(function() {
                if (selectedPengguna.length === 0) {
                    Swal.fire({
                        title: "Peringatan",
                        text: "Pilih Data Dahulu!",
                        icon: "warning"
                    });
                    return;
                }

                let csrfName = $('#csrf_token').attr('name');
                let csrfHash = $('#csrf_token').val();

                Swal.fire({
                    title: 'Apakah Anda Yakin Akan Menghapus Data Terpilih?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log(selectedPengguna);
                        $.ajax({
                            url: '<?= base_url('pengguna/deleteMultiple'); ?>',
                            type: "POST",
                            data: {
                                pengguna: selectedPengguna,
                                [csrfName]: csrfHash
                            },
                            success: function(res) {
                                Swal.fire({
                                    title: "Peringatan",
                                    text: 'Data berhasil dihapus!!',
                                    icon: "success"
                                });
                                $('#csrf_token').val(res.csrfHash);
                                location.reload();
                            },
                            error: function() {
                                Swal.fire({
                                    title: "Peringatan",
                                    text: "Gagal menghapus data!",
                                    icon: "warning"
                                });
                            }
                        });
                    }
                });

            })
        });
    </script>

    <!-- Script multiple delete -->

    <!-- Script multiple status -->
    <script>
        $(document).ready(function() {
            if ($.fn.DataTable.isDataTable('#table3')) {
                $('#table3').DataTable().destroy();
            }

            let table = $('#table3').DataTable({
                columnDefs: [{
                    targets: 0,
                    orderable: false
                }],
                responsive: true
            });
            // array penyimpan data terpilih
            let selectedPengguna = [];
            // =========================
            // CHECKBOX ITEM
            // =========================
            $(document).on('change', '.checkItem', function() {
                let data = {
                    id_pengguna: $(this).data('id_pengguna'),
                };

                if ($(this).is(':checked')) {
                    if (!selectedPengguna.some(item => item.id_pengguna == data.id_pengguna)) {
                        selectedPengguna.push(data);
                    }
                } else {
                    selectedPengguna = selectedPengguna.filter(item => item.id_pengguna != data.id_pengguna);
                }
            });

            // =========================
            // CHECK ALL
            // =========================
            $('#checkAll').click(function() {
                let checked = this.checked;
                $('.checkItem').each(function() {
                    $(this).prop('checked', checked).trigger('change');
                });
            });

            // =========================
            // SINKRONISASI PAGINATION
            // =========================
            table.on('draw', function() {
                $('.checkItem').each(function() {
                    let id = $(this).data('id_pengguna');
                    if (selectedPengguna.some(item => item.id_pengguna == id)) {
                        $(this).prop('checked', true);
                    }
                });
            });

            // deleted selected
            $('#statusSelected').click(function() {
                if (selectedPengguna.length === 0) {
                    Swal.fire({
                        title: "Peringatan",
                        text: "Pilih Data Dahulu!",
                        icon: "warning"
                    });
                    return;
                }

                let csrfName = $('#csrf_token').attr('name');
                let csrfHash = $('#csrf_token').val();

                Swal.fire({
                    title: 'Apakah Anda Yakin Akan Mengubah Status Data Terpilih?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, ubah',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log(selectedPengguna);
                        $.ajax({
                            url: '<?= base_url('pengguna/statusMultiple'); ?>',
                            type: "POST",
                            data: {
                                pengguna: selectedPengguna,
                                [csrfName]: csrfHash
                            },
                            success: function(res) {
                                Swal.fire({
                                    title: "Peringatan",
                                    text: 'Data berhasil diubah!!',
                                    icon: "success"
                                });
                                $('#csrf_token').val(res.csrfHash);
                                location.reload();
                            },
                            error: function() {
                                Swal.fire({
                                    title: "Peringatan",
                                    text: "Gagal ubah data!",
                                    icon: "warning"
                                });
                            }
                        });
                    }
                });

            })
        });
    </script>

    <!-- Script preview gambar -->
    <script>
        document.getElementById("dokumentasi").addEventListener("change", function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById("preview");

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = "block";
                }

                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>