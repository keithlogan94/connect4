<?php


namespace Connect4;


use Connect4\BoardPosition\BoardPosition;
use Exception;

class Board
{

    private $boardPositions = [];

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

        for ($c = 0; $c < $columns; $c++)
        {
            for ($r = 0; $r < $rows; $r++) {
                //Place this position on the board at a specific (X, Y) coordinate which will be used for calculations (Graphing calculations)
                $this->addBoardPosition(new BoardPosition(self::POSITION_INCREASE_BY * $c, self::POSITION_INCREASE_BY * $r));
            }
        }



    }




    private function addBoardPosition(BoardPosition $boardPosition)
    {
        if (!$boardPosition->canPlace()) throw new Exception('User should be able to place');
        $this->boardPositions[] = $boardPosition;
    }






}