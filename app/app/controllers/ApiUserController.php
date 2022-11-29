<?php

namespace Crud\Mvc\app\controllers;

use Crud\Mvc\app\models\User;
use Crud\Mvc\core\AbstractController;

class ApiUserController extends AbstractController
{

    public object $model;

    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        $this->model = new User();
    }

    public function validate()
    {
        $jsonRequest = ($this->request->getJsonRequest());
        if (@$this->model->getEmail($jsonRequest["email"]) == @$this->model->getEmailById($jsonRequest["user_id"])) {
            $this->response->setBodyJson(["available" => true]);
        } elseif (@$this->model->getEmail($jsonRequest["email"])) {
            $this->response->setBodyJson(["available" => false]);
        } else {
            $this->response->setBodyJson(["available" => true]);
        }
        return $this->response;

    }

    public function delete()
    {
        $jsonRequest = ($this->request->getJsonRequest());
        if ($this->model->deleteCheckedUsers($jsonRequest)) {
            $this->response->setBodyJson(["status" => true]);
            $_SESSION['status'] = "MultipleDelete";
        } else {
            $this->response->setBodyJson(["status" => false]);
        }
        return $this->response;
    }
}