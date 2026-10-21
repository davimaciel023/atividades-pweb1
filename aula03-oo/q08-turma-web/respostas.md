# Questão 08: Desafio: a turma na web

**Nível:** 🔴 Avançado

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `turma.php` | Você cria do zero: as classes `Aluno` e `Disciplina` e a página HTML |

## 1. Análise do código

**1.1 Desenhe (em texto ou tabela) as duas classes: atributos com tipo e visibilidade e métodos com tipo de retorno.**

**1.2 Explique `adicionarAluno(Aluno $aluno)`: o que significa um parâmetro do tipo de uma classe?**

_(responda aqui)_

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Resposta da página**: `curl.exe -i http://localhost:8000/q08-turma-web/turma.php`

```text
(cole aqui a saída do terminal)
```

**Explicação:**

_(responda aqui)_

**2.2 Trecho da resposta com `?teste=1`**: `curl.exe -s "http://localhost:8000/q08-turma-web/turma.php?teste=1"`

```text
(cole aqui a saída do terminal)
```

**Explicação:**

_(responda aqui)_

**2.3 Log do servidor das duas requisições**

```text
(cole aqui a saída do terminal)
```

**Explicação:**

_(responda aqui)_

**2.4 Erro ao passar um texto para `adicionarAluno` (pergunta a)**

```text
(cole aqui a saída do terminal)
```

**Explicação:**

_(responda aqui)_

## 3. Perguntas

**a) O que acontece ao chamar `$pweb->adicionarAluno('Eduardo')`? Por quê?**

_(responda aqui)_

**b) Os objetos `Aluno` continuam na memória do servidor entre uma requisição e outra? Use o log para justificar.**

_(responda aqui)_

**c) Por que `calcularMediaTurma()` verifica se a lista está vazia antes de dividir?**

_(responda aqui)_
