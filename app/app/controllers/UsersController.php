<?php

namespace Crud\Mvc\app\controllers;

use Crud\Mvc\app\models\User;
use Crud\Mvc\core\AbstractController;
use Crud\Mvc\core\http\response\ResponseInterface;
use Crud\Mvc\core\traits\Pagination;

class UsersController extends AbstractController
{
    use Pagination;

    private static mixed $errors;
    private object $model;
    private int $start;
    public function __construct($request, $response)

    {
        parent::__construct($request, $response);
        $this->model = new User();
    }

    public function index(): ResponseInterface
    {
        $result['status'] = $_SESSION['status'] ?? null;
        unset($_SESSION['status']);
        $result['pagination'] = $this->getPage();

        $result['content'] = $this->model->get_users($this->start , $this->per_page);
        $result = ['template' => 'users_templates/index.html.twig', "data" => $result];

        $this->response->setBody($result);
        return $this->response;
    }

    private function getPage():string
    {
        $page = $this->request->getParams()['page'] ?? 1;
        $this->per_page = 10;
        $total = $this->model->get_count("users");
        $this->make($page, $this->per_page, $total);
        $this->start = $this->get_start();
        return $this->get_html();
    }

    public function new(): ResponseInterface //GET
    {
        $result = ['template' => 'users_templates/new.html.twig', "data" => null];
        $this->response->setBody($result);
        return $this->response;
    }

    public function create(): ResponseInterface //POST
    {
        self::$errors = $this->model->createUser($this->request);

        if (!self::$errors) {
            $this->response->setHeaders(['Location: /users']);
            $_SESSION['status'] = "create";
            $result = ['template' => 'users_templates/new.html.twig', "data" => null];

        } else {
            $result['errors'] = self::$errors;
            $result['content'] = $this->request->getPost();
            $result = ['template' => 'users_templates/new.html.twig', "data" => $result];
        }
        $this->response->setBody($result);
        return $this->response;

    }


    public function edit(int $id): ResponseInterface //GET
    {
        $result['content'] = $this->model->getUserById($id);
        $result = ['template' => 'users_templates/edit.html.twig', "data" => $result];
        $this->response->setBody($result);
        return $this->response;
    }


    public function show($id): ResponseInterface //GET
    {
        $result['content'] = $this->model->getUserById($id);
        $result = ['template' => 'users_templates/show.html.twig', "data" => $result];
        $this->response->setBody($result);
        return $this->response;
    }


    public function update(): ResponseInterface //PUT
    {
        self::$errors = $this->model->updateUserById($this->request);
        if (!self::$errors) {
            $this->response->setHeaders(['Location: /users']);
            $_SESSION['status'] = "update";
            $result['status'] = $_SESSION['status'];
            $result = ['template' => 'users_templates/index.html.twig', "data" => $result]; // status
        } else {
            $result['errors'] = self::$errors;
            $result['content'] = $this->request->getPost();
            $result = ['template' => 'users_templates/edit.html.twig', "data" => $result];

        }
        $this->response->setBody($result);
        return $this->response;
    }

    public function delete($id): ResponseInterface //DELETE
    {
        $this->model->deleteUserById($id);
        $_SESSION['status'] = "delete";
        $this->response->setHeaders(['Location: /users']);

        $result = ['template' => 'users_templates/index.html.twig', "data" => null];
        $this->response->setBody($result);
        return $this->response;
    }

}
