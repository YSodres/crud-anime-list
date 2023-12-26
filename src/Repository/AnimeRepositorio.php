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
        $stmt = $this->pdo->query($sql);
        $animesFinalizados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $dadosAnimes = array_map(function ($anime) {
            return $this->formarObjeto($anime);
        }, $animesFinalizados);

        return $dadosAnimes;
    }

    public function listaAssistindo(): array
    {
        $sql = "SELECT * FROM animes WHERE status = 'Assistindo' ORDER BY nota DESC";
        $stmt = $this->pdo->query($sql);
        $animesAssistindo = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $dadosAnimes = array_map(function ($anime) {
            return $this->formarObjeto($anime);
        }, $animesAssistindo);

        return $dadosAnimes;
    }

    public function listaPretendeAssistir(): array
    {
        $sql = "SELECT * FROM animes WHERE status = 'Pretende Assistir' ORDER BY nome";
        $stmt = $this->pdo->query($sql);
        $animesPretendeAssistir = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $dadosAnimes = array_map(function ($anime) {
            return $this->formarObjeto($anime);
        }, $animesPretendeAssistir);

        return $dadosAnimes;
    }

    public function salvar(Anime $anime)
    {
        $sql = "INSERT INTO animes (nome, nota, status) VALUES (?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $anime->getNome());
        $stmt->bindValue(2, $anime->getNota());
        $stmt->bindValue(3, $anime->getStatus());
        $stmt->execute();
    }

    public function buscarTodos()
    {
        $sql = "SELECT * FROM animes ORDER BY nome";
        $stmt = $this->pdo->query($sql);
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $todosOsDados = array_map(function ($anime) {
            return $this->formarObjeto($anime);
        }, $dados);

        return $todosOsDados;
    }

    public function buscar(int $id)
    {
        $sql = "SELECT * FROM animes WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        return $dados;
    }

    public function atualizar(Anime $anime)
    {
        $sql = "UPDATE animes SET nome = ?, nota = ?, status = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $anime->getNome());
        $stmt->bindValue(2, $anime->getNota());
        $stmt->bindValue(3, $anime->getStatus());
        $stmt->bindValue(4, $anime->getId());
        $stmt->execute();
    }

    public function deletar(int $id)
    {
        $sql = "DELETE FROM animes WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }
}