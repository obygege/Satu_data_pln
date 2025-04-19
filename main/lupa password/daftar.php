<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <div class="login__content">
            <form action="register.php" method="POST" class="login__form">
                <div class="login__logo">
                    <img src="../../assets/img/Logo_PLN.png" alt="Logo" class="login__logo-img">
                </div>
                <div>
                    <h1 class="login__title"><span>Daftar</span> Admin</h1>
                </div>
                <div>
                    <div class="login__inputs">
                        <div>
                            <label for="nip" class="login__label">Nomor Induk Pegawai</label>
                            <input type="text" name="nip" placeholder="Masukkan NIP Admin" required class="login__input" id="input-nip">
                        </div>

                        <div>
                            <label for="nama" class="login__label">Nama Lengkap</label>
                            <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" required class="login__input" id="input-nama">
                        </div>

                        <div>
                            <label for="password" class="login__label">Password</label>
                            <input type="password" name="password" placeholder="Masukkan Password" required class="login__input" id="input-pass">
                        </div>

                        <div>
                            <label for="role" class="login__label">Role</label>
                            <select name="role" required class="login__input" id="input-role">
                                <option value="admin">Admin</option>
                                <option value="pegawai">Pegawai</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="login__buttons">
                        <button type="submit" class="login__button">Daftar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="../../assets/js/main.js"></script>
</body>
</html>
