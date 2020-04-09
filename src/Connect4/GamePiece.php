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