<?php
session_start();
include("../config/koneksi.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = mysqli_query($conn, "SELECT * FROM dokumen WHERE id = '$id'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $file_path = "../assetss/img/dokumen/" . $data['nama_dokumen'];

        if (file_exists($file_path)) {
            unlink($file_path);
        }

        $delete = mysqli_query($conn, "DELETE FROM dokumen WHERE id = '$id'");

        if ($delete) {
            echo "<script>alert('Dokumen berhasil dihapus.'); window.location.href='../main/user/dokumen_anda.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus dokumen di database.'); window.location.href='../main/user/dokumen_anda.php';</script>";
        }
    } else {
        echo "<script>alert('Data dokumen tidak ditemukan.'); window.location.href='../main/user/dokumen_anda.php';</script>";
    }
} else {
    echo "<script>alert('ID dokumen tidak ditemukan.'); window.location.href='../main/user/dokumen_anda.php';</script>";
}
?>
