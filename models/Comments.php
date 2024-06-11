<?php

namespace models;

use core\Core;
use core\Model;

/**
 * @property  int $id;
 * @property  int $userID;
 * @property  string $text;
 * @property  string date;
 * @property  int $newsId;
 */

class Comments extends Model
{
    public static $tableName = 'comments';
    public static function saveComment($commentData)
    {
        var_dump($commentData);
        $db = Core::get()->db;
        return $db->insert(self::$tableName, $commentData);
    }


    public static function getCommentHtml($comment)
    {
        $userID = htmlspecialchars($comment['userId']);
        $text = nl2br(htmlspecialchars($comment['text']));
        $date = htmlspecialchars($comment['date']);

        $user = Users::findByID($userID);
        $username = htmlspecialchars($user['username']);

        $html = "
        <div class='comment mb-3'>
            <div class='d-flex align-items-center'>
                <div class='profile-picture me-2'>
                    <a href='/users/view/$userID'>" . \models\Users::outputProfilePicture($user) . " class='additional-class rounded-circle' style='width: 50px; height: 50px;'" . "</a>
                </div>
                <div>
                    <a href='/users/view/$userID'><strong>$username</strong></a>
                    <p class='text-muted'><small>Posted on $date</small></p>
                </div>
            </div>
            <p>$text</p>
        </div>";

        return $html;
    }
}