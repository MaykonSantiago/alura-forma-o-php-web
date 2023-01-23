<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class NewVideoController
{
    public function __construct(private VideoRepository $repository)
    {
    }

    public function processarRequisicao()
    {
        $url   = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        $title = filter_input(INPUT_POST, 'titulo');

        if ($url === false || $title === false) {
            header('Location: /?success=0');
            exit();
        }

        if ($this->repository->add(new Video($url, $title)) === false) {
            header('Location: /?success=0');
        } else {
            header('Location: /?success=1');
        }
    }
}
