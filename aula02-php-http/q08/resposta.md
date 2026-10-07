# Q08 – O que o navegador entende? (Content-Type)

## 1. `json_encode`, `JSON_PRETTY_PRINT` e `JSON_UNESCAPED_UNICODE`

- `json_encode($dados)` converte o array PHP em texto JSON.
- `JSON_PRETTY_PRINT` formata o JSON com quebras de linha e indentação, para ficar legível. Sem ele, tudo sai em uma linha só.
- `JSON_UNESCAPED_UNICODE` mantém os caracteres acentuados como estão (`ç`, `ã`). Sem ele, o PHP escreve cada um como sequência `\uXXXX`.

## 2. Resposta com o `header` comentado

```
curl.exe -i http://localhost:8000/q08/q08-content-type.php
```

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 07 Oct 2026 20:36:40 GMT
Connection: close
X-Powered-By: PHP/8.4.25
Content-type: text/html; charset=UTF-8

{
    "disciplina": "Programação Web I",
    "status": "Ativo",
    "alunos": 30
}
```

Sem a linha `header(...)`, o PHP usa o padrão `text/html`. O navegador trata o corpo como uma página HTML, não como JSON.

## 3. Resposta com o `header` ativo

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 07 Oct 2026 20:36:40 GMT
Connection: close
X-Powered-By: PHP/8.4.25
Content-Type: application/json; charset=utf-8

{
    "disciplina": "Programação Web I",
    "status": "Ativo",
    "alunos": 30
}
```

## 4. O que mudou e o que não mudou

- **Mudou:** só o cabeçalho `Content-Type`, de `text/html; charset=UTF-8` para `application/json; charset=utf-8`.
- **Não mudou:** o corpo da resposta, que é exatamente o mesmo texto, e o status `200 OK`.

O `Content-Type` diz ao cliente como interpretar o corpo. Com `text/html`, o navegador tenta renderizar como HTML (espaços e quebras de linha são juntados). Com `application/json`, ele sabe que é JSON e pode mostrar com o visualizador de JSON. Por isso o cabeçalho importa, e não o conteúdo.

## 5. Sem `JSON_UNESCAPED_UNICODE`

Com a opção retirada (`json_encode($dados, JSON_PRETTY_PRINT)`):

```
{
    "disciplina": "Programação Web I",
    "status": "Ativo",
    "alunos": 30
}
```

"Programação" virou `Programação`. O `ç` e o `ã` foram trocados por `ç` e `ã`, que são os códigos Unicode dos dois caracteres. É JSON válido e quem ler o JSON recupera o texto original, mas fica ilegível para uma pessoa. A opção deixa as letras acentuadas visíveis na saída.

## Observação

Os prints do DevTools (`prints/devtools-html.png` e `prints/devtools-json.png`) precisam ser tirados no navegador, na aba Network.
