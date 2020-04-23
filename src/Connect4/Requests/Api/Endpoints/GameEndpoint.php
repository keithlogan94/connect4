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

        if (!isset($_SESSION['user_id'])) throw new Exception('must be logged in');

        if (!isset($_GET['game_id'])) throw new Exception('game_id must be set but was not');
        if (!is_numeric($_GET['game_id'])) throw new Exception('game_id must be numeric');

        $gameId = intval($_GET['game_id']);

        unset($_SESSION['invite_code']);
        unset($_SESSION['invite_link']);


        //check if this ip address is assigned
//        $board = new Board($gameId);
//        $ipAssignedYellow = $board->getGameData(IP_ASSIGNED_YELLOW);
//        $ipAssignedRed = $board->getGameData(IP_ASSIGNED_RED);
//        $ip = get_ip();

//        if ($ip !== $ipAssignedYellow && $ip !== $ipAssignedRed) {

//            if (!$ipAssignedYellow) {
//                $board->setGameData(IP_ASSIGNED_YELLOW, get_ip());
//            } else if (!$ipAssignedRed) {
//                $board->setGameData(IP_ASSIGNED_RED, get_ip());
//            }


//        }

        $port = APPLICATION_PORT;
        $hostname = APPLICATION_HOSTNAME;
        $version = APPLICATION_VERSION;
        $userId = intval($_SESSION['user_id']);

        $customJavascript = "const gameId = $gameId; const applicationPort = '$port'; const applicationHostname = '$hostname'; const version = '$version'; const userId = $userId;";
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