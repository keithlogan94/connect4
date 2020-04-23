<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Database\Database;
use Connect4\Requests\Request;
use Exception;

class InviteLinkEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {
        if (!isset($_GET['invite_code'])) {
            throw new Exception('Invite code was not found');
        }

        $inviteCode = $_GET['invite_code'];


        $database = new Database();

        $result = $database->queryPrepared('CALL find_game_setup_by_invite_code(?)', 's', $inviteCode);
        $gameSetup = mysqli_fetch_assoc($result);

        $_SESSION['invited'] = $gameSetup;


        if (isset($_SESSION['user_id'])) {

            if ($gameSetup['setup_user_id'] == $_SESSION['user_id']) {
                throw new Exception('You can\'t go to your own invite link');
            } else {
                echo "the user is logged in<BR>";
                print_r($gameSetup);

                $database->queryPrepared('CALL update_setup_game_invite_user_id(?, ?)', 'ii', $_SESSION['user_id'], intval($gameSetup['game_setup_id']));

            }
        } else {
            $link = '<a href=\'/signup\'>signup</a>';
            $link = urlencode($link);

            $message = base64_encode($gameSetup['setup_user_id'] . ' has invited you to play a game of Connect4! Please login to play with them, or '.$link.' if you don\'t have an account.');
            header("Location: /login");
        }






    }

    public function getRequestCode(): string
    {
        return 'invite_link';
    }

    public function getRequestMethod(): string
    {
        return 'GET';
    }
}