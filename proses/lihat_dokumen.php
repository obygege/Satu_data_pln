<?php
session_start();
include '../config/koneksi.php';

// Cek jika user sudah login
if (!isset($_SESSION['nip'])) {
    die("Akses ditolak. Silakan login terlebih dahulu.");
}

$nip = $_SESSION['nip'];

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID dokumen tidak valid.");
}

$query = mysqli_query($conn, "SELECT * FROM dokumen WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Dokumen tidak ditemukan.");
}

$nama_dokumen = $data['nama_dokumen'];
$file_path = '../assetss/img/dokumen/' . $nama_dokumen;
$ext = strtolower(pathinfo($nama_dokumen, PATHINFO_EXTENSION));

if (!file_exists($file_path)) {
    die("File tidak ditemukan.");
}

$allowed = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'jpg', 'jpeg', 'png', 'gif'];
if (!in_array($ext, $allowed)) {
    die("Tipe file tidak didukung.");
}

$mime = mime_content_type($file_path);

mysqli_query($conn, "INSERT INTO log_dokumen (nip, nama_dokumen, aksi) VALUES ('$nip', '$nama_dokumen', 'lihat')");

$download_only = ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];

if (in_array($ext, $download_only)) {
    header('Content-Description: File Transfer');
    header('Content-Type: ' . $mime);
    header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
    header('Content-Length: ' . filesize($file_path));
    readfile($file_path);
    exit;
}

header("X-Content-Type-Options: nosniff");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lihat Dokumen</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            background-color: #f0f0f0;
        }
        iframe, embed, object {
            width: 100%;
            height: 100vh;
            border: none;
        }
    </style>
    <script>
        document.addEventListener('contextmenu', event => event.preventDefault());
    </script>
</head>
<body>

<?php if ($ext === 'pdf'): ?>
    <embed src="<?= $file_path ?>" type="application/pdf">
<?php elseif (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])): ?>
    <img src="<?= $file_path ?>" style="width:100%;height:auto;" alt="Gambar Dokumen">
<?php endif; ?>

</body>
</html>
