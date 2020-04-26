<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

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

<?php global $title; ?>
<?php if (!isset($title)) throw new Exception('$title not set'); ?>
<title><?= $title ?></title>
<meta content="" name="descriptison">
<meta content="" name="keywords">

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

<!-- Template Main CSS File -->
<link href="/css/style.css" rel="stylesheet">

<style>
    #hero {
        width: 100%;
        height: 17vh;
        background-size: cover;
        position: relative;
        margin-bottom: 5em;
    }

    .center {
        margin: 0 auto;
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