<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/akun.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> -->


</head>

<body>
    <header>
        <div class="logo">
            <img src="/assets/assets/logo.png" alt="Logo">
            <div class="company-name">SMIS PPOB</div>
        </div>
        <div class="menu">
            <a href="/topup" class="menu-item">Top Up</a>
            <a href="/transaction" class="menu-item">Transaction</a>
            <a href="/akun" class="menu-item">Akun</a>
        </div>
    </header>
    <div class="account-container">
        <?php if (session()->getFlashdata('success')) : ?>
            <div style="color: green;" class="alert alert-success" role="alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- Tampilkan pesan error jika ada -->
        <?php if (session()->getFlashdata('error')) : ?>
            <div style="color: red;" class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if ($profile) : ?>
            <div class="profile-section">
                <!-- Ubah path gambar profil sesuai keinginan -->
                <img src="/assets/assets/Profile Photo.png" alt="Profile Image" class="profile-image">
                <h2><?= $profile['first_name'] ?> <?= $profile['last_name'] ?></h2>
            </div>

            <form action="/updateProfile" method="post" class="account-form">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= $profile['email'] ?>" readonly>

                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" value="<?= $profile['first_name'] ?>">

                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" value="<?= $profile['last_name'] ?>">

                <button type="submit" class="update-button">Update</button>
            </form>

            <a href="/logout" class="logout-button">Logout</a>
        <?php else : ?>
            <p>Data profile tidak tersedia.</p>
        <?php endif; ?>
    </div>

</body>

</html>