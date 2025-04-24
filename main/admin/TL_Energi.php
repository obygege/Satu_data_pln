<?php
session_start();
include('sessilogin.php');
include("../../config/koneksi.php");

$perPage = 5;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $perPage;

$query = "SELECT dokumen.*, users.nama AS nama_user 
          FROM dokumen 
          JOIN users ON dokumen.nip = users.nip 
          WHERE dokumen.bidang = 'TL Energi' 
          LIMIT $start, $perPage";
$result = mysqli_query($conn, $query);

$totalQuery = "SELECT COUNT(*) AS total 
               FROM dokumen 
               WHERE bidang = 'TL Energi'";
$totalResult = mysqli_query($conn, $totalQuery);
$totalData = mysqli_fetch_assoc($totalResult);
$totalDocs = $totalData['total'];
$totalPages = ceil($totalDocs / $perPage);
?>

<!doctype html>
<html
    lang="id">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Data TL Energi</title>

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
                                <span class="w-px-22 h-px-22"><i class="icon-base bx bx-search icon-md"></i></span>
                                <input
                                    type="text"
                                    class="form-control border-0 shadow-none ps-1 ps-sm-2 d-md-block d-none"
                                    placeholder="Search..."
                                    aria-label="Search..." />
                            </div>
                        </div>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-md-auto">
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
                                        <div class="card-header d-flex align-items-center justify-content-between">
                                            <h5 class="mb-0">Dokumen TL Energi</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="container mt-5">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped table-hover">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th>No</th>
                                                                <th>NIP</th>
                                                                <th>Nama User</th>
                                                                <th>Nama Dokumen</th>
                                                                <th>Bidang</th>
                                                                <th>Keterangan</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $no = $start + 1;

                                                            if (mysqli_num_rows($result) > 0) {
                                                                while ($doc = mysqli_fetch_assoc($result)) {
                                                            ?>
                                                                    <tr>
                                                                        <td><?= $no++ ?></td>
                                                                        <td><?= htmlspecialchars($doc['nip']) ?></td>
                                                                        <td><?= htmlspecialchars($doc['nama_user']) ?></td>
                                                                        <td><?= htmlspecialchars($doc['nama_dokumen']) ?></td>
                                                                        <td><?= htmlspecialchars($doc['bidang']) ?></td>
                                                                        <td><?= htmlspecialchars($doc['keterangan']) ?></td>
                                                                        <td>
                                                                            <!-- Lihat Button -->
                                                                            <a href="../../proses/lihat_dokumen.php?id=<?= $doc['id'] ?>" class="btn btn-primary btn-sm">
                                                                                <i class="fas fa-eye"></i> Lihat
                                                                            </a>

                                                                            <!-- Download Button -->
                                                                            <a href="../../proses/download.php?id=<?= $doc['id'] ?>" class="btn btn-success btn-sm">
                                                                                <i class="fas fa-download"></i> Download
                                                                            </a>

                                                                            <!-- Aktivitas Button -->
                                                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#aktivitasModal" onclick="loadAktivitas(<?= $doc['id'] ?>)">
                                                                                <i class="fas fa-info-circle"></i> Aktivitas
                                                                            </button>

                                                                            <!-- Pop Up Siapa Saja yang mengakses dokumen -->
                                                                            <!-- Modal Aktivitas -->
                                                                            <div class="modal fade" id="aktivitasModal" tabindex="-1" aria-labelledby="aktivitasModalLabel" aria-hidden="true">
                                                                                <div class="modal-dialog modal-lg">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="aktivitasModalLabel">Aktivitas Dokumen</h5>
                                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div id="aktivitasContent">
                                                                                                <!-- Data aktivitas akan dimuat di sini -->
                                                                                                <p>Memuat data...</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- Pop Up Selesai -->

                                                                            <!-- JS Function Pop Up -->
                                                                            <script>
                                                                                function loadAktivitas(docId) {
                                                                                    // Tampilkan loading sementara
                                                                                    document.getElementById('aktivitasContent').innerHTML = '<p>Memuat data...</p>';

                                                                                    // Gunakan AJAX untuk mendapatkan data aktivitas berdasarkan id dokumen
                                                                                    var xhr = new XMLHttpRequest();
                                                                                    xhr.open('GET', 'aktivitas.php?id=' + docId, true);
                                                                                    xhr.onload = function() {
                                                                                        if (xhr.status === 200) {
                                                                                            // Tampilkan data aktivitas ke dalam modal
                                                                                            document.getElementById('aktivitasContent').innerHTML = xhr.responseText;
                                                                                        } else {
                                                                                            document.getElementById('aktivitasContent').innerHTML = '<p>Terjadi kesalahan saat memuat data.</p>';
                                                                                        }
                                                                                    };
                                                                                    xhr.send();
                                                                                }
                                                                            </script>
                                                                            <!-- Function End -->
                                                                        </td>
                                                                    </tr>
                                                            <?php
                                                                }
                                                            } else {
                                                                echo "<tr><td colspan='7' class='text-center'>Tidak ada dokumen yang ditemukan</td></tr>";
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <div class="d-flex justify-content-between" style="margin-top: 10px;">
                                                        <nav aria-label="Page navigation">
                                                            <ul class="pagination">
                                                                <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                                                    <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                                                                        <span aria-hidden="true">&laquo;</span>
                                                                    </a>
                                                                </li>

                                                                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                                                    <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                                                                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                                                    </li>
                                                                <?php } ?>

                                                                <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                                                                    <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                                                                        <span aria-hidden="true">&raquo;</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                </div>

                                                <?php
                                                mysqli_close($conn);
                                                ?>
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

        <script>
            document.getElementById('searchInput').addEventListener('input', function() {
                const keyword = this.value.toLowerCase();
                const rows = document.querySelectorAll('table tbody tr');

                rows.forEach(row => {
                    const text = row.innerText.toLowerCase();
                    if (text.includes(keyword)) {
                        row.style.display = '';
                        row.classList.add('table-primary');
                    } else {
                        row.style.display = 'none';
                        row.classList.remove('table-primary');
                    }
                });
            });
        </script>


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

        <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>