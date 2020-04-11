<?php



namespace testing\functions\unit_tests\connect4_translate_position;




use function connect4_translate_position\column_after;
use function connect4_translate_position\column_before;
use function connect4_translate_position\get_columns;
use function connect4_translate_position\get_rows;
use function connect4_translate_position\move_up;
use function connect4_translate_position\row_after;
use function connect4_translate_position\row_before;
use function connect4_translate_position\move_left;
use function connect4_translate_position\move_right;
use function connect4_translate_position\move_down;

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

function test_valid_column_after()
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

function test_valid_column_before()
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

function test_valid_row_after()
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

function test_valid_row_before()
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

function test_valid_move_up()
{
    echo "running Unit Test";
    echo "testing " . __METHOD__ . PHP_EOL;

    if (move_up('A1') !== false) throw new Exception('move up failed to return right column');
    if (move_up('B1') !== 'A1') throw new Exception('move up failed to return right column');
    if (move_up('C1') !== 'B1') throw new Exception('move up failed to return right column');
    if (move_up('D1') !== 'C1') throw new Exception('move up failed to return right column');
    if (move_up('E1') !== 'D1') throw new Exception('move up failed to return right column');
    if (move_up('F1') !== 'E1') throw new Exception('move up failed to return right column');
    if (move_up('G1') !== 'F1') throw new Exception('move up before failed to return right column');
    if (move_up('H1') !== false) throw new Exception('move up before failed to return right column');
}

function test_valid_move_down()
{

    echo "running Unit Test";
    echo "testing " . __METHOD__ . PHP_EOL;

    if (move_down('A1') !== 'B1') throw new Exception('move down failed to return right column');
    if (move_down('B1') !== 'C1') throw new Exception('move down failed to return right column');
    if (move_down('C1') !== 'D1') throw new Exception('move down failed to return right column');
    if (move_down('D1') !== 'E1') throw new Exception('move down failed to return right column');
    if (move_down('E1') !== 'F1') throw new Exception('move down failed to return right column');
    if (move_down('F1') !== 'G1') throw new Exception('move down failed to return right column');
    if (move_down('G1') !== false) throw new Exception('move down before failed to return right column');
    if (move_down('H1') !== false) throw new Exception('move down before failed to return right column');



}

function test_valid_move_right()
{
    echo "running Unit Test";
    echo "testing " . __METHOD__ . PHP_EOL;

    if (move_right('A1') !== 'A2') throw new Exception('move right failed to return right column');
    if (move_right('B1') !== 'B2') throw new Exception('move right failed to return right column');
    if (move_right('C1') !== 'C2') throw new Exception('move right failed to return right column');
    if (move_right('D1') !== 'D2') throw new Exception('move right failed to return right column');
    if (move_right('E1') !== 'E2') throw new Exception('move right failed to return right column');
    if (move_right('F1') !== 'F2') throw new Exception('move right failed to return right column');
    if (move_right('G1') !== 'G2') throw new Exception('move right before failed to return right column');
    if (move_right('G0') !== false) throw new Exception('move right before failed to return right column');
    if (move_right('G6') !== false) throw new Exception('move right before failed to return right column');
    if (move_right('H1') !== false) throw new Exception('move right before failed to return right column');

}

function test_valid_move_left()
{
    echo "running Unit Test";
    echo "testing " . __METHOD__ . PHP_EOL;

    if (move_left('A2') !== 'A1') throw new Exception('move left failed to return right column');
    if (move_left('B2') !== 'B1') throw new Exception('move left failed to return right column');
    if (move_left('C2') !== 'C1') throw new Exception('move left failed to return right column');
    if (move_left('D2') !== 'D1') throw new Exception('move left failed to return right column');
    if (move_left('E2') !== 'E1') throw new Exception('move left failed to return right column');
    if (move_left('F2') !== 'F1') throw new Exception('move left failed to return right column');
    if (move_left('G2') !== 'G1') throw new Exception('move left before failed to return right column');
    if (move_left('G1') !== false) throw new Exception('move left before failed to return right column');
    if (move_left('H1') !== false) throw new Exception('move left before failed to return right column');
}

function move_up_right(string $positionCode)
{
    echo "running Unit Test";
    echo "testing " . __METHOD__ . PHP_EOL;

    if (move_left('A2') !== 'A1') throw new Exception('move left failed to return right column');
    if (move_left('B2') !== 'B1') throw new Exception('move left failed to return right column');
    if (move_left('C2') !== 'C1') throw new Exception('move left failed to return right column');
    if (move_left('D2') !== 'D1') throw new Exception('move left failed to return right column');
    if (move_left('E2') !== 'E1') throw new Exception('move left failed to return right column');
    if (move_left('F2') !== 'F1') throw new Exception('move left failed to return right column');
    if (move_left('G2') !== 'G1') throw new Exception('move left before failed to return right column');
    if (move_left('G1') !== false) throw new Exception('move left before failed to return right column');
    if (move_left('H1') !== false) throw new Exception('move left before failed to return right column');
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







