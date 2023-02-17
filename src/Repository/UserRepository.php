<?php

namespace Alura\Mvc\Repository;

use Alura\Mvc\Entity\User;
use PDO;

class UserRepository
{

    public function __construct(private PDO $pdo)
    {
    }

    public function findByEmail(string $email): User
    {

        $sql = 'SELECT * FROM users WHERE email=:email';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $this->hydrateUser($user);
    }

    public function atualizaHashSenha(User $userData): void
    {
        $statement = $this->pdo->prepare('UPDATE users SET password = ? WHERE id = ?');
        $statement->bindValue(1, password_hash($userData->password, PASSWORD_ARGON2ID));
        $statement->bindValue(2, $userData->id);
        $statement->execute();
    }

    public function hydrateUser(array $userData): User
    {
        $user = new User($userData['email'], $userData['password']);
        $user->setId($userData['id']);

        return $user;
    }
}
