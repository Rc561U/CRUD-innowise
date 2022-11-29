<?php

namespace Crud\Mvc\core;

use Crud\Mvc\core\traits\DatabaseConnect;

class AbstractModel
{
    protected object $database;

    public function __construct()
    {
        $connect = DatabaseConnect::getInstance();
        $this->database = $connect->connect();
    }
}