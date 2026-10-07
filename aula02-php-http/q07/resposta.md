# Q07 – O dado pode não vir, o dado pode ser perigoso

## 1. Os dois problemas do código

```php
$nome = $_GET['nome'];
echo "Olá, " . $nome;
```

1. **Ausência do parâmetro:** se a URL não trouxer `nome`, o índice `$_GET['nome']` não existe e o PHP emite um aviso.
2. **Saída sem escape:** o valor vindo da URL é impresso do jeito que chegou. Se ele tiver HTML ou JavaScript, o navegador interpreta como código da página (XSS).

## 2. Antes de corrigir

Acessando `saudacao.php` sem parâmetros, o log fica assim:

```
[::1]:60623 Accepted
[::1]:60623 [200]: GET /q07/q07-tratamento.php
[::1]:60623 Closing
```

A resposta sai com status 200, mas com o aviso dentro da página:

```
<br />
<b>Warning</b>:  Undefined array key "nome" in <b>...\q07\q07-tratamento.php</b> on line <b>2</b><br />
Olá, 
```

Com `curl.exe -s "http://localhost:8000/q07/q07-tratamento.php?nome=<b>Oi</b>"`:

```
Olá, <b>Oi</b>
```

A tag `<b>` foi devolvida como veio. No navegador, "Oi" apareceria em negrito, ou seja, o visitante conseguiu injetar HTML na página.

Log da requisição:

```
[::1]:60625 [200]: GET /q07/q07-tratamento.php?nome=<b>Oi</b>
```
