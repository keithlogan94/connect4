<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Requests\Request;

abstract class Endpoints
{


    abstract protected function shouldEndpointHandleRequest(Request $request) : bool;

    abstract protected function handleRequest(Request $request);


    public static function getAllEndpoints()
    {

        return [
            CreateGameEndpoint::class,
        ];



    }


}