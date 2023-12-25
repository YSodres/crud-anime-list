<?php

require_once("src/conexao-db.php");
require_once("src/Model/Anime.php");
require_once("src/Repository/AnimeRepositorio.php");

$animeRepositorio = new AnimeRepositorio($pdo);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Se o formulário foi enviado
    $animeId = isset($_POST["anime_id"]) ? $_POST["anime_id"] : null;

    if ($animeId) {
        // Buscar o anime apenas se o ID for fornecido
        $anime = $animeRepositorio->buscar($animeId);
    }
} else {
    // Se é a primeira vez que a página é carregada
    $animes = $animeRepositorio->buscarTodos();
    $animeId = null;
    $anime = null;
}

if (isset($_POST["confirmar"]) && $animeId) {
    // Se o formulário foi confirmado e um anime foi selecionado
    $anime = new Anime(
        $animeId,
        $_POST["nome"],
        $_POST["nota"],
        $_POST["status"]
    );

    $animeRepositorio->atualizar($anime);

    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Anime</title>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
    <header></header>
    <main class="animes">
        <section class="animes__conteudo">
            <h1 class="animes__conteudo__titulo">Informações do Anime</h1>

            <a class="animes__conteudo__adicionar" href="index.php">Página principal</a>

            <form class="animes__conteudo__formulario" method="post">
                <label for="anime_id">Escolha o Anime</label>
                <select name="anime_id" id="anime_id" required>
                    <option value="" selected disabled>-</option>
                    <?php foreach ($animes as $animeOption) {
                        ?>
                        <option value="<?= $animeOption->getId() ?>" <?= ($animeOption->getId() == $animeId) ? 'selected' : '' ?>>
                            <?= $animeOption->getNome() ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>

                <label for="nome">Nome do Anime:</label>
                <input type="text" id="nome" name="nome" value="<?= $anime ? $anime->getNome() : ''; ?>" readonly required>

                <label for="nota">Nota:</label>
                <input type="number" id="nota" name="nota" min="0" max="10" step="0.1" value="<?= $anime ? $anime->getNota() : ''; ?>" readonly>

                <label for="status">Status:</label>
                <select id="status" name="status" readonly disabled>
                    <option value="Finalizado" <?= ($anime && $anime->getStatus() == 'Finalizado') ? 'selected' : ''; ?>>Finalizado</option>
                    <option value="Assistindo" <?= ($anime && $anime->getStatus() == 'Assistindo') ? 'selected' : ''; ?>>Assistindo</option>
                    <option value="Pretende Assistir" <?= ($anime && $anime->getStatus() == 'Pretende Assistir') ? 'selected' : ''; ?>>Pretende Assistir</option>
                </select>

                <button type="submit" name="confirmar" disabled>Confirmar</button>
            </form>
        </section>
    </main>
    <footer></footer>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var selectAnime = document.getElementById('anime_id');
            var nomeInput = document.getElementById('nome');
            var notaInput = document.getElementById('nota');
            var statusSelect = document.getElementById('status');
            var confirmarButton = document.querySelector('[name="confirmar"]');

            selectAnime.addEventListener('change', function () {
                var selectedOption = selectAnime.options[selectAnime.selectedIndex];

                if (selectedOption.value !== '') {
                    // Anime selecionado, faz a requisição AJAX para obter os dados do anime
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "obter_dados_anime.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            var dadosAnime = JSON.parse(xhr.responseText);

                            // Preenche os campos com os dados do anime obtidos
                            nomeInput.value = dadosAnime.nome;
                            notaInput.value = dadosAnime.nota;
                            statusSelect.value = dadosAnime.status;

                            // Remove a propriedade 'readonly' dos campos e 'disabled' do select
                            nomeInput.removeAttribute('readonly');
                            notaInput.removeAttribute('readonly');
                            statusSelect.removeAttribute('disabled');
                            confirmarButton.removeAttribute('disabled');
                        }
                    };
                    xhr.send("anime_id=" + selectedOption.value);
                } 
            });
        });
    </script>
</body>
</html>
