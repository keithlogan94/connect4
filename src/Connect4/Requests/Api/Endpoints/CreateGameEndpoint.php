<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Requests\Request;

class CreateGameEndpoint extends Endpoints
{

    protected function handleRequest(Request $request)
    {
        // TODO: Implement handleRequest() method.
    }

    protected function shouldEndpointHandleRequest(Request $request): bool
    {

        if ($request->getUrlParts()[0] === 'create-game')


    }


}