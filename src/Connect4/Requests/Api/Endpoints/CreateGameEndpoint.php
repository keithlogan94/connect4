<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Game;
use Connect4\Requests\Request;
use Exception;

class CreateGameEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {

        if (!isset($_SESSION['user_id'])) throw new Exception('must be logged in');


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