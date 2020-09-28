<?php

namespace App\Controllers;

use Illuminate\Routing\Controller as BaseController;

class AppController extends BaseController
{
    protected $session = null;

    public function __construct()
    {
        $this->session = new \Session;
        if ($this->session->check()) {
            if (in_array($_SERVER['REQUEST_URI'], URI_REDIRECT)) {
                \Response::redirect('/search');
            }
        } elseif (!in_array($_SERVER['REQUEST_URI'], URI_REDIRECT)) {
            \Response::redirect('/login');
        }
    }
}
