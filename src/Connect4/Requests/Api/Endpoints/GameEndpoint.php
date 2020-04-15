<?php /** @noinspection PhpUnusedLocalVariableInspection */


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Board;
use Connect4\Requests\Request;
use Exception;
use function Connect4\functions\utils\get_ip;

class GameEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {

        if (!isset($_GET['game_id'])) throw new Exception('game_id must be set but was not');
        if (!is_numeric($_GET['game_id'])) throw new Exception('game_id must be numeric');

        $gameId = intval($_GET['game_id']);


        //check if this ip address is assigned
        $board = new Board($gameId);
        $ipAssignedYellow = $board->getGameData(IP_ASSIGNED_YELLOW);
        $ipAssignedRed = $board->getGameData(IP_ASSIGNED_RED);
        $ip = get_ip();

        if ($ip !== $ipAssignedYellow && $ip !== $ipAssignedRed) {

            if (!$ipAssignedYellow) {
                $board->setGameData(IP_ASSIGNED_YELLOW, get_ip());
            } else if (!$ipAssignedRed) {
                $board->setGameData(IP_ASSIGNED_RED, get_ip());
            }


        }

        $port = APPLICATION_PORT;
        $hostname = APPLICATION_HOSTNAME;
        $version = APPLICATION_VERSION;

        $customJavascript = "const gameId = $gameId; const applicationPort = '$port'; const applicationHostname = '$hostname'; const version = '$version';";
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