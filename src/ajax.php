<?php

/* AJAX ONLY
 * This file should catch requests only for ajax calls
 * */

use Connect4\Requests\Request;

require_once dirname(__FILE__) . '/autoload.php';


//c++ style main function where the code begins
function main() {

    //Let's start the game
    $request = Request::getInstance();

    if (!$request->isRequestPost()) throw new Exception('Only Post requests are supported for ajax calls');





}







main();






