<?php

namespace Crud\Mvc\app\controllers;

use Crud\Mvc\core\AbstractController;

class NotFoundController extends AbstractController
{
    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
    }

    public function index()
    {
        $result['template'] = "app/views/errors/404.php";
        $this->response->setBody($result);
        $this->response->setCode(404);
        return $this->response;
    }
}
