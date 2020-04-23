<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Requests\Request;
use Exception;

class GameSetupEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {

        if (!isset($_SESSION['user_id'])) throw new Exception('must be logged in');

        if (isset($_SESSION['active_game_id'])) {
            header("Location: /" . $_SESSION['active_game_id']);
        } else {
            include dirname(__FILE__) . '/../../../../html/setup.php';
        }





    }

    public function getRequestCode(): string
    {
        return 'game_setup';
    }

    public function getRequestMethod(): string
    {
        return 'GET';
    }
}