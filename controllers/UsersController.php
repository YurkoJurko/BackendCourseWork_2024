<?php

namespace controllers;

use core\Controller;
use core\Core;
use http\Client\Curl\User;
use models\Pictures;
use models\Users;
use mysql_xdevapi\Exception;

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
        if (Users::isUserLogged()) {
            return $this->redirect('/');
        }

        if ($this->isPost) {
            $login = $this->post->login;
            $user = Users::findByCondition(["login" => $login]);

            if (!empty($user))
                $this->addErrorMessage('Користувач з таким логіном вже існує');

            $email = $this->post->email;
            $domain = substr($email, strpos($email, '@') + 1);
            if (!(strpos($domain, 'student.ztu.edu.ua') !== false || strpos($domain, 'ztu.edu.ua') !== false))
                $this->addErrorMessage('Допустимі лише адреси домену ztu.edu.ua.');

            $user = Users::findByCondition(['email' => $email]);
            if (!empty($user))
                $this->addErrorMessage('Користувач з такою поштою вже існує');

            if ($this->post->password1 !== $this->post->password2)
                $this->addErrorMessage('Паролі не співпадають');

            if (!$this->areErrorMMessagesExist()) {
                Users::registerUser($this->post->username, $this->post->login, $this->post->email, $this->post->password1);

                $user = Users::loginVerification($this->post->login, $this->post->password1);
                if (is_object($user)) {
                    Users::loginUser($user);
                    $this->redirect('/site/index');
                    die;
                } else {
                    $this->addErrorMessage('Автоматичний вхід не вдався');
                    $this->redirect('/users/login');
                    die;
                }
            }
        }

        return $this->render();
    }

    public function actionEdit()
    {
        if (Users::isUserLogged()) {
            if ($this->isPost) {
                if (isset($_POST['action'])) {
                    $this->clearErrorMessages();
                    $user = Core::get()->session->get('user');
                    $action = $_POST['action'];
                    if ($action === 'update_profile') {
                        $username = $this->post->username;
                        $login = $this->post->login;

                        $user->username = $username;
                        $user->login = $login;


                        if (!is_null($this->files->profilePicture && $this->files->profilePicture['error'] === UPLOAD_ERR_OK)) {
                            try {
                                $profilePictureID = Pictures::savePicture($this->files->profilePicture);
                                $user->profilePictureID = $profilePictureID;
                            } catch (Exception $e) {
                                $this->addErrorMessage("Не вдалося завантажити фото профілю: " . $e->getMessage());
                            }
                        }

                        Users::updateUser($user);
                        $this->redirect('/users/view');
                    } else {
                        $password = $user->password;

                        $currentPas = $this->post->currentPas;
                        $newPas1 = $this->post->newPas1;
                        $newPas2 = $this->post->newPas2;

                        if (!password_verify($currentPas, $password))
                            $this->addErrorMessage("Введено не вірний пароль");
                        if ($newPas1 !== $newPas2)
                            $this->addErrorMessage("Нові паролі не співпадають");

                        if (!$this->areErrorMMessagesExist()) {
                            $user->password = password_hash($newPas2, PASSWORD_DEFAULT);
                            Users::updateUser($user);
                            $this->redirect('/users/view');
                            die;
                        }

                        return $this->render();
                    }
                }
            } else {
                return $this->render();
            }
        } else {
            return $this->redirect('/users/login');
        }
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

    public function actionView()
    {
        if(is_null(Users::findByID(Core::get()->additionalParam))){
            $this->actionIndex();
        }
        return $this->render();
    }
}