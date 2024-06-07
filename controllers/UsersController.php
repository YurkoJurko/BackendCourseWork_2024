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
        if (Users::isUserLogged())
            return $this->redirect('/');
        if ($this->isPost) {
            $user = Users::loginVerification($this->post->login, $this->post->password);

            if (!is_string($user)) {
                Users::loginUser($user);
                $this->redirect('/');
                die;
            } else {
                $this->addErrorMessage($user);
                return $this->render();
            }
        }
        return $this->render();
    }

    public function actionRegister()
    {
        if (Users::isUserLogged())
            return $this->redirect('/');
        if ($this->isPost) {
            $login = $this->post->login;
            $user = Users::findByCondition(["login" => $login]);

            if (!empty($user))
                $this->addErrorMessage('Користувач з таким логіном вже існує');

            $email = $this->post->email;
            $domain = substr($email, strpos($email, '@') + 1);
            if (!(strpos($domain, 'student.ztu.edu.ua') !== false || strpos($domain, 'ztu.edu.ua') !== false)) {
                $this->addErrorMessage('Допустимі лише адреси домену ztu.edu.ua.');
            }
            $user = Users::findByCondition(['email' => $email]);
            if (!empty($user))
                $this->addErrorMessage('Користувач з такою поштою вже існує');

            if ($this->post->password1 !== $this->post->password2)
                $this->addErrorMessage('Паролі не співпадають');
            if (!$this->areErrorMMessagesExist()) {
//                if (!isset($this- >post->profilePictureID))
//                    $this->post->profilePictureID = 1;
                Users::registerUser($this->post->username, $this->post->login, $this->post->email, $this->post->password, 1);
            }
        }
        return $this->render();
    }

    public function actionLogout()
    {
        Users::logoutUser();
        $this->redirect('/users/login');
    }

    public function actionIndex()
    {
        return $this->redirect("/users/login");
    }
}