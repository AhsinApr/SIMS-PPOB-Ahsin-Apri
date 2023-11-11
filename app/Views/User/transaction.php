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

    <div class="transaction-history">
        <div class="transaction-history">
            <div class="history-heading">Riwayat Transaksi</div>
            <?php if ($riwayat && is_array($riwayat)) : ?>
                <?php foreach ($riwayat['records'] as $transaction) : ?>
                    <div class="transaction-item">
                        <div class="transaction-details">
                            <div class="transaction-amount"><?= isset($transaction['total_amount']) ? $transaction['total_amount'] : '' ?></div>
                            <div class="transaction-date"><?= isset($transaction['created_on']) ? $transaction['created_on'] : '' ?></div>
                        </div>
                        <div class="transaction-status"><?= isset($transaction['description']) ? $transaction['description'] : '' ?></div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>


    </div>


</body>

</html>