<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Comments;
use models\News;
use models\Pictures;
use models\Users;
use mysql_xdevapi\Exception;

class NewsController extends Controller
{
    public function actionAdd()
    {
        if (\core\Core::get()->session->get('user')->role !== "admin" && \core\Core::get()->session->get('user')->role !== "moderator") {
            \core\Core::get()->controllerObject->redirect('/layouts/error');
        } else {
            $db = Core::get()->db;
            if ($this->isPost) {
                $user = Core::get()->session->get('user');
                $post = $this->post;

                $newsData = [
                    'title' => $post->title,
                    'text' => $post->text,
                    'shortText' => $post->shortText,
                    'date' => date('Y-m-d H:i:s'),
                    'isVisible' => 0,
                    'postedBy' => $user->id,
                ];
                $newsId = $db->insert('news', $newsData);
                $filesArray = $this->files->pictures;

                if (!empty($filesArray)) {
                    $files = Pictures::separateFiles($filesArray);
                    Pictures::saveMultiplePictures($files, $newsId);
                }
                $this->redirect("/news/view/{$newsId}");
            } else {
                return $this->render();
            }
        }
    }

    public function actionModerationList()
    {
        if (\core\Core::get()->session->get('user')->role === 'moderator' || \core\Core::get()->session->get('user')->role === 'admin') {

            return $this->render();
        } else return $this->redirect('/layouts/error');
    }

    public function actionEdit()
    {
        if (\core\Core::get()->session->get('user')->role === 'moderator' || \core\Core::get()->session->get('user')->role === 'admin') {
            if ($this->isPost) {
                $post = $this->post;

                $newsId = \core\Core::get()->additionalParam;

                $fields = [
                    'title' => $post->title,
                    'text' => $post->text,
                    'shortText' => $post->shortText
                ];
                \models\News::updateNewsFields($newsId, $fields);
                Pictures::deleteByCondition(['newsId' => $newsId]);
                $filesArray = $this->files->pictures;

                if (!empty($filesArray)) {
                    $files = Pictures::separateFiles($filesArray);
                    Pictures::saveMultiplePictures($files, $newsId);
                }
                return $this->redirect("/news/view/{$newsId}");
            } else {
                return $this->render();
            }
        } else {
            return $this->redirect('/layouts/error');
        }
    }


    public function actionSubmit()
    {
        if (\core\Core::get()->session->get('user')->role === 'moderator')
            return $this->render();
        else $this->redirect('/layouts/error');
    }

    public function actionIndex()
    {
        return $this->redirect('/layouts/error');
    }

    public function actionView()
    {
        $news = News::findByID(Core::get()->additionalParam);
        if (!is_null($news) && ($news['isVisible'] == 1 || ($news['isVisible'] == 0 && (Core::get()->session->get('user')->role === 'moderator' || Core::get()->session->get('user')->role === 'admin')))) {
            if ($this->isPost) {
                $db = Core::get()->db;
                $commentText = $this->post->commentText;
                $userID = \core\Core::get()->session->get('user')->id;

                $commentData = [
                    'userID' => $userID,
                    'text' => $commentText,
                    'date' => date('Y-m-d H:i:s'),
                    'newsId' => Core::get()->additionalParam
                ];
                $db->insert('comments', $commentData);
                return $this->render();
            } else return $this->render();
        } else return $this->redirect('/layouts/error');
    }

    public function actionDelete()
    {
        if (\core\Core::get()->session->get('user')->role === 'moderator' || \core\Core::get()->session->get('user')->role === 'admin') {
            return $this->render();
        } else return $this->redirect('/layouts/error');
    }

    public function actionDeleteComment()
    {
        $commentID = Core::get()->additionalParam;
        $comment = Comments::findByID($commentID);
        $currentUserID = \core\Core::get()->session->get('user')->id;
        $currentUserRole = \core\Core::get()->session->get('user')->role;
        if (!is_null($comment) && ($comment['userID'] === $currentUserID || $currentUserRole === 'moderator' || $currentUserRole === 'admin')) {
            return $this->render();
        } else {
            return $this->redirect('/layouts/error');
        }
    }

}