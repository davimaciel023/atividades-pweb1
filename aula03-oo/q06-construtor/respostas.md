# Questão 06: Construtor

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `produto.php` | O Produto da aula. Você acrescenta o construtor |
| `teste-erros.php` | Fornecido: três criações erradas, uma de cada vez |

## 1. Análise do código

**1.1 Cole o seu construtor e explique cada linha.**

```php
public function __construct(string $nome, float $preco, int $quantidade = 1)
{
    $this->nome = $nome;
    $this->preco = $preco;
    $this->quantidade = $quantidade;
}
```

- A primeira linha declara o construtor, que é chamado automaticamente no `new`, e recebe o nome, o preço e a quantidade (com valor padrão 1).
- `$this->nome = $nome;` guarda o nome recebido no atributo do objeto.
- `$this->preco = $preco;` guarda o preço.
- `$this->quantidade = $quantidade;` guarda a quantidade.

**1.2 Explique o `= 1` no parâmetro `$quantidade`.**

É um valor padrão. Se a quantidade não for informada no `new`, ela vale 1. Foi o que aconteceu com o Monitor, criado só com nome e preço.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída de**: `php q06-construtor/produto.php`

```text
Produto: Notebook
Preço unitário: R$ 3.500,00
Quantidade: 3
Total: R$ 10.500,00

Produto: Mouse
Preço unitário: R$ 59,90
Quantidade: 10
Total: R$ 599,00

Produto: Monitor
Preço unitário: R$ 899,00
Quantidade: 1
Total: R$ 899,00

Total do pedido: R$ 11.998,00
```

**Explicação:**

Os três produtos foram criados com o construtor, um por linha. O `foreach` chamou `apresentar()` e mostrou o total de cada um. O Monitor ficou com quantidade 1 por causa do valor padrão. A soma 10.500 + 599 + 899 deu o total do pedido de R$ 11.998,00.

**2.2 Erro com `new Produto('Teclado')`**: `php q06-construtor/teste-erros.php`

```text
--- testes ---

Fatal error: Uncaught ArgumentCountError: Too few arguments to function Produto::__construct(), 1 passed in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q06-construtor\teste-erros.php on line 9 and at least 2 expected in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q06-construtor\produto.php:12
Stack trace:
#0 C:\Users\davimaciel\atividades-pweb1\aula03-oo\q06-construtor\teste-erros.php(9): Produto->__construct('Teclado')
#1 {main}
  thrown in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q06-construtor\produto.php on line 12
```

(Antes do `--- testes ---` aparece a saída do `produto.php`, porque ele é incluído com `require`.)

**Explicação:**

Foi passado só o nome, mas o construtor precisa de pelo menos nome e preço. O PHP gerou um `ArgumentCountError`: 1 argumento passado e pelo menos 2 esperados.

**2.3 Erro com `new Produto('Teclado', 'cem reais', 2)`**

```text
--- testes ---

Fatal error: Uncaught TypeError: Produto::__construct(): Argument #2 ($preco) must be of type float, string given, called in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q06-construtor\teste-erros.php on line 10 and defined in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q06-construtor\produto.php:12
Stack trace:
#0 C:\Users\davimaciel\atividades-pweb1\aula03-oo\q06-construtor\teste-erros.php(10): Produto->__construct('Teclado', 'cem reais', 2)
#1 {main}
  thrown in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q06-construtor\produto.php on line 12
```

**Explicação:**

A quantidade de argumentos está certa, mas o segundo (`$preco`) recebeu o texto `'cem reais'` em vez de um `float`. O PHP gerou um `TypeError`.

**2.4 Erro com `new Produto()`**

```text
--- testes ---

Fatal error: Uncaught ArgumentCountError: Too few arguments to function Produto::__construct(), 0 passed in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q06-construtor\teste-erros.php on line 11 and at least 2 expected in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q06-construtor\produto.php:12
Stack trace:
#0 C:\Users\davimaciel\atividades-pweb1\aula03-oo\q06-construtor\teste-erros.php(11): Produto->__construct()
#1 {main}
  thrown in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q06-construtor\produto.php on line 12
```

**Explicação:**

Nenhum argumento foi passado. Agora que a classe tem construtor com parâmetros obrigatórios, não dá mais para criar um produto vazio: 0 passados, pelo menos 2 esperados.

## 3. Perguntas

**a) A mensagem diz "at least 2 expected", e não "exactly 3". Por quê?**

Porque o terceiro parâmetro (`$quantidade`) tem valor padrão, então é opcional. Só nome e preço são obrigatórios: no mínimo 2, no máximo 3.

**b) Quem devolve o objeto pronto: o `__construct` ou o `new`?**

O `new`. Ele cria o objeto, chama o `__construct` para preencher os atributos e depois devolve o objeto. O construtor não retorna nada.

**c) Que erro da versão anterior (sem construtor) deixou de ser possível?**

Criar um produto e esquecer de preencher algum atributo, deixando-o sem valor (o que daria o erro "must not be accessed before initialization" ao usar). Agora o objeto já nasce com nome, preço e quantidade.
