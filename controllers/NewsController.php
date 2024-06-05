<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\News;

class NewsController extends Controller
{
    public function actionAdd()
    {
        $db = Core::get()->db;
       // News::deleteByCondition(['date' => '2024-06-05 13:43:23']);
       // var_dump(News::findByCondition(['text' => 'TestText1']));
        return $this->render();
    }

    public function actionIndex()
    {
        //Core::get()->session->set();
        return $this->render('views/news/view.php');
    }

    public function actionView($params)
    {
        return $this->render();
    }
}