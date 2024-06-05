<?php

namespace core;

class Session
{
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function setValues($assocArray)
    {
        foreach ($assocArray as $key => $value)
            $this->set($key, $value);
    }

    public function get($key)
    {
        return $_SESSION[$key];
    }
}