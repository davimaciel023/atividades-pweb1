# Q10 – Cookies e a ordem da resposta HTTP

## Parte A – Contador de visitas

Código em [contador.php](contador.php): lê o cookie `visitas` com `$_COOKIE` (padrão 0), soma 1, grava com `setcookie` (validade de 1 hora) e mostra a mensagem.

### A.3 Duas chamadas sem guardar cookies

```
curl.exe -i http://localhost:8000/q10/contador.php
```

Primeira e segunda chamada deram a mesma saída:

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 07 Oct 2026 20:43:41 GMT
Connection: close
X-Powered-By: PHP/8.4.25
Set-Cookie: visitas=1; expires=Wed, 07 Oct 2026 21:43:41 GMT; Max-Age=3600
Content-type: text/html; charset=UTF-8

Você visitou esta página 1 vez(es).
```

**Por que não passa de 1:** o servidor manda o cookie no cabeçalho `Set-Cookie`, mas quem guarda e devolve o cookie é o cliente. O `curl` sem opções não guarda nada, então na chamada seguinte não envia o cookie `visitas`. Para o PHP, `$_COOKIE['visitas']` não existe, o valor padrão 0 é usado e o resultado é sempre 1. O HTTP não guarda estado: cada requisição é independente, e o estado fica no cliente.

### A.4 Três chamadas com `-c cookies.txt -b cookies.txt`

```
curl.exe -i -c cookies.txt -b cookies.txt http://localhost:8000/q10/contador.php
```

Terceira saída:

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 07 Oct 2026 20:43:42 GMT
Connection: close
X-Powered-By: PHP/8.4.25
Set-Cookie: visitas=3; expires=Wed, 07 Oct 2026 21:43:42 GMT; Max-Age=3600
Content-type: text/html; charset=UTF-8

Você visitou esta página 3 vez(es).
```

Conteúdo do `cookies.txt` no final:

```
localhost	FALSE	/q10	FALSE	1791409422	visitas	3
```

- `-c cookies.txt` (cookie-jar) **grava** no arquivo os cookies que o servidor mandar.
- `-b cookies.txt` **lê** do arquivo os cookies e os envia na requisição.

Juntas, as duas opções fazem o `curl` se comportar como um navegador: guarda o cookie recebido e o devolve na próxima chamada. Por isso o contador subiu para 1, 2 e 3.

## Parte B – O erro "headers already sent"

### B.1 `login.php` original

```php
<?php
echo "Carregando a página...";
setcookie("usuario_logado", "true", time() + 3600);
header("Location: dashboard.php");
```

```
curl.exe -i http://localhost:8000/q10/login.php
```

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 07 Oct 2026 20:43:42 GMT
Connection: close
X-Powered-By: PHP/8.4.25
Content-type: text/html; charset=UTF-8

Carregando a página...<br />
<b>Warning</b>:  Cannot modify header information - headers already sent by (output started at ...\q10\login.php:2) in <b>...\q10\login.php</b> on line <b>3</b><br />
<br />
<b>Warning</b>:  Cannot modify header information - headers already sent by (output started at ...\q10\login.php:2) in <b>...\q10\login.php</b> on line <b>4</b><br />
```

**Explicação do aviso:** o `echo` da linha 2 já mandou texto para o cliente. Numa resposta HTTP os cabeçalhos vêm antes do corpo, e quando o PHP começa a enviar o corpo ele fecha os cabeçalhos. Quando `setcookie` (linha 3) e `header` (linha 4) tentam adicionar cabeçalhos, é tarde demais. O PHP avisa "headers already sent by (output started at login.php:2)", apontando onde a saída começou. O resultado é um status 200 sem `Set-Cookie` e sem `Location`: o cookie não foi gravado e o redirecionamento não aconteceu.
