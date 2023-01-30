<?php

namespace Alura\Mvc\Controller;

class LoginFormController implements Controller
{
    public function processarRequisicao(): void
    {
           require_once __DIR__ . '/../../view/login-form.php';
    }
}
