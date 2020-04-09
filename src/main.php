<?php

require_once dirname(__FILE__) . '/autoload.php';

use Connect4\Game;
use Connect4\Requests\Request;


//c++ style main function where the code begins
function main() {

    $request = Request::getInstance();
    if (!$request->isRequestGet()) throw new Exception('Only GET requests are supported for accessing main.php');

    //Let's start the game!
    $game = new Game();
    $game->start();



}







main();






