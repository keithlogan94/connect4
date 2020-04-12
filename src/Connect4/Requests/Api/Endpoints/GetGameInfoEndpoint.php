<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Board;
use Connect4\Requests\Request;
use Exception;

class GetGameInfoEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {

        if (!isset($_GET['game_id'])) throw new Exception('game_id must be set but was not');
        if (!is_numeric($_GET['game_id'])) throw new Exception('game_id must be numeric');

        if (!isset($_GET['game_info'])) throw new Exception('game_info must be set but was not');


        $gameId = intval($_GET['game_id']);
        $gameInfo = $_GET['game_info'];

        $board = new Board($gameId);
        $info = $board->getGameData($gameInfo);


        echo json_encode([
            $gameInfo => $info,
        ]);

    }

    public function getRequestCode(): string
    {
        return 'game_info';
    }

    public function getRequestMethod(): string
    {
        return 'GET';
    }

}