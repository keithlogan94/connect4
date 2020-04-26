<?php if (!isset($version)) throw new Exception('version should be set but wasn\'t'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include dirname(__FILE__) . '/html-head.php'; ?>

    <script>
        <?php
        if (!isset($customJavascript)) throw new Exception('$customJavascript was not set and must be set when returning error html');
        ?>
        <?= $customJavascript ?>
    </script>
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