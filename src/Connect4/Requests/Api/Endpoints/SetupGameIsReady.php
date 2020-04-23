<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Database\Database;
use Connect4\Requests\Request;

class SetupGameIsReady extends Endpoint
{

    public function handleRequest(Request $request)
    {


        $inviteCode = $_GET['invite_code'];

        $database = new Database();
        $result = $database->queryPrepared('CALL find_game_setup_by_invite_code(?)', 's', $inviteCode);

        if (mysqli_num_rows($result) === 0) echo json_encode([]);
        else echo json_encode(mysqli_fetch_assoc($result));



    }

    public function getRequestCode(): string
    {
        return 'setup_is_game_ready';
    }

    public function getRequestMethod(): string
    {
        return 'GET';
    }
}