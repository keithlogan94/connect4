<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Requests\Request;

class SignupEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {


        $_COOKIE['should_login'] = true;
        $_SESSION['should_login'] = true;

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