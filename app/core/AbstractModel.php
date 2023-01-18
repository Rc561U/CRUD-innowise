<?php

namespace Crud\Mvc\core;

use Crud\Mvc\core\traits\DatabaseConnect;

class AbstractModel
{
    public object $database;

    public function __construct()
    {
        $connect = DatabaseConnect::getInstance();
        $this->database = $connect->connect();
    }


}