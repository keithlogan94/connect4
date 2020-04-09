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

    $errorHeaders = ['Message','Stack Trace','File','Line','Code'];
    $wrappedHeaders = array_wrap_each($errorHeaders, '<h2 class="error-header">', '</h2>');

    $errorMessages = [$e->getMessage(),$e->getTraceAsString(),$e->getFile(),$e->getLine(),$e->getCode()];
    $wrappedMessages = array_wrap_each($errorMessages, '<p class="error-message">', '</p>');

    $errorMessage = '';

    if (count($wrappedHeaders) !== count($wrappedMessages))
        throw new Exception('count of each array should match');

    for ($i = 0; $i < count($errorHeaders); $i++) {
        $errorMessage .= "<div class='mb-4'>";
        $errorMessage .= $wrappedHeaders[$i];
        $errorMessage .= $wrappedMessages[$i];
        $errorMessage .= "</div>";
    }


    include dirname(__FILE__) . '../html/error-message.php';

}


