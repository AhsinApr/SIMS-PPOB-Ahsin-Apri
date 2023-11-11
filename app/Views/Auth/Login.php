<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/assets/css/auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body>
    <div class="container">
        <div class="login">
            <form action="/authenticate" method="post">
                <div class="logo">
                    <img src="/assets/assets/logo.png" alt="Logo Image">
                    <p>SIMS PPOB</p>

                </div>
                <?php if (session('error')) : ?>
                    <p style="color: red;"><?= session('error') ?></p>
                <?php endif; ?>
                <h3>Masuk Atau Buat Akun Untuk Memulai</h3>
                <hr>
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="example@gmail.com">
                <div class="form-group password-container">
                    <label for="password">Password:</label>
                    <div style="position: relative;">
                        <input type="password" id="password" name="password" placeholder="Password">
                        <i class="password-icon fas fa-eye" onclick="togglePassword()"></i>
                    </div>
                </div>

                <button>Login</button>
                <p>Belum punya akun? registrasi <a class="link" href="/viewregister" target="_blank">disini</a></p>

            </form>
        </div>
        <div class="right">
            <img src="/assets/assets/login.png" alt="">
        </div>
    </div>
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");

            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
</body>

</html>