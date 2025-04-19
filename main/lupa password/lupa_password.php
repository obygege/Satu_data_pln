<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="../../assetss/img/favicon/Logo_PLN.png" />
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        body {
            background-image:
                linear-gradient(rgba(21, 116, 172, 0.6), rgba(28, 181, 228, 0.6)),
                url('../../assets/img/ubp.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 100vh;
        }

        .container {
            border-radius: 40px;
            padding: 30px;
            width: 100%;
            height: 100vh;
        }

        .login__form {
            max-width: 500px;
            margin: auto;
        }

        .btn-toggle {
            width: 50%;
            border-radius: 0;
        }

        .btn-primary {
            background-color: #FEF100;
            border: none;
            color: #333;
        }

        .btn-primary:hover {
            background-color: #e6e600;
        }

        .card-footer a {
            color: #333;
        }

        .logo {
            width: 100px;
            margin: 0 auto;
            display: block;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5" style="background-color: rgba(255, 255, 255, 0.6);">
                    <div class="card-header text-center">
                        <img src="../../assets/img/Logo_PLN.png" alt="Logo" class="logo" />
                        <h3>Lupa Kata Sandi</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <button class="btn btn-primary btn-toggle" data-bs-toggle="modal" data-bs-target="#pegawaiModal">Pegawai</button>
                            <button class="btn btn-primary btn-toggle" data-bs-toggle="modal" data-bs-target="#adminModal">Admin</button>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="../../index.php">Kembali ke Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pegawaiModal" tabindex="-1" aria-labelledby="pegawaiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pegawaiModalLabel">Reset Password Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="proses_lupa_pw_usr.php" method="POST">
                        <div class="mb-3">
                            <label for="nip" class="form-label">Nomor Induk Pegawai (NIP)</label>
                            <input type="text" class="form-control" name="nip" required placeholder="Masukkan NIP">
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">Nomor HP</label>
                            <input type="text" class="form-control" name="no_hp" required placeholder="Masukkan Nomor HP">
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" required placeholder="Masukkan Nama">
                        </div>
                        <div class="mb-3">
                            <label for="bidang" class="form-label">Bidang</label>
                            <input type="text" class="form-control" name="bidang" required placeholder="Masukkan Bidang">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Kirim Permintaan Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="adminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adminModalLabel">Reset Password Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="reset_password_admin.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required placeholder="Masukkan Email">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Kirim Permintaan Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
