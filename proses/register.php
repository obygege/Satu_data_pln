<?php
session_start();
include("../config/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];  // Menambahkan nama
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk memasukkan data pengguna baru ke database
    $sql = "INSERT INTO users (nip, nama, password, role) VALUES ('$nip', '$nama', '$hashed_password', '$role')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Akun berhasil dibuat!'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat mendaftar. Silakan coba lagi.');</script>";
    }
}
?>
