<?php

require 'app/lib/Dev.php';
define('APP_ROOT_DIR', __DIR__);

//use app\core\Router;
//use app\lib\Db;

//autoload

spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class.".php");
    if(file_exists($path)){
        require $path;
    }
});

session_start();

$router = new app\core\Router();
//$router = new app\lib\DB();
$router->run();