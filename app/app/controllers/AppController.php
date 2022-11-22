<?php

namespace Crud\Mvc\app\controllers;

use Crud\Mvc\core\AbstractController;

class AppController extends AbstractController
{
    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
    }

    public function index()
    {
        $path = 'app/views/home.php';
        $this->response->setBody($path);
        return $this->response;
    }
}