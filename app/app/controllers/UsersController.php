<?php

namespace Crud\Mvc\app\controllers;

use Crud\Mvc\app\models\User;
use Crud\Mvc\core\AbstractController;
use Crud\Mvc\core\http\response\ResponseInterface;

class UsersController extends AbstractController
{
    private static mixed $errors;
    private object $model;

    public function __construct($request, $response)

    {
        parent::__construct($request, $response);
        $this->model = new User();
    }

    public function index(): ResponseInterface
    {
        $result['content'] = $this->model->readUser();
        $result['template'] = "app/views/users/index.php";
        $result['status'] = $_SESSION['status'] ?? null;
        $this->response->setBody($result);
        return $this->response;
    }

    public function new(): ResponseInterface //GET
    {
        $result['template'] = "app/views/users/new.php";
        $this->response->setBody($result);
        return $this->response;
    }

    public function create(): ResponseInterface //POST
    {
        self::$errors = $this->model->createUser($this->request);

        if (!self::$errors) {
            $this->response->setHeaders(['Location: /users']);
            $_SESSION['status'] = "create";
            $result['template'] = "app/views/users/index.php";
            $this->response->setBody(null);

        } else {
            $result['template'] = "app/views/users/new.php";
            $result['errors'] = self::$errors;
//            $this->response->setHeaders(['Location: /users/new']);
            $this->response->setBody($result);
        }
        return $this->response;

    }


    public function edit(int $id): ResponseInterface //GET
    {
        $result['content'] = $this->model->getUserById($id);
        $result['template'] = "app/views/users/edit.php";
        $this->response->setBody($result);
        return $this->response;
    }


    public function show($id): ResponseInterface //GET
    {
        $result['content'] = $this->model->getUserById($id);
        $result['template'] = "app/views/users/show.php";
        $this->response->setBody($result);
        return $this->response;
    }


    public function update(): ResponseInterface //PUT
    {
        self::$errors = $this->model->updateUserById($this->request);
        if (!self::$errors) {
            $this->response->setHeaders(['Location: /users']);
            $_SESSION['status'] = "update";
            $result['template'] = "app/views/users/index.php";
            $this->response->setBody($result);
        } else {
            $result['template'] = "app/views/users/edit.php";
            $result['errors'] = self::$errors;
            $this->response->setBody($result);
        }

        return $this->response;
    }

    public function delete($id): ResponseInterface //DELETE
    {
        $this->model->deleteUserById($id);
        $result['template'] = "app/views/users/index.php";
        $_SESSION['status'] = "delete";
        $this->response->setHeaders(['Location: /users']);
        $this->response->setBody($result);
        return $this->response;
    }


}
