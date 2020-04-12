<?php

namespace Connect4;


use Connect4\Database\Database;

class Game
{

    public function getGamePositions(int $gameId)
    {

        $database = new Database();
        $result = $database->queryPrepared('CALL get_game_board_positions(?)', 'i', $gameId);


        $rows = [];

        while ($row = mysqli_fetch_assoc($result))
            $rows[] = $row;


        return $rows;


    }



    public function createNewGame()
    {
        $database = new Database();
        $result = $database->query("CALL create_game()");

        $row = mysqli_fetch_assoc($result);

        $gameId = $row['game_id'];

        $newGameColor = 'yellow';

        $previousGameId = intval($gameId) - 1;
        if ($previousGameId > 0) {
            $previousGame = new Board($previousGameId);
            $winningColor = $previousGame->getGameData('winning_color');

            if ($winningColor) {
                switch ($winningColor) {
                    case "yellow":
                            $newGameColor = 'red';
                        break;
                        case "red";
                            $newGameColor = 'yellow';
                        break;
                    default:
                }
            }
        }


        $board = new Board($gameId);
        $board->saveGamePositionsToDatabase();

        //yellow starts the game
        $board->setGameData('turn_color', $newGameColor);


        return $row;
    }



}