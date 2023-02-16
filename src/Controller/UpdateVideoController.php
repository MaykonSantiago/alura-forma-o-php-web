<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class UpdateVideoController implements Controller
{
    public function __construct(private VideoRepository $repository)
    {
    }

    public function processarRequisicao(ServerRequestInterface $request): ResponseInterface
    {
        $body        = $request->getParsedBody();
        $queryParams = $request->getQueryParams();

        $url = filter_var($body['url'], FILTER_VALIDATE_URL);
        $title = filter_var($body['titulo']);
        $id = filter_var($queryParams['id']);

        $video = new Video($url, $title);
        $video->setId($id);

        if($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fInfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $fInfo->file($_FILES['image']['tmp_name']);

            if (str_starts_with($mimeType, 'image/')) {
                $safeFileName = uniqid('upload_') . '_' . pathinfo($_FILES['image']['name'], PATHINFO_BASENAME);

                move_uploaded_file(
                    $_FILES['image']['tmp_name'],
                    __DIR__ . '/../../public/img/uploads/' . $safeFileName
                );
                $video->setImagePath($safeFileName);
            }
        }

        if ($this->repository->update($video) === false) {
            return new Response(302, [
                'Location' => '/?success=0'
            ]);
        } else {
            return new Response(302, [
                'Location' => '/?success=1'
            ]);
        }
    }
}
