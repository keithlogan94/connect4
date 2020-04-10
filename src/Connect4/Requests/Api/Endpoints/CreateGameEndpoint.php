<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Database\Database;
use Connect4\Requests\Request;

class CreateGameEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {

        echo "running stored procedure";

        $database = new Database();
        var_dump($database->query("CALL create_game()"));


    }

    public function getRequestCode(): string
    {
        return "create_game";
    }

    public function getRequestMethod(): string
    {
        return "POST";
    }

}