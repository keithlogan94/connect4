<?php


namespace utils;


function array_wrap_each(array $strItems, $before = '', $after = '') {
    $newItems = [];

    foreach ($strItems as $item)
        $newItems[] = $before . $item . $after;

    return $newItems;
}


