<?php


namespace Connect4\functions\logic;


use Connect4\Board;
use Connect4\BoardPosition\BoardPosition;
use Connect4\Exceptions\BoardPositionEmptyException;
use Connect4\GamePiece;
use Exception;


function board_position_code(BoardPosition $boardPosition)
{
    if (is_empty($boardPosition)) throw new BoardPositionEmptyException('board position empty');
    return $boardPosition->getPositionCode();
}

function board_position_color(BoardPosition $boardPosition)
{
    if (is_empty($boardPosition)) throw new BoardPositionEmptyException('board position empty');
    return $boardPosition->getGamePiece()->getColorEnumeration() === GamePiece::YELLOW_COLOR ? 'yellow' : 'red';
}

function is_empty(BoardPosition $boardPosition)
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










