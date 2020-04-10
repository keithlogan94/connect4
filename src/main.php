<?php

require_once dirname(__FILE__) . '/autoload.php';

use Connect4\Game;
use Connect4\Requests\Api\Api;
use Connect4\Requests\Request;
use function utils\echo_error_page;


//c++ style main function where the code begins
function main() {

    $request = new Request();
    $api = new Api();
    $api->handleRequest($request);



}






try {
    main();
} catch (Exception $e) {
    echo_error_page($e);
}






