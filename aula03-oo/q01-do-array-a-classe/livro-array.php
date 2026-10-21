<?php

declare(strict_types=1);

// Questão 01 - ponto de partida: um livro guardado em array associativo
$livro = [
    'titulo'     => 'Vidas Secas',
    'autor'      => 'Graciliano Ramos',
    'ano'        => 1938,
    'preco'      => 39.90,
    'disponivel' => true,
];

echo "{$livro['titulo']}, de {$livro['autor']} ({$livro['ano']})\n";
