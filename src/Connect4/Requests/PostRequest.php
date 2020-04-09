<?php


namespace Connect4\Requests;


class PostRequest extends Request
{

    protected function getRequestType(): int
    {
        return self::REQUEST_TYPE_POST;
    }


}