<?php


//Load our code
require_once dirname(__FILE__) . '/functions/utils.php';
require_once dirname(__FILE__) . '/functions/connect4_translate_position.php';
require_once dirname(__FILE__) . '/testing/functions/unit_tests_connect4_translate_position.php';

spl_autoload_register(function ($class) {

    $class = str_replace('\\', '/', $class) . '.php';
    require_once $class;

});







