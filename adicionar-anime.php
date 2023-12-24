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

            <form class="animes__conteudo__formulario">
                <label for="nome">Nome do Anime:</label>
                <input type="text" id="nome" name="nome" required>

                <label for="nota">Nota:</label>
                <input type="number" id="nota" name="nota" min="0" max="10" step="0.1">

                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="finalizado">Finalizado</option>
                    <option value="assistindo">Assistindo</option>
                    <option value="pretende">Pretende Assistir</option>
                </select>

                <button type="submit">Confirmar</button>
            </form>
            <div class="animes__conteudo__imagem">
                <img src="/img/haikyuu.png.png" alt="Haikyuu">
            </div>
        </section>
    </main>
    <footer></footer>
</body>
</html>
