<?php

namespace Crud\Mvc\core;

use Crud\Mvc\core\traits\DatabaseConnect;

class AbstractModel
{
    use DatabaseConnect;

    protected object $database;

    public function __construct()
    {
        $this->database = $this->connect();
    }
}