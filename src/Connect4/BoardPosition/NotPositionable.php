<?php


namespace Connect4\BoardPosition;


class NotPositionable implements Positionable
{

    public function canPlace(): bool
    {
        return false;
    }

}