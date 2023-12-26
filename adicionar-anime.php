<?php

require_once("src/conexao-db.php");
require_once("src/Model/Anime.php");
require_once("src/Repository/AnimeRepositorio.php");

if (isset($_POST["confirmar"])) {
    $nota = (isset($_POST["nota"]) && $_POST["nota"] != "") ? floatval($_POST["nota"]) : null;

    $anime = new Anime(
        null,
        $_POST["nome"],
        $nota,
        $_POST["status"],
    );

    $animeRepositorio = new AnimeRepositorio($pdo);
    $animeRepositorio->salvar($anime);

    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Anime</title>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
    <header></header>
    <main class="animes">
        <section class="animes__conteudo">
            <h1 class="animes__conteudo__titulo">Informações do Anime</h1>

            <a class="animes__conteudo__adicionar" href="index.php">Página principal</a>

            <form class="animes__conteudo__formulario" method="post">
                <label for="nome" class="required">Nome do Anime:</label>
                <input type="text" id="nome" name="nome" required>

                <label for="nota">Nota:</label>
                <input type="number" id="nota" name="nota" min="0" max="10" step="0.1">

                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="Finalizado">Finalizado</option>
                    <option value="Assistindo">Assistindo</option>
                    <option value="Pretende Assistir">Pretende Assistir</option>
                </select>

                <div class = "animes__conteudo__formulario__botoes">
                    <button type="submit" name="confirmar">Confirmar</button>
                </div>
            </form>
            <div class="animes__conteudo__imagem">
                <img src="/img/haikyuu.png.png" alt="Haikyuu">
            </div>
        </section>
    </main>
    <footer></footer>
</body>
</html>
