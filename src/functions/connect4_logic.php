<?php


namespace Connect4\functions\logic;


use Connect4\Board;
use Connect4\BoardPosition\BoardPosition;
use Connect4\Exceptions\BoardPositionEmptyException;
use Connect4\GamePiece;
use Exception;


function board_position_code(BoardPosition &$boardPosition)
{
    return $boardPosition->getPositionCode();
}

function board_position_color(BoardPosition &$boardPosition)
{
    return $boardPosition->getGamePiece()->getColorEnumeration() === GamePiece::YELLOW_COLOR ? 'yellow' : 'red';
}

function is_empty(BoardPosition &$boardPosition)
{
    return $boardPosition->isEmpty();
}

function get_board_position_by_position_code(Board &$board, string $positionCode)
{
    $boardPositions = $board->getBoardPositions();
    for ($i = 0; $i < count($boardPositions); $i++)
    {
        /* @var $bPosition BoardPosition */
        $bPosition = $boardPositions[$i];
        if (board_position_code($bPosition) === $positionCode) return $bPosition;
    }

    return false;

}


function do_game_pieces_match_color(BoardPosition $position1, BoardPosition $position2)
{

    if (board_position_code($position1) === board_position_code($position2))
        throw new Exception('should not compare the same position');

    if (is_empty($position1)) throw new BoardPositionEmptyException('board position empty');
    if (is_empty($position2)) throw new BoardPositionEmptyException('board position empty');

    if (board_position_color($position1) === board_position_color($position2))
        return true;
    else return false;

}

function get_beginning_position_code_of_direction(Board &$board, string $positionCode, string $direction)
{

    if (is_empty(get_board_position_by_position_code($board, $positionCode)))
        throw new BoardPositionEmptyException('board position should not be empty');

    $begginingPositionCode = $positionCode;

    $translate = get_opposite_of_direction($direction);

    while (true) {
        $newPositionCode = $translate($begginingPositionCode);
        if ($newPositionCode === false) break;
        $newBoardPosition = get_board_position_by_position_code($board, $newPositionCode);
        if (is_empty($newBoardPosition)) break;
        $begginingPosition = get_board_position_by_position_code($board, $begginingPositionCode);
        if (!do_game_pieces_match_color($begginingPosition, $newBoardPosition)) break;
        $begginingPositionCode = $newPositionCode;
    }

    return $begginingPositionCode;

}

function get_opposite_of_direction(string $direction)
{

    $keys = [
        'Connect4\functions\translate_position\move_up' => 'Connect4\functions\translate_position\move_down',
        'Connect4\functions\translate_position\move_up_right' => 'Connect4\functions\translate_position\move_down_left',
        'Connect4\functions\translate_position\move_up_left' => 'Connect4\functions\translate_position\move_down_right',
        'Connect4\functions\translate_position\move_down' => 'Connect4\functions\translate_position\move_up',
        'Connect4\functions\translate_position\move_down_right' => 'Connect4\functions\translate_position\move_up_left',
        'Connect4\functions\translate_position\move_down_left' => 'Connect4\functions\translate_position\move_up_right',
        'Connect4\functions\translate_position\move_right' => 'Connect4\functions\translate_position\move_left',
        'Connect4\functions\translate_position\move_left' => 'Connect4\functions\translate_position\move_right',
    ];

    foreach ($keys as $key => $oppositeDirection)
        if ($key === $direction) return $oppositeDirection;

    return false;


}

function get_translated_positions_to_check()
{
    return [
        'Connect4\functions\translate_position\move_up',
        'Connect4\functions\translate_position\move_up_right',
        'Connect4\functions\translate_position\move_up_left',
        'Connect4\functions\translate_position\move_down',
        'Connect4\functions\translate_position\move_down_right',
        'Connect4\functions\translate_position\move_down_left',
        'Connect4\functions\translate_position\move_down_left',
        'Connect4\functions\translate_position\move_right',
        'Connect4\functions\translate_position\move_left',
    ];
}


function print_not_empty_positions(Board &$board)
{
    foreach ($board->getBoardPositions() as $boardPosition)
    {
        if (!is_empty($boardPosition))
        {
            $positionCode = board_position_code($boardPosition);
            echo "$positionCode is not empty and is ".board_position_color($boardPosition)."\r\n";
        }
    }

}









