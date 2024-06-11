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
        if (count($parts) == 1) {
            $parts[1] = 'Index';
        }

        \core\Core::get()->moduleName = $parts[0];
        \core\Core::get()->actionName = $parts[1];
            if (isset($parts[2])) {
                if ($parts[2] === 'DESC' || $parts[2] == 'ASC' || $parts[0] === 'users' || ($parts[0] === 'news' && ($parts[1] === 'view' || $parts[1] === 'submit' || $parts[1] === 'edit')))
                    \core\Core::get()->additionalParam = $parts[2];
                else \core\Core::get()->additionalParam = 'DESC';
            }
            if (isset($parts[3])) {
                \core\Core::get()->paginationParam = $parts[3];
            }
        $controller = 'controllers\\' . ucfirst($parts[0]) . 'Controller';
        $method = 'action' . ucfirst($parts[1]);

        if (class_exists($controller)) {
            $controllerObject = new $controller();
            Core::get()->controllerObject = $controllerObject;
            if (method_exists($controller, $method)) {
                array_splice($parts, 0, 2);
                return $controllerObject->$method($parts);
            } else {
                $this->redirectToErrorPage();
            }
        } else {
            $this->redirectToErrorPage();
        }
    }

    protected function redirectToErrorPage()
    {
        http_response_code(404);
        include 'views/layouts/error.php';
        exit;
    }
}
