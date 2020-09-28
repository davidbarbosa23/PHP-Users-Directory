<?php

define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', dirname(dirname(__DIR__)) . DS);

// Composer Autoload
require BASE_PATH . 'vendor' . DS . 'autoload.php';

// Load Envirinment Variables
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

// Database Connection
require BASE_PATH . 'config' . DS . 'database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

// Users table
try {
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
    echo "Users table successfully migrated.\n\n";
} catch (\Throwable $th) {
    echo $th->getMessage() . "\n\n";
}

// Countries table
try {
    Capsule::schema()->create(
        'countries',
        function ($table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->boolean('active')->default(1);
        }
    );
    echo "Countries table successfully migrated.\n\n";
} catch (\Throwable $th) {
    echo $th->getMessage() . "\n\n";
}

// Customers table
try {
    Capsule::schema()->create(
        'customers',
        function ($table) {
            $table->increments('id')->unsigned();
            $table->string('job_title');
            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('document');
            $table->string('phone_number');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->date('birthday')->nullable();
            $table->string('lang')->nullable();
    
            $table->timestamps();
        }
    );
    echo "Customers table successfully migrated.\n\n";
} catch (\Throwable $th) {
    echo $th->getMessage() . "\n\n";
}

echo "Migration finished.\n";
