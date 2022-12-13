<?php

use Crud\Mvc\app\controllers\ApiUsersController;
use Crud\Mvc\app\models\User;
use Crud\Mvc\core\http\response\JsonResponse;
use Crud\Mvc\core\http\response\ResponseInterface;
use Crud\Mvc\core\traits\DatabaseConnect;

include_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2), '.env-php');
$dotenv->load();

class ApiUsersControllerTest extends \PHPUnit\Framework\TestCase
{
    private ResponseInterface $response;
    private object $stubApiController;
    private object $model;



    protected function setUp(): void
    {
        $this->response = new JsonResponse();
        $this->stubApiController = $this->createMock(ApiUsersController::class);
        $this->model = $this->createMock(User::class);

    }

    protected function tearDown(): void
    {}

    /**
     * @dataProvider additionProvider
     */
    public function testUsersApiController($method)
    {
        $this->stubApiController->method("handleResponse")
            ->willReturn('REST API data');  // https://gorest.co.in/
        $result = $this->stubApiController->handleResponse($method);
        $this->response->setBodyJson($result);
        $this->assertInstanceOf(ResponseInterface::class, $this->response);
    }


    public function additionProvider(): array
    {
        return [
            'GET' => ['GET'],
            'POST' => ['POST'],
            'PATCH' => ['PATCH'],
            'DELETE' => ['DELETE'],
        ];
    }

    /**
     * @dataProvider validateProvider
     */
    public function testUserValidation()
    {
        $jsonRequest = [''=>''];
        $this->model->expects($this->any())
            ->method('getEmail')
            ->with($jsonRequest)
            ->willReturn(true);

        $this->model->expects($this->any())
            ->method('getUserById')
            ->with($jsonRequest)
            ->willReturn(true);

        $res = $this->stubApiController->validate();
        $this->assertInstanceOf(ResponseInterface::class, $res);
    }

    public function validateProvider(): array
    {
        return [
            [''=>''],
            ['email' => 'localhost@local.com'],
            ['email' => 'localhost@local.com', 'user_id' => 12],
        ];
    }


}
