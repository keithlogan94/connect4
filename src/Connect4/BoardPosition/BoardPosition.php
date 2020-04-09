<?php


namespace Connect4\BoardPosition;


use Connect4\GamePiece;
use Exception;

class BoardPosition implements Positionable
{

    protected int $xPosition;
    protected int $yPosition;
    private Positionable $positionable;
    private $filledGamePiece = null;

    public function __construct(int $xPosition, int $yPosition)
    {
        $this->xPosition = $xPosition;
        $this->yPosition = $yPosition;
        $this->positionable = new IsPositionable();
    }

    public function canPlace(): bool
    {
        //if this game position is empty and the user can't place for some reason then throw an exception
        if ($this->isEmpty() && !$this->canPlace()) throw new Exception('This error should not occur, but just testing');
        return $this->positionable->canPlace();
    }

    public function isEmpty(): bool
    {
        return is_null($this->filledGamePiece);
    }

    public function place(GamePiece $gamePiece)
    {
        //check if this position is not empty
        if (!$this->isEmpty()) throw new Exception('Board position is already filled');
        $this->setFilledGamePiece($gamePiece);
        $this->setPositionable(new NotPositionable());
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
     * @return IsPositionable|Positionable
     */
    private function getPositionable()
    {
        return $this->positionable;
    }

    /**
     * @param IsPositionable|Positionable $positionable
     */
    private function setPositionable($positionable): void
    {
        $this->positionable = $positionable;
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