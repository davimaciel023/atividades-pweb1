# Q05 – Média com dados da URL

## 1. Código original

- `const MEDIA_APROVACAO = 7;` define uma constante. Ela é escrita sem `$` e não pode ser alterada depois. Serve para guardar a média mínima em um lugar só.
- `($n1 + $n2) / 2` precisa de parênteses porque a divisão tem precedência sobre a soma. Sem eles, o PHP calcularia `$n1 + ($n2 / 2)`, que não é a média.
- `$media >= MEDIA_APROVACAO ? "Aprovado" : "Em recuperação"` é o operador ternário, um `if/else` em uma linha. Se a condição for verdadeira, vale o texto depois do `?`. Se for falsa, vale o texto depois do `:`.

## 2. Leitura das notas pela URL

```php
$n1 = (float) ($_GET['n1'] ?? 0);
$n2 = (float) ($_GET['n2'] ?? 0);
```

- `$_GET['n1']` pega o parâmetro `n1` da query string.
- `?? 0` usa `0` quando o parâmetro não existe, sem gerar aviso de índice indefinido.
- `(float)` converte o texto recebido para número.

## 3. Saídas

```
curl.exe -s "http://localhost:8000/q05/q05-media.php?n1=5&n2=6"
```

```
<p>Notas: 5 e 6</p>
<p>Média: 5.5</p>
<p>Situação: Em recuperação</p>
```

```
curl.exe -s "http://localhost:8000/q05/q05-media.php?n1=9"
```

```
<p>Notas: 9 e 0</p>
<p>Média: 4.5</p>
<p>Situação: Em recuperação</p>
```

Na segunda chamada `n2` não veio na URL, então virou `0` e a média caiu para 4.5.

## 4. Log das requisições

```
[::1]:51707 Accepted
[::1]:51707 [200]: GET /q05/q05-media.php?n1=5&n2=6
[::1]:51707 Closing
[::1]:51708 Accepted
[::1]:51708 [200]: GET /q05/q05-media.php?n1=9
[::1]:51708 Closing
```

Os valores das notas aparecem na linha `GET`, depois do `?`, porque a query string faz parte da URL. Por isso o log do servidor mostra os dados enviados. Isso é um motivo para não mandar dados sensíveis por GET.

## 5. Teste `?n1=abc&n2=10`

```
<p>Notas: 0 e 10</p>
<p>Média: 5</p>
<p>Situação: Em recuperação</p>
```

`"abc"` não começa com número, então `(float) "abc"` vira `0`. A média fica `(0 + 10) / 2 = 5`. O PHP não dá erro nem avisa que o valor era inválido, e o resultado fica errado sem que ninguém perceba. Para tratar isso seria preciso validar a entrada, por exemplo com `is_numeric()`.
