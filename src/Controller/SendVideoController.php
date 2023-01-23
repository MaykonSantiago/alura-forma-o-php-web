<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use PDO;

class SendVideoController implements Controller
{
    public function __construct(private VideoRepository $repository)
    {      
    }

    public function processarRequisicao(): void
    {
        $id = intval(filter_input(INPUT_GET, 'id'));
        $video = null;
    
        if($id !== 0) {
            $video = $this->repository->findById($id);
        }
         require_once __DIR__ . '/../../inicio-html.php' 
        ?>

        <main class="container">

            <form class="container__formulario" method="post">
                <h2 class="formulario__titulo">Envie um vídeo!</h2>
                    <div class="formulario__campo">
                        <label class="campo__etiqueta" for="url">Link embed</label>
                        <input 
                            name="url" 
                            class="campo__escrita" 
                            required
                            placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g" id='url'
                            value="<?= $video?->url ?>"
                            id='url'
                        />
                    </div>

                    <div class="formulario__campo">
                        <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                        <input
                            name="titulo"
                            class="campo__escrita"
                            required
                            placeholder="Neste campo, dê o nome do vídeo" id='url'
                            value="<?= $video?->title ?>"
                            id='titulo'
                        />
                    </div>

                    <input class="formulario__botao" type="submit" value="Enviar" />
            </form>

        </main>
        <?php require_once __DIR__ . '/../../fim-html.php';
    }
}
