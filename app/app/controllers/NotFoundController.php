<?php

namespace Crud\Mvc\app\controllers;

use Crud\Mvc\core\AbstractController;
use Crud\Mvc\core\http\response\ResponseInterface;

class NotFoundController extends AbstractController
{
    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
    }

    public function index():ResponseInterface
    {
        $result = ['template' => 'errors_templates/404.html.twig', "data" => null];
        $this->response->setBody($result);
        $this->response->setCode(404);
        return $this->response;
    }
}
