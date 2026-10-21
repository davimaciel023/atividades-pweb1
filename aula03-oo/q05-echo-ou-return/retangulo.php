<?php

declare(strict_types=1);

// Questão 05 - os métodos imprimem. Refatore para que devolvam o valor.
class Retangulo
{
    public float $largura;
    public float $altura;

    public function area(): void
    {
        echo "Área: " . ($this->largura * $this->altura) . "\n";
    }

    public function perimetro(): void
    {
        echo "Perímetro: " . (2 * ($this->largura + $this->altura)) . "\n";
    }
}

$sala = new Retangulo();
$sala->largura = 8;
$sala->altura = 6;
$sala->area();
$sala->perimetro();
