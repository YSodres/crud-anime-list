<?php

class AnimeRepositorio
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    private function formarObjeto($dados)
    {
        return new Anime(
            $dados["id"],
            $dados["nome"],
            $dados["nota"],
            $dados["status"],
        );
    }

    public function listaFinalizado(): array
    {
        $sql = "SELECT * FROM animes WHERE status = 'Finalizado' ORDER BY nota DESC";
        $statement = $this->pdo->query($sql);
        $animesFinalizados = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dadosAnimes = array_map(function ($anime) {
            return $this->formarObjeto($anime);
        }, $animesFinalizados);

        return $dadosAnimes;
    }

    public function listaAssistindo(): array
    {
        $sql = "SELECT * FROM animes WHERE status = 'Assistindo' ORDER BY nota DESC";
        $statement = $this->pdo->query($sql);
        $animesAssistindo = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dadosAnimes = array_map(function ($anime) {
            return $this->formarObjeto($anime);
        }, $animesAssistindo);

        return $dadosAnimes;
    }

    public function listaPretendeAssistir(): array
    {
        $sql = "SELECT * FROM animes WHERE status = 'Pretende Assistir' ORDER BY nome";
        $statement = $this->pdo->query($sql);
        $animesPretendeAssistir = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dadosAnimes = array_map(function ($anime) {
            return $this->formarObjeto($anime);
        }, $animesPretendeAssistir);

        return $dadosAnimes;
    }

    public function salvar(Anime $anime)
    {
        $sql = "INSERT INTO animes (nome, nota, status) VALUES (?,?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $anime->getNome());
        $statement->bindValue(2, $anime->getNota());
        $statement->bindValue(3, $anime->getStatus());
        $statement->execute();
    }

    public function buscarTodos()
    {
        $sql = "SELECT * FROM animes ORDER BY nome";
        $statement = $this->pdo->query($sql);
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);

        $todosOsDados = array_map(function ($anime) {
            return $this->formarObjeto($anime);
        }, $dados);

        return $todosOsDados;
    }

    public function buscar(int $id)
    {
        $sql = "SELECT * FROM animes WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();

        $dados = $statement->fetch(PDO::FETCH_ASSOC);

        return $this->formarObjeto($dados);
    }

    public function atualizar(Anime $anime)
    {
        $sql = "UPDATE animes SET nome = ?, nota = ?, status = ? WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $anime->getNome());
        $statement->bindValue(2, $anime->getNota());
        $statement->bindValue(3, $anime->getStatus());
        $statement->execute();
    }
}