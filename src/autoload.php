<?php


//Load our code!

spl_autoload_register(function ($class) {

    $class = str_replace('\\', '/', $class) . '.php';
    require_once $class;

});







