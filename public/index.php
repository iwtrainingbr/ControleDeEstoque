<?php

ini_set('display_errors', 1);

$url = explode('?', $_SERVER['REQUEST_URI'])[0];

include_once '../config/database.php';

include_once '../vendor/autoload.php';

$routes = include '../config/routes.php';

if (!isset($routes[$url])) {
  echo 'Erro 404: Página não encontrada';
  exit;
}

$controller = $routes[$url]['controller'];
$method = $routes[$url]['method'];

(new $controller)->$method();
