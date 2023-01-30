<?php

use Alura\Mvc\Controller\{
    LoginController,
    LoginFormController,
    NewVideoController,
    RemoveVideoController,
    SendVideoController,
    UpdateVideoController,
    VideoListController,
};

return [
    'GET|/'              => VideoListController::class,
    'GET|/novo-video'    => SendVideoController::class,
    'POST|/novo-video'   => NewVideoController::class,
    'GET|/editar-video'  => SendVideoController::class,
    'POST|/editar-video' => UpdateVideoController::class,
    'GET|/remover-video' => RemoveVideoController::class,
    'GET|/login'         => LoginFormController::class,
    'POST|/login'        => LoginController::class,
];
