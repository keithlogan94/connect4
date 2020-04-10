<?php


namespace Connect4\Requests;


class UrlParts
{

    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function getUriParts()
    {
        $url = $this->url;
        if ($url[0] === '/') $url = substr($url, 1);
        if (strpos($url, '?') !== FALSE) {
            $removeStr = substr($url, strpos($url, '?'));
            $url = str_replace($removeStr, '', $url);
        }

        if (empty($url)) return false;

        return explode('/', trim($url));
    }







}