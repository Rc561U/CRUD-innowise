<?php

namespace Crud\Mvc\core\traits;

trait Singleton
{
    private static object $instance;

    public function __construct() {}
    public function __wakeup() {}
    private function __clone() {}


    static public function getInstance():object
    {
        return static::$instance ?? (static::$instance = new static());
    }
}