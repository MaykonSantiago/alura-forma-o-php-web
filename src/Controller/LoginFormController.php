<?php

namespace Alura\Mvc\Controller;

class LoginFormController extends ControllerWithHtml implements Controller
{
    public function processarRequisicao(): void
    {
        if (array_key_exists('logado', $_SESSION) && $_SESSION['logado'] === true){
            header('Location: /');
            return;
        }

        echo $this->renderTemplate('login-form');
    }
}
