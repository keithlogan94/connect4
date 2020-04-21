<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Requests\Request;

class MembershipEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {


        include dirname(__FILE__) . '/../../../../html/membership.php';

    }

    public function getRequestCode(): string
    {
        return 'membership';
    }

    public function getRequestMethod(): string
    {
        return 'GET';
    }
}