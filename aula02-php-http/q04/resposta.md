# Q04 – Tipos e conversões

## 2. Saída do `var_dump` e explicação

```
int(15)
string(3) "105"
float(3.5)
int(1)
int(3)
bool(false)
bool(true)
bool(false)
```

| Linha | Resultado | Explicação |
|---|---|---|
| `"10" + 5` | `int(15)` | O `+` é aritmético, então o PHP converte `"10"` para número e soma. |
| `"10" . 5` | `string(3) "105"` | O `.` é concatenação, então o PHP converte `5` para texto e junta os dois. |
| `7 / 2` | `float(3.5)` | A divisão `/` devolve float quando não é exata. |
| `7 % 2` | `int(1)` | O `%` devolve o resto da divisão inteira. |
| `(int) "3.9 kg"` | `int(3)` | O PHP lê o número do início da string (`3.9`), ignora ` kg` e o cast para int trunca a parte decimal, sem arredondar. |
| `(bool) "0"` | `bool(false)` | A string `"0"` é uma das strings consideradas falsas pelo PHP. |
| `(bool) "false"` | `bool(true)` | Qualquer string não vazia, exceto `"0"`, é verdadeira. O PHP não lê o texto "false" como valor lógico. |
| `0.1 + 0.2 == 0.3` | `bool(false)` | Floats são guardados em binário e `0.1 + 0.2` dá `0.30000000000000004`, que é diferente de `0.3`. |

## 3. Diferença entre `"10" + 5` e `"10" . 5`

`+` e `.` fazem operações diferentes, e o operador decide a conversão. Com `+`, os operandos viram números e o resultado é `int(15)`. Com `.`, os operandos viram strings e o resultado é a string `"105"`.

`(bool) "0"` dá `false` e `(bool) "false"` dá `true` porque na conversão para bool o PHP olha só o conteúdo como valor, não como palavra. `"0"` está na lista de valores falsos (junto com `""`, `0`, `0.0`, `[]` e `null`). `"false"` é uma string com 5 caracteres, então é verdadeira.

## 4. Linhas acrescentadas

```php
var_dump("5" == 5);
var_dump("5" === 5);
```

```
bool(true)
bool(false)
```

- `"5" == 5` é `true`: o `==` converte os tipos antes de comparar, então `"5"` vira o número 5.
- `"5" === 5` é `false`: o `===` compara também o tipo, e string não é int.

Por isso é mais seguro usar `===` quando o tipo importa.
