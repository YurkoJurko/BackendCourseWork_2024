<?php

namespace core;

use http\Params;

class Model
{
    protected $fieldsArray;
    protected $primaryKey = 'id';

    public function __construct()
    {
        $this->fieldsArray = [];
    }

    public function save()
    {
        $temp = $this->{$this->primaryKey};
        if (empty($temp)) {
            Core::get()->db->insert($this->table, $this->fieldsArray);
        } else {
            Core::get()->db->update($this->table, $this->fieldsArray, [$this->primaryKey => $this->{$this->primaryKey}]);
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