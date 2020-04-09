<?php


namespace utils;


use Exception;

function array_wrap_each(array $strItems, $before = '', $after = '') {
    $newItems = [];

    foreach ($strItems as $item)
        $newItems[] = $before . $item . $after;

    return $newItems;
}


function echo_error_page(Exception $e)
{
    //generate error string to display to the user
    http_response_code(500);

    $errorHeaders = ['Message','Stack Trace','File','Line','Code'];
    $wrappedHeaders = array_wrap_each($errorHeaders, '<h2 class="error-header">', '</h2>');

    $errorMessages = [$e->getMessage(),$e->getTraceAsString(),$e->getFile(),$e->getLine(),$e->getCode()];
    $wrappedMessages = array_wrap_each($errorMessages, '<p class="error-message">', '</p>');

    $errorMessage = '';

    if (count($wrappedHeaders) !== count($wrappedMessages))
        throw new Exception('count of each array should match');

    for ($i = 0; $i < count($errorHeaders); $i++)//I prefer not to use braces for one line for statements
        //concatonate the header and message together and then wrap them in a div
        $errorMessage .= implode("", array_wrap_each([ $wrappedHeaders[$i] . $wrappedMessages[$i] ], "<div class='mb-4'>", "</div>" ));


    include dirname(__FILE__) . '/../html/error-message.php';

}


