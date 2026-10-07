<?php
header('Content-Type: application/json; charset=utf-8');

$dados = [
    'disciplina' => 'Programação Web I',
    'status'     => 'Ativo',
    'alunos'     => 30,
];

echo json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
