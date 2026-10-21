<?php

declare(strict_types=1);

class Aluno
{
    private string $nome;
    private float $nota1;
    private float $nota2;

    public function __construct(string $nome, float $nota1, float $nota2)
    {
        if ($nota1 < 0 || $nota1 > 10 || $nota2 < 0 || $nota2 > 10) {
            throw new Exception("Nota inválida para {$nome}: use valores de 0 a 10.");
        }
        $this->nome = $nome;
        $this->nota1 = $nota1;
        $this->nota2 = $nota2;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function calcularMedia(): float
    {
        return ($this->nota1 + $this->nota2) / 2;
    }

    public function situacao(): string
    {
        $media = $this->calcularMedia();

        if ($media >= 7) {
            return 'Aprovado';
        }
        if ($media >= 4) {
            return 'Recuperação';
        }
        return 'Reprovado';
    }
}

class Disciplina
{
    private string $nome;
    private array $alunos = [];

    public function __construct(string $nome)
    {
        $this->nome = $nome;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getAlunos(): array
    {
        return $this->alunos;
    }

    public function adicionarAluno(Aluno $aluno): void
    {
        $this->alunos[] = $aluno;
    }

    public function calcularMediaTurma(): float
    {
        if (count($this->alunos) === 0) {
            return 0;
        }

        $soma = 0;
        foreach ($this->alunos as $aluno) {
            $soma += $aluno->calcularMedia();
        }
        return $soma / count($this->alunos);
    }

    public function contarAprovados(): int
    {
        $aprovados = 0;
        foreach ($this->alunos as $aluno) {
            if ($aluno->situacao() === 'Aprovado') {
                $aprovados++;
            }
        }
        return $aprovados;
    }
}
