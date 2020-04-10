<?php


namespace Connect4\Requests\Api\Endpoints;


use Connect4\Requests\Request;

abstract class Endpoint
{


    abstract public function shouldEndpointHandleRequest(Request $request) : bool;

    abstract public function handleRequest(Request $request);




}