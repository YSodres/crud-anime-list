<?php

require_once("src/conexao-db.php");
require_once("src/Model/Anime.php");
require_once("src/Repository/AnimeRepositorio.php");

$animeRepositorio = new AnimeRepositorio($pdo);
$animes = $animeRepositorio->buscarTodos();
$animeId = $_POST["anime_id"] ?? null;
$anime = null;

if (isset($_POST["confirmar"]) && $animeId) {
    // Se o formulário foi confirmado e um anime foi selecionado
    $nota = isset($_POST["nota"]) && $_POST["nota"] !== "" ? floatval($_POST["nota"]) : null;

    $anime = new Anime($animeId, $_POST["nome"], $nota, $_POST["status"]);

    $animeRepositorio->atualizar($anime);

    header("Location: index.php");
    exit;
}

if (isset($_POST["excluir"]) && $animeId) {
    $animeRepositorio->deletar($animeId);

    header("Location: editar-anime.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Anime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .required:after {
            content:" *"; 
            color: red;
        }
    </style>
</head>
<body>
    <header></header>
    <main>
        <section class="container mt-4">
            <h1 class="text-center mb-4 fw-bold">Informações do Anime</h1>

            <a class="btn btn-primary mb-4" href="index.php">Página principal</a>

            <div class="d-flex .flex-colum">
                <form method="post">
                    <div class="mb-2">
                        <label for="anime_id" class="form-label fw-bold">Escolha o Anime:</label>
                        <select class="form-select" name="anime_id" id="anime_id" required>
                            <option value="" selected disabled>-</option>
                            <?php foreach ($animes as $animeOption): ?>
                                <option value="<?= $animeOption->getId() ?>" <?= ($animeOption->getId() == $animeId) ? 'selected' : '' ?>>
                                    <?= $animeOption->getNome() ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="nome" class="required form-label fw-bold">Nome do Anime:</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?= $anime ? $anime->getNome() : ''; ?>" readonly required>
                    </div>

                    <div class="mb-2">
                        <label for="nota" class="form-label fw-bold">Nota:</label>
                        <input type="number" class="form-control" id="nota" name="nota" min="0" max="10" step="0.1" value="<?= $anime ? $anime->getNota() : ''; ?>" readonly>
                    </div>

                    <div class="mb-2">
                        <label for="status" class="form-label fw-bold">Status:</label>
                        <select class="form-select" id="status" name="status" disabled>
                            <option value="Finalizado" <?= ($anime && $anime->getStatus() == 'Finalizado') ? 'selected' : ''; ?>>Finalizado</option>
                            <option value="Assistindo" <?= ($anime && $anime->getStatus() == 'Assistindo') ? 'selected' : ''; ?>>Assistindo</option>
                            <option value="Pretende Assistir" <?= ($anime && $anime->getStatus() == 'Pretende Assistir') ? 'selected' : ''; ?>>Pretende Assistir</option>
                        </select>
                    </div>
                    
                    <div class="d-flex gap-2 mt-3">
                        <button class="btn btn-success" type="submit" id="confirmar" name="confirmar" disabled>Confirmar</button>
                        <button class="btn btn-danger" type="submit" id="excluir" name="excluir" disabled>Excluir</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <footer></footer>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let animeSelect = document.getElementById('anime_id');
            let nomeInput = document.getElementById('nome');
            let notaInput = document.getElementById('nota');
            let statusSelect = document.getElementById('status');
            let confirmarButton = document.getElementById('confirmar');
            let excluirButton = document.getElementById('excluir');

            animeSelect.addEventListener('change', function () {
                let selectedOption = animeSelect.options[animeSelect.selectedIndex];

                if (selectedOption.value !== '') {
                    // Anime selecionado, faz a requisição AJAX usando a API Fetch
                    fetch('src/API/obter_dados_anime.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'anime_id=' + selectedOption.value
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erro na requisição: ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(dadosAnime => {
                        // Preenche os campos com os dados do anime obtidos
                        nomeInput.value = dadosAnime.nome;
                        notaInput.value = dadosAnime.nota;
                        statusSelect.value = dadosAnime.status;

                        // Remove a propriedade 'readonly' dos campos e 'disabled' do select
                        nomeInput.removeAttribute('readonly');
                        notaInput.removeAttribute('readonly');
                        statusSelect.removeAttribute('disabled');
                        confirmarButton.removeAttribute('disabled');
                        excluirButton.removeAttribute('disabled');
                    })
                    .catch(error => {
                        console.error('Erro na requisição:', error);
                    });
                }
            });

            excluirButton.addEventListener('click', function (event) {
                let confirmacao = confirm("Tem certeza que deseja excluir este anime da lista?");

                if (!confirmacao) {
                    // cancela a operação de exclusao
                    event.preventDefault();
                }
            })
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
