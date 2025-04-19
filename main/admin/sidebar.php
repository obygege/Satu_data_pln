<?php
include("../../config/koneksi.php");
$currentPage = basename($_SERVER['PHP_SELF']);

$query = "SELECT COUNT(*) AS total_pending FROM reset_password WHERE status = 'pending'";
$result = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($result);
$totalPending = $data['total_pending'];

mysqli_close($conn);
?>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style="position: sticky;">
    <div class="app-brand demo">
        <a href="index.php" class="app-brand-link">
            <span class="app-brand-logo demo"></span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">PLN ARSIP</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left d-block d-xl-none align-middle"></i>
        </a>
    </div>

    <div class="menu-divider mt-0"></div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item <?php if($currentPage == 'dashboard_admin.php') echo 'active'; ?>">
            <a href="dashboard_admin.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home"></i>
                <div class="text-truncate">Dashboards</div>
            </a>
        </li>

        <li class="menu-item <?php if($currentPage == 'data_user.php') echo 'active'; ?>">
            <a href="data_user.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div class="text-truncate">Data User</div>
            </a>
        </li>

        <li class="menu-item <?php if($currentPage == 'reset_password_user.php') echo 'active'; ?>">
            <a href="reset_password_user.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-key"></i>
                <div class="text-truncate">Reset Password</div>
                <span class="badge rounded-pill bg-danger ms-auto"><?= $totalPending ?></span>
            </a>
        </li>

        <li class="menu-item <?php if($currentPage == 'administrasi_umum.php' || $currentPage == 'sdm.php' || $currentPage == 'ti.php') echo 'active open'; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-folder"></i>
                <div class="text-truncate">Administrasi Umum</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?php if($currentPage == 'SDM.php') echo 'active'; ?>">
                    <a href="SDM.php" class="menu-link">
                        <div class="text-truncate">SDM</div>
                    </a>
                </li>
                <li class="menu-item <?php if($currentPage == 'TI.php') echo 'active'; ?>">
                    <a href="TI.php" class="menu-link">
                        <div class="text-truncate">TI</div>
                    </a>
                </li>
                <li class="menu-item <?php if($currentPage == 'TL_Pengadaan.php') echo 'active'; ?>">
                    <a href="TL_Pengadaan.php" class="menu-link">
                        <div class="text-truncate">TL Pengadaan</div>
                    </a>
                </li>
                <li class="menu-item <?php if($currentPage == 'TL_Pelaksana_K4.php') echo 'active'; ?>">
                    <a href="TL_Pelaksana_K4.php" class="menu-link">
                        <div class="text-truncate">TL Pelaksana K4</div>
                    </a>
                </li>
                <li class="menu-item <?php if($currentPage == 'TL_Lingkungan.php') echo 'active'; ?>">
                    <a href="TL_Lingkungan.php" class="menu-link">
                        <div class="text-truncate">TL Lingkungan</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item <?php if($currentPage == 'ophar.php') echo 'active open'; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div class="text-truncate">OPHAR</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?php if($currentPage == 'TL_Rendal.php') echo 'active'; ?>">
                    <a href="TL_Rendal.php" class="menu-link">
                        <div class="text-truncate">TL Rendal</div>
                    </a>
                </li>
                <li class="menu-item <?php if($currentPage == 'TL_Pemeliharaan.php') echo 'active'; ?>">
                    <a href="TL_Pemeliharaan.php" class="menu-link">
                        <div class="text-truncate">TL Pemeliharaan</div>
                    </a>
                </li>
                <li class="menu-item <?php if($currentPage == 'TL_Logistik.php') echo 'active'; ?>">
                    <a href="TL_Logistik.php" class="menu-link">
                        <div class="text-truncate">TL Logistik</div>
                    </a>
                </li>
                <li class="menu-item <?php if($currentPage == 'TL_Energi.php') echo 'active'; ?>">
                    <a href="TL_Energi.php" class="menu-link">
                        <div class="text-truncate">TL Energi</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item <?php if($currentPage == 'enjinering.php') echo 'active open'; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-wrench"></i>
                <div class="text-truncate">Enjinering</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?php if($currentPage == 'TL_Pengelolaan_Sistem.php') echo 'active'; ?>">
                    <a href="TL_Pengelolaan_Sistem.php" class="menu-link">
                        <div class="text-truncate">TL Pengelolaan Sistem</div>
                    </a>
                </li>
                <li class="menu-item <?php if($currentPage == 'TL_Pemeliharaan_Prediktif.php') echo 'active'; ?>">
                    <a href="TL_Pemeliharaan_Prediktif.php" class="menu-link">
                        <div class="text-truncate">TL Pemeliharaan Prediktif</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
