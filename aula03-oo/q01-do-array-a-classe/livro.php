<?php

declare(strict_types=1);

class Livro
{
    public string $titulo;
    public string $autor;
    public int $ano;
    public float $preco;
    public bool $disponivel;
}

$livro1 = new Livro();
$livro1->titulo = 'Vidas Secas';
$livro1->autor = 'Graciliano Ramos';
$livro1->ano = 1938;
$livro1->preco = 39.90;
$livro1->disponivel = true;

$livro2 = new Livro();
$livro2->titulo = 'Iracema';
$livro2->autor = 'José de Alencar';
$livro2->ano = 1865;
$livro2->preco = 29.90;
$livro2->disponivel = false;

echo "{$livro1->titulo}, de {$livro1->autor} ({$livro1->ano})\n";
echo "{$livro2->titulo}, de {$livro2->autor} ({$livro2->ano})\n";

var_dump($livro2);
