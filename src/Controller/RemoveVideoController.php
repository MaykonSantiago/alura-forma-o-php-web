<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class RemoveVideoController implements Controller
{
    public function __construct(private VideoRepository $repository)
    {
    }

    public function processarRequisicao(): void
    {
        $id = $_GET['id'];

        if ($this->repository->remove($id) === false) {
            header('Location: /?success=0');
        } else {
            header('Location: /?success=1');
        }
    }
}
