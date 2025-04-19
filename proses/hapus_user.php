<?php
include("../config/koneksi.php");

if (isset($_GET['nip'])) {
    $nip = $_GET['nip'];

    $query = "DELETE FROM users WHERE nip = '$nip'";

    if (mysqli_query($conn, $query)) {

        header('Location: ../main/admin/data_user.php');
        exit;
    } else {

        echo "Error: " . mysqli_error($conn);
    }
} else {

    echo "NIP tidak ditemukan.";
}
?>
