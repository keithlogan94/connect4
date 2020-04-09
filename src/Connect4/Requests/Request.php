<?php

namespace Connect4\Requests;


use Exception;

abstract class Request
{

    const REQUEST_TYPE_POST = 1;
    const REQUEST_TYPE_GET = 2;


    abstract protected function getRequestType() : int;

    public static function getInstance()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case "POST":
                return new PostRequest();
                break;
            case "GET":
                return new GetRequest();
            default:
                throw new Exception('Request type not supported');
        }
    }

    public function isRequestPost() : bool
    {
        return $this->getRequestType() === self::REQUEST_TYPE_POST;
    }

    public function isRequestGet() : bool
    {
        return $this->getRequestType() === self::REQUEST_TYPE_GET;
    }




}