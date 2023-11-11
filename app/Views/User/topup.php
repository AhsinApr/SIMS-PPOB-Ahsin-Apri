<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/User.css">
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
    <div class="container">
        <div class="left-div">
            <!-- Konten di sini untuk div kiri -->
            <img src="/assets/assets/Profile Photo.png" alt="Profile Image" id="profile-image">
            <div id="welcome-text">Selamat Datang</div>
            <div id="user-name"><?= isset($profile['first_name']) ? $profile['first_name'] : '' ?> <?= isset($profile['last_name']) ? $profile['last_name'] : '' ?></div>
        </div>
        <div class="right-div">
            <!-- Konten di sini untuk div kanan -->
            <p>Sisa Saldo</p>
            <h2> RP <?= isset($balance['balance']) ? $balance['balance'] : '' ?></h2>
        </div>
    </div>

    <form action="/updateTopup" method="post" id="topUpForm" class="ccontainer">
        <div id="welcome-text">Silahakan Masukan</div>
        <div id="user-name" style="margin-bottom: 5%;">Nominal Top UP</div>
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
        <div class="button-group">
            <input type="number" id="nominal" placeholder="Masukan Nomina" name="top_up_amount" min="10000" step="10000" oninput="checkTopUpButton()" required>
            <button type="button" onclick="setNominal(10000)">Rp 10.000</button>
            <button type="button" onclick="setNominal(20000)">Rp 20.000</button>
            <button type="button" onclick="setNominal(50000)">Rp 50.000</button>
        </div>

        <div class="button-group">
            <label for="nominal"></label>
            <button type="submit" id="topUpButton" disabled>Top Up</button>
            <button type="button" onclick="setNominal(100000)">Rp 100.000</button>
            <button type="button" onclick="setNominal(250000)">Rp 250.000</button>
            <button type="button" onclick="setNominal(500000)">Rp 500.000</button>
        </div>


    </form>

    <script>
        function setNominal(value) {
            document.getElementById('nominal').value = value;
            checkTopUpButton();
        }

        function checkTopUpButton() {
            const nominalInput = document.getElementById('nominal');
            const topUpButton = document.getElementById('topUpButton');

            if (nominalInput.value >= 10000) {
                topUpButton.removeAttribute('disabled');
            } else {
                topUpButton.setAttribute('disabled', 'true');
            }
        }
    </script>


</body>

</html>