<?php
session_start();
include("../config/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nip = mysqli_real_escape_string($conn, $_POST['nip']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE nip = '$nip'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            // Set session
            $_SESSION['id'] = $user['id'];
            $_SESSION['nip'] = $user['nip'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['bidang'] = $user['bidang'];

            // Arahkan sesuai role
            switch ($user['role']) {
                case 'admin':
                    header("Location: ../main/admin/dashboard_admin.php");
                    exit();
                case 'pegawai':
                    header("Location: ../main/user/dashboard_pegawai.php");
                    exit();
                default:
                    // Jika role tidak dikenal, keluar
                    session_destroy();
                    echo "<script>
                        alert('Role tidak valid!');
                        window.location.href = '../index.php';
                    </script>";
                    exit();
            }
        }
    }

    // Jika login gagal
    echo "<script>
        alert('NIP atau Password salah!');
        window.location.href = '../index.php';
    </script>";
}
?>
