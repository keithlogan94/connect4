<?php


namespace Connect4\BoardPosition;


class IsPositionable implements Positionable
{

    public function canPlace(): bool
    {
        return true;
    }

}