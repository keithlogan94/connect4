<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Database\Database;
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

            $user = mysqli_fetch_assoc($result);

            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['db_user'] = $user;


            header("Location: /setup");


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