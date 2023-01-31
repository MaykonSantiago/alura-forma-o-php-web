<?php

use Alura\Mvc\Controller\Error404Controller;
use Alura\Mvc\Repository\VideoRepository;


require_once __DIR__ . '/../vendor/autoload.php';
$routes = require_once __DIR__ . '/../config/routes.php';


$dbPath = __DIR__ . '/../banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$repository = new VideoRepository($pdo);

$httpMethod = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '/';

session_start();
$isLogginRoute = $path=== '/login';

if (!array_key_exists('logado', $_SESSION) && !$isLogginRoute) {
    header('Location: /login');
}

$key = "$httpMethod|$path";

if (array_key_exists($key, $routes)) {
    $controllerClass = $routes[$key];
    $controller = new $controllerClass($repository);
} else {
    $controller = new Error404Controller();
}

$controller->processarRequisicao();
