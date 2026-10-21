# Questão 07: Encapsulamento

**Nível:** 🔴 Avançado

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `conta.php` | A conta da aula. Você encapsula |
| `teste-protecao.php` | Fornecido: três tentativas de burlar a classe |

## 1. Análise do código

**1.1 Cole a sua classe e explique: quais atributos e métodos são `private`, quais são `public` e por quê.**

_(responda aqui)_

**1.2 Explique o método privado `registrar()` e como o extrato é montado.**

_(responda aqui)_

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída com `$conta->saldo = -300;` na versão original (item 1)**

```text
(cole aqui a saída do terminal)
```

**Explicação:**

_(responda aqui)_

**2.2 Saída da versão encapsulada**: `php q07-encapsulamento/conta.php`

```text
(cole aqui a saída do terminal)
```

**Explicação:**

_(responda aqui)_

**2.3 Tentativa 1: `$conta->saldo = -300;`**: `php q07-encapsulamento/teste-protecao.php`

```text
(cole aqui a saída do terminal)
```

**Explicação:**

_(responda aqui)_

**2.4 Tentativa 2: `$conta->registrar(...)`**

```text
(cole aqui a saída do terminal)
```

**Explicação:**

_(responda aqui)_

**2.5 Tentativa 3: `echo $conta->saldo;`**

```text
(cole aqui a saída do terminal)
```

**Explicação:**

_(responda aqui)_

## 3. Perguntas

**a) Por que a conta não tem um método `setSaldo()`?**

_(responda aqui)_

**b) Qual a diferença entre a versão original (`echo` + `return`) e a nova (`throw`) quando uma operação é inválida?**

_(responda aqui)_

**c) O que acontece com o saldo quando um saque é recusado? Use a saída 2.2.**

_(responda aqui)_
