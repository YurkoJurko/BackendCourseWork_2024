<?php

namespace core;

use function MongoDB\BSON\toJSON;

class Controller
{
    protected $template;
    protected $errorMessages;
    public $isPost = false;
    public $isGet = false;
    public $post;
    public $get;

    public function __construct()
    {
        $module = Core::get()->moduleName;
        $action = Core::get()->actionName;
        $path = "views/{$module}/{$action}.php";
        $this->template = new Template($path);

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $this->isPost = true;
                break;
            case 'GET':
                $this->isGet = true;
                break;
        }
        $this->post = new Post();
        $this->get = new Get();
        $this->errorMessages = [];
    }

    public function render($pathToView = null)
    {
        if (!empty($pathToView))
            $this->template->setTemplatePath($pathToView);
        return [
            'Content' => $this->template->getHTML()
        ];
    }

    public function redirect($path)
    {
        header("Location: {$path}");
        die;
    }

    public function addErrorMessage($message)
    {
        $this->errorMessages[] = $message;
        $this->template->setParam('errorMessage', implode('<br/>', $this->errorMessages));
    }

    public function clearErrorMessages()
    {
        $this->errorMessages = [];
        $this->template->setParam('errorMessage', null);
    }

    public function areErrorMMessagesExist()
    {
        return count($this->errorMessages) > 0;
    }

}