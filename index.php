<?php

spl_autoload_register(static function ($className) {
    $path = str_replace('\\', '/', __DIR__ . "/" . $className . '.php');
    if (is_file($path)) {
        include_once($path);
    }

});

$route = isset($_GET['route']) ? $_GET['route'] : '';


$db = new \core\Database();
/*
echo \core\Config::get()->dbName;
$core = \core\Core::get();
$core->run($route);
$core->finish();
*/