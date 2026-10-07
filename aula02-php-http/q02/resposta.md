# Q02 – Erros em PHP

## 1. Erro no código

Falta o `;` no fim da **linha 10** (`$curso = "ADS"`).

## 2. Erro no navegador (display_errors=1)

```
Parse error: syntax error, unexpected token "echo" in ...\q02\q02-erros.php on line 11
```

Log do Terminal 1:

```
[::1]:53622 Accepted
[::1]:53622 [200]: GET /q02/q02-erros.php - syntax error, unexpected token "echo" in ...\q02-erros.php on line 11
[::1]:53622 Closing
```

## 3. Com display_errors=0

A página fica em branco. Log do Terminal 1:

```
[::1]:56826 Accepted
[::1]:56826 [500]: GET /q02/q02-erros.php - syntax error, unexpected token "echo" in ...\q02-erros.php on line 11
[::1]:56826 Closing
```

## 4. Diferença de status

- `display_errors=1`: status **200**. O PHP escreve a mensagem de erro na própria página e a resposta sai como se tivesse dado certo.
- `display_errors=0`: status **500** (erro interno do servidor) e a página vazia. O status mostra que realmente houve erro, e o usuário não vê detalhes do código.

Em produção se usa `display_errors=0`, para não mostrar caminhos e detalhes do sistema.

## Por que a linha apontada é a 11 e não a 10

O PHP aponta a linha em que **percebeu** o problema. Ao ler a linha 10, ele ainda esperava um `;` ou mais código da mesma instrução. Só ao encontrar o `echo` na linha 11 ele viu que algo estava errado. O erro de verdade estava na linha anterior.

## 5. Correção

Linha 10 corrigida para:

```php
$curso = "ADS";
```

Testado: a página agora mostra "Bem-vindo ao curso de ADS".
