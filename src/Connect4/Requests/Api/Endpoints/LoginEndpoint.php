<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Requests\Request;

class LoginEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {


        if (!isset($_COOKIE['should_login']) && !isset($_SESSION['should_login'])) {
            header("Location: /signup");
        }


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