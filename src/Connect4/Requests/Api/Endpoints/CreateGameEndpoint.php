<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Requests\Request;

class CreateGameEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {




    }

    public function shouldEndpointHandleRequest(Request $request): bool
    {

        if ($request->getUrlParts()->getUriParts()[0] === 'create-game' && $request->isRequestPost())
            return true;

        return false;
    }


}