<?php


namespace Connect4;


use Connect4\BoardPosition\BoardPosition;
use Connect4\Database\Database;
use Connect4\Exceptions\BoardPositionEmptyException;
use function Connect4\functions\logic\board_position_code;
use function Connect4\functions\logic\do_game_pieces_match_color;
use function Connect4\functions\logic\get_board_position_by_position_code;
use function Connect4\functions\logic\is_empty;
use Exception;

class Board
{

    private array $boardPositions = [];
    private int $gameId;

    private $turnNumber = 0;

    const POSITION_INCREASE_BY = 10;


    public function __construct(int $gameId)
    {
        $this->gameId = $gameId;
        $this->generateGamePositions();
    }

    public function setGameData(string $key, string $value)
    {

        $database = new Database();
        $database->queryPrepared('CALL set_game_data(?, ?, ?)', 'iss', $this->gameId, $key, $value);

    }

    public function getPositionCodeOfClosestToBottomOpenBoardPosition(int $column)
    {
        $pos = ['A','B','C','D','E','F','G'];

        $closestPositionCode = false;
        $closestNumber = -1;

        foreach ($this->boardPositions as $boardPosition)
        {
            /* @var BoardPosition $boardPosition */
            if (strpos($boardPosition->getPositionCode(), strval($column)) !== FALSE) {
                if ($boardPosition->isEmpty() && array_search($boardPosition->getPositionCode()[0], $pos) > $closestNumber)
                {
                    $closestNumber = array_search($boardPosition->getPositionCode()[0], $pos);
                    $closestPositionCode = $boardPosition->getPositionCode();
                }

            }
        }

        return $closestPositionCode;

    }

    public function placeGamePieceInColumn(GamePiece $gamePiece, int $column) : array
    {

        $placeInPositionCode = $this->getPositionCodeOfClosestToBottomOpenBoardPosition($column);


        $returnArray = [];

        foreach ($this->boardPositions as $boardPosition) {
            /* @var BoardPosition $boardPosition */
            if ($boardPosition->getPositionCode() === $placeInPositionCode && $boardPosition->isEmpty())
            {
                $returnArray = $boardPosition->place($gamePiece);
                break;
            }

        }

        return $returnArray;

    }

    public function getGameData(string $key)
    {

        $database = new Database();
        $result = $database->queryPrepared('CALL get_game_data(?, ?)', 'is', $this->gameId, $key);

        return mysqli_fetch_assoc($result)['value'];

    }


    private function generateGamePositions()
    {
        //generate 6 x 7 columns (42)

        $game = new Game();
        $rows = $game->getGamePositions($this->gameId);

        $positionsIndexableByPositionCode = [];

        foreach ($rows as $row) {
            $positionsIndexableByPositionCode[$row['position_code']] = $row;
        }


        $columns = 6;
        $rows = 7;

        $columnCodes = [1,2,3,4,5,6];
        $rowCodes = ['A','B','C','D','E','F','G'];

        for ($c = 0; $c < $columns; $c++)
        {
            for ($r = 0; $r < $rows; $r++) {

                $positionCode = $rowCodes[$r] . $columnCodes[$c];

                $boardPosition = new BoardPosition(self::POSITION_INCREASE_BY * $c, self::POSITION_INCREASE_BY * $r, $positionCode, $this);

                if (isset($positionsIndexableByPositionCode[$positionCode]))
                {
                    $loadIsFilled = $positionsIndexableByPositionCode[$positionCode]['is_filled'];
                    $loadColor = $positionsIndexableByPositionCode[$positionCode]['filled_color'];
                    $xPosition = intval($positionsIndexableByPositionCode[$positionCode]['x_position']);
                    $yPosition = intval($positionsIndexableByPositionCode[$positionCode]['y_position']);
                    $boardPosition->setXPosition($xPosition);
                    $boardPosition->setYPosition($yPosition);

                    if ($loadIsFilled) {
                        $gamePiece = new GamePiece($loadColor === 'yellow' ? GamePiece::YELLOW_COLOR : GamePiece::RED_COLOR);
                        $boardPosition->setFilledGamePiece($gamePiece);
                    }
                }


                //Place this position on the board at a specific (X, Y) coordinate which will be used for calculations (Graphing calculations)
                $this->addBoardPosition($boardPosition);
            }
        }



    }

    public function saveGamePositionsToDatabase()
    {
        $database = new Database();
        $savedTurnNumber = $this->getGameData('turn_number');
        if (is_numeric($savedTurnNumber)) $this->turnNumber = intval($savedTurnNumber);
        $this->setGameData('turn_number', $this->turnNumber + 0);

        foreach ($this->boardPositions as $boardPosition)
        {

            $turnNumber = intval($this->getGameData('turn_number'));

            /* @var BoardPosition $boardPosition */
            $database->queryPrepared('CALL add_board_position(?, ?, ?, ?, ?, ?, ?)', 'isiiisi',
                $this->gameId, $boardPosition->getPositionCode(), $boardPosition->getXPosition(), $boardPosition->getYPosition(),
                !$boardPosition->isEmpty() ? 1 : 0, ($boardPosition->isEmpty() ? 0 :  ($boardPosition->getGamePiece()->getColorEnumeration() === GamePiece::RED_COLOR ? 'red' : 'yellow'))
                , $turnNumber
            );


        }

    }


    public function getBoardPositionAt(int $X, int $Y)
    {

        foreach ($this->boardPositions as $boardPosition)
        {
            /* @var $boardPosition BoardPosition */
            if ($boardPosition->getXPosition() === $X && $boardPosition->getYPosition() === $Y) {
                return $boardPosition;
            }
        }

        return false;

    }

    public function checkForWin(BoardPosition $boardPosition, int $inARow)
    {

//        $checkCoords = $boardPosition->getXYCoordsToCheck();

        $translatedPositionsToCheck = $boardPosition->getTranslatedPositionsToCheck();

        foreach ($translatedPositionsToCheck as $translatedPosition)
        {

            //run function in connect4_translate_position
            $translatedPositionCode = $translatedPosition(board_position_code($boardPosition));

            $boardPositionToCheck = get_board_position_by_position_code($this, $translatedPositionCode);

            try {
                if (do_game_pieces_match_color($boardPosition, $boardPositionToCheck))
                {
                    if ($inARow === 3) return true;
                    $isWin = $this->checkForWinOneDirection($boardPositionToCheck, $inARow + 1, $translatedPosition);
                    if ($isWin) return true;
                    else continue;
                } else {
                    continue;
                }
            } catch (BoardPositionEmptyException $e)
            {
                continue;
            }


        }


        return false;



    }

    public function checkForWinOneDirection(BoardPosition $boardPosition, int $inARow, string $direction)
    {
        if (is_empty($boardPosition)) return false;
        //run function in connect4_translate_position
        $translatedPositionCode = $direction(board_position_code($boardPosition));

        $boardPositionToCheck = get_board_position_by_position_code($this, $translatedPositionCode);

        if (is_empty($boardPositionToCheck)) return false;

        try {
            if (do_game_pieces_match_color($boardPosition, $boardPositionToCheck))
            {
                if ($inARow === 3) return true;
                $isWin = $this->checkForWinOneDirection($boardPositionToCheck, $inARow + 1, $direction);
                if ($isWin) return true;
                else return false;
            } else {
                return false;
            }
        } catch (BoardPositionEmptyException $e)
        {
            return false;
        }

    }

    public function getBoardPositions()
    {
        return $this->boardPositions;
    }




    private function addBoardPosition(BoardPosition $boardPosition) : void
    {
        $this->boardPositions[] = $boardPosition;
        return;
    }







}