<?php

namespace Connect4\Requests;


use Exception;

class Request
{

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

    private function isRequestOfType(string $request)
    {
        return strtolower($_SERVER['REQUEST_METHOD']) === strtolower($request);
    }

    public function getUrlParts() : UrlParts
    {
        return new UrlParts($_SERVER['REQUEST_URI']);
    }




}