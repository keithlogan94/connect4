<?php

require_once dirname(__FILE__) . '/autoload.php';

use function Connect4\functions\utils\echo_error_page;
use Connect4\Requests\Api\Api;
use Connect4\Requests\Request;


//c++ style main function where the code begins
function main() {

    $requestCode = false;

    if (isset($_GET['request_code'])) $requestCode = $_GET['request_code'];
    else $requestCode = 'init_screen';

    $request = new Request($requestCode);
    $api = new Api();
    $api->handleRequest($request);



}






try {
    main();
} catch (Exception $e) {
    echo_error_page($e);
}






