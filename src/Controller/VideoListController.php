<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\HtmlRendererTrait;
use Alura\Mvc\Repository\VideoRepository;

class VideoListController implements Controller
{
    use HtmlRendererTrait;
    
    public function __construct(private VideoRepository $repository)
    {
    }

    public function processarRequisicao(): void
    {
        $videosList = $this->repository->all();
        
        echo $this->renderTemplate(
            'video-list',
            ['videosList' => $videosList],
        );
    }
}
