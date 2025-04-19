<?php
require '../../config/koneksi.php'; // koneksi ke database
require '../../vendor/autoload.php'; // PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Cek apakah email ada di database admin
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika email ditemukan
    if ($result->num_rows > 0) {
        // Generate token unik
        $token = bin2hex(random_bytes(32));

        // Simpan token ke database (tanpa expired)
        $stmt = $conn->prepare("UPDATE users SET token = ? WHERE email = ?");
        $stmt->bind_param("ss", $token, $email);
        $stmt->execute();

        // Kirim Email dengan PHPMailer
        $mail = new PHPMailer(true);
        try {
            // Konfigurasi SMTP Gmail
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'testwebsite723@gmail.com'; // Ganti dengan emailmu
            $mail->Password   = 'uqjqfhkoahripysi';          // App password Gmail
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('testwebsite723@gmail.com', 'Admin Website');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Reset Password Akun Anda';

            // Tentukan domain tergantung environment
            $domain = ($_SERVER['SERVER_NAME'] == 'localhost') ? 'http://localhost/website_pln' : 'http://futuraalink.com';
            $linkReset = $domain . '/main/lupa password/ganti_password.php?token=' . $token;

            $mail->Body = "
                <div style='max-width:600px; margin:0 auto; font-family:Arial, sans-serif; border:1px solid #ddd; border-radius:8px; padding:20px; background-color:#f9f9f9;'>
                    <div style='text-align:center; margin-bottom:20px;'>
                        <img src='" . $domain . "/assets/img/Logo_pln.png' alt='Logo' style='max-height:80px;'>
                    </div>
                    <h2 style='color:#333;'>Permintaan Reset Password</h2>
                    <p style='font-size:16px; color:#555;'>Halo, kami menerima permintaan untuk mereset password akun Anda.</p>
                    <p style='font-size:16px; color:#555;'>Jika Anda tidak meminta reset password, abaikan saja email ini. Jika ya, klik tombol di bawah ini untuk melanjutkan:</p>
                    <div style='text-align:center; margin:30px 0;'>
                        <a href='$linkReset' style='padding:12px 25px; background-color:#007bff; color:#fff; text-decoration:none; border-radius:6px; font-weight:bold;'>Reset Password</a>
                    </div>
                    <p style='font-size:14px; color:#888;'>Link ini berlaku hingga Anda menggunakannya untuk reset password.</p>
                    <hr style='margin:30px 0;'>
                    <p style='font-size:12px; color:#aaa; text-align:center;'>© " . date('Y') . " Futura Link. All rights reserved.</p>
                </div>
            ";

            $mail->send();
            echo "<script>
                alert('Link reset password berhasil dikirim ke email $email. Silakan cek inbox atau spam.');
                window.location.href = 'lupa_password.php';
            </script>";
        } catch (Exception $e) {
            echo "<script>
                alert('Gagal mengirim email. Error: {$mail->ErrorInfo}');
                window.history.back();
            </script>";
        }
    } else {
        echo "<script>
            alert('Email tidak ditemukan dalam database.');
            window.history.back();
        </script>";
    }
}
?>
