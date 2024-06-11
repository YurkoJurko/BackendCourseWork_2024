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
 * @property int $isVisible ;
 * @property int $postedBy ;
 */
class News extends Model
{
    public static $tableName = 'news';

    public static function getAllNews($limit, $offset, $includeButtons, $where = null, $orderBy = null, $orderDirection = null)
    {
        $db = Core::get()->db;
        $news = $db->select(static::$tableName, "*", $where, $limit, $offset, $orderBy, $orderDirection);

        $html = '';
        foreach ($news as $item) {
            $html .= "<div class='card mb-3 p-3'>";
            $html .= "<a href='/news/view/{$item['id']}' class='news-link'>";
            $html .= "<div class='card-body'>";
            $html .= "<h2 class='card-title'>{$item['title']}</h2>";
            $html .= "<p class='card-text'>{$item['shortText']}</p>";
            $html .= "<p class='card-text'><small class='text-muted'>{$item['date']}</small></p>";
            $html .= "</div>";
            $html .= "</a>";

            if ($includeButtons) {
                $html .= "<div class='buttons-container'>";
                $html .= "<a href='/news/edit/{$item['id']}' ><button type='button' class='btn btn-primary edit-button m-1'>Змінити</button></a>";
                $html .= "<a href='/news/submit/{$item['id']}' ><button type='button' class='btn btn-success submit-button m-1'>Узгодити</button></a>";
                $html .= "</div>";
            }
            $html .= "</div>";
        }

        return $html;
    }

    public static function generatePagination($currentPage, $totalPages, $href)
    {
        $pagination = '';
        for ($i = 1; $i <= $totalPages; $i++) {
            $activeClass = ($currentPage == $i) ? 'active' : '';
            $pagination .= "<li class='page-item {$activeClass}'><a class='page-link' href='/$href{$i}'>{$i}</a></li>";
        }
        return $pagination;
    }

    public static function updateNewsFields($id, $fields)
    {
        if (!is_array($fields) || empty($fields)) {
            throw new \Exception("Fields parameter must be a non-empty associative array.");
        }

        if (!isset($id) || empty($id)) {
            throw new \Exception("News ID is required.");
        }

        $db = Core::get()->db;
        $where = ['id' => $id];
        $result = $db->update(static::$tableName, $fields, $where);

        return $result;
    }
}