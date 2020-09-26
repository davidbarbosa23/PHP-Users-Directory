<?php

use Illuminate\Http\Request as BaseRequest;

class Request extends BaseRequest
{
    public function __construct()
    {
        parent::__construct(
            $_GET,
            $_REQUEST,
            $_POST,
            $_COOKIE,
            [],
            $_SERVER
        );
    }
}