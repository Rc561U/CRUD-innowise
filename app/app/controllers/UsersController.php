<?php

namespace Crud\Mvc\app\controllers;

use Crud\Mvc\core\AbstractController;
use Crud\Mvc\core\http\response\ResponseInterface;

class UsersController extends AbstractController
{

    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
    }

    public function new(): ResponseInterface
    {
        $path = "app/views/new.php";
        $this->response->setBody($path);
        return $this->response;
    }

    public function create(): ResponseInterface
    {
        $path = "app/views/new.php";
        $this->response->setBody($path);
        return $this->response;
    }

}