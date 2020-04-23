<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Requests\Request;

class SignupEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {



        include dirname(__FILE__) . '/../../../../html/signup.php';




    }

    public function getRequestCode(): string
    {
        return 'signup';
    }

    public function getRequestMethod(): string
    {
        return 'GET';
    }
}