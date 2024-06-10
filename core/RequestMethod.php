<?php

namespace core;

class RequestMethod
{
    public $array;

    public function __construct($array)
    {
        $this->array = $array;
    }

    public function __get($key)
    {
        if (isset($this->array[$key])) {
            return $this->array[$key];
        } else {
            return null;
        }
    }

    public function getAll()
    {
        return $this->array;
    }
}