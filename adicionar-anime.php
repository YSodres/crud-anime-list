<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Anime</title>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
    <h1>Adicionar Anime</h1>
    
    <form action="processar_adicao.php" method="post">
        <label for="nome">Nome do Anime:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="nota">Nota:</label>
        <input type="number" id="nota" name="nota" min="0" max="10" step="0.1">

        <label for="categoria">Categoria:</label>
        <select id="categoria" name="categoria" required>
            <option value="finalizado">Finalizado</option>
            <option value="assistindo">Assistindo</option>
            <option value="pretende_assistir">Pretende Assistir</option>
        </select>

        <button type="submit">Adicionar</button>
    </form>

    <a href="index.php">Voltar para a Lista</a>
</body>
</html>
