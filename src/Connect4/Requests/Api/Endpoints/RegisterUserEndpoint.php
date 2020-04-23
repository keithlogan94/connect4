<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Database\Database;
use Connect4\Game;
use Connect4\Requests\Request;
use Exception;

class RegisterUserEndpoint extends Endpoint
{

    public function handleRequest(Request $request)
    {

        session_start();

        try {

            $_SESSION['email_input'] = $email = filter_input(INPUT_POST, 'email_input', FILTER_VALIDATE_EMAIL);
            if (empty($email)) {
                throw new Exception('Please enter an email.');
            }
            if (!$email) {
                throw new Exception('Your email is not valid.');
            }


            $_SESSION['first_name_input'] = $firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);

            if (empty($firstName)) {
                throw new Exception('Please enter a First Name.');
            }



            $_SESSION['last_name_input'] = $lastName = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);

            if (empty($lastName)) {
                throw new Exception('Please enter a Last Name.');
            }

            $_SESSION['favorite_color_input'] = $favoriteColor = filter_input(INPUT_POST, 'favorite_color', FILTER_SANITIZE_STRING);
            if ($favoriteColor !== 'red' && $favoriteColor !== 'yellow') {
                throw new Exception('Favorite color should be red or yellow');
            }

            $password = filter_input(INPUT_POST, 'password_input', FILTER_SANITIZE_STRING);
            if (empty($password)) {
                throw new Exception('Please enter a password.');
            }

            if (strlen($password) < 5) {
                throw new Exception('Your password length must be atleast 5 characters');
            }

            if (
                strpos($password, '!') === FALSE &&
                strpos($password, '#') === FALSE &&
                strpos($password, '@') === FALSE &&
                strpos($password, '$') === FALSE &&
                strpos($password, '%') === FALSE &&
                strpos($password, '^') === FALSE &&
                strpos($password, '&') === FALSE &&
                strpos($password, '*') === FALSE &&
                strpos($password, '(') === FALSE &&
                strpos($password, ')') === FALSE
            ) {
                throw new Exception('In your password you must have atleast 1 special character ! @ # $ % ^ & * ( ) ');
            }


            $confirmPassword = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);
            if (empty($confirmPassword)) {
                throw new Exception('Please enter a confirm password');
            }

            if ($confirmPassword !== $password) {
                throw new Exception('Your confirm password does not match your password.');
            }






            $database = new Database();
            $result = @$database->queryPrepared('CALL add_user(?, ?, ?, ?, ?)', 'sssss', $firstName, $lastName, $email, $password, $favoriteColor);

            $_SESSION['user_id'] = mysqli_fetch_assoc($result)['user_id'];
            $userId = mysqli_fetch_assoc($result)['user_id'];



            if (isset($_SESSION['invited'])) {
                $invited = $_SESSION['invited'];
                if ($invited['setup_user_id'] != $userId) {
                    if (intval($invited['invited_user_id']) < 0) {

//                        $database->queryPrepared('CALL update_setup_game_invite_user_id(?, ?)', 'ii', $_SESSION['user_id'], intval($invited['game_setup_id']));
                        Game::confirmInviteCreateGame($invited);


                    }
                }
            } else {
                header("Location: /setup");
            }

        } catch (Exception $exception) {

            $errorStr = base64_encode($exception->getMessage());
            header("Location: /signup?error=$errorStr");
        }

    }

    public function getRequestCode(): string
    {
        return 'register_user';
    }

    public function getRequestMethod(): string
    {
        return 'POST';
    }
}