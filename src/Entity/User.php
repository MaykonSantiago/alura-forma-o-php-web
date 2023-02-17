<?php

namespace Alura\Mvc\Entity;

use InvalidArgumentException;

class User
{
    public readonly int $id;
    

    public function __construct(
        public readonly string $email,
        public string $password
    )
    {
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
