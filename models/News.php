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


    public static function getAllNews($limit, $offset, $where = null)
    {
        $db = Core::get()->db;
        $news = $db->select(static::$tableName, "*", $where, $limit, $offset);

        $html = '';
        foreach ($news as $item) {
            $html .= "<div class='card mb-3'>";
            $html .= "<div class='card-body'>";
            $html .= "<h2 class='card-title'>{$item['title']}</h2>";
            $html .= "<p class='card-text'>{$item['shortText']}</p>";
            $html .= "<p class='card-text'><small class='text-muted'>{$item['date']}</small></p>";
            $html .= "</div>";
            $html .= "</div>";
        }


        return $html;
    }

    public static function getUnapprovedNews()
    {
        $db = Core::get()->db;
        return $db->select(static::$tableName, "*", ["isVisible" => 0]);
    }
    public static function countAllNews()
    {
        $db = Core::get()->db;
        return $db->count(static::$tableName);
    }
}