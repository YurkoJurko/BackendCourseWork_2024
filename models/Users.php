<?php

namespace models;

use core\Core;
use core\Model;
use Couchbase\User;

/**
 * @property  int $id ;
 * @property string $username ;
 * @property string $login ;
 * @property string $email ;
 * @property string $password ;
 * @property int $registrationDate ;
 * @property int $profilePictureID ;
 * @property int $role ;
 */
class Users extends Model
{
    public static $tableName = 'users';

    public static function loginVerification($login, $password)
    {
        $isEmail = filter_var($login, FILTER_VALIDATE_EMAIL);

        $searchCriteria = $isEmail ? ['email' => $login, 'password' => $password] : ['login' => $login, 'password' => $password];
        $rows = self::findByCondition($searchCriteria);

        if (!empty($rows)) {
            return $rows[0];
        } else {
            $searchCriteria = $isEmail ? ['email' => $login] : ['login' => $login];
            $rows = self::findByCondition($searchCriteria);
            return !empty($rows) ? 'Не правильно введений пароль' : 'Користувача з такими даними не знайдено';
        }
    }

    public static function registerUser($username, $login, $email, $password, $profilePictureID = null)
    {
        $user = new Users();
        $user->username = $username;
        $user->login = $login;
        $user->email = $email;
        $user->password = $username;
        $user->registrationDate = date('Y-m-d');
        if (!is_null($profilePictureID))
            $user->profilePictureID = $profilePictureID;
        else $username->profilePictureID = 1;

        $user->save();
    }

    public static function isUserLogged()
    {
        return !empty(Core::get()->session->get('user'));
    }

    public static function loginUser($user)
    {
        Core::get()->session->set('user', $user);
    }

    public static function logoutUser()
    {
        Core::get()->session->remove('user');
    }
}
