# Questão 08: Desafio: a turma na web

**Nível:** 🔴 Avançado

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `turma.php` | Você cria do zero: as classes `Aluno` e `Disciplina` e a página HTML |

## 1. Análise do código

**1.1 Desenhe (em texto ou tabela) as duas classes: atributos com tipo e visibilidade e métodos com tipo de retorno.**

```text
+------------------------------------------------+
| Aluno                                          |
+------------------------------------------------+
| - nome: string                                 |
| - nota1: float                                 |
| - nota2: float                                 |
+------------------------------------------------+
| + __construct(string, float, float)            |
| + getNome(): string                            |
| + calcularMedia(): float                       |
| + situacao(): string                           |
+------------------------------------------------+

+------------------------------------------------+
| Disciplina                                     |
+------------------------------------------------+
| - nome: string                                 |
| - alunos: array = []                           |
+------------------------------------------------+
| + __construct(string)                          |
| + getNome(): string                            |
| + getAlunos(): array                           |
| + adicionarAluno(Aluno): void                  |
| + calcularMediaTurma(): float                  |
| + contarAprovados(): int                       |
+------------------------------------------------+

(- = private, + = public)
```

**1.2 Explique `adicionarAluno(Aluno $aluno)`: o que significa um parâmetro do tipo de uma classe?**

Significa que o método só aceita um objeto da classe `Aluno`. Se for passado outro tipo (um texto, um número), o PHP recusa com `TypeError`. Assim a lista `$alunos` só guarda alunos de verdade, e os outros métodos podem chamar `calcularMedia()` e `situacao()` em cada item com segurança.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Resposta da página**: `curl.exe -i http://localhost:8000/q08-turma-web/turma.php`

```text
HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 21 Oct 2026 18:54:30 GMT
Connection: close
X-Powered-By: PHP/8.4.25
Content-type: text/html; charset=UTF-8

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Programação Web I</title>
</head>
<body>
    
    <h1>Programação Web I</h1>

    <table border="1">
        <tr>
            <th>Aluno</th>
            <th>Média</th>
            <th>Situação</th>
        </tr>
                    <tr>
                <td>Ana</td>
                <td>8,8</td>
                <td>Aprovado</td>
            </tr>
                    <tr>
                <td>Bruno</td>
                <td>5,5</td>
                <td>Recuperação</td>
            </tr>
                    <tr>
                <td>Caio</td>
                <td>2,8</td>
                <td>Reprovado</td>
            </tr>
                    <tr>
                <td>Daniela</td>
                <td>7,0</td>
                <td>Aprovado</td>
            </tr>
            </table>

    <p>Média da turma: 6,00</p>
    <p>Aprovados: 2 de 4</p>
</body>
</html>
```

**Explicação:**

O `-i` mostra os cabeçalhos: status `200 OK` e `Content-type: text/html`. Depois vem o HTML gerado pelo PHP: a tabela com os quatro alunos, a média da turma 6,00 ((8,75 + 5,5 + 2,75 + 7,0) / 4) e 2 de 4 aprovados (Ana e Daniela), como esperado.

**2.2 Trecho da resposta com `?teste=1`**: `curl.exe -s "http://localhost:8000/q08-turma-web/turma.php?teste=1"`

```text
<body>
            <p><strong>Recusado:</strong> Nota inválida para Eduardo: use valores de 0 a 10.</p>
    
    <h1>Programação Web I</h1>
```

**Explicação:**

Com `?teste=1` a página tentou criar o aluno Eduardo com nota 11. O construtor do `Aluno` lançou a exceção, o `try/catch` capturou e a mensagem apareceu no topo. O Eduardo não foi adicionado, então a tabela, a média e os aprovados continuaram iguais.

**2.3 Log do servidor das duas requisições**

```text
[Wed Oct 21 15:54:29 2026] PHP 8.4.25 Development Server (http://localhost:8000) started
[Wed Oct 21 15:54:30 2026] [::1]:61996 Accepted
[Wed Oct 21 15:54:30 2026] [::1]:61996 [200]: GET /q08-turma-web/turma.php
[Wed Oct 21 15:54:30 2026] [::1]:61996 Closing
[Wed Oct 21 15:54:30 2026] [::1]:61997 Accepted
[Wed Oct 21 15:54:30 2026] [::1]:61997 [200]: GET /q08-turma-web/turma.php?teste=1
[Wed Oct 21 15:54:30 2026] [::1]:61997 Closing
```

**Explicação:**

Cada requisição aparece separada: a conexão é aceita (`Accepted`), o GET é respondido com status 200 e a conexão é fechada (`Closing`). A segunda usou outra porta do cliente (61997) e trouxe o `?teste=1` na URL.

**2.4 Erro ao passar um texto para `adicionarAluno` (pergunta a)**

```text
<br />
<b>Fatal error</b>:  Uncaught TypeError: Disciplina::adicionarAluno(): Argument #1 ($aluno) must be of type Aluno, string given, called in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q08-turma-web\turma.php on line 100 and defined in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q08-turma-web\turma.php:65
Stack trace:
#0 C:\Users\davimaciel\atividades-pweb1\aula03-oo\q08-turma-web\turma.php(100): Disciplina-&gt;adicionarAluno('Eduardo')
#1 {main}
  thrown in <b>C:\Users\davimaciel\atividades-pweb1\aula03-oo\q08-turma-web\turma.php</b> on line <b>65</b><br />
```

**Explicação:**

O método esperava um objeto `Aluno` e recebeu o texto `'Eduardo'`. O PHP gerou um `TypeError` e a página parou ali, sem mostrar nenhum HTML. Como é uma página web, o erro veio formatado com tags `<b>` e `<br />`.

## 3. Perguntas

**a) O que acontece ao chamar `$pweb->adicionarAluno('Eduardo')`? Por quê?**

Dá `Fatal error` com `TypeError`, porque o parâmetro é do tipo `Aluno` e foi passada uma string. Para funcionar teria que ser `new Aluno('Eduardo', nota1, nota2)`.

**b) Os objetos `Aluno` continuam na memória do servidor entre uma requisição e outra? Use o log para justificar.**

Não. No log cada requisição é aceita, respondida e fechada (`Accepted` → `GET` → `Closing`). A cada requisição o PHP executa o script do zero, cria os objetos de novo e os descarta ao terminar. Por isso o Eduardo da requisição com `?teste=1` não interfere na seguinte.

**c) Por que `calcularMediaTurma()` verifica se a lista está vazia antes de dividir?**

Porque a média é a soma dividida pela quantidade de alunos. Sem alunos a divisão seria por zero, o que gera erro (`DivisionByZeroError`). Por isso, se a lista estiver vazia, o método devolve 0.
