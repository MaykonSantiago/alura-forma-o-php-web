<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SendVideoController implements RequestHandlerInterface
{
    public function __construct(
        private VideoRepository $repository,
        private Engine $template    
    )
    {      
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $id = filter_var($queryParams['id'] ?? '', FILTER_VALIDATE_INT);
        $video = null;
    
        if($id !== false && $id !== null) {
            $video = $this->repository->findById($id);
        }

        return new Response(
            200,
            [],
            $this->template->render(
                'video-send',
                ['video' => $video],
            )
        );
    }
}
