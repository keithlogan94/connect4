<?php


namespace Connect4\Requests\Api;


use Connect4\Requests\Api\Endpoints\CreateGameEndpoint;
use Connect4\Requests\Api\Endpoints\Endpoint;
use Connect4\Requests\Api\Endpoints\GetGamePositionsEndPoint;
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

            if ($request->isRequestOfType($endpoint->getRequestMethod()) &&
                $endpoint->getRequestCode() === $request->getRequestCode())
            {
                $requestHandled = true;
                $endpoint->handleRequest($request);
                break;
            }

        }

        if (!$requestHandled)
            throw new Exception('Failed to find handler for request: ' .
                print_r($_SERVER) .
                print_r(print_r($request->getUrlParts()->getUriParts(), true) .
                    ' REQUEST TYPE: ' . $_SERVER['REQUEST_METHOD'], true));


        return;

    }


    public static function getAllEndpoints()
    {
        return [
            CreateGameEndpoint::class,
            GetGameScreenEndpoint::class,
            GetGamePositionsEndPoint::class,
        ];
    }




}