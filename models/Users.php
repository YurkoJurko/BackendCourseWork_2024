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

        $searchCriteria = $isEmail ? ['email' => $login] : ['login' => $login];
        $rows = self::findByCondition($searchCriteria);

        if (!empty($rows)) {
            $user = is_object($rows[0]) ? $rows[0] : (object) $rows[0];

            if (isset($user->password) && password_verify($password, $user->password)) {
                return $user;
            } else {
                return 'Не правильно введений пароль';
            }
        } else {
            return 'Користувача з такими даними не знайдено';
        }
    }

    public static function registerUser($username, $login, $email, $password, $profilePictureID = null)
    {
        $user = new Users();
        $user->username = $username;
        $user->login = $login;
        $user->email = $email;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->registrationDate = date('Y-m-d');
        if (!is_null($profilePictureID))
            $user->profilePictureID = $profilePictureID;
        else $username->profilePictureID = 1;

        $user->save();

        return $user;
    }

    public static function outputProfilePicture($user)
    {
        $output = '';

        if (is_null($user) || (is_object($user) && is_null($user->profilePictureID)) || (is_array($user) && !isset($user['profilePictureID']))) {
            $pictureID = 1;
        } else {
            $pictureID = is_object($user) ? $user->profilePictureID : $user['profilePictureID'];
        }

        $picture = \models\Pictures::findPictureByID($pictureID);

        if ($picture && isset($picture['picture']) && isset($picture['type'])) {
            $imageData = $picture['picture'];
            $base64Image = base64_encode($imageData);
            $imageMimeType = $picture['type'];

            $output .= "<img src='data:$imageMimeType;base64,$base64Image' alt='ProfilePicture'";
            return $output;
        }

        return $output;
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
