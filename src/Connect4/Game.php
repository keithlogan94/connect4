<?php

namespace Connect4;


class Game
{



    public function start()
    {
        header("Content-Type: text/html");
        echo file_get_contents(dirname(__FILE__) . '/../html/game-screen.html');
    }


}