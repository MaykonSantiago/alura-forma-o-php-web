<?php

use Alura\Mvc\Controller\{
    JsonVideoListController,
    LoginController,
    LoginFormController,
    LogoutController,
    NewJsonVideoController,
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
    'GET|/logout'        => LogoutController::class,
    'GET|/videos-json'   => JsonVideoListController::class,
    'POST|/videos'       => NewJsonVideoController::class,
];
