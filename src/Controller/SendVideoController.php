<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use PDO;

class SendVideoController implements Controller
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

        require_once __DIR__ . '/../../view/video-send.php';
    }
}
