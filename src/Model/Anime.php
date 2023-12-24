<?php

class Anime
{
    private ?int $id;
    private string $nome;
    private float $nota;
    private string $status;

    public function __construct(?int $id, string $nome, float $nota, string $status)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->nota = $nota;
        $this->status = $status;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getNota(): float
    {
        return $this->nota;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}