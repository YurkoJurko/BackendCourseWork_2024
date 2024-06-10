<?php

namespace core;

class Model
{
    protected $fieldsArray;
    protected static $primaryKey = 'id';
    protected static $tableName = '';

    public function __construct()
    {
        $this->fieldsArray = [];
    }

    public function save()
    {
        $temp = $this->{static::$primaryKey};
        if (!isset($this->{static::$primaryKey}) || empty($temp))
            Core::get()->db->insert(static::$tableName, $this->fieldsArray);
    }

    public static function deleteById($id)
    {
        Core::get()->db->delete(static::$tableName, [static::$primaryKey => $id]);
    }

    public static function deleteByCondition($conditionAssocArray)
    {
        Core::get()->db->delete(static::$tableName, $conditionAssocArray);
    }

    public static function findByID($id)
    {
        $arr = Core::get()->db->select(static::$tableName, '*', [static::$primaryKey => $id]);
        if (count($arr) > 0) {
            return $arr[0];
        } else {
            return null;
        }
    }

    public static function findByCondition($conditionAssocArray)
    {
        $arr = Core::get()->db->select(static::$tableName, '*', $conditionAssocArray);
        if (count($arr) > 0) {
            return $arr;
        } else {
            return null;
        }
    }

    public function __set($key, $value)
    {
        $this->fieldsArray[$key] = $value;
    }

    public function __get($key)
    {
        return $this->fieldsArray[$key];
    }
}
