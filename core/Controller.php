<?php

namespace core;

class Controller
{
    protected $template;
    public $isPost = false;
    public $isGet = false;
    public function __construct()
    {
        $module = Core::get()->moduleName;
        $action = Core::get()->actionName;
        $path = "views/{$module}/{$action}.php";
        $this->template = new Template($path);

        switch ($_SERVER['REQUEST_METHOD']){
            case 'POST':
                $this->isPost = true;
                break;
            case 'GET':
                $this->isGet = true;
                break;
        }
    }
    public function render($pathToView = null)
    {
        if(!empty($pathToView))
            $this->template->setTemplatePath($pathToView);
        return[
            'Content' => $this->template->getHTML()
        ];
    }
}