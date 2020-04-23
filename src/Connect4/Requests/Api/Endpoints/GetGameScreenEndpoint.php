<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Board;
use Exception;
use function Connect4\functions\logic\get_last_game_played_id;
use function Connect4\functions\logic\is_last_game_played_won;
use Connect4\Game;
use Connect4\Requests\Request;

class GetGameScreenEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {

        header("Location: /setup");
        return;

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