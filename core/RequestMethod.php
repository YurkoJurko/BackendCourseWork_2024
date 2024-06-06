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
        return $this->array[$key];
    }

    public function getAll()
    {
        return $this->array;
    }
}