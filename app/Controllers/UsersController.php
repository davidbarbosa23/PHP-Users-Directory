<?php

namespace App\Controllers;

use App\Models\Users;

class UsersController extends AppController
{
    public function index()
    {
        return view('users', $params);
    }
}
