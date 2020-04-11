<?php


namespace Connect4\functions\logic;


use Connect4\Board;
use Connect4\BoardPosition\BoardPosition;


function board_position_code(BoardPosition $boardPosition)
{
    return $boardPosition->getPositionCode();
}

function get_board_position_by_position_code(Board &$board, string $positionCode)
{
    $boardPositions = $board->getBoardPositions();
    for ($i = 0; $i < count($boardPositions); $i++)
    {
        /* @var $bPosition BoardPosition */
        $bPosition = $boardPositions[$i];
        if ($bPosition->getPositionCode() === $positionCode) return $bPosition;
    }

    return false;

}

function do_game_pieces_match_color(BoardPosition $position1, BoardPosition $position2)
{



}










