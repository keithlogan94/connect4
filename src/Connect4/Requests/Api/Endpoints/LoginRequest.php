<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Database\Database;
use Connect4\Game;
use Connect4\Requests\Request;
use Exception;

class LoginRequest extends Endpoint
{

    public function handleRequest(Request $request)
    {



        try {

            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            if (empty($email)) {
                throw new Exception('Please enter a valid email.');
            }

            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            if (empty($password)) {
                throw new Exception('Please enter a valid password.');
            }



            $database = new Database();
            $result = $database->queryPrepared('CALL find_user_by_email_password(?, ?)', 'ss', $email, $password);

            if (mysqli_num_rows($result) === 0) throw new Exception('Account not found.');

            $user = mysqli_fetch_assoc($result);

            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['db_user'] = $user;
            setcookie('user_id', $user['user_id'], time() + (86400 * 30), "/");
            setcookie('db_user', base64_encode(json_encode($user)), time() + (86400 * 30), "/");


            if (isset($_SESSION['invited'])) {
                $invited = $_SESSION['invited'];
                if ($invited['setup_user_id'] != $user['user_id']) {
                    if (intval($invited['invited_user_id']) < 0) {

//                        $database->queryPrepared('CALL update_setup_game_invite_user_id(?, ?)', 'ii', $_SESSION['user_id'], intval($invited['game_setup_id']));

                        Game::confirmInviteCreateGame($invited);


                    }
                }
            } else {
                header("Location: /setup");
            }


        } catch (Exception $e) {
            $errorStr = base64_encode($e->getMessage());
            header("Location: /login?error=$errorStr");
        }








    }

    public function getRequestCode(): string
    {
        return 'login_request';
    }

    public function getRequestMethod(): string
    {
        return 'POST';
    }
}