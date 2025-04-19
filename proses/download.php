<?php
// Koneksi ke database
include '../config/koneksi.php'; // sesuaikan path koneksi

// Ambil ID dari URL
$id = $_GET['id'];

// Ambil data dokumen dari database
$query = mysqli_query($conn, "SELECT * FROM dokumen WHERE id = '$id'");
$doc = mysqli_fetch_assoc($query);

if ($doc) {
    $filePath = $doc['path'];
    $fileName = $doc['nama_dokumen'] . '.' . pathinfo($filePath, PATHINFO_EXTENSION);

    if (file_exists($filePath)) {
        // Set header untuk download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    } else {
        echo "File tidak ditemukan.";
    }
} else {
    echo "Dokumen tidak ditemukan.";
}
?>
