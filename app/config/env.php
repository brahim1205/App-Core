
<?php

use Dotenv\Dotenv;

$dotenv= Dotenv::createImmutable(dirname(__DIR__,2));
$dotenv->load();
define('DSN_MYSQL', $_ENV['DSN_MYSQL']);
define('DB_USER_MYSQL', $_ENV['DB_USER_MYSQL']);
define('DB_PASS_MYSQL', $_ENV['DB_PASS_MYSQL']);
define('BASE_DSN_MYSQL', $_ENV['BASE_DSN_MYSQL']);


define('DB_NAME', $_ENV['DB_NAME']);
define('DB_DRIVER', $_ENV['DB_DRIVER']);


define('DSN_POSTGRES', $_ENV['DSN_POSTGRES']);
define('DB_USER_POSTGRES', $_ENV['DB_USER_POSTGRES']);
define('DB_PASS_POSTGRES', $_ENV['DB_PASS_POSTGRES']);
define('BASE_DSN_POSTGRES',$_ENV['BASE_DSN_POSTGRES']);