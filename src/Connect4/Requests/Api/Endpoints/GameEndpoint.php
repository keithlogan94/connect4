<?php /** @noinspection PhpUnusedLocalVariableInspection */


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Requests\Request;
use Exception;

class GameEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {

        if (!isset($_GET['game_id'])) throw new Exception('game_id must be set but was not');
        if (!is_numeric($_GET['game_id'])) throw new Exception('game_id must be numeric');

        $gameId = intval($_GET['game_id']);

        $port = APPLICATION_PORT;

        $customJavascript = "const gameId = $gameId; const applicationPort = '$port';";
        include dirname(__FILE__) . '/../../../../html/basic-game-screen.php';

    }

    public function getRequestCode(): string
    {
        return 'game';
    }

    public function getRequestMethod(): string
    {
        return 'GET';
    }

}