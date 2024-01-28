<?php

require_once("src/conexao-db.php");
require_once("src/Model/Anime.php");
require_once("src/Repository/AnimeRepositorio.php");

if (isset($_POST["confirmar"])) {
    $animeRepositorio = new AnimeRepositorio($pdo);

    $nota = isset($_POST["nota"]) && $_POST["nota"] !== "" ? floatval($_POST["nota"]) : null;

    $anime = new Anime($animeId, $_POST["nome"], $nota, $_POST["status"]);

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="/css/styles.css"> -->
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
                        <label for="nome" class="required form-label fw-bold">Nome do Anime:</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>

                    <div class="mb-2">
                        <label for="nota" class="form-label fw-bold">Nota:</label>
                        <input type="number" class="form-control" id="nota" name="nota" min="0" max="10" step="0.1">
                    </div>

                    <div class="mb-2">
                        <label for="status" class="form-label fw-bold">Status:</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Finalizado">Finalizado</option>
                            <option value="Assistindo">Assistindo</option>
                            <option value="Pretende Assistir">Pretende Assistir</option>
                        </select>
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-success" type="submit" name="confirmar">Confirmar</button>
                    </div>
                </form>
            </div>

            <div class="">
                <img src="/img/haikyuu.png.png" alt="Haikyuu">
            </div>
        </section>
    </main>
    <footer></footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
