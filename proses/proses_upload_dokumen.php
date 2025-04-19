<?php
include("../config/koneksi.php");

session_start();

if (isset($_SESSION['nip'])) {
    $nip = $_SESSION['nip']; 
} elseif (isset($_POST['nip'])) {
    $nip = $_POST['nip']; 
} else {
    echo "<script>alert('NIP tidak ditemukan.');</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role = htmlspecialchars($_POST['role']);
    $bidang = htmlspecialchars($_POST['bidang']);
    // Periksa apakah keterangan kosong, jika ya, set menjadi NULL
    $keterangan = !empty($_POST['keterangan']) ? htmlspecialchars($_POST['keterangan']) : NULL;
    $dokumen = $_FILES['dokumen'];

    $uploadDir = '../assetss/img/dokumen/';
    $fileExtension = strtolower(pathinfo($dokumen['name'], PATHINFO_EXTENSION));

    $allowedExtensions = ['pdf', 'docx', 'xlsx', 'pptx', 'jpg', 'png'];

    $maxFileSize = 5 * 1024 * 1024;

    if (!in_array($fileExtension, $allowedExtensions)) {
        echo "<script>alert('Jenis file tidak diizinkan.');</script>";
        exit;
    }

    if ($dokumen['size'] > $maxFileSize) {
        echo "<script>alert('Ukuran file terlalu besar. Maksimal ukuran file adalah 5MB.');</script>";
        exit;
    }

    $safeFileName = basename($dokumen['name']);
    $safeFileName = preg_replace('/[^a-zA-Z0-9\-_\.]/', '', $safeFileName);

    $uploadFile = $uploadDir . $safeFileName;

    if (move_uploaded_file($dokumen['tmp_name'], $uploadFile)) {
        // Mengamankan input sebelum query
        $nip = mysqli_real_escape_string($conn, $nip);
        $role = mysqli_real_escape_string($conn, $role);
        $bidang = mysqli_real_escape_string($conn, $bidang);
        $keterangan = mysqli_real_escape_string($conn, $keterangan);
        $safeFileName = mysqli_real_escape_string($conn, $safeFileName);
        $uploadFile = mysqli_real_escape_string($conn, $uploadFile);

        // Query untuk insert data, jika keterangan NULL maka akan menjadi NULL di database
        $query = "INSERT INTO dokumen (nip, nama_dokumen, role, bidang, path, keterangan) 
                  VALUES ('$nip', '$safeFileName', '$role', '$bidang', '$uploadFile', " . ($keterangan ? "'$keterangan'" : "NULL") . ")";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Dokumen berhasil diupload!'); window.location.href = '../main/user/upload_dokumen.php';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data dokumen ke database.');</script>";
        }
    } else {
        echo "<script>alert('Gagal mengupload dokumen. Pastikan file tidak terlalu besar dan formatnya benar.');</script>";
    }
}
?>
