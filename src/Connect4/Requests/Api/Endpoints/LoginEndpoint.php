<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Requests\Request;

class LoginEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {


        include dirname(__FILE__) . '/../../../../html/login.php';

    }

    public function getRequestCode(): string
    {
        return 'login';
    }

    public function getRequestMethod(): string
    {
        return 'GET';
    }
}