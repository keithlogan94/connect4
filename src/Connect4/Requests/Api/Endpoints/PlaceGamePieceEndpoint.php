<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Board;
use Connect4\GamePiece;
use Connect4\Requests\Request;
use Exception;
use function Connect4\functions\utils\get_ip;

class PlaceGamePieceEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {

        if (!isset($_SESSION['user_id'])) throw new Exception('must be logged in');

        if (!isset($_GET['game_id'])) throw new Exception('game_id must be set');
        if (!isset($_GET['color'])) throw new Exception('color must be set');
        if (!isset($_GET['column'])) throw new Exception('column must be set');

        if (!is_numeric($_GET['game_id'])) throw new Exception('game_id must be numeric');
        if (!is_numeric($_GET['column'])) throw new Exception('column must be numeric');


        $gameId = intval($_GET['game_id']);
        $color = $_GET['color'];
        $column = intval($_GET['column']);




        $gamePiece = new GamePiece($color === 'yellow' ? GamePiece::YELLOW_COLOR : GamePiece::RED_COLOR);

        $board = new Board($gameId);


        $ip = get_ip();
        switch ($color) {
            case "yellow":
                if ($board->getGameData(IP_ASSIGNED_YELLOW) !== $ip) {
                    throw new Exception('this ip can\'t play for yellow');
                }
                break;
            case "red":
                if ($board->getGameData(IP_ASSIGNED_RED) !== $ip) {
                    throw new Exception('this ip can\'t play for red');
                }
                break;
            default:
                throw new Exception('unhandled color');
        }


        $returnArray = $board->placeGamePieceInColumn($gamePiece, $column);


        echo json_encode($returnArray);



    }

    public function getRequestCode(): string
    {
        return 'place_game_piece';
    }

    public function getRequestMethod(): string
    {
        return 'POST';
    }
}