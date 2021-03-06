<?php


namespace Connect4;


use Exception;

class GamePiece
{

    //COLOR ENUMERATIONS
    const YELLOW_COLOR = 1;
    const RED_COLOR = 2;

    private int $colorEnumeration;


    public function __construct(int $colorEnumeration)
    {
        if (!$this->isValidColor($colorEnumeration)) throw new Exception('Invalid color enumeration');
        $this->colorEnumeration = $colorEnumeration;
    }


    public function getColorEnumeration() : int
    {
        return $this->colorEnumeration;
    }

    public function getColorString() : string
    {
        return $this->getColorEnumeration() === self::YELLOW_COLOR ? 'yellow' : 'red';
    }

    private function isValidColor(int $colorEnumeration) : bool
    {
        switch ($colorEnumeration)
        {
            case self::RED_COLOR:
            case self::YELLOW_COLOR:
                return true;
                break;
            default:
                return false;
        }
    }


}