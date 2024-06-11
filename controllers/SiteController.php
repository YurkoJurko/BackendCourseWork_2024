<?php

namespace controllers;

use core\Controller;
use core\Model;
use core\Template;
use models\Users;

class SiteController extends Controller
{
    public function actionIndex()
    {
        return $this->render();
    }

    public function actionSearch()
    {
        return $this->render();
    }

    public function actionPromotePage()
    {
        if (\core\Core::get()->session->get('user')->role === 'moderator' || \core\Core::get()->session->get('user')->role === 'admin') {
            return $this->render();
        } else return $this->redirect('/layouts/error');
    }
}