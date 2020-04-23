<?php

namespace Connect4;


use Connect4\Database\Database;
use Exception;
use function Connect4\functions\utils\get_favorite_color_by_user_id;

class Game
{

    private int $newGameId;
    private Board $board;

    /**
     * @return int
     */
    public function getNewGameId(): int
    {
        return $this->newGameId;
    }

    /**
     * @param int $newGameId
     */
    public function setNewGameId(int $newGameId): void
    {
        $this->newGameId = $newGameId;
    }

    public static function confirmInviteCreateGame(array $gameSetup)
    {
        $database = new Database();
        $database->queryPrepared('CALL update_setup_game_invite_user_id(?, ?)', 'ii', $_SESSION['user_id'], intval($gameSetup['game_setup_id']));

        $game = new Game();
        $newGame = $game->createNewGame(intval($gameSetup['game_setup_id']));
        $gameId = intval($newGame['game_id']);
        if (!is_int($gameId)) throw new Exception('$gameId is not an int');
        if ($gameId < 0) throw new Exception('$gameId is less than 0');
        $board = $game->getBoard();

        $favoriteColorOfSetupUser = get_favorite_color_by_user_id(intval($gameSetup['setup_user_id']));

        switch ($favoriteColorOfSetupUser) {
            case "yellow":
                $board->setGameData(USER_ASSIGNED_YELLOW, $gameSetup['setup_user_id']);
                $board->setGameData(USER_ASSIGNED_RED, $_SESSION['user_id']);
                break;
            case "red":
                $board->setGameData(USER_ASSIGNED_RED, $gameSetup['setup_user_id']);
                $board->setGameData(USER_ASSIGNED_YELLOW, $_SESSION['user_id']);
                break;
            default:
                throw new Exception('favorite color not set');
        }

        $database->queryPrepared('CALL update_game_setup_game_id(?, ?)', 'ii', $gameId, intval($gameSetup['game_setup_id']));

        header("Location: /" . $gameId);
    }

    public function getGamePositions(int $gameId)
    {

        $database = new Database();
        $result = $database->queryPrepared('CALL get_game_board_positions(?)', 'i', $gameId);


        $rows = [];

        while ($row = mysqli_fetch_assoc($result))
            $rows[] = $row;


        return $rows;


    }

    public function getBoard() : Board
    {
        if (!isset($this->board)) {
            $this->board = new Board($this->getNewGameId());
        }
        return $this->board;
    }



    public function createNewGame(int $gameSetupId)
    {
        $database = new Database();
        $result = $database->queryPrepared("CALL create_game(?)", 'i', $gameSetupId);

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


        $this->setNewGameId(intval($row['game_id']));


        return $row;
    }



}