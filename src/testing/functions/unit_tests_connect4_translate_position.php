<?php



namespace Connect4\functions\translate_position\unit_tests;




use function Connect4\functions\translate_position\column_after;
use function Connect4\functions\translate_position\column_before;
use function Connect4\functions\translate_position\get_columns;
use function Connect4\functions\translate_position\get_rows;
use function Connect4\functions\translate_position\move_up;
use function Connect4\functions\translate_position\row_after;
use function Connect4\functions\translate_position\row_before;
use function Connect4\functions\translate_position\move_left;
use function Connect4\functions\translate_position\move_right;
use function Connect4\functions\translate_position\move_down;
use function Connect4\functions\translate_position\move_up_right;
use function Connect4\functions\translate_position\move_up_left;
use function Connect4\functions\translate_position\move_down_left;
use function Connect4\functions\translate_position\move_down_right;


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
    if (column_after(0) !== false) throw new Exception('column after failed to return right column');
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
    if (column_before(1) !== false) throw new Exception('column before failed to return right column');
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
    try {
        if (move_up('H1') !== false) throw new Exception('move up before failed to return right column');
        throw new Exception('should have thrown an exception');
    } catch (Exception $e) {
        //expected
    }

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
    try {
        if (move_down('H1') !== false) throw new Exception('move down before failed to return right column');
        throw new Exception('should have thrown an exception');
    } catch (Exception $e) {
        //expected
    }




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
    try {
        if (move_right('G0') !== false) throw new Exception('move right before failed to return right column');
        throw new Exception('should have thrown an exception');
    } catch (Exception $e) {
        //expected
    }
    if (move_right('G6') !== false) throw new Exception('move right before failed to return right column');
    try {
        if (move_right('H1') !== false) throw new Exception('move right before failed to return right column');
        throw new Exception('should have thrown an exception');
    } catch (Exception $e) {
        //expected
    }


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
    try {
        if (move_left('H1') !== false) throw new Exception('move left before failed to return right column');
        throw new Exception('should have thrown an exception');
    } catch (Exception $e) {
        //expected
    }

}

function test_valid_move_up_right()
{
    echo "running Unit Test";
    echo "testing " . __METHOD__ . PHP_EOL;

    if (move_up_right('A2') !== false) throw new Exception('move up right failed to return right column');
    if (move_up_right('B2') !== 'A3') throw new Exception('move up right failed to return right column');
    if (move_up_right('C2') !== 'B3') throw new Exception('move up right failed to return right column');
    if (move_up_right('D2') !== 'C3') throw new Exception('move up right failed to return right column');
    if (move_up_right('E2') !== 'D3') throw new Exception('move up right failed to return right column');
    if (move_up_right('F2') !== 'E3') throw new Exception('move up right failed to return right column');
    if (move_up_right('G2') !== 'F3') throw new Exception('move up right before failed to return right column');
    if (move_up_right('G1') !== 'F2') throw new Exception('move up right before failed to return right column');
    try {
        if (move_up_right('H1') !== false) throw new Exception('move up right before failed to return right column');
        throw new Exception('should have thrown an exception');
    } catch (Exception $e) {
        //expected
    }

}

function test_valid_move_down_right()
{
    echo "running Unit Test";
    echo "testing " . __METHOD__ . PHP_EOL;

    if (move_down_right('A2') !== 'B3') throw new Exception('move_down_right right failed to return right column');
    if (move_down_right('B2') !== 'C3') throw new Exception('move_down_right right failed to return right column');
    if (move_down_right('C2') !== 'D3') throw new Exception('move_down_right right failed to return right column');
    if (move_down_right('D2') !== 'E3') throw new Exception('move_down_right right failed to return right column');
    if (move_down_right('E2') !== 'F3') throw new Exception('move_down_right right failed to return right column');
    if (move_down_right('F2') !== 'G3') throw new Exception('move_down_right right failed to return right column');
    if (move_down_right('G2') !== false) throw new Exception('move_down_right right before failed to return right column');
    if (move_down_right('G1') !== false) throw new Exception('move_down_right right before failed to return right column');
    try {
        if (move_down_right('H1') !== false) throw new Exception('move_down_right right before failed to return right column');
        throw new Exception('should have thrown an exception');
    } catch (Exception $e) {
        //expected
    }

}

function test_valid_move_down_left()
{
    echo "running Unit Test";
    echo "testing " . __METHOD__ . PHP_EOL;

    if (move_down_left('A2') !== 'B1') throw new Exception('move_down_left right failed to return right column');
    if (move_down_left('B2') !== 'C1') throw new Exception('move_down_left right failed to return right column');
    if (move_down_left('C2') !== 'D1') throw new Exception('move_down_left right failed to return right column');
    if (move_down_left('D2') !== 'E1') throw new Exception('move_down_left right failed to return right column');
    if (move_down_left('E2') !== 'F1') throw new Exception('move_down_left right failed to return right column');
    if (move_down_left('F2') !== 'G1') throw new Exception('move_down_left right failed to return right column');
    if (move_down_left('G2') !== false) throw new Exception('move_down_left right before failed to return right column');
    if (move_down_left('G1') !== false) throw new Exception('move_down_left right before failed to return right column');
    try {
        if (move_down_left('H1') !== false) throw new Exception('move_down_right right before failed to return right column');
        throw new Exception('should have thrown an exception');
    } catch (Exception $e) {
        //expected
    }
}


function test_valid_move_up_left()
{
    echo "running Unit Test";
    echo "testing " . __METHOD__ . PHP_EOL;

    if (move_up_left('A2') !== false) throw new Exception('move_up_left failed to return right column');
    if (move_up_left('B2') !== 'A1') throw new Exception('move_up_left failed to return right column');
    if (move_up_left('C2') !== 'B1') throw new Exception('move_up_left failed to return right column');
    if (move_up_left('D2') !== 'C1') throw new Exception('move_up_left failed to return right column');
    if (move_up_left('E2') !== 'D1') throw new Exception('move_up_left failed to return right column');
    if (move_up_left('F2') !== 'E1') throw new Exception('move_up_left failed to return right column');
    if (move_up_left('G2') !== 'F1') throw new Exception('move_up_left before failed to return right column');
    if (move_up_left('G1') !== false) throw new Exception('move_up_left before failed to return right column');
    try {
        if (move_up_left('H1') !== false) throw new Exception('move_up_left before failed to return right column');
        throw new Exception('should have thrown an exception');
    } catch (Exception $e) {
        //expected
    }

}



function run_section_unit_tests()
{

    test_valid_get_rows();
    test_valid_get_columns();
    test_valid_column_after();
    test_valid_column_before();
    test_valid_row_after();
    test_valid_row_before();
    test_valid_move_up();
    test_valid_move_down();
    test_valid_move_right();
    test_valid_move_left();
    test_valid_move_up_right();
    test_valid_move_down_right();
    test_valid_move_down_left();
    test_valid_move_up_left();

}







