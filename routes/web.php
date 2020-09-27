<?php

$router = $app['router'];

$router->get('/', function() {
    return \Response::view('home');
});

// Users route
$router->get(
    'users',
    'App\Controllers\UsersController@index'
);

// 404
$router->fallback(function() {
    return \Response::view('404');
});