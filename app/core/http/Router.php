<?php

namespace Crud\Mvc\core\http;


use Crud\Mvc\core\http\request\RequestCreator;
use Crud\Mvc\core\http\request\RequestInterface;
use Crud\Mvc\core\http\response\HtmlResponse;
use Crud\Mvc\core\http\response\JsonResponse;
use Crud\Mvc\core\http\response\ResponseInterface;
use Crud\Mvc\core\http\response\ResponseProcessor;

class Router
{
    protected static array $routes;
    protected static array $route;
    protected static string $controller;
    protected static string $action;
    protected static ?int $id;
    private static string $path = "\Crud\Mvc\app\controllers\\";
    private ResponseProcessor $responseProcessor;
    private RequestInterface $request;

    public function __construct()
    {
        $res = new RequestCreator();
        $this->request = $res->create();
        $this->responseProcessor = new ResponseProcessor();
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
        header("Access-Control-Allow-Headers: X-Requested-With");
    }

    /**
     * @param $regex
     * @param array $route
     * @return void
     */
    public static function add($regex, array $route = []): void
    {
        self::$routes[$regex] = $route;
    }

    /**
     * @return void
     */
    public function run(): void
    {

        $this->mapRequest();
    }

    /**
     * @return void
     */
    public function mapRequest(): void
    {
        self::dispatch($this->request->getUri());
        $this->mainProcessor();
    }

    /**
     * @param $url
     * @return void
     */
    public static function dispatch($url): void
    {
        if (self::matchRoute($url)) {
            $controller = self::$path . ucfirst(self::$route['controller']) . "Controller";
            $action = self::$route['action'];
            $apiController = self::$controller = self::$path . 'Api' . ucfirst(self::$route['controller']) . "Controller";
            if ( !empty(self::$route['api']) && class_exists($apiController) && method_exists($apiController, $action)) {

                self::$action = $action;
                self::$controller = $apiController;
                if (isset(self::$route['id'])) {
                    self::$id = self::$route['id'];
                }
            } elseif (class_exists($controller) && method_exists($controller, $action)) {
                if (isset(self::$route['id'])) {
                    self::$id = self::$route['id'];
                }
                self::$controller = $controller;
                self::$action = $action;
            }  else {
                self::$controller = self::$path . "NotFoundController";
                self::$action = "index";
            }
        } else {
            http_response_code(404);
            self::$controller = self::$path . "NotFoundController";
            self::$action = "index";
        }
    }

    /**
     * @param $url
     * @return bool
     */
    public static function matchRoute($url): bool
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                if (!isset($route['action'])|| ($route['action']) == "") {
                    $route['action'] = 'index';
                }
                self::$route = $route;
                return true;
            }
        }
        return false;
    }


    /**
     * @return void
     */
    private function mainProcessor(): void
    {
        $controller = self::$controller;
        $action = self::$action;
        if (str_contains($controller, "Api")){
            $response = $this->createResponseObject('json');
        }else {
            $response = $this->createResponseObject('html');
        }
        $controllerClass = new $controller($this->request, $response);
        if (isset(self::$id)) {
            $response = $controllerClass->$action(self::$id);
        } else {
            $response = $controllerClass->$action();
        }
        $this->responseProcessor->process($response);
    }


    /**
     * @param string $type
     * @return ResponseInterface
     */
    private function createResponseObject(string $type): ResponseInterface
    {
        return match ($type) {
            'json' => new JsonResponse(),
            'html' => new HtmlResponse(),
        };
    }
}

