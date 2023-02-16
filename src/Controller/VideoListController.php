<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\HtmlRendererTrait;
use Alura\Mvc\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class VideoListController implements Controller
{
    use HtmlRendererTrait;
    
    public function __construct(private VideoRepository $repository)
    {
    }

    public function processarRequisicao(ServerRequestInterface $request): ResponseInterface
    {
        $videosList = $this->repository->all();
        
        return new Response(
            200,
            [],
            $this->renderTemplate(
                'video-list',
                ['videosList' => $videosList],
            )
        );
    }
}
