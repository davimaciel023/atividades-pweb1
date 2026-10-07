# Q06 – Strings e acentuação

## 1. Código original

```php
$palavra = $_GET['palavra'] ?? "Ceara";
echo "<p>Palavra: $palavra</p>";
echo "<p>strlen: " . strlen($palavra) . "</p>";
```

- Lê o parâmetro `palavra` da URL. Se ele não vier, usa `"Ceara"`.
- Mostra a palavra, interpolada dentro das aspas duplas.
- Mostra o resultado de `strlen`, que conta **bytes**, não caracteres.

## 2. Código completo

Em [q06-strings.php](q06-strings.php), com `mb_strlen`, `strtoupper`, `mb_strtoupper` e um `if` que classifica como "palavra curta" (até 5 letras, medido com `mb_strlen`) ou "palavra longa".

## 3. Saída com `?palavra=Ceara`

```
curl.exe -s "http://localhost:8000/q06/q06-strings.php?palavra=Ceara"
```

```
<p>Palavra: Ceara</p>
<p>strlen: 5</p>
<p>mb_strlen: 5</p>
<p>strtoupper: CEARA</p>
<p>mb_strtoupper: CEARA</p>
<p>Classificação: palavra curta</p>
```

Sem acento, todos os valores batem: cada letra ocupa 1 byte.

## 4. Linha do log com `?palavra=Ceará`

```
[::1]:63888 [200]: GET /q06/q06-strings.php?palavra=Cear%C3%A1
```

O navegador não envia o `á` cru na URL. Ele codifica os bytes do caractere em UTF-8 como `%XX`. O `á` ocupa 2 bytes em UTF-8 (`C3 A1`), por isso vira `%C3%A1`. As letras sem acento seguem iguais.

## 5. Comparação entre `Ceara` e `Ceará`

| Função | `Ceara` | `Ceará` |
|---|---|---|
| `strlen` | 5 | **6** |
| `mb_strlen` | 5 | 5 |
| `strtoupper` | CEARA | CEAR**á** |
| `mb_strtoupper` | CEARA | CEAR**Á** |

- `strlen` conta bytes. O `á` ocupa 2 bytes em UTF-8, então "Ceará" dá 6. `mb_strlen` conta caracteres e dá 5.
- `strtoupper` trabalha byte a byte e só converte as letras ASCII. O `á` ficou minúsculo. `mb_strtoupper` entende UTF-8 e converteu para `Á`.
- Por isso a classificação deve usar `mb_strlen`. Com `strlen`, "Ceará" contaria 6 e seria classificada como longa por causa do acento.

## Problema encontrado: `mb_strlen` indefinida

Na primeira execução apareceu `Uncaught Error: Call to undefined function mb_strlen()`. O PHP desta máquina está sem `php.ini`, então a extensão `mbstring` não estava ativa. Para o teste, ela foi carregada na linha de comando:

```
php -d extension_dir="<pasta do php>/ext" -d extension=mbstring -S localhost:8000
```

Para ativar de forma permanente: criar o `php.ini` a partir de `php.ini-development`, tirar o `;` de `extension=mbstring` e reiniciar o servidor.
