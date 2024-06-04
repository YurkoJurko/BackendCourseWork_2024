<?php

spl_autoload_register(static function ($className) {
    $path = str_replace('\\', '/', __DIR__ . "/" . $className . '.php');
    if (is_file($path)) {
        include_once($path);
    }

});

$route = isset($_GET['route']) ? $_GET['route'] : '';

$router = new core\Router($route);
$router->run();
$router->finish();