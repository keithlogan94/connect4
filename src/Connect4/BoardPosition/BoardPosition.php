<?php


namespace Connect4\BoardPosition;


use Connect4\GamePiece;
use Exception;

class BoardPosition
{

    protected int $xPosition;
    protected int $yPosition;
    private string $positionCode;
    private $filledGamePiece = null;

    public function __construct(int $xPosition, int $yPosition, string $positionCode)
    {
        $this->positionCode = $positionCode;
        $this->xPosition = $xPosition;
        $this->yPosition = $yPosition;
    }

    public function canPlace(): bool
    {
        return $this->isEmpty();
    }

    public function isEmpty(): bool
    {
        return is_null($this->filledGamePiece);
    }

    public function place(GamePiece $gamePiece) : void
    {
        //check if this position is not empty
        if (!$this->isEmpty()) throw new Exception('Board position is already filled');
        $this->setFilledGamePiece($gamePiece);
        return;
    }



    /*
     * GETTERS AND SETTERS
     * */


    /**
     * @return int
     */
    private function getXPosition(): int
    {
        return $this->xPosition;
    }

    /**
     * @param int $xPosition
     */
    private function setXPosition(int $xPosition): void
    {
        $this->xPosition = $xPosition;
    }

    /**
     * @return int
     */
    private function getYPosition(): int
    {
        return $this->yPosition;
    }

    /**
     * @param int $yPosition
     */
    private function setYPosition(int $yPosition): void
    {
        $this->yPosition = $yPosition;
    }

    /**
     * @return null
     */
    private function getFilledGamePiece()
    {
        return $this->filledGamePiece;
    }

    /**
     * @param null $filledGamePiece
     */
    private function setFilledGamePiece($filledGamePiece): void
    {
        $this->filledGamePiece = $filledGamePiece;
    }





}