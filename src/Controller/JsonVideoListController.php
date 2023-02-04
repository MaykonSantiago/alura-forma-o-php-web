<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class JsonVideoListController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processarRequisicao(): void
    {
        $videoList = array_map(function(Video $video): array {
            return[
                'url'        => $video->url,
                'title'      => $video->title,
                'image_path' => $video->getImagePath(),
            ];
        }, $this->videoRepository->all());
        echo json_encode($videoList);
    }
}
