<?php


namespace Connect4\Database;


use Exception;
use mysqli_result;

class Database
{

    private $connection;

    public function __construct()
    {

        $connection = mysqli_connect('db','root','83Qn9]=32r.]X<Gt', 'connect4');

        if (!$connection) throw new Exception('Failed to connect to database: ' .
            mysqli_connect_error());


        $this->connection = $connection;



    }



    public function queryPrepared($sql, $paramTypes, ...$params)
    {
        $connection = $this->connection;

        //check if there are any results that should be cleaned up
        if (mysqli_more_results($connection)) {
            while ($result = mysqli_next_result($connection)) {
                if ($result instanceof mysqli_result) mysqli_free_result($result);
                if (!mysqli_more_results($connection)) break;
            }
        }


        if (mysqli_error($connection)) throw new Exception(mysqli_error($connection));

        $stmt = mysqli_stmt_init($connection);

        if (!$stmt) throw new Exception('$stmt was not null');

        if (mysqli_stmt_error($stmt)) throw new Exception(mysqli_stmt_error($stmt));

        mysqli_stmt_prepare($stmt, $sql);
        @mysqli_stmt_bind_param($stmt, $paramTypes, ...$params);
        mysqli_stmt_execute($stmt);


        if (mysqli_stmt_error($stmt)) throw new Exception(mysqli_stmt_error($stmt));


        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        return $result;

    }



}