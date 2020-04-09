<?php

require_once dirname(__FILE__) . '/autoload.php';

use Connect4\Game;
use Connect4\Requests\Request;
use function utils\array_wrap_each;


//c++ style main function where the code begins
function main() {

    $request = Request::getInstance();
    if (!$request->isRequestGet()) throw new Exception('Only GET requests are supported for accessing main.php');

    //Let's start the game!
    $game = new Game();
    $game->start();



}






try {
    main();
} catch (Exception $e) {
    //generate error string to display to the user

    $errorHeaders = ['Message','Stack Trace','File','Line','Code'];
    $wrappedHeaders = array_wrap_each($errorHeaders, '<h2 class="error-header">', '</h2>');

    $errorMessages = [$e->getMessage(),$e->getTraceAsString(),$e->getFile(),$e->getLine(),$e->getCode()];
    $wrappedMessages = array_wrap_each($errorMessages, '<p class="error-message">', '</p>');

    $errorMessage = '';

    if (count($wrappedHeaders) !== count($wrappedMessages))
        throw new Exception('count of each array should match');

    for ($i = 0; $i < count($errorHeaders); $i++) {
        $errorMessage .= "<div class='mb-4'>";
        $errorMessage .= $wrappedHeaders[$i];
        $errorMessage .= $wrappedMessages[$i];
        $errorMessage .= "</div>";
    }


    include dirname(__FILE__) . '/html/error-message.php';
}






