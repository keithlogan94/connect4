<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Board;
use Connect4\Requests\Request;
use Exception;

class GetNearestToBottomPositionCode extends Endpoint
{

    public function handleRequest(Request $request)
    {
        if (!isset($_GET['game_id'])) throw new Exception('game_id must be set');
        if (!is_numeric($_GET['game_id'])) throw new Exception('game_id must be numeric');
        if (!isset($_GET['column'])) throw new Exception('column must be set');
        if (!is_numeric($_GET['column'])) throw new Exception('column must be numeric');

        $gameId = intval($_GET['game_id']);
        $column = intval($_GET['column']);

        $board = new Board($gameId);
        $positionCode = $board->getPositionCodeOfClosestToBottomOpenBoardPosition($column);


        echo json_encode([
            'column' => $column,
            'game_id' => $gameId,
            'position_code' => $positionCode
        ]);


    }

    public function getRequestCode(): string
    {
        return 'get_nearest_to_bottom_game_position';
    }

    public function getRequestMethod(): string
    {
        return 'GET';
    }
}