<?php

namespace Crud\Mvc\core\traits;

trait Singleton
{
    private static object $instance;

    public function __construct()
    {
    }

    static public function getInstance(): object
    {
        return static::$instance ?? (static::$instance = new static());
    }

    public function __wakeup()
    {
    }

    private function __clone()
    {
    }
}