<?php

session_start();

require_once dirname(__FILE__) . '/autoload.php';
require_once dirname(__FILE__) . '/constants.php';

use function Connect4\functions\utils\echo_error_page;
use function Connect4\functions\utils\get_setting;
use Connect4\Requests\Api\Api;
use Connect4\Requests\Request;

//port setting can be updated in ini file
define("APPLICATION_PORT", get_setting('port'));
define("APPLICATION_HOSTNAME", get_setting('hostname'));
define("APPLICATION_VERSION", get_setting('version'));

//c++ style main function where the code begins
function main() {


    if (isset($_GET['request_code'])) {
        $requestCode = $_GET['request_code'];
        $request = new Request($requestCode);
        $api = new Api();
        $api->handleRequest($request);
    } else {
        if ($_SERVER['REQUEST_URI'] === '/') {
            $requestCode = 'init_screen';
            $request = new Request($requestCode);
            $api = new Api();
            $api->handleRequest($request);
        }
    }





}






try {
    main();
} catch (Exception $e) {
    if ($e->getMessage() === 'must be logged in') {
        header("Location: /login");
    } else {
        echo_error_page($e);
    }
}






