<?php
require '../../config/koneksi.php';

if (!isset($_GET['token'])) {
    die('Token tidak ditemukan.');
}

$token = $_GET['token'];

$stmt = $conn->prepare("SELECT * FROM users WHERE token = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('Link tidak valid!');
}

$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $passwordBaru = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET password = ?, token = NULL WHERE id = ?");
    $stmt->bind_param("si", $passwordBaru, $user['id']);
    $stmt->execute();

    echo "<script>
        alert('Password berhasil diubah!');
        window.location.href = '../../index.php';
    </script>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Ganti Password</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            transition: border-color 0.3s;
        }

        input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            background-color: #007bff;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .note {
            font-size: 13px;
            color: #888;
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Ganti Password</h2>
        <form method="POST">
            <label for="password">Password Baru:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Ubah Password</button>
        </form>
        <p class="note">Gunakan password yang kuat dan mudah diingat.</p>
    </div>
</body>

</html>