<?php

use Alura\Mvc\Repository\VideoRepository;

    $dbPath = __DIR__ . '/banco.sqlite';
    $pdo = new PDO("sqlite:$dbPath");
    $success = $_GET['success'];

    $repository = new VideoRepository($pdo);
    $videosList = $repository->all();
?>
<?php require_once 'inicio-html.php'?>
    <?php if(isset($success)): ?>
        <div class="alerta">
            <?php if($success === '1'): ?>
                Sucesso
            <?php else: ?>
                Falha
            <?php endif; ?>
            <?php $success = $_GET['success'] = null; ?>
        </div>
    <?php endif;?>

    <ul class="videos__container" alt="videos alura">
        <?php foreach($videosList as $video): ?>
            <li class="videos__item">
                <iframe width="100%" height="72%" src=<?= $video->url?>
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
                <div class="descricao-video">
                    <img src="./img/logo.png" alt="logo canal alura">
                    <h3><?= $video->title?></h3>
                    <div class="acoes-video">
                        <a href="/editar-video?id=<?= $video->id; ?>">Editar</a>
                        <a href="/remover-video?id=<?= $video->id; ?>">Excluir</a>
                    </div>
                </div>
            </li>
        <?php endforeach;?>
    </ul>
<?php require_once 'fim-html.php' ?>