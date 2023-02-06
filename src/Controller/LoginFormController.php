<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\HtmlRendererTrait;

class LoginFormController implements Controller
{
    use HtmlRendererTrait;
    
    public function processarRequisicao(): void
    {
        if (array_key_exists('logado', $_SESSION) && $_SESSION['logado'] === true){
            header('Location: /');
            return;
        }

        echo $this->renderTemplate('login-form');
    }
}
