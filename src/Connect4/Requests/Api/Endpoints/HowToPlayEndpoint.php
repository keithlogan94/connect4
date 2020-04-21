<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Requests\Request;

class HowToPlayEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {



        include dirname(__FILE__) . '/../../../../html/how-to-play.php';


    }

    public function getRequestCode(): string
    {
        return 'how_to_play';
    }

    public function getRequestMethod(): string
    {
        return 'GET';
    }
}