<?php

namespace Crud\Mvc\app\controllers;

use Crud\Mvc\core\AbstractController;
use Crud\Mvc\core\http\response\ResponseInterface;

class AppController extends AbstractController
{
    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
    }


    public function index(): ResponseInterface
    {
        $result = ['template' => 'home_templates/home.html.twig', 'data' => null];
        $this->response->setBody($result);
        return $this->response;
    }
}