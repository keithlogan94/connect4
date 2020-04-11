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

        $board = new Board($gameId);
        $board->saveGamePositionsToDatabase();


        return $row;
    }


    public function echoGameScreen()
    {
        header("Content-Type: text/html");
        echo file_get_contents(dirname(__FILE__) . '/../html/basic-game-screen.html');
    }


}