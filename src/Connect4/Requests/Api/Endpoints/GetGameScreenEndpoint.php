<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Game;
use Connect4\Requests\Request;

class GetGameScreenEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {

        $game = new Game();
        $row = $game->createNewGame();

        header("Location: http://localhost:8378/" . $row['game_id']);


    }

    public function getRequestCode(): string
    {
        return 'init_screen';
    }

    public function getRequestMethod(): string
    {
        return 'GET';
    }

}