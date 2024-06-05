<?php

namespace models;

use core\Core;
use core\Model;

/**
 * @property  int $id ;
 * @property string $title ;
 * @property string $text ;
 * @property string $shortText ;
 * @property string $date ;
 * @property int $likes ;
 * @property int $isVisible ;
 */
class News extends Model
{
    public static $tableName = 'news';
}