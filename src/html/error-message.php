<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>(ERROR) FOTF Connect4</title>
    <link type="text/css" rel="stylesheet" href="/css/main.css" media="all">
</head>
<body>
    <div class="error">
        <h1 class="error-header">An Error Occurred</h1>
        <?php
        if (!isset($errorMessage)) throw new Exception('$errorMessage was not set and must be set when returning error html: error-message.php');
        ?>
        <?= $errorMessage ?>
    </div>
</body>
</html>