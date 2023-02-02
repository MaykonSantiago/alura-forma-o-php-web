<?php

namespace Alura\Mvc\Entity;

use InvalidArgumentException;

class Video
{
    public readonly int $id;
    public readonly string $url;
    private ?string $image_path = null;

    public function __construct(
        string $url,
        public readonly string $title,
    )
    {
        $this->setUrl($url);
    }

    public function setUrl(string $url): void
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new InvalidArgumentException('URL inválida');
        }

        $this->url = $url;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setImagePath(string $image_path): void
    {
        $this->image_path = $image_path;
    }

    public function getImagePath(): ?string
    {
        return $this->image_path;
    }
}
