<?php

$router = $app['router'];

$router->get('/', function () {
    return \Response::view('home');
});

// Login routes
$router->get(
    'login',
    'App\Controllers\UsersController@login'
);

$router->post(
    'login',
    'App\Controllers\UsersController@loginProcess'
);

// Logout route
$router->get(
    'logout',
    'App\Controllers\UsersController@logout'
);

// Register routes
$router->get(
    'register',
    'App\Controllers\UsersController@register'
);

$router->post(
    'register',
    'App\Controllers\UsersController@registerProcess'
);

// Users route
$router->get(
    'users',
    'App\Controllers\UsersController@index'
);

// 404
$router->fallback(function () {
    return \Response::view('404');
});
