<?php
session_start();
include("../config/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $bidang = $_POST['bidang'];
    $avatarName = '';  

    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assetss/img/avatars/';
        $fileName = $_FILES['avatar']['name']; 
        $fileTmpPath = $_FILES['avatar']['tmp_name']; 
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION); 
        $newFileName = uniqid('avatar_') . '.' . $fileExtension; 
        $destinationPath = $uploadDir . $newFileName; 

        if (move_uploaded_file($fileTmpPath, $destinationPath)) {
            $avatarName = $newFileName; 
        } else {
            echo "Gagal mengupload gambar.";
        }
    }

    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    } else {
        $sql = "SELECT password FROM users WHERE nip = '$nip'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);
        $hashed_password = $user['password'];
    }

    $sql = "UPDATE users SET nama = '$nama', password = '$hashed_password', role = '$role', bidang = '$bidang', avatar = '$avatarName' WHERE nip = '$nip'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='../main/admin/lihat_profile.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat memperbarui data.');</script>";
    }
}
?>
