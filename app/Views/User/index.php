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

    <!-- services -->
    <!-- services -->
    <div class="menu-container">
        <?php if ($services && is_array($services)) : ?>
            <?php foreach ($services as $service) : ?>
                <div class="custom-menu-item">
                    <div class="menu-icon">
                        <?php if (isset($service['service_icon'])) : ?>
                            <img src="<?= $service['service_icon'] ?>" alt="<?= $service['service_name'] ?>">
                        <?php endif; ?>
                    </div>
                    <div class="menu-name"><?= isset($service['service_name']) ? $service['service_name'] : '' ?></div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- slider -->
    <div class="slider-container">
        <div id="captionbaner">Temukan Promo Menarik</div>
        <div class="slider-wrapper">
            <?php if ($banner && is_array($banner)) : ?>
                <?php foreach ($banner as $item) : ?>
                    <div class="slide">
                        <img src="<?= isset($item['banner_image']) ? $item['banner_image'] : '' ?>" alt="<?= isset($item['banner_name']) ? $item['banner_name'] : '' ?>">
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>


    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            var currentIndex = 0;
            var slideWidth = $(".slide").width();
            var totalSlides = $(".slide").length;
            var cloneCount = 1; // Jumlah klon banner yang ditambahkan

            // Menambahkan klon dari banner pertama ke akhir
            $(".slider-wrapper").append($(".slide").clone());
            totalSlides += cloneCount;

            function showSlide(index) {
                if (index >= totalSlides) {
                    currentIndex = 0;
                } else if (index < 0) {
                    currentIndex = totalSlides - 1;
                } else {
                    currentIndex = index;
                }

                var transformValue = -currentIndex * slideWidth;
                $(".slider-wrapper").css("transform", "translateX(" + transformValue + "px)");
            }

            $(".prev-btn").click(function() {
                showSlide(currentIndex - 1);
            });

            $(".next-btn").click(function() {
                showSlide(currentIndex + 1);
            });

            setInterval(function() {
                showSlide(currentIndex + 1);
            }, 2000);
        });
    </script>

</body>

</html>