<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\HtmlRendererTrait;
use Alura\Mvc\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SendVideoController implements RequestHandlerInterface
{
    use HtmlRendererTrait;
    
    public function __construct(private VideoRepository $repository)
    {      
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $id = intval(filter_var($queryParams['id']));
        $video = null;
    
        if($id !== 0) {
            $video = $this->repository->findById($id);
        }

        return new Response(
            200,
            [],
            $this->renderTemplate(
                'video-send',
                ['video' => $video],
            )
        );
    }
}
