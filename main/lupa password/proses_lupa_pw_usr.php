<?php
include("../../config/koneksi.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nip = trim($_POST['nip']);
    $no_hp = trim($_POST['no_hp']);
    $nama = trim($_POST['nama']);
    $bidang = trim($_POST['bidang']);

    if (empty($nip) || empty($no_hp) || empty($nama) || empty($bidang)) {
        echo "<script>
                alert('Semua field harus diisi!');
                window.location.href = '../index.php'; // Redirect ke halaman form
              </script>";
        exit;
    }

    $nip = htmlspecialchars($nip);
    $no_hp = htmlspecialchars($no_hp);
    $nama = htmlspecialchars($nama);
    $bidang = htmlspecialchars($bidang);

    $query = "INSERT INTO reset_password (nip, no_hp, nama, bidang, status) 
              VALUES (?, ?, ?, ?, 'pending')";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('ssss', $nip, $no_hp, $nama, $bidang);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Permintaan reset password telah dikirim. Admin akan memprosesnya dan mengirimkan password di Whatsapp anda.');
                    window.location.href = '../../index.php'; // Redirect ke halaman login
                  </script>";
        } else {
            echo "<script>
                    alert('Terjadi kesalahan saat mengirim permintaan.');
                    window.location.href = '../../index.php'; // Redirect ke halaman login
                  </script>";
        }
        $stmt->close();
    } else {
        echo "<script>
                alert('Terjadi kesalahan dengan koneksi ke database.');
                window.location.href = '../../index.php'; // Redirect ke halaman login
              </script>";
    }
    $conn->close();
}
?>