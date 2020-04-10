<?php


namespace Connect4\Requests;


class UrlParts
{

    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    private function getUriParts()
    {
        $url = $this->url;
        if (strpos($url, '?') !== FALSE) {
            $removeStr = substr($url, strpos($url, '?'));
            $url = str_replace($removeStr, '', $url);
        }
        return explode('/', $url);
    }







}