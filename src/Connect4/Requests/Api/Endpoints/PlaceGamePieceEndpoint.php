<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Requests\Request;
use Exception;

class PlaceGamePieceEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {
//        &game_id=$1&color=$2&column=$3

        if (!isset($_GET['game_id'])) throw new Exception('game_id must be set');
        if (!isset($_GET['color'])) throw new Exception('color must be set');
        if (!isset($_GET['column'])) throw new Exception('column must be set');

        if (!is_numeric($_GET['game_id'])) throw new Exception('game_id must be numeric');
        if (!is_numeric($_GET['column'])) throw new Exception('column must be numeric');







        echo 'test';




    }

    public function getRequestCode(): string
    {
        return 'place_game_piece';
    }

    public function getRequestMethod(): string
    {
        return 'POST';
    }
}