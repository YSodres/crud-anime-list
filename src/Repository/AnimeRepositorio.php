<?php

class AnimeRepository
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
        $sql1 = "SELECT * FROM animes WHERE status = 'Finalizado' ORDER BY nota";
        $statement = $this->pdo->query($sql1);
        $animesFinalizados = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dadosAnimes = array_map(function ($finalizado) {
            return $this->formarObjeto($finalizado);
        }, $animesFinalizados);

        return $dadosAnimes;
    }

    public function listaAssistindo(): array
    {
        $sql1 = "SELECT * FROM animes WHERE status = 'Assistindo' ORDER BY nota";
        $statement = $this->pdo->query($sql1);
        $animesAssistindo = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dadosAnimes = array_map(function ($assistindo) {
            return $this->formarObjeto($assistindo);
        }, $animesAssistindo);

        return $dadosAnimes;
    }

    public function listaPretendeAssistir(): array
    {
        $sql1 = "SELECT * FROM animes WHERE status = 'Pretende Assistir' ORDER BY nome";
        $statement = $this->pdo->query($sql1);
        $animesPretendeAssistir = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dadosAnimes = array_map(function ($pretendeAssistir) {
            return $this->formarObjeto($pretendeAssistir);
        }, $animesPretendeAssistir);

        return $dadosAnimes;
    }
}