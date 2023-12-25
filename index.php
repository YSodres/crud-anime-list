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
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
    <header></header>
    <main class="animes">
        <section class="animes__conteudo">
            <h1 class="animes__conteudo__titulo">Listas de Animes</h1>
            
            <div class="animes__conteudo__opcoes">
                <a class="animes__conteudo__adicionar" href="adicionar-anime.php">Adicionar Anime</a>
                <a class="animes__conteudo__adicionar" href="editar-anime.php">Editar Anime</a>
            </div>

            <div class="animes__conteudo__categorias">
                <div class="finalizado">
                    <h2>Finalizado</h2>
                    <ul>
                        <?php foreach ($dadosFinalizado as $finalizado) {
                        ?>
                            <li>
                                <?= $finalizado->getNome(); ?>
                                <?php if ($finalizado->getNota() !== null) {
                                ?>
                                    - Nota: <?= $finalizado->getNota(); ?>
                                <?php 
                                }
                                ?>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>

                <div class="assistindo">
                    <h2>Assistindo</h2>
                    <ul>
                        <?php foreach ($dadosAssistindo as $assistindo) {
                        ?>
                            <li>
                                <?= $assistindo->getNome(); ?>
                                <?php if ($assistindo->getNota() !== null) {
                                ?>
                                    - Nota: <?= $assistindo->getNota(); ?>
                                <?php 
                                }
                                ?>
                            </li>                        
                        <?php
                        }
                        ?>
                    </ul>
                </div>

                <div class="pretende">
                    <h2>Pretende Assistir</h2>
                    <ul>
                        <?php foreach ($dadosPretendeAssistir as $pretendeAssistir) {
                        ?>
                            <li>
                                <?= $pretendeAssistir->getNome(); ?>
                                <?php if ($pretendeAssistir->getNota() !== null) {
                                ?>
                                    - Nota: <?= $pretendeAssistir->getNota(); ?>
                                <?php 
                                }
                                ?>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </section>
    </main>
    <footer></footer>
</body>
</html>
