<?php


namespace Connect4;


use Connect4\BoardPosition\BoardPosition;
use Exception;

class Board
{

    private array $boardPositions = [];

    const POSITION_INCREASE_BY = 10;


    public function __construct()
    {
        $this->generateGamePositions();
    }

    private function generateGamePositions()
    {
        //generate 6 x 7 columns (42)
        $columns = 6;
        $rows = 7;

        $columnCodes = [1,2,3,4,5,6];
        $rowCodes = ['A','B','C','D','E','F','G'];

        for ($c = 0; $c < $columns; $c++)
        {
            for ($r = 0; $r < $rows; $r++) {
                //Place this position on the board at a specific (X, Y) coordinate which will be used for calculations (Graphing calculations)
                $this->addBoardPosition(new BoardPosition(self::POSITION_INCREASE_BY * $c, self::POSITION_INCREASE_BY * $r, $rowCodes[$r] . $columnCodes[$c] ));
            }
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