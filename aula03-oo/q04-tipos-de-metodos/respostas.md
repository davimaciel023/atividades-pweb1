# Questão 04: Tipos de métodos

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `termostato.php` | Fornecido. Você acrescenta dois métodos no item 4 |

## 1. Análise do código

**1.1 ANTES de executar, classifique os métodos:**

| Método | Tipo de retorno | Recebe parâmetro? | Altera o objeto? | Tipo do método |
|---|---|---|---|---|
| `getTemperatura()` | `float` | Não | Não | Com retorno (de consulta / getter) |
| `definirAlvo()` | `void` | Sim (`float $alvo`) | Sim | Com parâmetros / modificador |
| `resfriar()` | `void` | Sim (`float $graus`) | Sim | Com parâmetros / modificador |
| `precisaResfriar()` | `bool` | Não | Não | De consulta (com retorno) |
| `mostrarStatus()` | `void` | Não | Não | De ação |

**1.2 ANTES de executar, escreva as 5 linhas que você espera ver na saída:**

```text
Laboratório 1: 25.0 °C (alvo 22.0 °C) - resfriando
Laboratório 1: 23.0 °C (alvo 22.0 °C) - resfriando
Laboratório 1: 23.0 °C (alvo 24.0 °C) - ok
33
bool(false)
```

**1.3 Cole os dois métodos novos (`aquecer` e `diferencaParaAlvo`) e classifique cada um.**

```php
public function aquecer(float $graus): void
{
    $this->temperatura += $graus;
}

public function diferencaParaAlvo(): float
{
    return $this->temperatura - $this->alvo;
}
```

- `aquecer()`: com parâmetros / modificador, pois recebe os graus e altera a temperatura, sem retornar nada.
- `diferencaParaAlvo()`: com retorno / de consulta, pois devolve um `float` e não altera o objeto.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída do código original**: `php q04-tipos-de-metodos/termostato.php`

```text
Laboratório 1: 25 °C (alvo 22 °C) - resfriando
Laboratório 1: 23 °C (alvo 22 °C) - resfriando
Laboratório 1: 23 °C (alvo 24 °C) - ok
33
bool(false)
```

**Explicação:**

Começa em 25 °C com alvo 22, então precisa resfriar. Depois de `resfriar(2)` fica 23, ainda acima de 22. Com `definirAlvo(24)` o alvo sobe e 23 já não é maior que 24, então fica "ok". O `echo` mostra 23 + 10 = 33, e o `var_dump` mostra `false` porque não precisa mais resfriar.

**2.2 Saída com os métodos novos**

```text
Laboratório 1: 25 °C (alvo 22 °C) - resfriando
Laboratório 1: 23 °C (alvo 22 °C) - resfriando
Laboratório 1: 23 °C (alvo 24 °C) - ok
33
bool(false)
Laboratório 1: 28 °C (alvo 24 °C) - resfriando
Diferença para o alvo: 4 °C
```

**Explicação:**

As cinco primeiras linhas são iguais. Depois `aquecer(5)` levou a temperatura de 23 para 28, que é maior que o alvo 24, então volta a "resfriando". A diferença para o alvo é 28 − 24 = 4.

## 3. Perguntas

**a) Sua previsão do item 1.2 acertou todas as linhas? Explique cada diferença.**

Acertei os valores e as situações, mas errei a formatação: eu previ `25.0`, `22.0` etc., e o PHP mostrou `25`, `22`. Quando um `float` sem parte decimal é convertido para texto, o PHP não mostra o `.0`. As linhas `33` e `bool(false)` saíram como previ.

**b) Por que `echo $sala->getTemperatura() + 10` funciona, mas `$sala->mostrarStatus() + 10` não faria sentido?**

`getTemperatura()` devolve um número (`float`), então dá para somar 10. `mostrarStatus()` é `void`: só imprime e não devolve nada (o resultado é `null`), então não existe um valor para somar.

**c) Qual método chama outro método do mesmo objeto?**

O `mostrarStatus()`, que chama `$this->precisaResfriar()` para decidir se escreve "resfriando" ou "ok".
