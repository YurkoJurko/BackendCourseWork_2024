<?php

namespace controllers;

use core\Controller;
use core\Model;
use core\Template;
use models\Users;

class SiteController extends Controller
{
    public function actionAdd()
    {
        return [
            'Content' => $this->template->getHTML(),
            'Title' => 'Додавання новини'
        ];
    }

    public function actionIndex()
    {
        return $this->render();
    }

    public function actionView($params)
    {
        return [
            'Content' => '<a href="#">test</a>',
            'Title' => 'Перегляд новин'
        ];
    }
}