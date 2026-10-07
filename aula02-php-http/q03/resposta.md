# Q03 – Aspas e concatenação

## 4. Chaves em `{$semestre}` e espaço em `$nome . $curso`

### Para que servem as chaves em `{$semestre}`

Dentro de aspas duplas, o PHP substitui variáveis pelo valor. As chaves `{ }` marcam onde o nome da variável termina:

```php
echo "Cursa o {$semestre}º semestre de $curso";
```

Sem as chaves (`"$semestreº"`), o PHP leria `semestreº` como o nome da variável, porque o `º` é um caractere que pode fazer parte de nome de variável. Essa variável não existe, então o PHP mostraria um aviso de variável indefinida e o número `2` não apareceria. Com `{$semestre}` o nome fica `semestre`, e o `º` sai como texto normal: "Cursa o 2º semestre de ADS".

As chaves também servem para separar a variável de letras coladas nela e para acessar arrays e propriedades dentro da string, como `"{$aluno['nome']}"`.

### Como colocar um espaço em `$nome . $curso`

O operador `.` só junta os valores, sem espaço. `echo $nome . $curso;` mostra `MariaADS`. O espaço precisa entrar como uma string no meio da concatenação:

```php
echo $nome . " " . $curso;   // Maria ADS
```

Outras formas que dão o mesmo resultado:

```php
echo "$nome $curso";         // aspas duplas, o espaço fica dentro da string
echo $nome, " ", $curso;     // echo com vírgulas
```
