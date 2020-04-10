<?php

namespace Connect4\Requests;


use Exception;

class Request
{

    private $requestCode;

    public function __construct($requestCode)
    {
        $this->requestCode = $requestCode;
    }

    public function isRequestPost() : bool
    {
        return $this->isRequestOfType("POST");
    }

    public function isRequestGet() : bool
    {
        return $this->isRequestOfType("GET");
    }

    public function isRequestPut() : bool
    {
        return $this->isRequestOfType("PUT");
    }

    public function isRequestDelete() : bool
    {
        return $this->isRequestOfType("DELETE");
    }

    public function isRequestPatch() : bool
    {
        return $this->isRequestOfType("PATCH");
    }

    public function isRequestOfType(string $requestMethod)
    {
        return strtolower($_SERVER['REQUEST_METHOD']) === strtolower($requestMethod);
    }

    public function getUrlParts() : UrlParts
    {
        return new UrlParts($_SERVER['REQUEST_URI']);
    }

    public function getRequestCode()
    {
        return $this->requestCode;
    }




}