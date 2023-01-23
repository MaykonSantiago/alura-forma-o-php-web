<?php

namespace Alura\Mvc\Repository;

use Alura\Mvc\Entity\Video;
use Exception;
use PDO;

class VideoRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function add(Video $video): bool
    {
        $query = 'INSERT INTO videos (url, title) VALUES (:url, :title)';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(1, $video->url);
        $stmt->bindValue(2, $video->title);

        $resultado = $stmt->execute();
        if ($resultado === false) {
            throw new Exception('Erro ao salvar o vídeo');
        }

        $id = $this->pdo->lastInsertId();

        $video->setId(intval($id));

        return $resultado;
    }

    public function remove(int $id): bool
    {
        $query = "DELETE FROM videos WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

    public function update(Video $video): bool
    {
        $query = 'UPDATE videos SET url = :url, title = :title WHERE id = :id';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':url', $video->url);
        $stmt->bindValue(':title', $video->title);
        $stmt->bindValue(':id', $video->id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function all(): array
    {
        $videoList = $this->pdo
            ->query('SELECT * FROM videos')
            ->fetchAll(\PDO::FETCH_ASSOC);

        return array_map(
            $this->hydrateVideo(...),
            $videoList
        );
    }

    public function findById(int $id): Video
    {
        $query = 'SELECT * FROM videos WHERE id = ?';

        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $video = $stmt->fetch(PDO::FETCH_ASSOC);

        return $this->hydrateVideo($video);
    }

    public function hydrateVideo(array $videoData): Video
    {
        $video = new Video($videoData['url'], $videoData['title']);
        $video->setId($videoData['id']);
        return $video;
    }
}
