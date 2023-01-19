<?php
    $dbPath = __DIR__ . '/banco.sqlite';
    $pdo = new PDO("sqlite:$dbPath");

    $id = intval(filter_input(INPUT_GET, 'id'));
    $action = '/novo-video.php';

    if($id !== 0) {
        $query = 'SELECT * FROM videos WHERE id = ?';

        $stmt = $pdo->prepare($query);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $video = $stmt->fetch(PDO::FETCH_ASSOC);
        $action = "/editar-video.php?id=$id";
    }
?>
<?php require_once 'inicio-html.php' ?>
    <main class="container">

        <form class="container__formulario" action="<?= $action ?>" method="post">
            <h2 class="formulario__titulo">Envie um vídeo!</h2>
                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="url">Link embed</label>
                    <input 
                        name="url" 
                        class="campo__escrita" 
                        required
                        <?php if($action == '/novo-video.php'): ?>
                            placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g" id='url'
                        <?php else: ?>
                            value="<?= $video['url']; ?>"
                        <?php endif; ?>
                        id='url'
                    />
                </div>


                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                    <input
                        name="titulo"
                        class="campo__escrita"
                        required
                        <?php if ($action == '/novo-video.php'): ?>
                            placeholder="Neste campo, dê o nome do vídeo" id='url'
                        <?php elseif ($action == "/editar-video.php?id=$id" ): ?>
                            value="<?= $video['title']; ?>"
                        <?php endif; ?>
                        id='titulo'
                    />
                </div>

                <input class="formulario__botao" type="submit" value="Enviar" />
        </form>

    </main>
<?php require_once 'fim-html.php' ?>