<?php


namespace Connect4\functions\utils;


use Exception;

function array_wrap_each(array $strItems, $before = '', $after = '') : array {
    $newItems = [];

    foreach ($strItems as $item)//prefer not to use braces for one line foreach statements
        $newItems[] = $before . $item . $after;

    return $newItems;
}


function echo_error_page(Exception $e) : void
{
    //let the browser know of the error
    http_response_code(500);

    //generate error string to display to the user
    $errorHeaders = ['Message','Stack Trace','File','Line','Code'];
    $wrappedHeaders = array_wrap_each($errorHeaders, '<h2 class="error-header">', '</h2>');

    $errorMessages = [$e->getMessage(),$e->getTraceAsString(),$e->getFile(),$e->getLine(),$e->getCode()];
    $wrappedMessages = array_wrap_each($errorMessages, '<p class="error-message">', '</p>');

    //this variable will be used in the included file `error-message.php`
    $errorMessage = '';

    //just checking the above arrays match in length
    if (count($wrappedHeaders) !== count($wrappedMessages))
        throw new Exception('count of each array should match');

    for ($i = 0; $i < count($errorHeaders); $i++)//I prefer not to use braces for one line for statements
        //concatonate the header and message together and then wrap them in a div
        $errorMessage .= implode("", array_wrap_each([ $wrappedHeaders[$i] . $wrappedMessages[$i] ], "<div class='mb-4'>", "</div>" ));


    include dirname(__FILE__) . '/../html/error-message.php';

    return;

}



function get_setting($name)
{
    $fileName = dirname(__FILE__) . '/../settings.ini';
    if (!file_exists($fileName)) throw new Exception('ini file not found');
    $iniFile = parse_ini_file($fileName);

    return $iniFile[$name];

}


function get_ip()
{
    return $_SERVER['REMOTE_ADDR'];
}





