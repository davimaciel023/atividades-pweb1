# Questão 02: Lendo erros de objetos

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `erros.php` | Fornecido com quatro erros. Corrija um de cada vez |

## 1. Análise do código

**1.1 Preencha a tabela, na ordem em que os erros apareceram:**

| Rodada | Linha | Tipo da mensagem (Warning ou Fatal error) | O que estava errado | Como corrigiu |
|---|---|---|---|---|
| 1 | 19 | Warning (e um Deprecated) | `$aluno->$nome` tinha um `$` a mais antes do nome do atributo | Troquei por `$aluno->nome` |
| 2 | 20 | Fatal error (TypeError) | O semestre recebia o texto `'3'`, mas o atributo é `int` | Troquei por `$aluno->semestre = 3;` |
| 3 | 21 | Fatal error (Error) | O atributo `$curso` era lido sem nunca ter recebido valor | Acrescentei `$aluno->curso = 'ADS';` |
| 4 | 14 | Warning | Dentro do método foi usado `$nome` em vez de `$this->nome` | Troquei por `{$this->nome}` |

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Rodada 1**: `php q02-lendo-erros/erros.php`

```text
Warning: Undefined variable $nome in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q02-lendo-erros\erros.php on line 19

Deprecated: Creation of dynamic property Aluno::$ is deprecated in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q02-lendo-erros\erros.php on line 19

Fatal error: Uncaught TypeError: Cannot assign string to property Aluno::$semestre of type int in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q02-lendo-erros\erros.php:20
Stack trace:
#0 {main}
  thrown in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q02-lendo-erros\erros.php on line 20
```

**2.2 Rodada 2**

```text
Fatal error: Uncaught TypeError: Cannot assign string to property Aluno::$semestre of type int in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q02-lendo-erros\erros.php:20
Stack trace:
#0 {main}
  thrown in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q02-lendo-erros\erros.php on line 20
```

**2.3 Rodada 3**

```text
Fatal error: Uncaught Error: Typed property Aluno::$curso must not be accessed before initialization in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q02-lendo-erros\erros.php:21
Stack trace:
#0 {main}
  thrown in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q02-lendo-erros\erros.php on line 21
```

**2.4 Rodada 4**

```text
Curso: ADS

Warning: Undefined variable $nome in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q02-lendo-erros\erros.php on line 14
Sou , do 3º semestre.
```

**2.5 Execução final, sem erros**

```text
Curso: ADS
Sou Carla, do 3º semestre.
```

**Explicação:**

A cada rodada eu li só a primeira mensagem, corrigi a linha indicada e executei de novo. Na rodada 1 o `$nome` virou uma variável indefinida (o PHP 8.4 também avisou que ia criar uma propriedade dinâmica sem nome). Na 2 o PHP recusou o texto no atributo `int`. Na 3 ele recusou ler o curso sem valor. Na 4 o programa já rodava, mas o nome saía vazio porque o método usava `$nome` em vez de `$this->nome`. No final apareceu a saída esperada.

## 3. Perguntas

**a) Na rodada 1 apareceram duas mensagens. Qual delas parou o programa? Qual a diferença entre `Warning` e `Fatal error`?**

Quem parou o programa foi o `Fatal error` da linha 20 (no meu PHP 8.4 apareceu também um `Deprecated`, que é só um aviso). O `Warning` avisa que algo está errado, mas o programa continua executando; o `Fatal error` interrompe a execução ali mesmo.

**b) Por que o erro do `$curso` só aparece na linha do `echo`, e não na linha do `new Aluno()`?**

Porque criar o objeto sem dar valor ao atributo é permitido: o atributo fica "não inicializado". O erro só acontece quando tentamos ler esse atributo, o que acontece no `echo`.

**c) Dentro do método, por que é preciso escrever `$this->nome`, e não só `$nome`?**

Porque `$nome` sozinho é uma variável local do método, que não existe. `$this` é o próprio objeto que chamou o método, e `$this->nome` acessa o atributo desse objeto.
