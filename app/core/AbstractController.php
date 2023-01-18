<?php

namespace Crud\Mvc\core;

use Crud\Mvc\core\http\request\RequestInterface;
use Crud\Mvc\core\http\response\ResponseInterface;

class AbstractController
{
    protected RequestInterface $request;
    protected ResponseInterface $response;

    protected object $database;


    public function __construct(RequestInterface $request, ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
}