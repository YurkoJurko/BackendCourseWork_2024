<?php

namespace modules;

use core\Core;
use core\Model;

/**
 * @var int $id ;
 * @var string $title ;
 * @var string $text ;
 * @var string $shortText ;
 * @var string $date ;
 * @var int $likes ;
 * @var int $isVisible ;
 */
class News extends Model
{
    public $table = 'news';
}