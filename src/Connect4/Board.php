<?php


namespace Connect4;


use Connect4\BoardPosition\BoardPosition;
use Connect4\Database\Database;
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

    public function placeGamePieceInColumn(GamePiece $gamePiece, int $column) : void
    {

        $placeInPositionCode = $this->getPositionCodeOfClosestToBottomOpenBoardPosition($column);

        foreach ($this->boardPositions as $boardPosition) {
            /* @var BoardPosition $boardPosition */
            if ($boardPosition->getPositionCode() === $placeInPositionCode && $boardPosition->isEmpty())
            {
                $boardPosition->place($gamePiece);
                break;
            }

        }

        return;

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

        $this->setGameData('turn_number', $this->turnNumber + 1);


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

        $checkCoords = $boardPosition->getXYCoordsToCheck();

        foreach ($checkCoords as $checkCoord)
        {
            $boardPositionToCheck = $this->getBoardPositionAt($checkCoord['X'], $checkCoord['Y']);

            if ($boardPosition->doesBoardPositionGamePieceMatchBoardPositionGamePiece($boardPositionToCheck))
            {
                if ($inARow === 3) return true;
                $isWin = $this->checkForWinOneDirection($boardPositionToCheck, $inARow + 1, $boardPosition->getXPosition() - $checkCoord['X'], $boardPosition->getXPosition() - $checkCoord['Y'] );
                if ($isWin) return true;
                else return false;
            } else {
                return false;
            }


        }



    }

    public function checkForWinOneDirection(BoardPosition $boardPosition, int $inARow, int $directionX, int $directionY)
    {
        $checkCoords = $boardPosition->getXYCoordsToCheck();

        $boardPositionToCheck = $this->getBoardPositionAt($boardPosition->getXPosition() + $directionX, $boardPosition->getYPosition() + $directionY);

        if ($boardPosition->doesBoardPositionGamePieceMatchBoardPositionGamePiece($boardPositionToCheck))
        {
            if ($inARow === 3) return true;
            $isWin = $this->checkForWinOneDirection($boardPositionToCheck, $inARow + 1, $directionX, $directionY);
            if ($isWin) return true;
            else return false;
        } else {
            return false;
        }


    }

    public function getBoardPositions()
    {
        return $this->boardPositions;
    }




    private function addBoardPosition(BoardPosition $boardPosition) : void
    {
        if (!$boardPosition->canPlace()) throw new Exception('User should be able to place');
        $this->boardPositions[] = $boardPosition;
        return;
    }







}