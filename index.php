<?php

require_once("src/conexao-db.php");
require_once("src/Model/Anime.php");
require_once("src/Repository/AnimeRepositorio.php");

$animeRepositorio = new AnimeRepositorio($pdo);
$dadosFinalizado = $animeRepositorio->listaFinalizado();
$dadosAssistindo = $animeRepositorio->listaAssistindo();
$dadosPretendeAssistir = $animeRepositorio->listaPretendeAssistir();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listas de Animes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <header></header>
    <main>
        <section class="container mt-4">
            <h1 class="text-center mb-4 fw-bold">Listas de Animes</h1>
            
            <div class="d-flex justify-content-left gap-4 mb-4">
                <a class="btn btn-primary" href="adicionar-anime.php">Adicionar Anime</a>
                <a class="btn btn-secondary" href="editar-anime.php">Editar Anime</a>
            </div>

            <div class="row">
                <div class="col">
                    <h2 class="mb-3 fw-bold">Finalizado</h2>
                    <ul class="list-group">
                        <?php foreach ($dadosFinalizado as $finalizado): ?>
                            <li class="fw-bold pb-1">
                                <?= $finalizado->getNome(); ?>
                                <?php if ($finalizado->getNota() !== null): ?>
                                    - Nota: <?= $finalizado->getNota(); ?>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="col">
                    <h2 class="mb-3 fw-bold">Assistindo</h2>
                    <ul class="list-group">
                        <?php foreach ($dadosAssistindo as $assistindo): ?>
                            <li class="fw-bold pb-1">
                                <?= $assistindo->getNome(); ?>
                                <?php if ($assistindo->getNota() !== null): ?>
                                    - Nota: <?= $assistindo->getNota(); ?>
                                <?php endif; ?>
                            </li>                        
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="col">
                    <h2 class="mb-3 fw-bold">Pretende Assistir</h2>
                    <ul class="list-group">
                        <?php foreach ($dadosPretendeAssistir as $pretendeAssistir): ?>
                            <li class="fw-bold pb-1">
                                <?= $pretendeAssistir->getNome(); ?>
                                <?php if ($pretendeAssistir->getNota() !== null): ?>
                                    - Nota: <?= $pretendeAssistir->getNota(); ?>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>
    </main>
    <footer></footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
