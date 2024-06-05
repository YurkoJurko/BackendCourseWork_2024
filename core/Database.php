<?php

namespace core;

class Database
{
    public $PDO;

    public function __construct()
    {
       echo $host = Config::get()->dbHost;
        echo   $name = Config::get()->dbName;
        echo   $login = Config::get()->dbUserLogin;
        echo   $pass = Config::get()->dbUserPassword;
        $this->PDO = new \PDO("mysql:");
    }
}