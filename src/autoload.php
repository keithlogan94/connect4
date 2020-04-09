<?php


//Load our code!
require_once dirname(__FILE__) . '/functions/utils.php';

spl_autoload_register(function ($class) {

    $class = str_replace('\\', '/', $class) . '.php';
    require_once $class;

});







