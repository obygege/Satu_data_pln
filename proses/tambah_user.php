<?php
include("../config/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nip = mysqli_real_escape_string($conn, $_POST['nip']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $bidang = mysqli_real_escape_string($conn, $_POST['bidang']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
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

    $query = "INSERT INTO users (nip, nama, role, bidang, avatar, password) 
              VALUES ('$nip', '$nama', '$role', '$bidang', '$avatarName', '$password')";

    if (mysqli_query($conn, $query)) {
        header('Location: ../main/admin/data_user.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
