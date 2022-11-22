<?php

require 'vendor/autoload.php';

use Crud\Mvc\core\http\Router;


$app = new Router();
Router::add('^$', ['controller' => 'App', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

$app->run();
