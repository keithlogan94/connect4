<?php


namespace Connect4\Requests\Api;


use Connect4\Requests\Api\Endpoints\CreateGameEndpoint;
use Connect4\Requests\Api\Endpoints\Endpoint;
use Connect4\Requests\Api\Endpoints\GetGameScreenEndpoint;
use Connect4\Requests\Request;
use Exception;

class Api
{

    public function handleRequest(Request $request) : void
    {

        $endpoints = array_map(function ($class) {
            return new $class();
        }, self::getAllEndpoints());

        $requestHandled = false;

        foreach ($endpoints as $endpoint) {

            /* @var Endpoint $endpoint */
            if ($endpoint->shouldEndpointHandleRequest($request))
            {
                $endpoint->handleRequest($request);
                $requestHandled = true;
                break;
            }

        }

        if (!$requestHandled)
            throw new Exception('Failed to find handler for request');


        return;

    }


    public static function getAllEndpoints()
    {
        return [
            CreateGameEndpoint::class,
            GetGameScreenEndpoint::class,
        ];
    }




}