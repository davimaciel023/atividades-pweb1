# Questão 03: Métodos e `$this`

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `aluno.php` | Fornecido com os métodos a completar |

## 1. Análise do código

**1.1 Cole o código dos três métodos que você escreveu e explique cada um.**

```php
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

public function apresentar(): void
{
    $media = number_format($this->calcularMedia(), 1, ',', '.');
    echo "{$this->nome}: média {$media} ({$this->situacao()})\n";
}
```

- `calcularMedia()` soma as duas notas do objeto e divide por 2, devolvendo um `float`.
- `situacao()` pega a média chamando `calcularMedia()` e devolve o texto da situação conforme a faixa da média.
- `apresentar()` formata a média com uma casa decimal e imprime o nome, a média e a situação.

**1.2 Classifique os três métodos: de ação, com retorno, com parâmetros, modificador ou de consulta? Justifique.**

- `calcularMedia()`: com retorno / de consulta, pois devolve um valor e não altera o objeto.
- `situacao()`: com retorno / de consulta, pois devolve um texto e também não altera nada.
- `apresentar()`: de ação, pois é `void` e só imprime na tela.

Nenhum deles recebe parâmetros nem modifica atributos.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída de**: `php q03-metodos-this/aluno.php`

```text
Ana: média 8,8 (Aprovado)
Bruno: média 5,5 (Recuperação)
Caio: média 2,8 (Reprovado)
```

**Explicação:**

Cada aluno chamou `apresentar()`. A Ana tem média 8,75 (aparece 8,8 por causa do arredondamento com uma casa) e foi aprovada; o Bruno ficou com 5,5, em recuperação; o Caio com 2,75 (2,8), reprovado. Bateu com a saída esperada.

**2.2 Saída com o quarto aluno (notas 6,5 e 7,5)**

```text
Ana: média 8,8 (Aprovado)
Bruno: média 5,5 (Recuperação)
Caio: média 2,8 (Reprovado)
Davi: média 7,0 (Aprovado)
```

**Explicação:**

Criei o aluno Davi com notas 6,5 e 7,5. A média deu exatamente 7,0 e a situação foi Aprovado, porque a condição é média maior ou igual a 7.

## 3. Perguntas

**a) Por que `situacao()` chama `$this->calcularMedia()` em vez de repetir a conta?**

Para não repetir código. A conta da média fica em um só lugar; se um dia ela mudar, basta alterar `calcularMedia()` e `situacao()` continua certa.

**b) Com média exatamente 7,0, qual é a situação? Qual linha do código decide isso?**

Aprovado. Quem decide é a linha `if ($media >= 7)`, porque usa "maior ou igual".

**c) O método `apresentar()` foi escrito uma vez. Como ele sabe se deve mostrar a Ana ou o Bruno?**

Pelo `$this`. Quando escrevo `$ana->apresentar()`, o `$this` dentro do método é a Ana; em `$bruno->apresentar()`, o `$this` é o Bruno. Então `$this->nome` e as notas são as do objeto que chamou.
