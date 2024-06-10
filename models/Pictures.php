<?php

namespace models;

use core\Core;
use core\Model;
use mysql_xdevapi\Exception;


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

    public static function savePicture($file, $newsId = null)
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('File upload error.');
        }

        if (!self::checkFile($file)) {
            throw new Exception('Invalid file type.');
        }

        $fileContent = file_get_contents($file['tmp_name']);

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        $type = self::determineTypeFromMimeType($mimeType);
        if ($type === null) {
            throw new Exception('Unsupported file type.');
        }

        $pictureData = [
            'picture' => $fileContent,
            'newsId' => $newsId,
            'type' => $type,
        ];

        $db = Core::get()->db;
        $pictureId = $db->insert('pictures', $pictureData);

        return $pictureId;
    }

    public static function saveMultiplePictures($files, $newsId = null)
    {
        foreach (array_slice($files, 0, -1) as $file) {
            var_dump($file);
            $pictureId = self::savePicture($file, $newsId);
        }
    }

    private static function checkFile($file)
    {
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        return in_array($mimeType, $allowedMimeTypes);
    }

    private static function determineTypeFromMimeType($mimeType)
    {
        $mimeTypeMap = [
            'image/jpeg' => 'jpeg',
            'image/png' => 'png',
            'image/gif' => 'gif',
        ];

        return $mimeTypeMap[$mimeType] ?? null;
    }

    public static function separateFiles($files)
    {
        $numFiles = count($files['name']);
        $separatedFiles = array();

        for ($i = 0; $i < $numFiles; $i++) {
            $file = array(
                'name' => $files['name'][$i],
                'full_path' => $files['full_path'][$i],
                'type' => $files['type'][$i],
                'tmp_name' => $files['tmp_name'][$i],
                'error' => $files['error'][$i],
                'size' => $files['size'][$i]
            );

            $separatedFiles[] = $file;
        }

        return $separatedFiles;
    }

}