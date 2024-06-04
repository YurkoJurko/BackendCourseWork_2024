<?php

namespace core;

class Controller
{
    protected $template;
    public function __construct()
    {
        $module = Core::get()->moduleName;
        $action = Core::get()->actionName;
        $path = "views/{$module}/{$action}.php";
        $this->template = new Template($path);
    }
    public function render()
    {
        return[
            'Content' => $this->template->getHTML()
        ];
    }
}