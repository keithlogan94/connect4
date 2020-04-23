<?php


namespace Connect4\Requests\Api;


use Connect4\Requests\Api\Endpoints\CreateGameEndpoint;
use Connect4\Requests\Api\Endpoints\Endpoint;
use Connect4\Requests\Api\Endpoints\FriendsEndpoint;
use Connect4\Requests\Api\Endpoints\GameEndpoint;
use Connect4\Requests\Api\Endpoints\GameSetupEndpoint;
use Connect4\Requests\Api\Endpoints\GetGameInfoEndpoint;
use Connect4\Requests\Api\Endpoints\GetGamePositionsEndPoint;
use Connect4\Requests\Api\Endpoints\GetGameScreenEndpoint;
use Connect4\Requests\Api\Endpoints\GetNearestToBottomPositionCode;
use Connect4\Requests\Api\Endpoints\HowToPlayEndpoint;
use Connect4\Requests\Api\Endpoints\InviteLinkEndpoint;
use Connect4\Requests\Api\Endpoints\LoginEndpoint;
use Connect4\Requests\Api\Endpoints\LoginRequest;
use Connect4\Requests\Api\Endpoints\LogoutEndpoint;
use Connect4\Requests\Api\Endpoints\MembershipEndpoint;
use Connect4\Requests\Api\Endpoints\PlaceGamePieceEndpoint;
use Connect4\Requests\Api\Endpoints\RegisterUserEndpoint;
use Connect4\Requests\Api\Endpoints\SetupGameIsReady;
use Connect4\Requests\Api\Endpoints\SignupEndpoint;
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
            FriendsEndpoint::class,
            SetupGameIsReady::class,
            LogoutEndpoint::class,
            LoginRequest::class,
            InviteLinkEndpoint::class,
            RegisterUserEndpoint::class,
            LoginEndpoint::class,
            SignupEndpoint::class,
            MembershipEndpoint::class,
            HowToPlayEndpoint::class,
            GameSetupEndpoint::class,
            CreateGameEndpoint::class,
            GetGameScreenEndpoint::class,
            GetGamePositionsEndPoint::class,
            PlaceGamePieceEndpoint::class,
            GetNearestToBottomPositionCode::class,
            GetGameInfoEndpoint::class,
            GameEndpoint    ::class,
        ];
    }




}