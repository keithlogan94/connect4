<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Requests\Request;

abstract class Endpoint
{


    abstract public function handleRequest(Request $request);

    abstract public function getRequestCode() : string;

    abstract  public function getRequestMethod() : string;




}