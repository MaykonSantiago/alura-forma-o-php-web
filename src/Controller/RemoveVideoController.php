<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class RemoveVideoController
{
    public function __construct(private VideoRepository $repository)
    {
    }

    public function processarRequisicao()
    {
        $id = $_GET['id'];

        if ($this->repository->remove($id) === false) {
            header('Location: /?success=0');
        } else {
            header('Location: /?success=1');
        }
    }
}
