<?php

namespace controllers;

use core\Controller;

class UsersController extends Controller
{
    public function actionLogin()
    {
        if($this->isPost) {
            return $this->render();
        }
    }

    public function actionIndex()
    {
        return $this->render('views/users/view.php');
    }
}