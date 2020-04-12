<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Board;
use function Connect4\functions\logic\get_last_game_played_id;
use function Connect4\functions\logic\is_last_game_played_won;
use Connect4\Game;
use Connect4\Requests\Request;

class GetGameScreenEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {

        $id = get_last_game_played_id();

        if (is_int($id) && $id > 0) {
            if (is_last_game_played_won()) {
                $game = new Game();
                $row = $game->createNewGame();
                header("Location: http://localhost:8378/" . $row['game_id']);
            } else {
                $board = new Board($id);
                if ($board->getGameData('is_tie') === 'yes') {
                    $game = new Game();
                    $row = $game->createNewGame();
                    header("Location: http://localhost:8378/" . $row['game_id']);
                } else {
                    header("Location: http://localhost:8378/" . $id);
                }
            }
        } else {
            $game = new Game();
            $row = $game->createNewGame();
            header("Location: http://localhost:8378/" . $row['game_id']);
        }








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