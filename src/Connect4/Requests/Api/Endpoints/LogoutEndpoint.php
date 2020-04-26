<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Requests\Request;

class LogoutEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {

        $_SESSION = [];
        header('Location: /login?m=VGhhbmtzIGZvciBwbGF5aW5nIQ==');

    }

    public function getRequestCode(): string
    {
        return 'logout';
    }

    public function getRequestMethod(): string
    {
        return 'GET';
    }
}