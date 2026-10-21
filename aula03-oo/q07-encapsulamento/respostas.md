# Questão 07: Encapsulamento

**Nível:** 🔴 Avançado

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `conta.php` | A conta da aula. Você encapsula |
| `teste-protecao.php` | Fornecido: três tentativas de burlar a classe |

## 1. Análise do código

**1.1 Cole a sua classe e explique: quais atributos e métodos são `private`, quais são `public` e por quê.**

```php
class ContaBancaria
{
    private string $titular;
    private string $numero;
    private float $saldo = 0.0;
    private array $extrato = [];

    public function __construct(string $titular, string $numero)
    {
        $this->titular = $titular;
        $this->numero = $numero;
    }

    public function getTitular(): string
    {
        return $this->titular;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }

    public function getExtrato(): array
    {
        return $this->extrato;
    }

    public function depositar(float $valor): void
    {
        if ($valor <= 0) {
            throw new Exception('Depósito inválido.');
        }
        $this->saldo += $valor;
        $this->registrar('Depósito', $valor);
    }

    public function sacar(float $valor): void
    {
        if ($valor <= 0) {
            throw new Exception('Saque inválido.');
        }
        if ($valor > $this->saldo) {
            throw new Exception('Saldo insuficiente.');
        }
        $this->saldo -= $valor;
        $this->registrar('Saque', $valor);
    }

    private function registrar(string $operacao, float $valor): void
    {
        $this->extrato[] = "{$operacao}: R$ " . number_format($valor, 2, ',', '.');
    }

    public function apresentarDados(): void
    {
        echo "Titular: {$this->titular}\n";
        echo "Conta: {$this->numero}\n";
        echo 'Saldo: R$ ' . number_format($this->getSaldo(), 2, ',', '.') . "\n";
    }
}
```

Todos os atributos (`$titular`, `$numero`, `$saldo`, `$extrato`) são `private`, para que ninguém de fora altere os dados direto. O método `registrar()` também é `private`, porque só a própria conta deve escrever no extrato. São `public` o construtor, os getters, `depositar()`, `sacar()` e `apresentarDados()`: é por eles que o código de fora usa a conta, sempre passando pelas regras.

**1.2 Explique o método privado `registrar()` e como o extrato é montado.**

`registrar()` recebe o nome da operação e o valor, monta um texto como `Depósito: R$ 1.000,00` e acrescenta no fim do array `$extrato`. Ele é chamado dentro de `depositar()` e `sacar()`, só depois que a operação deu certo. Assim, operações recusadas não entram no extrato. O `getExtrato()` devolve esse array para ser mostrado com um `foreach`.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída com `$conta->saldo = -300;` na versão original (item 1)**

```text
Titular: João
Conta: 12345
Saldo: R$ -300,00
```

**Explicação:**

Como o `$saldo` era `public`, o código de fora trocou o saldo direto para −300, passando por cima das regras de `depositar()` e `sacar()`. A conta ficou com um saldo impossível e o PHP não reclamou de nada.

**2.2 Saída da versão encapsulada**: `php q07-encapsulamento/conta.php`

```text
Recusado: Saldo insuficiente.
Recusado: Depósito inválido.

Extrato de João:
- Depósito: R$ 1.000,00
- Saque: R$ 250,00
Saldo final: R$ 750,00
```

**Explicação:**

Depositar 1000 e sacar 250 funcionaram. O saque de 5000 e o depósito de −10 lançaram exceções, que foram capturadas pelos `try/catch` e mostradas como "Recusado". O extrato só tem as duas operações válidas e o saldo final é 750.

**2.3 Tentativa 1: `$conta->saldo = -300;`**: `php q07-encapsulamento/teste-protecao.php`

```text
Recusado: Saldo insuficiente.
Recusado: Depósito inválido.

Extrato de João:
- Depósito: R$ 1.000,00
- Saque: R$ 250,00
Saldo final: R$ 750,00

--- tentativas por fora ---

Fatal error: Uncaught Error: Cannot access private property ContaBancaria::$saldo in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q07-encapsulamento\teste-protecao.php:9
Stack trace:
#0 {main}
  thrown in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q07-encapsulamento\teste-protecao.php on line 9
```

**Explicação:**

Primeiro roda o `conta.php` (por causa do `require`). Depois a tentativa de mudar o saldo de fora foi bloqueada: o `$saldo` é `private`, então o PHP gera um erro e para.

**2.4 Tentativa 2: `$conta->registrar(...)`**

```text
Recusado: Saldo insuficiente.
Recusado: Depósito inválido.

Extrato de João:
- Depósito: R$ 1.000,00
- Saque: R$ 250,00
Saldo final: R$ 750,00

--- tentativas por fora ---

Fatal error: Uncaught Error: Call to private method ContaBancaria::registrar() from global scope in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q07-encapsulamento\teste-protecao.php:10
Stack trace:
#0 {main}
  thrown in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q07-encapsulamento\teste-protecao.php on line 10
```

**Explicação:**

Tentei colocar um depósito falso no extrato chamando `registrar()` de fora. Como o método é `private`, só pode ser chamado de dentro da classe; do "escopo global" o PHP recusa.

**2.5 Tentativa 3: `echo $conta->saldo;`**

```text
Recusado: Saldo insuficiente.
Recusado: Depósito inválido.

Extrato de João:
- Depósito: R$ 1.000,00
- Saque: R$ 250,00
Saldo final: R$ 750,00

--- tentativas por fora ---

Fatal error: Uncaught Error: Cannot access private property ContaBancaria::$saldo in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q07-encapsulamento\teste-protecao.php:11
Stack trace:
#0 {main}
  thrown in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q07-encapsulamento\teste-protecao.php on line 11
```

**Explicação:**

Nem ler o atributo privado é permitido de fora. Para consultar o saldo é preciso usar `getSaldo()`.

## 3. Perguntas

**a) Por que a conta não tem um método `setSaldo()`?**

Porque o saldo só deve mudar por depósitos e saques, que validam o valor e registram no extrato. Um `setSaldo()` permitiria colocar qualquer valor (até negativo), voltando ao problema da saída 2.1.

**b) Qual a diferença entre a versão original (`echo` + `return`) e a nova (`throw`) quando uma operação é inválida?**

Na original o método só imprimia uma mensagem e saía; quem chamou não ficava sabendo que deu errado e o programa seguia. Com `throw` a operação é interrompida com uma exceção, e quem chamou é obrigado a tratar com `try/catch` (senão o programa para). A mensagem também pode ser mostrada do jeito que quisermos, como "Recusado: ...".

**c) O que acontece com o saldo quando um saque é recusado? Use a saída 2.2.**

Nada: o saldo não muda. O `throw` acontece antes da linha que subtrai, então o saque de 5000 não alterou nada. Na saída 2.2 o saldo final continuou R$ 750,00 e o extrato não tem esse saque.
