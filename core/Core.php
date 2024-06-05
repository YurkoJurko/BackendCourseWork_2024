<?php

namespace core;

class Core
{
    public $defaultLayoutPath = 'views/layouts/index.php';
    public $moduleName;
    public $actionName;
    public $router;
    public $template;
    public $Title;
    private static $instance;

    private function __construct()
    {
        if ($handle = opendir('config')) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    echo "$entry\n";
                }
            }
        }
        $this->template = new Template($this->defaultLayoutPath);
    }

    public function run($route)
    {
        $this->router = new \core\Router($route);
        $params = $this->router->run();
        $this->template->setParams($params);
    }

    public function finish()
    {
        $this->template->display();
        $this->router->finish();
    }

    public static function get()
    {
        if (empty(self::$instance))
            self::$instance = new Core();

        return self::$instance;
    }
}