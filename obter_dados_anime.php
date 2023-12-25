<?php
require_once("src/conexao-db.php");
// obter_dados_anime.php

header('Content-Type: application/json');

try {
    // Se o ID do anime foi fornecido
    if (isset($_POST['anime_id'])) {
        // Substitua "seu_host", "seu_usuario", "sua_senha" e "seu_banco" pelos seus próprios detalhes de conexão

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $animeId = $_POST['anime_id'];

        // Adicione aqui o código para obter os dados do anime pelo ID
        // Exemplo:
        $stmt = $pdo->prepare('SELECT * FROM animes WHERE id = :id');
        $stmt->bindParam(':id', $animeId, PDO::PARAM_INT);
        $stmt->execute();
        $anime = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($anime) {
            // Retorna os dados do anime como JSON
            echo json_encode($anime);
        } else {
            // Se o anime não for encontrado, retorna uma mensagem de erro
            echo json_encode(['error' => 'Anime não encontrado']);
        }
    } else {
        // Se o ID do anime não foi fornecido, retorna uma mensagem de erro
        echo json_encode(['error' => 'ID do anime não fornecido']);
    }
} catch (PDOException $e) {
    // Se ocorrer um erro na conexão com o banco de dados
    echo json_encode(['error' => 'Erro na conexão com o banco de dados']);
}