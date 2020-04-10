<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Requests\Request;
use Exception;

class GetGamePositionsEndPoint extends Endpoint
{

    public function handleRequest(Request $request)
    {

        if (!isset($_GET['game_id'])) throw new Exception('game_id must be set but was not');
        if (!is_numeric($_GET['game_id'])) throw new Exception('game_id must be numeric');

        $gameId = $_GET['game_id'];

        echo "getting game positions for " . $gameId;




    }

    public function getRequestCode(): string
    {
        return 'get_game_positions';
    }

    public function getRequestMethod(): string
    {
        return 'GET';
    }
}