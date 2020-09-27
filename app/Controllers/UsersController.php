<?php

namespace App\Controllers;

use App\Models\Users;
use App\Models\Countries;

class UsersController extends AppController
{
    private $user = null;

    public function index()
    {
        $params = [];

        return view('users', $params);
    }

    public function register()
    {
        $countries = Countries::all();
        $params = [
            'countries' => $countries
        ];

        return view('register', $params);
    }

    public function registerProcess(\Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|unique|email',
            'country_id' => 'required',
            'password' => 'required|min:6|password',
            'password_confirm' => 'required|equals:password',
        ];
        $validateResult = validate($request, $rules);

        $countries = Countries::all();
        $params = [
            'countries' => $countries,
            'errors' => $validateResult,
            'data' => [
                'email' => $request->get('email'),
                'name' => $request->get('name'),
                'country_id' => $request->get('country_id')
            ]
        ];

        if (count($validateResult) == 0) {
            $user = new Users;
            if ($user->register($request)) {
                unset($params['errors']);
                unset($params['data']);
                $params['success'] = ['User registered successfully. <a href="/login" class="btn btn-primary">Login</a>'];
            } else {
                $params['errors'] = ['Error to register user.'];
            }
        }

        return view('register', $params);
    }

    public function login()
    {
        return view('login');
    }

    public function loginProcess(\Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];
        $validateResult = validate($request, $rules);

        if (count($validateResult) == 0) {
            $isValid = $this->validateCredentials($request);
            if ($isValid) {
                $this->session->start($this->user);
                return \Response::redirect('/users');
            }

            $validateResult = ['The email or password is invalid'];
        }
        $params = [
            'errors' => $validateResult,
            'data' => [
                'email' => $request->get('email')
            ]
        ];

        return view('login', $params);
    }

    public function logout()
    {
        $this->session->end();
        \Response::redirect('/');
    }

    private function validateCredentials($request)
    {
        $this->user = Users::whereEmail($request->get('email'))->first();
        if ($this->user) {
            if (password_verify($request->get('password'), $this->user->password)) {
                return true;
            }
        }

        return false;
    }
}
