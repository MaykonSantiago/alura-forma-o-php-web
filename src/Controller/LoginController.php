<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\FlashMessageTrait;
use Nyholm\Psr7\Response;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoginController implements Controller
{
    use FlashMessageTrait;

    private PDO $pdo;

    public function __construct() {
        $dbPath = __DIR__ . '/../../banco.sqlite';
        $this->pdo = new PDO("sqlite:$dbPath");
    }
    
    function processarRequisicao(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();
        $email = filter_var($body['email'], FILTER_VALIDATE_EMAIL);
        $password = filter_var($body['password']);

        $sql = 'SELECT * FROM users WHERE email=:email';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        $correctPassword = password_verify($password, $userData['password'] ?? '');

        if ($correctPassword) {
        //atualiza o hash da senha do usuário sempre que o algoritmo for alterado
            if (password_needs_rehash($userData['password'], PASSWORD_ARGON2ID)) {
                $statement = $this->pdo->prepare('UPDATE users SET password = ? WHERE id = ?');
                $statement->bindValue(1, password_hash($password, PASSWORD_ARGON2ID));
                $statement->bindValue(2, $userData['id']);
                $statement->execute();
            }

            $_SESSION['logado'] = true;
            return new Response(302, [
                'Location' => '/'
            ]);
        } else {
            $this->addErrorMessage('Usuário ou senha inválidos');
            return new Response(302, [
                'Location' => '/login'
            ]);
        }
    }
}
