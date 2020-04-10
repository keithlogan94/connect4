<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Requests\Request;

class CreateGameEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {

        echo "test";


    }

    public function getRequestCode(): string
    {
        return "create_game";
    }

    public function getRequestMethod(): string
    {
        return "POST";
    }

}