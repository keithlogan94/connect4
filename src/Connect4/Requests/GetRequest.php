<?php


namespace Connect4\Requests;


class GetRequest extends Request
{

    protected function getRequestType(): int
    {
        return self::REQUEST_TYPE_GET;
    }




}