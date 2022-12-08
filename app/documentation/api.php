<?php
require("../vendor/autoload.php");
$openapi = \OpenApi\Generator::scan(['../app/models']);
echo $openapi->toJson();

