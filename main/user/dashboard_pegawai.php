<?php
session_start();
include('sessilogin.php'); 
include("../../config/koneksi.php"); 

if (!isset($_SESSION['nip'])) {
    die('NIP belum terdaftar.');
}
$nip = $_SESSION['nip'];

$nama_user = '';
$total_dokumen = 0;
$total_dokumen_keseluruhan = 0;
$growth_percentage = 0;

try {
    // Ambil nama user
    $sql_user = "SELECT nama FROM users WHERE nip = ?";
    $stmt_user = $conn->prepare($sql_user);
    $stmt_user->bind_param('s', $nip);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();
    $nama_user = ($result_user->num_rows > 0) ? $result_user->fetch_assoc()['nama'] : "Pengguna tidak ditemukan";

    // Total dokumen user
    $sql_dokumen = "SELECT COUNT(*) AS total_dokumen FROM dokumen WHERE nip = ?";
    $stmt_dokumen = $conn->prepare($sql_dokumen);
    $stmt_dokumen->bind_param('s', $nip);
    $stmt_dokumen->execute();
    $total_dokumen = $stmt_dokumen->get_result()->fetch_assoc()['total_dokumen'];

    // Total dokumen keseluruhan
    $sql_dokumen_keseluruhan = "SELECT COUNT(*) AS total_dokumen_keseluruhan FROM dokumen";
    $stmt_keseluruhan = $conn->prepare($sql_dokumen_keseluruhan);
    $stmt_keseluruhan->execute();
    $total_dokumen_keseluruhan = $stmt_keseluruhan->get_result()->fetch_assoc()['total_dokumen_keseluruhan'];

    // Hitung kontribusi user
    $growth_percentage = ($total_dokumen_keseluruhan > 0) ? ($total_dokumen / $total_dokumen_keseluruhan) * 100 : 0;

    $stmt_user->close();
    $stmt_dokumen->close();
    $stmt_keseluruhan->close();
    $conn->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>


<!doctype html>
<html
    lang="id">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard User</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assetss/img/favicon/Logo_PLN.png" />

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
                                <span class="w-px-22 h-px-22"><i class="icon-base">Dashboard</i></span>
                            </div>
                        </div>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-md-auto">
                            <!-- Place this tag where you want the button to render. -->
                            <!-- User -->
                            <?php
                            include('dropdown_user_pg.php');
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
                                    <!-- Card -->
                                    <div class="container mt-5">
                                        <div class="row" style="background-color: rgba(191, 191, 191, 0.1); border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); margin-bottom: 20px;">
                                            <div class="col-xxl-6 col-xl-6 col-md-6 mb-4">
                                                <div class="card-body">
                                                    <h5 class="card-title text-primary mb-3">Selamat Datang <span><?php echo htmlspecialchars($nama_user); ?></span></h5>
                                                    <p class="mb-6">
                                                        Kamu Sudah mengupload Dokumen Sebanyak<br /><?php echo $total_dokumen; ?> Dokumen
                                                    </p>

                                                    <a href="dokumen_anda.php" class="btn btn-sm btn-outline-primary">Lihat</a>
                                                </div>
                                            </div>
                                            <div class="col-sm-5 text-center text-sm-left">
                                                <div class="card-body pb-0 px-0 px-md-6" style="margin-right: 50px;">
                                                    <img
                                                        src="../../assetss/img/illustrations/Stu_data.png"
                                                        height="175"
                                                        alt="View Badge User" style="padding-left: 80%;" />
                                                </div>
                                            </div>

                                            <div class="col-xxl-6 col-xl-6 col-md-6 mb-4">
                                                <div class="card shadow-sm border-0 rounded" style="background-color: rgba(0, 43, 91, 0.05); border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                                                    <div class="card-body d-flex align-items-center">
                                                        <div class="icon bg-primary text-white rounded-circle p-3">
                                                            <i class="fas fa-cloud-upload-alt"></i>
                                                        </div>
                                                        <div class="ms-3">
                                                            <h5>Total Dokumen yang Di-upload</h5>
                                                            <p class="fs-4"><?php echo $total_dokumen; ?> dokumen</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Card 2: Total Dokumen Keseluruhan -->
                                            <div class="col-xxl-6 col-xl-6 col-md-6 mb-4">
                                                <div class="card shadow-sm border-0 rounded" style="background-color: #e6f0ff; border-radius: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                                                    <div class="card-body d-flex align-items-center">
                                                        <div class="icon bg-warning text-white rounded-circle p-3">
                                                            <i class="fas fa-file-alt"></i>
                                                        </div>
                                                        <div class="ms-3">
                                                            <h5>Total Dokumen Keseluruhan</h5>
                                                            <p class="fs-4"><?php echo $total_dokumen_keseluruhan; ?> dokumen</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" style="background-color: rgba(255, 255, 255, 0.1); border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); margin-bottom: 20px;">
                                            <div class="col-12 mb-4">
                                                <div class="card shadow-sm border-0 rounded" style="background-color: rgba(191, 191, 191, 0.1); border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); margin-bottom: 20px;">
                                                    <div class="card-body">
                                                        <!-- Daftar Dokumen Anda -->
                                                        <div class="row g-3">
                                                            <!-- Card Dokumen Saya -->
                                                            <div class="col-md-4">
                                                                <div class="card shadow-sm border-0 bg-white rounded-4">
                                                                    <div class="card-body" style="background-color: #e6f0ff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                                                                        <h6 class="text-muted">Dokumen Saya</h6>
                                                                        <h3 class="fw-bold text-primary"><?= $total_dokumen; ?></h3>
                                                                        <p class="mb-0 small">User: <strong><?= htmlspecialchars($nama_user); ?></strong></p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Card Total Dokumen -->
                                                            <div class="col-md-4">
                                                                <div class="card shadow-sm border-0 bg-white rounded-4">
                                                                    <div class="card-body" style="background-color: #e6f0ff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                                                                        <h6 class="text-muted">Total Dokumen</h6>
                                                                        <h3 class="fw-bold text-success"><?= $total_dokumen_keseluruhan; ?></h3>
                                                                        <p class="mb-0 small">Seluruh pengguna</p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Card Growth -->
                                                            <div class="col-md-4">
                                                                <div class="card shadow-sm border-0 bg-white rounded-4">
                                                                    <div class="card-body" style="background-color: #e6f0ff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                                                                        <h6 class="text-muted">Kontribusi Saya</h6>
                                                                        <h3 class="fw-bold text-warning"><?= number_format($growth_percentage, 1); ?>%</h3>
                                                                        <p class="mb-0 small">Dari total dokumen</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Card -->
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