<?php

// APP Contstant
define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', dirname(__DIR__) . DS);
define('APP_PATH', BASE_PATH . 'app');
define('CACHE_PATH', BASE_PATH . 'tmp' . DS . 'cache');
define('VIEWS_PATH', APP_PATH . DS . 'Views');
define('URI_REDIRECT', ['/login', '/register']);

require BASE_PATH . 'vendor/autoload.php';

// Load Envirinment Variables
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

// App Container
$app = new Illuminate\Container\Container;
$app->instance('app', $app);

// Database Connection
require BASE_PATH . 'config' . DS . 'database.php';

// Register Providers
with(new Illuminate\Events\EventServiceProvider($app))->register();
with(new Illuminate\Routing\RoutingServiceProvider($app))->register();

// Routes file
require BASE_PATH . 'routes' . DS . 'web.php';

$request = Illuminate\Http\Request::capture();
$response = $app['router']->dispatch($request);
$response->send();