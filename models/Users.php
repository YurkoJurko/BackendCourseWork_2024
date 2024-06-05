<?php

namespace models;

use core\Model;

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
}