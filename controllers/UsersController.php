<?php

namespace controllers;

use core\Controller;
use core\Core;
use http\Client\Curl\User;
use models\Users;

class UsersController extends Controller
{
    public function actionLogin()
    {
        if ($this->isPost) {
            $user = Users::loginVerification($this->post->login, $this->post->password);

            if (!is_string($user)) {
                Users::loginUser($user);
                $this->redirect('/');
                die;
            } else {
               $this->template->setParam('errorMessage', $user);
               return $this->render();
            }
        }
        return $this->render();
    }


    public function actionLogout()
    {
        Users::logoutUser();
        $this->redirect('/users/login');
    }
}