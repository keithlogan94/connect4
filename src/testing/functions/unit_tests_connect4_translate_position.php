<?php



namespace testing\functions\unit_tests\connect4_translate_position;




use function connect4_translate_position\column_after;
use function connect4_translate_position\column_before;
use function connect4_translate_position\get_columns;
use function connect4_translate_position\get_rows;
use function connect4_translate_position\row_after;
use function connect4_translate_position\row_before;

use Exception;

function test_valid_get_rows()
{
    echo "running Unit Test";
    echo "testing " . __METHOD__ . PHP_EOL;
    $columns = get_rows();

    if (count($columns) !== 7) throw new Exception('rows returned wrong count');

    foreach ($columns as $column) {
        if (!ctype_alpha($column)) throw new Exception('character should be letter');
    }


}

function test_valid_get_columns()
{
    echo "running Unit Test";
    echo "testing " . __METHOD__ . PHP_EOL;

    $columns = get_columns();

    if (count($columns) !== 6) throw new Exception('columns returned wrong count');

    foreach ($columns as $column) {
        if (!is_int($column)) throw new Exception('character should be int');
    }

}

function test_valid_column_after(int $column)
{
    echo "running Unit Test";
    echo "testing " . __METHOD__ . PHP_EOL;

    if (column_after(-1) !== false) throw new Exception('column after failed to return right column');
    if (column_after(0) !== 1) throw new Exception('column after failed to return right column');
    if (column_after(1) !== 2) throw new Exception('column after failed to return right column');
    if (column_after(3) !== 4) throw new Exception('column after failed to return right column');
    if (column_after(4) !== 5) throw new Exception('column after failed to return right column');
    if (column_after(5) !== 6) throw new Exception('column after failed to return right column');
    if (column_after(6) !== false) throw new Exception('column after failed to return right column');

}

function test_valid_column_before(int $column)
{
    echo "running Unit Test";
    echo "testing " . __METHOD__ . PHP_EOL;

    if (column_before(0) !== false) throw new Exception('column before failed to return right column');
    if (column_before(1) !== 0) throw new Exception('column before failed to return right column');
    if (column_before(3) !== 2) throw new Exception('column before failed to return right column');
    if (column_before(4) !== 3) throw new Exception('column before failed to return right column');
    if (column_before(5) !== 4) throw new Exception('column before failed to return right column');
    if (column_before(6) !== 5) throw new Exception('column before failed to return right column');
    if (column_before(7) !== false) throw new Exception('column before failed to return right column');

}

function test_valid_row_after(string $row)
{
    echo "running Unit Test";
    echo "testing " . __METHOD__ . PHP_EOL;

    if (row_after('A') !== 'B') throw new Exception('row after failed to return right column');
    if (row_after('B') !== 'C') throw new Exception('row after failed to return right column');
    if (row_after('C') !== 'D') throw new Exception('row after failed to return right column');
    if (row_after('D') !== 'E') throw new Exception('row after failed to return right column');
    if (row_after('E') !== 'F') throw new Exception('row after failed to return right column');
    if (row_after('F') !== 'G') throw new Exception('row after failed to return right column');
    if (row_after('G') !== false) throw new Exception('row after before failed to return right column');
}

function test_valid_row_before(string $row)
{
    echo "running Unit Test";
    echo "testing " . __METHOD__ . PHP_EOL;

    if (row_before('A') !== false) throw new Exception('row before failed to return right column');
    if (row_before('B') !== 'A') throw new Exception('row before failed to return right column');
    if (row_before('C') !== 'B') throw new Exception('row before failed to return right column');
    if (row_before('D') !== 'C') throw new Exception('row before failed to return right column');
    if (row_before('E') !== 'D') throw new Exception('row before failed to return right column');
    if (row_before('F') !== 'E') throw new Exception('row before failed to return right column');
    if (row_before('G') !== 'F') throw new Exception('row before before failed to return right column');
    if (row_before('H') !== false) throw new Exception('row before before failed to return right column');
}

function move_up(string $positionCode)
{
    if (strlen($positionCode) !== 2) throw new Exception('$positionCode character count is not equal to 2');
    if (array_search($positionCode[0], get_rows()) === false) throw new Exception('undefined row');
    if (array_search(intval($positionCode[1]), get_columns()) === false) throw new Exception('undefined column');
    return \connect4_translate_position\row_before($positionCode[0]) . $positionCode[1];
}

function move_down(string $positionCode)
{
    if (strlen($positionCode) !== 2) throw new Exception('$positionCode character count is not equal to 2');
    if (array_search($positionCode[0], get_rows()) === false) throw new Exception('undefined row');
    if (array_search(intval($positionCode[1]), get_columns()) === false) throw new Exception('undefined column');
    return \connect4_translate_position\row_after($positionCode[0]) . $positionCode[1];
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
    $positionCode = \connect4_translate_position\move_up($positionCode);
    $positionCode = \connect4_translate_position\move_right($positionCode);
    return $positionCode;
}

function move_down_right(string $positionCode)
{
    $positionCode = move_right($positionCode);
    $positionCode = \connect4_translate_position\move_down($positionCode);
    return $positionCode;
}

function move_down_left(string $positionCode)
{
    $positionCode = move_down($positionCode);
    $positionCode = \connect4_translate_position\move_left($positionCode);
    return $positionCode;
}


function move_up_left(string $positionCode)
{
    $positionCode = move_up($positionCode);
    $positionCode = move_left($positionCode);
    return $positionCode;
}







