<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class NewVideoController implements Controller
{
    public function __construct(private VideoRepository $repository)
    {
    }

    public function processarRequisicao(): void
    {
        $url   = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        $title = filter_input(INPUT_POST, 'titulo');

        $video = new Video($url, $title);

        if ($url === false || $title === false) {
            header('Location: /?success=0');
            exit();
        }

        if($_FILES['image']['error'] === UPLOAD_ERR_OK) {

            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                __DIR__ . '/../../public/img/uploads/' . $_FILES['image']['name']
            );
            $video->setImagePath($_FILES['image']['name']);
        }
        
        if ($this->repository->add($video)) {
            header('Location: /?success=0');
        } else {
            header('Location: /?success=1');
        }
    }
}
