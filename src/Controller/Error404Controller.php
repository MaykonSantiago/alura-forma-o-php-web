<?php

namespace Alura\Mvc\Controller;

class Error404Controller
{
    public function processarRequisicao()
    {
        http_response_code(404);
    }
}
