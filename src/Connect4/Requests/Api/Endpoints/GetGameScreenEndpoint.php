<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Game;
use Connect4\Requests\Request;

class GetGameScreenEndpoint extends Endpoint
{

    public function shouldEndpointHandleRequest(Request $request): bool
    {
        if ($request->getUrlParts()->getUriParts() === false && $request->isRequestGet())
            return true;

        return false;
    }

    public function handleRequest(Request $request)
    {

        $game = new Game();
        $game->start();


    }
}