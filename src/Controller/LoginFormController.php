<?php

namespace Alura\Mvc\Controller;

class LoginFormController implements Controller
{
    public function processarRequisicao(): void
    {
        session_start();
        if ($_SESSION['logado'] === true){
            header('Location: /');
            return;
        }
        require_once __DIR__ . '/../../view/login-form.php';
    }
}
