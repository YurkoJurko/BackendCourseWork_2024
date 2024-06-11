<?php

namespace models;

use core\Core;
use core\Model;
use http\Exception;

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

    public static function getCommentHtmlByNewsId($newsId)
    {
        $commentsArray = self::findByCondition(['newsId' => $newsId]);
        if (!is_null($commentsArray)) {
            $html = '';

            foreach ($commentsArray as $comment) {
                if (isset($comment['userID'], $comment['text'], $comment['date'])) {
                    $userID = $comment['userID'];
                    $text = $comment['text'];
                    $date = $comment['date'];
                    $commentID = $comment['id'];

                    $user = Users::findByID($userID);
                    if ($user) {
                        $username = $user['username'];

                        $deleteButton = '';
                        if (\core\Core::get()->session->get('user')->role === 'moderator' || \core\Core::get()->session->get('user')->role === 'admin') {
                            $deleteButton = "<a href='/news/deleteComment/$commentID' class='btn btn-danger btn-sm'>Видалити коментар</a>";
                        }

                        $html .= "
            <div class='comment mb-3'>
                <div class='d-flex align-items-center'>
                    <div class='profile-picture me-2'>
                        <a href='/users/view/$userID'>" . Users::outputProfilePicture($user) . " class='additional-class rounded-circle' style='width: 50px; height: 50px;'</a>
                    </div>
                    <div>
                        <a href='/users/view/$userID'><strong>$username</strong></a>
                        <p class='text-muted'><small>Posted on $date</small></p>
                    </div>
                </div>
                <p>$text</p>
                $deleteButton
            </div>";
                    }
                }
            }
            if (!empty($html)) {
                return $html;
            }
        }

        return "<p>Ще ніхто не залишив коментаря... Але ти можеш стати першим!</p>";
    }
}
