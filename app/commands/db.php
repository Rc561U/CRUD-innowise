<?php
include_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
$dotenv->load();
function pdoConnect(){
    $dsn = "mysql:dbname=test;host=127.0.0.1";
    return new PDO($dsn, "root", "rootpass");
}


function migrate(){
    $model = pdoConnect();
    $migration = new \Crud\Mvc\system\Migrations();
    $migration->dump($model);
}

function seed(){
    $model = pdoConnect();
    $seed = new \Crud\Mvc\system\Seeds();
    $seed->fillUserTable($model);
}

if(function_exists( $argv[1] )){
    $argv[1]();
}

