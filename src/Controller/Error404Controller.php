<?php

namespace Alura\Mvc\Controller;

class Error404Controller implements Controller
{
    public function processarRequisicao(): void
    {
        http_response_code(404);
    }
}
