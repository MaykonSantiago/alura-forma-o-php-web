<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class UpdateVideoController
{
    public function __construct(private VideoRepository $repository)
    {
    }

    public function processarRequisicao()
    {
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        $title = filter_input(INPUT_POST, 'titulo');
        $id = filter_input(INPUT_GET, 'id');

        $video = new Video($url, $title);
        $video->setId($id);


        if ($this->repository->update($video) === false) {
            header('Location: /?success=0');
        } else {
            header('Location: /?success=1');
        }
    }
}
