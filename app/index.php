<?php
session_start();
require 'vendor/autoload.php';

use Crud\Mvc\core\http\Router;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$app = new Router();
Router::add('^$', ['controller' => 'App', 'action' => 'index']);
Router::add('^user\/(?P<id>[0-9]+)$', ['controller' => 'Users', 'action' => 'show']);
Router::add('users/validate', ['controller' => 'ApiUser', 'action' => 'validate']);
Router::add('^(?P<controller>[a-z-]+)\/?(?P<action>[a-z-]+)?\/?(?P<id>[0-9]+)?$');

$app->run();



