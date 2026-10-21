<?php

declare(strict_types=1);

// Questão 04 - classifique cada método ANTES de executar
class Termostato
{
    public string $local;
    public float $temperatura = 25.0;
    public float $alvo = 22.0;

    public function getTemperatura(): float
    {
        return $this->temperatura;
    }

    public function definirAlvo(float $alvo): void
    {
        $this->alvo = $alvo;
    }

    public function resfriar(float $graus): void
    {
        $this->temperatura -= $graus;
    }

    public function precisaResfriar(): bool
    {
        return $this->temperatura > $this->alvo;
    }

    public function mostrarStatus(): void
    {
        $situacao = $this->precisaResfriar() ? 'resfriando' : 'ok';
        echo "{$this->local}: {$this->temperatura} °C (alvo {$this->alvo} °C) - {$situacao}\n";
    }
}

$sala = new Termostato();
$sala->local = 'Laboratório 1';

$sala->mostrarStatus();
$sala->resfriar(2);
$sala->mostrarStatus();
$sala->definirAlvo(24);
$sala->mostrarStatus();
echo $sala->getTemperatura() + 10, "\n";
var_dump($sala->precisaResfriar());
