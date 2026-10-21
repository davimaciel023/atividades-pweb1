<?php

declare(strict_types=1);

// Questão 07 - a conta da aula (exemplo 05). Encapsule.
// O saldo é público apenas para fins didáticos nesta aula.
class ContaBancaria
{
    public string $titular;
    public string $numero;
    public float $saldo = 0.0;

    public function depositar(float $valor): void
    {
        if ($valor <= 0) {
            echo "Depósito inválido.\n";
            return;
        }
        $this->saldo += $valor;
    }

    public function sacar(float $valor): void
    {
        if ($valor <= 0 || $valor > $this->saldo) {
            echo "Saque inválido ou saldo insuficiente.\n";
            return;
        }
        $this->saldo -= $valor;
    }

    public function consultarSaldo(): float
    {
        return $this->saldo;
    }

    public function apresentarDados(): void
    {
        echo "Titular: {$this->titular}\n";
        echo "Conta: {$this->numero}\n";
        echo 'Saldo: R$ ' . number_format($this->consultarSaldo(), 2, ',', '.') . "\n";
    }
}

$conta = new ContaBancaria();
$conta->titular = 'João';
$conta->numero = '12345';
$conta->depositar(1000);
$conta->sacar(250);
$conta->apresentarDados();
