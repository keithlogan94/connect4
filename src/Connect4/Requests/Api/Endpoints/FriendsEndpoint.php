<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Requests\Request;

class FriendsEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {



        include dirname(__FILE__) . '/../../../../html/friends.php';



    }

    public function getRequestCode(): string
    {
        return 'friends';
    }

    public function getRequestMethod(): string
    {
        return 'GET';
    }
}