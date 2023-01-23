<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class VideoListController implements Controller
{
    public function __construct(private VideoRepository $repository)
    {
    }

    public function processarRequisicao(): void
    {
        $videosList = $this->repository->all();
        
        require_once __DIR__ . '/../../view/video-list.php';
    }
}
