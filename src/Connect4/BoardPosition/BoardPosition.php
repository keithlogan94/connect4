<?php


namespace Connect4\BoardPosition;


use Connect4\Database\Database;
use function Connect4\functions\logic\is_empty;
use Connect4\GamePiece;
use Exception;
use Connect4\Board;

class BoardPosition
{

    protected int $xPosition;
    protected int $yPosition;
    private string $positionCode;
    private $filledGamePiece = null;
    /* @var Board */
    private Board $board;

    public function __construct(int $xPosition, int $yPosition, string $positionCode, &$board)
    {
        $this->positionCode = $positionCode;
        $this->xPosition = $xPosition;
        $this->yPosition = $yPosition;
        $this->board = $board;
    }

    public function checkForWin(Board &$board)
    {
        /* @var Board */
        return $this->board->checkForWin($board, $this, 0);
    }

    public function getGamePiece() : GamePiece
    {
        if ($this->isEmpty()) throw new Exception('Game Position is empty');
        return $this->getFilledGamePiece();
    }

    public function getTranslatedPositionsToCheck()
    {
        return [
            'Connect4\functions\translate_position\move_up',
            'Connect4\functions\translate_position\move_up_right',
            'Connect4\functions\translate_position\move_up_left',
            'Connect4\functions\translate_position\move_down',
            'Connect4\functions\translate_position\move_down_right',
            'Connect4\functions\translate_position\move_down_left',
            'Connect4\functions\translate_position\move_down_left',
            'Connect4\functions\translate_position\move_right',
            'Connect4\functions\translate_position\move_left',
        ];
    }

    public function isEmpty(): bool
    {
        return is_null($this->filledGamePiece);
    }

    public function place(GamePiece $gamePiece) : array
    {
        $colorTurn = $this->board->getGameData('turn_color');

        if ($colorTurn != $gamePiece->getColorString())
            throw new Exception('It\'s ' . $colorTurn . '\'s turn');



        //check if this position is not empty
        if (!$this->isEmpty()) throw new Exception('Board position is already filled');
        $this->setFilledGamePiece($gamePiece);

        $this->board->saveGamePositionsToDatabase();

        $isWin = $this->checkForWin($this->board);


        $returnArray = [
            'win' => $isWin,
        ];

        if ($isWin) {
            unset($_SESSION['active_game_id']);

            $gameId = $this->board->getGameId();

            $database = new Database();

            $result = $database->queryPrepared('CALL find_game_setup_by_game_id(?)', 'i', $gameId);
            $gameSetup = mysqli_fetch_assoc($result);

            $userSetupUserId = intval($gameSetup['setup_user_id']);
            $userInvitedUserId = intval($gameSetup['invited_user_id']);

            if ($_SESSION['user_id'] == $userSetupUserId) {
                $database->queryPrepared('CALL update_game_win_loss(?, ?, ?)', 'iii', $gameId, $userSetupUserId, $userInvitedUserId);
            } else {
                $database->queryPrepared('CALL update_game_win_loss(?, ?, ?)', 'iii', $gameId, $userInvitedUserId, $userSetupUserId);
            }


            $returnArray['winning_color'] = $gamePiece->getColorString();
            $this->board->setGameData('winning_color', $gamePiece->getColorString());
        } else {
            //check if tie
            $isTie = true;
            $allBoardPositions = $this->board->getBoardPositions();
            foreach ($allBoardPositions as $boardPosition) {
                /* @var BoardPosition $boardPosition */
                if (is_empty($boardPosition)) {
                    $isTie = false;
                    break;
                }
            }

            if ($isTie) {
                $this->board->setGameData('is_tie', 'yes');
            }

        }

        switch ($gamePiece->getColorString())
        {
            case "yellow":
                $this->board->setGameData('turn_color', 'red');
                break;
            case "red":
                $this->board->setGameData('turn_color', 'yellow');
                break;
            default:
                throw new Exception('unhandled color');
        }

        return $returnArray;
    }



    /*
     * GETTERS AND SETTERS
     * */

    public function getPositionCode(): string
    {
        return $this->positionCode;
    }

    /**
     * @return int
     */
    public function getXPosition(): int
    {
        return $this->xPosition;
    }

    /**
     * @param int $xPosition
     */
    public function setXPosition(int $xPosition): void
    {
        $this->xPosition = $xPosition;
    }

    /**
     * @return int
     */
    public function getYPosition(): int
    {
        return $this->yPosition;
    }

    /**
     * @param int $yPosition
     */
    public function setYPosition(int $yPosition): void
    {
        $this->yPosition = $yPosition;
    }

    /**
     * @return null
     */
    public function getFilledGamePiece()
    {
        return $this->filledGamePiece;
    }

    /**
     * @param null $filledGamePiece
     */
    public function setFilledGamePiece($filledGamePiece): void
    {
        $this->filledGamePiece = $filledGamePiece;
    }





}