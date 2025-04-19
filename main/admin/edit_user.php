<?php
session_start();
include('sessilogin.php');
include("../../config/koneksi.php");

$nip = $_GET['nip'];
$query = "SELECT * FROM users WHERE nip = '$nip'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!doctype html>
<html
    lang="id">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Edit User</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assetss/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="../../assetss/vendor/fonts/iconify-icons.css" />

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="../../assetss/vendor/css/core.css" />
    <link rel="stylesheet" href="../../assetss/css/demo.css" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="../../assetss/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- endbuild -->

    <link rel="stylesheet" href="../../assetss/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../../assetss/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="../../assetss/js/config.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?php
            include('sidebar.php');
            ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav
                    class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                            <i class="icon-base bx bx-menu icon-md"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center me-auto">
                            <div class="nav-item d-flex align-items-center">
                                <span class="w-px-22 h-px-22"><i class="icon-base">Daftar User</i></span>
                            </div>
                        </div>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-md-auto">
                            <!-- Place this tag where you want the button to render. -->
                            <!-- User -->
                            <?php
                            include('dropdown_user.php');
                            ?>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <!-- New -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Basic Layout & Basic with Icons -->
                        <div class="row mb-6 gy-6">
                            <!-- Basic Layout -->
                            <div class="col-xxl">
                                <div class="card">
                                    <!-- Basic with Icons -->
                                    <div class="col-xxl">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="container mt-5">
                                                    <div class="container mt-5">
                                                        <div class="container mt-5">
                                                            <h4>Edit Pengguna</h4>
                                                            <form action="../../proses/edit_user.php" method="POST" enctype="multipart/form-data">
                                                                <div class="mb-3">
                                                                    <label for="nip" class="form-label">NIP</label>
                                                                    <input type="text" class="form-control" id="nip" name="nip" value="<?= $user['nip'] ?>" readonly>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="nama" class="form-label">Nama</label>
                                                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama'] ?>" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="role" class="form-label">Role</label>
                                                                    <select class="form-select" id="role" name="role" required>
                                                                        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                                                        <option value="pegawai" <?= $user['role'] == 'pegawai' ? 'selected' : '' ?>>Pegawai</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="bidang" class="form-label">Bidang</label>
                                                                    <select class="form-control" id="bidang" name="bidang" required>
                                                                        <option value="">-- Pilih Bidang --</option>
                                                                        <option value="SDM">SDM</option>
                                                                        <option value="TI">TI</option>
                                                                        <option value="TL Pengadaan">TL Pengadaan</option>
                                                                        <option value="TL Pelaksana K4">TL Pelaksana K4</option>
                                                                        <option value="TL Rendal">TL Rendal</option>
                                                                        <option value="TL Pemeliharaan">TL Pemeliharaan</option>
                                                                        <option value="TL Logistik">TL Logistik</option>
                                                                        <option value="TL Energi">TL Energi</option>
                                                                        <option value="TL Pengelolaan Sistem">TL Pengelolaan Sistem</option>
                                                                        <option value="TL Pemeliharaan Prediktif">TL Pemeliharaan Prediktif</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="avatar" class="form-label">Avatar</label>
                                                                    <input type="file" class="form-control" id="avatar" name="avatar">
                                                                    <img src="<?= $user['avatar'] ?>" alt="Avatar" class="rounded-circle" style="width: 40px; height: 40px;">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="password" class="form-label">Password</label>
                                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru (Opsional)">
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End -->
                            <!-- / Content -->

                            <!-- Footer -->
                            <?php
                            include('footer.php');
                            ?>
                            <!-- / Footer -->

                            <div class="content-backdrop fade"></div>
                        </div>
                        <!-- Content wrapper -->
                    </div>
                    <!-- / Layout page -->
                </div>

                <!-- Overlay -->
                <div class="layout-overlay layout-menu-toggle"></div>
            </div>
            <!-- / Layout wrapper -->

            <!-- Core JS -->

            <script src="../../assetss/vendor/libs/jquery/jquery.js"></script>

            <script src="../../assetss/vendor/libs/popper/popper.js"></script>
            <script src="../../assetss/vendor/js/bootstrap.js"></script>

            <script src="../../assetss/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

            <script src="../../assetss/vendor/js/menu.js"></script>

            <!-- endbuild -->

            <!-- Vendors JS -->
            <script src="../../assetss/vendor/libs/apex-charts/apexcharts.js"></script>

            <!-- Main JS -->

            <script src="../../assetss/js/main.js"></script>

            <!-- Page JS -->
            <script src="../../assetss/js/dashboards-analytics.js"></script>

            <!-- Place this tag before closing body tag for github widget button. -->
            <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>