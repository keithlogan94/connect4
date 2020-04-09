<?php

require_once dirname(__FILE__) . '/autoload.php';

use Connect4\Game;
use Connect4\Requests\Request;
use function utils\echo_error_page;


//c++ style main function where the code begins
function main() {

    throw new Exception('test');

    $request = Request::getInstance();
    if (!$request->isRequestGet()) throw new Exception('Only GET requests are supported for accessing main.php');

    //Let's start the game!
    $game = new Game();
    $game->start();



}






try {
    main();
} catch (Exception $e) {
    echo_error_page($e);
}






