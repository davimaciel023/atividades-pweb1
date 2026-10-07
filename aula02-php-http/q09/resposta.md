# Q09 – Método HTTP e código de status

## Código

[q09-somente-post.php](q09-somente-post.php):

- Envia `Content-Type: application/json; charset=utf-8`.
- Lê o método em `$_SERVER['REQUEST_METHOD']`.
- Se o método **não** for POST: status `405`, cabeçalho `Allow: POST`, JSON `{"erro": "Método não permitido"}` e `exit` para encerrar o script.
- Se for POST: status `200` e JSON `{"sucesso": "Dados recebidos"}`.
- O JSON é gerado com `json_encode` e `JSON_UNESCAPED_UNICODE`, para o `é` não virar `é`.

## 3. Saídas

### `curl.exe -i http://localhost:8000/q09/q09-somente-post.php`

```
HTTP/1.1 405 Method Not Allowed
Host: localhost:8000
Date: Wed, 07 Oct 2026 20:40:33 GMT
Connection: close
X-Powered-By: PHP/8.4.25
Content-Type: application/json; charset=utf-8
Allow: POST

{"erro":"Método não permitido"}
```

### `curl.exe -i -X POST http://localhost:8000/q09/q09-somente-post.php`

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 07 Oct 2026 20:40:33 GMT
Connection: close
X-Powered-By: PHP/8.4.25
Content-Type: application/json; charset=utf-8

{"sucesso":"Dados recebidos"}
```

### `curl.exe -i -X PUT http://localhost:8000/q09/q09-somente-post.php`

```
HTTP/1.1 405 Method Not Allowed
Host: localhost:8000
Date: Wed, 07 Oct 2026 20:40:33 GMT
Connection: close
X-Powered-By: PHP/8.4.25
Content-Type: application/json; charset=utf-8
Allow: POST

{"erro":"Método não permitido"}
```

## 4. Log do servidor

```
[::1]:57268 [405]: GET /q09/q09-somente-post.php
[::1]:57269 [200]: POST /q09/q09-somente-post.php
[::1]:57270 [405]: PUT /q09/q09-somente-post.php
```

Cada linha do log tem o formato `[cliente] [status]: MÉTODO caminho`. O **status** aparece entre colchetes, logo depois do endereço do cliente, e o **método** vem logo depois dos dois pontos. GET e PUT receberam 405 e POST recebeu 200.

## 5. No navegador

Ao abrir o endereço digitando na barra de endereços, o navegador usa o método **GET**. O servidor responde com status **405** e o JSON `{"erro":"Método não permitido"}`. Um navegador não consegue fazer POST só digitando a URL: isso exige um formulário ou JavaScript. Por isso a API precisa ser testada com `curl -X POST`.
