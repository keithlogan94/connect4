<?php



namespace connect4_translate_position;

use Exception;

function get_rows()
{
    return ['A','B','C','D','E','F','G'];
}

function get_columns()
{
    return [1,2,3,4,5,6];
}

function column_after(int $column)
{
    $columns = get_columns();
    $index = array_search($column, $columns);
    if ($index === false) return false;
    if ($index < 5) return $columns[$index+1];
    else return false;
}

function column_before(int $column)
{
    $columns = get_columns();
    $index = array_search($column, $columns);
    if ($index === false) return false;
    if ($index > 0) return $columns[$index-1];
    else return false;
}

function row_after(string $row)
{
    $rows = get_rows();
    $index = array_search($row, $rows);
    if ($index === false) return false;
    if ($index < 6) return $rows[$index+1];
    else return false;
}

function row_before(string $row)
{
    $rows = get_rows();
    $index = array_search($row, $rows);
    if ($index === false) return false;
    if ($index > 0) return $rows[$index-1];
    else return false;
}

function move_up(string $positionCode)
{
    if (strlen($positionCode) !== 2) throw new Exception('$positionCode character count is not equal to 2');
    if (array_search($positionCode[0], get_rows()) === false) throw new Exception('undefined row');
    if (array_search(intval($positionCode[1]), get_columns()) === false) throw new Exception('undefined column');
    return row_before($positionCode[0]) . $positionCode[1];
}

function move_down(string $positionCode)
{
    if (strlen($positionCode) !== 2) throw new Exception('$positionCode character count is not equal to 2');
    if (array_search($positionCode[0], get_rows()) === false) throw new Exception('undefined row');
    if (array_search(intval($positionCode[1]), get_columns()) === false) throw new Exception('undefined column');
    return row_after($positionCode[0]) . $positionCode[1];
}

function move_right(string $positionCode)
{
    if (strlen($positionCode) !== 2) throw new Exception('$positionCode character count is not equal to 2');
    if (array_search($positionCode[0], get_rows()) === false) throw new Exception('undefined row');
    if (array_search(intval($positionCode[1]), get_columns()) === false) throw new Exception('undefined column');
    return  $positionCode[0] . row_after(intval($positionCode[1]));
}

function move_left(string $positionCode)
{
    if (strlen($positionCode) !== 2) throw new Exception('$positionCode character count is not equal to 2');
    if (array_search($positionCode[0], get_rows()) === false) throw new Exception('undefined row');
    if (array_search(intval($positionCode[1]), get_columns()) === false) throw new Exception('undefined column');
    return  $positionCode[0] . row_before(intval($positionCode[1]));
}

function move_up_right(string $positionCode)
{
    $positionCode = move_up($positionCode);
    $positionCode = move_right($positionCode);
    return $positionCode;
}

function move_down_right(string $positionCode)
{
    $positionCode = move_right($positionCode);
    $positionCode = move_down($positionCode);
    return $positionCode;
}

function move_down_left(string $positionCode)
{
    $positionCode = move_down($positionCode);
    $positionCode = move_left($positionCode);
    return $positionCode;
}


function move_up_left(string $positionCode)
{
    $positionCode = move_up($positionCode);
    $positionCode = move_left($positionCode);
    return $positionCode;
}




