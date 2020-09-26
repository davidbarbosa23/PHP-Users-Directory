<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Database\Capsule\Manager as Capsule;

class TestBase extends TestCase
{
    public function setUp()
    {
        defined('DS') || define('DS', DIRECTORY_SEPARATOR);
        defined('BASE_PATH') || define('BASE_PATH', __DIR__ . DS . '..' . DS . '..' . DS);
        defined('APP_PATH') || define('APP_PATH', BASE_PATH . 'app');
        defined('CACHE_PATH') || define('CACHE_PATH', BASE_PATH . 'tmp' . DS . 'cache');
        defined('VIEWS_PATH') || define('VIEWS_PATH', APP_PATH . DS . 'Views');
        defined('URI_REDIRECT') || define('URI_REDIRECT', ['/login', '/register']);
    }

}