<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Game;
use Connect4\Requests\Request;

class GetGameScreenEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {

        $game = new Game();
        $game->start();


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