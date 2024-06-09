<?php

namespace core;

use core\RequestMethod;

class Files extends RequestMethod
{
    public function __construct()
    {
        parent::__construct($_FILES);
    }
}