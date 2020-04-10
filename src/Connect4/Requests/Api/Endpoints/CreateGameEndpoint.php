<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Database\Database;
use Connect4\Requests\Request;

class CreateGameEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {

        $database = new Database();
        $result = $database->query("CALL create_game()");
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);


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