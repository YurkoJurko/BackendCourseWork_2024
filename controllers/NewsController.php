<?php

namespace controllers;

use core\Controller;
use core\Core;
use core\Template;
use modules\News;

class NewsController extends Controller
{
    public function actionAdd()
    {
        $db = Core::get()->db;

        $news = new News();

//        $db->insert('news', [
//            'title' => 'TestTitle1',
//            'text' => 'TestText1',
//           'shortText' => 'TestShortText',
//           'date' => date('Y-m-d H:i:s'),
//            'likes' => 0,
//            'isVisible' => 0
//        ]);
//
//        $db->update('news', [
//            'Title' => 'SuccessfulUpdate'
//        ], [
//            'id' => 1
//        ]);

        return $this->render();
    }

    public function actionIndex()
    {
        $db = Core::get()->db;
        $rows = $db->select('news');
        var_dump($rows);
        return $this->render();
    }

    public function actionView($params)
    {
        return $this->render();
    }

//    public function actionDelete()
//    {
//        $db = Core::get()->db;
//        $db->delete('news', [
//           'id' => 3
//        ]);
//    }
//
//    public function actionUpdate()
//    {
//        $db = Core::get()->db;
//        $db->update('news', [
//            'Title' => 'SuccessfulUpdate'
//        ], [
//           'id' => 4
//        ]);
//    }
}