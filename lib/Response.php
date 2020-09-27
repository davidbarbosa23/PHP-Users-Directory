<?php

use Jenssegers\Blade\Blade;

class Response
{
    public static function view($view, $params = [])
    {
        $blade = new Blade(
            VIEWS_PATH,
            CACHE_PATH
        );

        return $blade->make($view, $params);
    }

    public static function json($data, $code = 200)
    {
        header_remove();
        http_response_code($code);
        header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
        header('Content-Type: application/json');

        $status = [
            200 => '200 OK',
            400 => '400 Bad Request',
            422 => 'Unprocessable Entity',
            500 => '500 Internal Server Error'
        ];

        header('Status: ' . $status[$code]);

        return json_encode($data);
    }

    public static function redirect($url)
    {
        if (env('APP_ENV') != 'testing') {
            header('Location: ' . $url);
            exit();
        } else {
            return $url;
        }
    }
}
