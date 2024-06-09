<?php

namespace core;

class Core
{
    public $defaultLayoutPath = 'views/layouts/index.php';
    public $moduleName;
    public $actionName;
    public $router;
    public $template;
    public $db;
    public $additionalParam;
    public Controller $controllerObject;
    private static $instance;
    public $session;

    private function __construct()
    {
        $this->template = new Template($this->defaultLayoutPath);

        $login = Config::get()->dbAdminLogin;
        $password = Config::get()->dbAdminPassword;
        $this->db = new Database($login, $password);
        $this->session = new Session();

        session_start();
    }

    public function run($route)
    {
        $this->router = new \core\Router($route);
        $params = $this->router->run();
        if (!empty($params)) {
            $this->template->setParams($params);
        }
    }

    public function finish()
    {
        $this->template->display();
    }

    public static function get()
    {
        if (empty(self::$instance))
            self::$instance = new Core();

        return self::$instance;
    }
}