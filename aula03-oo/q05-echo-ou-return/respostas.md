# Questão 05: `echo` ou `return`?

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `retangulo.php` | Fornecido com métodos que imprimem. Você refatora |

## 1. Análise do código

**1.1 Cole a versão refatorada da classe e explique o que mudou em cada método.**

```php
class Retangulo
{
    public string $nome;
    public float $largura;
    public float $altura;

    public function area(): float
    {
        return $this->largura * $this->altura;
    }

    public function perimetro(): float
    {
        return 2 * ($this->largura + $this->altura);
    }

    public function ehQuadrado(): bool
    {
        return $this->largura === $this->altura;
    }
}
```

- `area()`: antes era `void` e imprimia "Área: ..."; agora devolve o valor da área como `float`.
- `perimetro()`: mesma mudança, agora devolve o perímetro em vez de imprimir.
- `ehQuadrado()`: método novo que devolve `true` se a largura for igual à altura.
- Acrescentei o atributo `$nome` para identificar cada ambiente.

**1.2 Explique como o total da área foi calculado no `foreach`.**

Antes do laço criei `$areaTotal = 0`. Em cada volta do `foreach` sobre o array `$ambientes`, mostro a área do ambiente e somo `$ambiente->area()` em `$areaTotal`. No final, `$areaTotal` tem 48 + 49 + 108 = 205.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída do código original**: `php q05-echo-ou-return/retangulo.php`

```text
Área: 48
Perímetro: 28
```

**Explicação:**

Os dois métodos imprimem direto: a área 8 × 6 = 48 e o perímetro 2 × (8 + 6) = 28.

**2.2 Saída do teste `var_dump($sala->area())` na versão original (item 2)**

```text
Área: 48
Perímetro: 28
Área: 48
NULL
```

**Explicação:**

A chamada `$sala->area()` dentro do `var_dump` imprimiu "Área: 48" de novo, mas o `var_dump` mostrou `NULL`, porque o método não devolve nenhum valor.

**2.3 Saída da versão refatorada**

```text
Sala de aula: 48 m² (retângulo)
Laboratório: 49 m² (quadrado)
Biblioteca: 108 m² (retângulo)
Área total: 205 m²
Rodapé necessário na biblioteca: 42 m
```

**Explicação:**

O `foreach` mostrou cada ambiente com a área e se é quadrado (só o laboratório, 7 × 7). Como os métodos agora devolvem valores, deu para somar a área total (205) e usar o perímetro da biblioteca, 2 × (12 + 9) = 42 m de rodapé.

## 3. Perguntas

**a) O que um método `void` devolve? Use a saída 2.2 para responder.**

Não devolve nada. Na prática o resultado é `null`, como mostrou o `var_dump` na saída 2.2.

**b) Por que não dava para somar as áreas na versão original?**

Porque `area()` só imprimia a área na tela e devolvia `null`. Não havia um número para guardar numa variável e somar.

**c) Cite uma situação em que um método com `echo` faz sentido.**

Quando o objetivo é só mostrar algo na tela, como um `apresentar()` ou `mostrarStatus()` que exibe os dados do objeto formatados para o usuário.
