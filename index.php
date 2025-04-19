<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="assets/css/styles.css">

    <link rel="icon" type="image/x-icon" href="assetss/img/favicon/Logo_PLN.png" />

    <title>MASUK</title>
</head>

<body>
    <div class="container">
        <div class="login__content">
            <form action="proses/login.php" method="POST" class="login__form">
                <div class="login__logo">
                    <img src="assets/img/Logo_PLN.png" alt="Logo" class="login__logo-img">
                </div>
                <div>
                    <h1 class="login__title">
                        <span>Selamat</span> Datang
                    </h1>
                    <p class="login__description">
                        Silahkan Masuk untuk akses Pegawai
                    </p>
                </div>

                <div>
                    <div class="login__inputs">
                        <div>
                            <label for="input-id" class="login__label">Nomor Induk Pegawai</label>
                            <input type="text" name="nip" placeholder="Masukkan NIP Pegawai" required class="login__input" id="input-email">
                        </div>

                        <div>
                            <label for="input-pass" class="login__label">Password</label>

                            <div class="login__box">
                                <input type="password" name="password" placeholder="Masukkan Password" required class="login__input" id="input-pass">
                                <i class="ri-eye-off-line login__eye" id="input-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="login__buttons">
                        <button type="submit" class="login__button">Log In</button>
                    </div>

                    <audio autoplay loop>
                        <source src="assets/audio/background.mp3" type="audio/mpeg">
                        Browser mu tidak support Audio
                    </audio>
                    <audio id="bg-audio" autoplay>
                        <source src="assets/mp3/suara.mp3" type="audio/mpeg">
                    </audio>

                    <script>
                        window.addEventListener("DOMContentLoaded", () => {
                            const audio = document.getElementById("bg-audio");
                            audio.volume = 1.0;
                            audio.play().catch((e) => {
                                console.log("Autoplay diblokir: ", e);
                            });
                        });
                    </script>
                    <a href="main/lupa password/lupa_password.php" class="login__forgot">Lupa Password?</a>
                </div>
            </form>
        </div>
    </div>

    <!--=============== MAIN JS ===============-->
    <script src="assets/js/main.js"></script>
</body>

</html>