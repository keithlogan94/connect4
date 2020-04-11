<?php


namespace Connect4\BoardPosition;


use Connect4\Game;
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

    public function canPlace(): bool
    {
        return $this->isEmpty();
    }

    public function isPositionCodeEqualTo(string $positionCode)
    {
        return $this->getPositionCode() === $positionCode;
    }

    public function getPositionsAwayFromBoardPosition(BoardPosition $boardPosition)
    {
        if ($this->getPositionCode() === $boardPosition->getPositionCode())
            return [
                'X' => 0,
                'Y' => 0,
            ];

        return [
          'X' => (  ($boardPosition->getXPosition() - $this->getXPosition()) / Board::POSITION_INCREASE_BY ),
          'Y' => (  ($boardPosition->getYPosition() - $this->getYPosition()) / Board::POSITION_INCREASE_BY ),
        ];


    }

    public function checkForWin()
    {
        /* @var Board */
        return $this->board->checkForWin($this, 1);


    }

    public function getGamePiece() : GamePiece
    {
        if ($this->isEmpty()) throw new Exception('Game Position is empty');
        return $this->getFilledGamePiece();
    }

    public function doesBoardPositionGamePieceMatchBoardPositionGamePiece(BoardPosition $boardPosition): bool
    {
        if ($this->isEmpty()) return false;
        if ($boardPosition->getGamePiece()->getColorEnumeration() ===
            $boardPosition->getGamePiece()->getColorEnumeration())
            return true;

        return false;
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

    public function getXYCoordsToCheck()
    {
        return [

            //top right
            [
                'X' => $this->getXPosition() + (Board::POSITION_INCREASE_BY * 1),
                'Y' => $this->getXPosition() + (Board::POSITION_INCREASE_BY * 1),
            ],

            //top
            [
                'X' => $this->getXPosition() + (Board::POSITION_INCREASE_BY * 0),
                'Y' => $this->getXPosition() + (Board::POSITION_INCREASE_BY * 1),
            ],

            //right
            [
                'X' => $this->getXPosition() + (Board::POSITION_INCREASE_BY * 1),
                'Y' => $this->getXPosition() + (Board::POSITION_INCREASE_BY * 0),
            ],

            //bottom right
            [
                'X' => $this->getXPosition() + (Board::POSITION_INCREASE_BY * 1),
                'Y' => $this->getXPosition() + (Board::POSITION_INCREASE_BY * -1),
            ],

            //bottom
            [
                'X' => $this->getXPosition() + (Board::POSITION_INCREASE_BY * 0),
                'Y' => $this->getXPosition() + (Board::POSITION_INCREASE_BY * -1),
            ],

            //bottom left
            [
                'X' => $this->getXPosition() + (Board::POSITION_INCREASE_BY * -1),
                'Y' => $this->getXPosition() + (Board::POSITION_INCREASE_BY * -1),
            ],

            //left
            [
                'X' => $this->getXPosition() + (Board::POSITION_INCREASE_BY * -1),
                'Y' => $this->getXPosition() + (Board::POSITION_INCREASE_BY * 0),
            ],

            //top left
            [
                'X' => $this->getXPosition() + (Board::POSITION_INCREASE_BY * -1),
                'Y' => $this->getXPosition() + (Board::POSITION_INCREASE_BY * 1),
            ],

        ];
    }

    public function isEmpty(): bool
    {
        return is_null($this->filledGamePiece);
    }

    public function place(GamePiece $gamePiece) : array
    {
        //check if this position is not empty
        if (!$this->isEmpty()) throw new Exception('Board position is already filled');
        $this->setFilledGamePiece($gamePiece);

        $this->board->saveGamePositionsToDatabase();


        $isWin = $this->checkForWin();



        return [
            'win' => $isWin
        ];
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