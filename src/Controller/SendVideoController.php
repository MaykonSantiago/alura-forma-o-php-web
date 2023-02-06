<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use PDO;

class SendVideoController extends ControllerWithHtml implements Controller
{
    public function __construct(private VideoRepository $repository)
    {      
    }

    public function processarRequisicao(): void
    {
        $id = intval(filter_input(INPUT_GET, 'id'));
        $video = null;
    
        if($id !== 0) {
            $video = $this->repository->findById($id);
        }

        echo $this->renderTemplate(
            'video-send',
            ['video' => $video],
        );
    }
}
