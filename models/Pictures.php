<?php

namespace models;

use core\Core;
use core\Model;


/**
 * @property int $id
 * @property string $picture
 * @property int $newsId
 * @property int $type
 */
class Pictures extends Model
{
    public static $tableName = 'pictures';
    public static function findPictureByID($id)
    {
        return self::findByID($id);
    }
}