<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Game;
use Connect4\Requests\Request;

class CreateGameEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {


        $game = new Game();
        $row = $game->createNewGame();


        echo json_encode($row);


    }

    public function getRequestCode(): string
    {
        return "create_game";
    }

    public function getRequestMethod(): string
    {
        return "POST";
    }

}