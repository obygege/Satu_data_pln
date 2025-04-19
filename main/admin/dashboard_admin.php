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
    $sql_user = "SELECT nama FROM users WHERE nip = ?";
    $stmt_user = $conn->prepare($sql_user);
    $stmt_user->bind_param('s', $nip);  
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();

    if ($result_user->num_rows > 0) {
        $row_user = $result_user->fetch_assoc();
        $nama_user = $row_user['nama'];  
    } else {
        $nama_user = "Pengguna tidak ditemukan"; 
    }

    $sql_dokumen = "SELECT COUNT(*) AS total_dokumen FROM dokumen WHERE nip = ?";
    $stmt_dokumen = $conn->prepare($sql_dokumen);
    $stmt_dokumen->bind_param('s', $nip);
    $stmt_dokumen->execute();
    $result_dokumen = $stmt_dokumen->get_result();
    $total_dokumen = $result_dokumen->fetch_assoc()['total_dokumen'];

    $sql_dokumen_keseluruhan = "SELECT COUNT(*) AS total_dokumen_keseluruhan FROM dokumen";
    $stmt_dokumen_keseluruhan = $conn->prepare($sql_dokumen_keseluruhan);
    $stmt_dokumen_keseluruhan->execute();
    $result_dokumen_keseluruhan = $stmt_dokumen_keseluruhan->get_result();
    $total_dokumen_keseluruhan = $result_dokumen_keseluruhan->fetch_assoc()['total_dokumen_keseluruhan'];

    if ($total_dokumen_keseluruhan != 0) {
        $growth_percentage = ($total_dokumen / $total_dokumen_keseluruhan) * 100; 
    } else {
        $growth_percentage = 0;  
    }

    $stmt_user->close();
    $stmt_dokumen->close();
    $stmt_dokumen_keseluruhan->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    $conn->close();
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

    <title>Dashboard Admin</title>

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
                                    <!-- Card -->
                                    <div class="container mt-5">
                                        <div class="row">
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
                                                <div class="card-body pb-0 px-0 px-md-6">
                                                    <img
                                                        src="../../assetss/img/illustrations/Stu_data.png"
                                                        height="175"
                                                        alt="View Badge User" style="padding-left: 80%;" />
                                                </div>
                                            </div>

                                            <div class="col-xxl-6 col-xl-6 col-md-6 mb-4">
                                                <div class="card shadow-sm border-0 rounded">
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
                                                <div class="card shadow-sm border-0 rounded">
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

                                        <div class="row">
                                            <div class="col-12 mb-4">
                                                <div class="card shadow-sm border-0 rounded">
                                                    <div class="card-body">
                                                        <!-- Diagram -->
                                                        <div class="row row-bordered g-0">
                                                            <div class="col-lg-8">
                                                                <div class="card">
                                                                    <div class="card-header d-flex align-items-center justify-content-between">
                                                                        <div class="card-title mb-0">
                                                                            <h5 class="m-0 me-2">Total Dokumen dan Total Dokumen Keseluruhan</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="px-3">
                                                                        <canvas id="dokumenChart" width="350" height="250"></canvas>
                                                                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                                                        <script>
                                                                            var totalDokumen = <?php echo $total_dokumen; ?>;
                                                                            var totalDokumenKeseluruhan = <?php echo $total_dokumen_keseluruhan; ?>;

                                                                            var ctx = document.getElementById('dokumenChart').getContext('2d');
                                                                            var dokumenChart = new Chart(ctx, {
                                                                                type: 'bar',
                                                                                data: {
                                                                                    labels: ['Total Dokumen', 'Total Dokumen Keseluruhan'],
                                                                                    datasets: [{
                                                                                        label: 'Dokumen Comparison',
                                                                                        data: [totalDokumen, totalDokumenKeseluruhan],
                                                                                        backgroundColor: [
                                                                                            'rgba(54, 162, 235, 0.5)',
                                                                                            'rgba(255, 159, 64, 0.5)'
                                                                                        ],
                                                                                        borderColor: [
                                                                                            'rgba(54, 162, 235, 1)',
                                                                                            'rgba(255, 159, 64, 1)'
                                                                                        ],
                                                                                        borderWidth: 1
                                                                                    }]
                                                                                },
                                                                                options: {
                                                                                    responsive: true,
                                                                                    plugins: {
                                                                                        legend: {
                                                                                            position: 'top',
                                                                                        },
                                                                                        tooltip: {
                                                                                            backgroundColor: 'rgba(0, 0, 0, 0.7)',
                                                                                            titleColor: '#fff',
                                                                                            bodyColor: '#fff',
                                                                                            borderColor: '#ddd',
                                                                                            borderWidth: 1
                                                                                        }
                                                                                    },
                                                                                    scales: {
                                                                                        y: {
                                                                                            beginAtZero: true,
                                                                                        }
                                                                                    }
                                                                                }
                                                                            });
                                                                        </script>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Card for Daftar Dokumen -->
                                                            <div class="col-lg-4">
                                                                <div class="card">
                                                                    <div class="card-body px-xl-9 py-12 d-flex align-items-center flex-column" style="margin-left: 10%;">
                                                                        <div class="text-center mb-6">
                                                                            <h5 class="m-0">Daftar Dokumen</h5>
                                                                        </div>

                                                                        <!-- Menampilkan daftar dokumen -->
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>No</th>
                                                                                        <th>Nama</th>
                                                                                        <th>NIP</th>
                                                                                        <th>Bidang</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    // Query untuk mengambil data dari tabel users
                                                                                    $sql_user_list = "SELECT nama, nip, bidang FROM users";
                                                                                    $result_user_list = $conn->query($sql_user_list);

                                                                                    if ($result_user_list->num_rows > 0) {
                                                                                        $no = 1; // Inisialisasi nomor urut
                                                                                        while ($row = $result_user_list->fetch_assoc()) {
                                                                                            echo "<tr>
                        <td>" . $no++ . "</td> <!-- Nomor urut -->
                        <td>" . htmlspecialchars($row['nama']) . "</td>
                        <td>" . htmlspecialchars($row['nip']) . "</td>
                        <td>" . htmlspecialchars($row['bidang']) . "</td>
                    </tr>";
                                                                                        }
                                                                                    } else {
                                                                                        echo "<tr><td colspan='4' class='text-center'>Tidak ada data pengguna</td></tr>";
                                                                                    }
                                                                                    ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
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