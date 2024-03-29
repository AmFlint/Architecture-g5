<?php

//var_dump($_SERVER['REQUEST_URI']);

require '../vendor/autoload.php';
require '../config.php';

$route = new \classes\Router($_SERVER['REQUEST_URI']);
$route::$url = trim($route::$url, '/');

$route->init();

$currentRoute = $route->getRoute($_SERVER['REQUEST_URI']);
$route::generateController($currentRoute);
