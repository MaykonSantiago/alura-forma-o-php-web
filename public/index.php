<?php

use Alura\Mvc\Controller\{
    Error404Controller,
    NewVideoController,
    RemoveVideoController,
    SendVideoController,
    UpdateVideoController,
    VideoListController,
    Controller
};
use Alura\Mvc\Repository\VideoRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$dbPath = __DIR__ . '/../banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$repository = new VideoRepository($pdo);

if (!array_key_exists('PATH_INFO', $_SERVER) || $_SERVER['PATH_INFO'] === '/') {

    $controller = new VideoListController($repository);
    
    
} elseif ($_SERVER['PATH_INFO'] === '/novo-video') {

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        
        $controller = new SendVideoController($repository);

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $controller = new NewVideoController($repository);

    }
} elseif ($_SERVER['PATH_INFO'] === '/editar-video') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $controller = new SendVideoController($repository);

    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $controller = new UpdateVideoController($repository);
    }
} elseif ($_SERVER['PATH_INFO'] === '/remover-video') {
    
    $controller = new RemoveVideoController($repository);

} else {
    $controller = new Error404Controller();
}

/** @var Controller $controller */
$controller->processarRequisicao();
