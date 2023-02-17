<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Helper\FlashMessageTrait;
use Alura\Mvc\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class NewVideoController implements RequestHandlerInterface
{
    use FlashMessageTrait;

    public function __construct(private VideoRepository $repository)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();
        $url = filter_var($body['url'], FILTER_VALIDATE_URL);

        if ($url === false) {
            $this->addErrorMessage('URL inválida');
            return new Response(302, [
                'Location' => '/novo-video'
            ]);
        }
        $titulo = filter_var($body['titulo']);
        if ($titulo === false) {
            $this->addErrorMessage('Título não informado');
            return new Response(302, [
                'Location' => '/novo-video'
            ]);
        }

        $video = new Video($url, $titulo);
        $files = $request->getUploadedFiles();
        /** @var UploadedFileInterface $uploadedImage */
        $uploadedImage = $files['image'];

        if($uploadedImage->getError() === UPLOAD_ERR_OK) {
            $fInfo = new \finfo(FILEINFO_MIME_TYPE);
            $tmpFile = $uploadedImage->getStream()->getMetadata('uri');
            $mimeType = $fInfo->file($tmpFile);

            if (str_starts_with($mimeType, 'image/')) {
                $safeFileName = uniqid('upload_') . '_' . pathinfo($uploadedImage->getClientFilename(), PATHINFO_BASENAME);
                $uploadedImage->moveTo(__DIR__ . '/../../public/img/uploads/' . $safeFileName);
                $video->setImagePath($safeFileName);
            }
        }
        
        $success = $this->repository->add($video);
        if ($success === false) {
            $this->addErrorMessage('Erro ao cadastrar vídeo');
            return new Response(302, [
                'Location' => '/novo-video'
            ]);
        } else {
            return new Response(302, [
                'Location' => '/?sucesso=1'
            ]);
        }
    }
}
