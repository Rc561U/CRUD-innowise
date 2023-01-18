<?php

namespace Crud\Mvc\app\controllers;

use Crud\Mvc\app\models\ApiUser;
use Crud\Mvc\app\models\User;
use Crud\Mvc\core\AbstractController;
use Crud\Mvc\core\http\response\ResponseInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiUsersController extends AbstractController
{
    public object $model;
    private mixed $id;

    public function __construct($request, $response)
    {
        parent::__construct($request, $response);
        $this->model = new User();
    }

    public function index($id = null)
    {

        $this->response->setHeaders([
            'Access-Control-Allow-Origin: *',
            'Access-Control-Allow-Methods: GET, POST, PATCH, DELETE, OPTIONS',
            "Access-Control-Allow-Headers: X-Requested-With, Content-Type",
            "Access-Control-Expose-Headers: x-pagination-total",
            'Access-Control-Allow-Credentials: true',
            'Access-Control-Max-Age: 86400'
           ]);
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
                header("Access-Control-Allow-Headers: X-Requested-With, Content-Type");
            exit(0);
        }
        $this->id = $id;
        $result = $this->request->getMethod();
        $response = $this->handleResponse($result);
        $this->response->setBodyJson(json_decode($response));

        return $this->response;
    }

    public function validate(): ResponseInterface
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

    public function delete(): ResponseInterface
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


    public function handleResponse(string $method): bool|string
    {
        return match ($method) {
            'GET' => ApiUser::get($this->id, $this->request->getParams(), $this->response),
            'POST' => ApiUser::post($this->request->getJsonRequest(), $this->response),
            'DELETE' => ApiUser::delete($this->id, $this->response),
            'PATCH' => ApiUser::patch($this->id, $this->request->getJsonRequest(), $this->response),
        };
    }

}