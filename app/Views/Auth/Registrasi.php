<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="/assets/css/auth.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<style>

</style>

<body>
    <div class="container">
        <div class="login">
            <form action="/register" method="post">

                <div class="logo">
                    <img src="/assets/assets/logo.png" alt="Logo Image">
                    <p>SIMS PPOB</p>
                </div>
                <?php if (session()->getFlashdata('success')) : ?>
                    <div style="color: green;">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php elseif (session()->getFlashdata('error')) : ?>
                    <div style="color: red;">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <h3>Lengkapi Data Untuk Membuat Akun</h3>
                <hr>
                <label for="email"></label>
                <input type="text" id="email" name="email" placeholder="Masukkan email anda" required>

                <label for="nama_depan"></label>
                <input type="text" id="first_name" name="first_name" placeholder="Nama depan" required>
                <label for="nama_belakang"></label>
                <input type="text" id="last_name" name="last_name" placeholder="Nama belakang">

                <div class="form-group password-container">
                    <label for="password"></label>
                    <div style="position: relative;">
                        <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                        <i class="password-icon fas fa-eye" onclick="togglePassword('password')"></i>
                    </div>
                </div>

                <div class="form-group password-container">
                    <label for="ulangipassword"></label>
                    <div style="position: relative;">
                        <input type="password" id="ulangipassword" placeholder="Ulangi password">
                        <i class="password-icon fas fa-eye" onclick="togglePassword('ulangipassword')"></i>
                    </div>
                </div>

                <button>Daftar</button>
                <p>Sudah Punya Akun? login <a class="link" href="/" target="_blank">disini</a></p>
            </form>
        </div>
        <div class="right">
            <img src="/assets/assets/login.png" alt="">
        </div>
    </div>
    <script>
        function togglePassword(fieldId) {
            var passwordField = document.getElementById(fieldId);

            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
</body>

</html>