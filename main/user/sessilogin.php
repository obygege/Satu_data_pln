<?php
include('../../config/koneksi.php');
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'pegawai') {
    header("Location: ../../index.php");
    exit();
}
?>