<?php

define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', dirname(dirname(__DIR__)) . DS);

// Composer Autoload
require BASE_PATH . 'vendor' . DS . 'autoload.php';

// Load Envirinment Variables
$dotenv = Dotenv\Dotenv::create(BASE_PATH);
$dotenv->load();

// Database Connection
require BASE_PATH . 'config' . DS . 'database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

// Users table
Capsule::schema()->create(
    'users',
    function ($table) {
        $table->increments('id')->unsigned();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password');
        $table->integer('country_id');
        $table->boolean('active')->default(1);
        $table->timestamps();

        $table->index('name', 'email');
    }
);

// Countries table
Capsule::schema()->create(
    'countries',
    function ($table) {
        $table->increments('id')->unsigned();
        $table->string('name');
        $table->boolean('active')->default(1);
    }
);

echo "Migration finished successfully.\n";
