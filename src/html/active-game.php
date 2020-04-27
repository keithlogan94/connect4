<?php if (!isset($version)) throw new Exception('version should be set but wasn\'t'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>FOTF Connect4</title>
    <meta content="" name="descriptison">
    <meta content="" name="keywords">

    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Favicons -->
    <link href="/favicon.png" rel="icon">
    <link href="/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="/vendor/venobox/venobox.css" rel="stylesheet">

    <link type="text/css" rel="stylesheet" href="/css/main.css?version=<?= $version ?>" media="all">
    <link type="text/css" rel="stylesheet" href="/css/basic.css?version=<?= $version ?>" media="all">
    <link type="text/css" rel="stylesheet" href="/css/small-desktop.css?version=<?= $version ?>" media="screen and (max-device-width: 772px)">
    <link type="text/css" rel="stylesheet" href="/css/mobile-ipad.css?version=<?= $version ?>" media="screen and (max-device-width: 772px) and (min-device-width: 415px)">
    <link type="text/css" rel="stylesheet" href="/css/mobile-pixel2.css?version=<?= $version ?>" media="screen and (max-device-width: 415px)">
    <link type="text/css" rel="stylesheet" href="/css/mobile-iphone678.css?version=<?= $version ?>" media="screen and (max-device-width: 379px)">
    <link type="text/css" rel="stylesheet" href="/css/mobile-galaxys5.css?version=<?= $version ?>" media="screen and (max-device-width: 364px)">
    <link type="text/css" rel="stylesheet" href="/css/mobile-iphone5se.css?version=<?= $version ?>" media="screen and (max-device-width: 324px)">

    <!-- Template Main CSS File -->
    <link href="/css/style.css" rel="stylesheet">


    <style>
        #hero {
            width: 100%;
            height: 34vh;
            background-size: cover;
            position: relative;
            margin-bottom: 5em;
        }

        option:hover, option:active, option {
            background: lightgreen;
            font-weight: bold;
        }

        .no-pointer-events {
            pointer-events: none;
        }

        section {
            padding: 200px 0;
            padding-top: 0;
        }

        .popup {
            display: block;
            position: static;
            width: 80vw;
            left: 0;
            right: 0;
            top: 0;
            background: white;
            max-width: 600px;
            height: 16vh;
            padding: 2% 2% 0;
            margin: 0 auto 12px;
        }

        div#board {
            display: flex;
            text-align: center;
            max-width: 600px;
            transform: rotate(90deg) rotateX(180deg);
            background-image: url(https://i.stack.imgur.com/vNpylm.png);
            background-repeat: no-repeat;
            background-size: 639px 641px;
            overflow: hidden;
            width: 560px;
            height: 480px;
            margin: 55px auto 0;
        }

        .yellow, .red {
            display: inline-block;
            position: absolute;
            left: 0;
            right: 0;
            border-radius: 95px;
            text-align: center;
            margin: 0 auto;
            border: thick solid #551;
            height: 72px;
            width: 72px;
            background: yellow;
        }

        .red {
            background: red;
        }


    </style>

    <script>
        <?php
        if (!isset($customJavascript)) throw new Exception('$customJavascript was not set and must be set when returning error html');
        ?>
        <?= $customJavascript ?>
    </script>

    <style>
        button {
            width: 40%;
            height: 35px;
        }

        h1 {
            font-size: 20px;
        }

    </style>
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex align-items-center">

        <div class="logo mr-auto">
            <h1 class="text-light"><a href="/setup"><span>Connect4Friends</span></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="/images/logo.png" alt="" class="img-fluid"></a>-->
        </div>

        <?php
        include dirname(__FILE__) . '/links.php';
        ?>

    </div>
</header><!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero">
    <div class="hero-container">
        <h1>Connect4</h1>
    </div>
</section><!-- End Hero -->

<main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">


        <div class="section-title" style="max-width:500px;margin: 0 auto;">
            <h1 id="popup-message" class="mb-1">Yellow, please enter the column to drop your checker:</h1>
            <div class="popup-div">
                <input type="text" id="column" placeholder="Column: 1-6">
                <button class="place-checker">Place Checker</button>
            </div>
        </div>
        <div id="game-container" class="mt-1">
            <div id="board">
                <div>
                    <div class="board-position A" id="A1">
                    </div>
                    <div class="board-position A" id="A2">
                    </div>
                    <div class="board-position A" id="A3">
                    </div>
                    <div class="board-position A" id="A4">
                    </div>
                    <div class="board-position A" id="A5">
                    </div>
                    <div class="board-position A" id="A6">
                    </div>
                </div>
                <div>
                    <div class="board-position B" id="B1">
                    </div>
                    <div class="board-position B" id="B2">
                    </div>
                    <div class="board-position B" id="B3">
                    </div>
                    <div class="board-position B" id="B4">
                    </div>
                    <div class="board-position B" id="B5">
                    </div>
                    <div class="board-position B" id="B6">
                    </div>
                </div>
                <div>
                    <div class="board-position C" id="C1">
                    </div>
                    <div class="board-position C" id="C2">
                    </div>
                    <div class="board-position C" id="C3">
                    </div>
                    <div class="board-position C" id="C4">
                    </div>
                    <div class="board-position C" id="C5">
                    </div>
                    <div class="board-position C" id="C6">
                    </div>
                </div>
                <div>
                    <div class="board-position D" id="D1">
                    </div>
                    <div class="board-position D" id="D2">
                    </div>
                    <div class="board-position D" id="D3">
                    </div>
                    <div class="board-position D" id="D4">
                    </div>
                    <div class="board-position D" id="D5">
                    </div>
                    <div class="board-position D" id="D6">
                    </div>
                </div>
                <div>
                    <div class="board-position E" id="E1">
                    </div>
                    <div class="board-position E" id="E2">
                    </div>
                    <div class="board-position E" id="E3">
                    </div>
                    <div class="board-position E" id="E4">
                    </div>
                    <div class="board-position E" id="E5">
                    </div>
                    <div class="board-position E" id="E6">
                    </div>
                </div>
                <div>
                    <div class="board-position F" id="F1">
                    </div>
                    <div class="board-position F" id="F2">
                    </div>
                    <div class="board-position F" id="F3">
                    </div>
                    <div class="board-position F" id="F4">
                    </div>
                    <div class="board-position F" id="F5">
                    </div>
                    <div class="board-position F" id="F6">
                    </div>
                </div>
                <div>
                    <div class="board-position G" id="G1">
                    </div>
                    <div class="board-position G" id="G2">
                    </div>
                    <div class="board-position G" id="G3">
                    </div>
                    <div class="board-position G" id="G4">
                    </div>
                    <div class="board-position G" id="G5">
                    </div>
                    <div class="board-position G" id="G6">
                    </div>
                </div>
            </div>
        </div>


    </section><!-- End About Section -->




</main><!-- End #main -->

<?php include dirname(__FILE__) . '/footer.php' ?>

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- Vendor JS Files -->
<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="/vendor/php-email-form/validate.js"></script>
<script src="/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="/vendor/venobox/venobox.min.js"></script>

<!-- Template Main JS File -->
<script src="/js/main.js"></script>
<script src="/js/connect4.js?version=<?= $version ?>"></script>
<script src="/js/basic.js?version=<?= $version ?>"></script>

</body>

</html>