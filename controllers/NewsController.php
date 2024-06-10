<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\News;
use models\Pictures;
use models\Users;
use mysql_xdevapi\Exception;

class NewsController extends Controller
{
    public function actionAdd()
    {
        $db = Core::get()->db;
        if ($this->isPost) {
            $this->clearErrorMessages();
            $user = Core::get()->session->get('user');

            $title = $this->post->title;
            $text = $this->post->text;
            $shortText = $this->post->shortText ?? '';
            $date = date('Y-m-d H:i:s');
            $likes = 0;
            $isVisible = 0;
            $postedBy = $user->id;

            $newsData = [
                'title' => $title,
                'text' => $text,
                'shortText' => $shortText,
                'date' => $date,
                'likes' => $likes,
                'isVisible' => $isVisible,
                'postedBy' => $postedBy,
            ];
            $newsId = $db->insert('news', $newsData);
            $filesArray = $this->files->pictures;

            if (!empty($filesArray)) {
                $files = Pictures::separateFiles($filesArray);
                Pictures::saveMultiplePictures($files, $newsId);
            }
            $this->redirect('/news/view/' . $newsId);
        } else {
            return $this->render();
        }
    }


    public function actionIndex()
    {
        //var_dump(Users::findByID(1));
        //Core::get()->session->set();
        return $this->render('views/news/view.php');
    }

    public function actionView($params)
    {
        return $this->render();
    }




}