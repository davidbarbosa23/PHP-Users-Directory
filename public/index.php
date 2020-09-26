<?php

// APP Contstant
define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', __DIR__ . DS . '..' . DS);
define('APP_PATH', BASE_PATH . 'app');
define('CACHE_PATH', BASE_PATH . 'tmp' . DS . 'cache');
define('VIEWS_PATH', APP_PATH . DS . 'Views');
define('URI_REDIRECT', ['/login', '/register']);

require BASE_PATH . 'vendor/autoload.php';

// Load Envirinment Variables
$dotenv = Dotenv\Dotenv::create(BASE_PATH);
$dotenv->load();

// APP Container
$app = new Illuminate\Container\Container();
$app->bind('app', $app);

// Database Connection
require BASE_PATH . 'config' . DS . 'database.php';