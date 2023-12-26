<?php
require_once("src/conexao-db.php");
require_once("src/Repository/AnimeRepositorio.php");

header('Content-Type: application/json');

try {
    // Se o ID do anime foi fornecido
    if (isset($_POST['anime_id'])) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $animeRepositorio = new AnimeRepositorio($pdo);
        $anime = $animeRepositorio->buscar( $_POST['anime_id']);

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