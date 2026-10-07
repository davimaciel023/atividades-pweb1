# Q01 – Primeiro script PHP

## 1. Linhas HTML × PHP

- **PHP:** linhas 11–13 (`<?php echo ... ?>`) e linha 16 (`<?= date('H:i:S') ?>`).
- **HTML:** todas as outras linhas.

Diferença: `<?php echo ... ?>` abre um bloco PHP e precisa do `echo` para imprimir. `<?= ... ?>` é um atalho que já imprime o valor.

## 2. Log do Terminal 1

```
[::1]:54118 Accepted
[::1]:54118 [200]: GET /q01/q01-primeiro-script.php
[::1]:54118 Closing
```

- `Accepted`: o navegador conectou ao servidor.
- `[200]: GET /q01/q01-primeiro-script.php`: o navegador pediu essa página e o servidor respondeu 200 (deu certo).
- `Closing`: a conexão foi encerrada.

## 3. F5 três vezes

- Na página, só a hora muda. O resto fica igual.
- No log, aparece uma nova requisição `GET` a cada F5.

## 4. Ctrl+U

Não aparece PHP. O PHP roda no servidor e o navegador recebe só o HTML já pronto.

## 5. curl -i

```
HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 07 Oct 2026 19:05:24 GMT
Connection: close
X-Powered-By: PHP/8.4.25
Content-type: text/html; charset=UTF-8

<!DOCTYPE html>
<html lang="en">
...
    <h1>Olá, turma</h1>
    <p>
        Este texto foi gerado pelo php    </p>
    <p>Hora no servidor: 
        19:05:th    </p>
</body>
</html>
```

- **Primeira linha:** `HTTP/1.1 200 OK` é a versão do protocolo e o status (sucesso).
- **Cabeçalhos:** informações sobre a resposta, como a data, o tipo do conteúdo (`text/html`) e o servidor (`PHP`).
- **Corpo:** o HTML final, depois de o PHP ter sido executado.
