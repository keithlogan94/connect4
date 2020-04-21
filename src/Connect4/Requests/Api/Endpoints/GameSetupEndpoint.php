<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Requests\Request;

class GameSetupEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {


        include dirname(__FILE__) . '/../../../../html/setup.php';


    }

    public function getRequestCode(): string
    {
        return 'game_setup';
    }

    public function getRequestMethod(): string
    {
        return 'GET';
    }
}