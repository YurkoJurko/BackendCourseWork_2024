<?php

namespace core;

class Template
{
    protected $templateFilePath;
    protected $paramsArray;

    public function __set($name, $value)
    {
        Core::get()->template->setParam($name, $value);
    }

    public function __construct($templateFilePath)
    {
        $this->templateFilePath = $templateFilePath;
        $this->paramsArray = [];
    }

    public function setTemplatePath($path)
    {
        $this->templateFilePath = $path;
    }

    public function setParam($key, $param)
    {
        $this->paramsArray[$key] = $param;
    }

    public function setParams($params)
    {
        foreach ($params as $key => $param) {
            $this->setParam($key, $param);
        }
    }

    public function getHTML()
    {
        ob_start();
        extract($this->paramsArray);
        include($this->templateFilePath);
        $str = ob_get_contents();
        ob_end_clean();
        return $str;
    }

    public function display()
    {
        echo $this->getHTML();
    }
}