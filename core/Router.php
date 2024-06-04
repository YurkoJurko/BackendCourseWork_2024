<?php

namespace core;

class Router
{
    protected $route;

    public function __construct($route)
    {
        $this->route = $route;
    }

    public function run()
    {
        $parts = explode('/', $this->route);
        if (strlen($parts[0]) == 0) {
            $parts[0] = 'Site';
            $parts[1] = 'Index';
        }
        if (count($parts) == 1)
            $parts[1] = 'Index';

        $controller = 'controllers\\' . ucfirst($parts[0]) . 'Controller';
        $method = 'action' . ucfirst($parts[1]);

        if (class_exists($controller)) {
            $controllerObject = new $controller();
            if (method_exists($controller, $method)) {
                $params = array_splice($parts, 0, 2);
                $controllerObject->$method($params);
            } else $this->error(404);
        } else $this->error(404);
    }

    public function error($code)
    {
        http_response_code($code);
        echo $code;
    }
}