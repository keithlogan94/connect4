<?php if (!isset($version)) throw new Exception('version should be set but wasn\'t'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>FOTF Connect4</title>
    <meta content="" name="descriptison">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/images/favicon.png" rel="icon">
    <link href="/images/apple-touch-icon.png" rel="apple-touch-icon">

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

    <!-- =======================================================
    * Template Name: Vlava - v2.0.0
    * Template URL: https://bootstrapmade.com/vlava-free-bootstrap-one-page-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
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


        <div class="popup">
            <h1 id="popup-message" class="mb-1"><span id="color-player">Yellow</span>, please enter the column to drop your checker:</h1>
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

<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="footer-top">

        <div class="container">

            <div class="row  justify-content-center">
                <div class="col-lg-6">
                    <h3>Vlava</h3>
                    <p>Et aut eum quis fuga eos sunt ipsa nihil. Labore corporis magni eligendi fuga maxime saepe commodi placeat.</p>
                </div>
            </div>

            <div class="row footer-newsletter justify-content-center">
                <div class="col-lg-6">
                    <form action="" method="post">
                        <input type="email" name="email" placeholder="Enter your Email"><input type="submit" value="Subscribe">
                    </form>
                </div>
            </div>

            <div class="social-links">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>

        </div>
    </div>

    <div class="container footer-bottom clearfix">
        <div class="copyright">
            &copy; Copyright <strong><span>Vlava</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/vlava-free-bootstrap-one-page-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>
</footer><!-- End Footer -->

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