<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOTF Connect4</title>
    <link type="text/css" rel="stylesheet" href="/css/main.css" media="all">
    <link type="text/css" rel="stylesheet" href="/css/basic.css" media="all">
    <link type="text/css" rel="stylesheet" href="/css/small-desktop.css" media="screen and (max-device-width: 772px)">
    <link type="text/css" rel="stylesheet" href="/css/mobile-ipad.css" media="screen and (max-device-width: 772px) and (min-device-width: 415px)">
    <link type="text/css" rel="stylesheet" href="/css/mobile-pixel2.css" media="screen and (max-device-width: 415px)">
    <link type="text/css" rel="stylesheet" href="/css/mobile-iphone678.css" media="screen and (max-device-width: 379px)">
    <link type="text/css" rel="stylesheet" href="/css/mobile-galaxys5.css" media="screen and (max-device-width: 364px)">
    <link type="text/css" rel="stylesheet" href="/css/mobile-iphone5se.css" media="screen and (max-device-width: 324px)">
    <script>
        <?php
        if (!isset($customJavascript)) throw new Exception('$customJavascript was not set and must be set when returning error html');
        ?>
        <?= $customJavascript ?>
    </script>
</head>
<body>
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
<!--suppress JSUnresolvedLibraryURL -->
<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script src="/js/connect4.js?ver=1.01"></script>
<script src="/js/basic.js?ver=1.01"></script>
</body>
</html>



