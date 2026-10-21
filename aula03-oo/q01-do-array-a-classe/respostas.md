# Questão 01: Do array à classe

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `livro-array.php` | Fornecido: o livro em array associativo |
| `livro.php` | Você cria: a classe `Livro` e dois objetos |

## 1. Análise do código

**1.1 Explique a declaração `public float $preco;`: o que é cada uma das três partes?**

`public` é a visibilidade: o atributo pode ser lido e alterado de fora da classe. `float` é o tipo: o atributo só aceita número com casas decimais. `$preco` é o nome do atributo.

**1.2 Compare `$livro['titulo']` (array) e `$livro1->titulo` (objeto). O que muda na escrita e o que muda no que o PHP garante?**

No array a chave vai entre colchetes e aspas; no objeto usamos a seta `->` e o nome do atributo. No array qualquer chave e qualquer valor são aceitos. Na classe os atributos são definidos antes e têm tipo, então o PHP garante que cada objeto tem os mesmos campos e recusa um valor do tipo errado.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique com suas palavras.

**2.1 Saída de**: `php q01-do-array-a-classe/livro.php`

```text
Vidas Secas, de Graciliano Ramos (1938)
Iracema, de José de Alencar (1865)
object(Livro)#2 (5) {
  ["titulo"]=>
  string(7) "Iracema"
  ["autor"]=>
  string(16) "José de Alencar"
  ["ano"]=>
  int(1865)
  ["preco"]=>
  float(29.9)
  ["disponivel"]=>
  bool(false)
}
```

**Explicação:**

As duas primeiras linhas são os `echo` dos dois livros, no mesmo formato do array. Depois vem o `var_dump` do segundo livro, mostrando cada atributo com o seu tipo e valor (o `string(16)` conta bytes, por isso o "é" conta como 2).

**2.2 Erro ao atribuir o ano como texto (item 5)**

```text
Fatal error: Uncaught TypeError: Cannot assign string to property Livro::$ano of type int in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q01-do-array-a-classe\livro.php:17
Stack trace:
#0 {main}
  thrown in C:\Users\davimaciel\atividades-pweb1\aula03-oo\q01-do-array-a-classe\livro.php on line 17
```

**Explicação:**

Na linha 17 tentei guardar o texto `'1938'` no atributo `$ano`, que é `int`. O PHP lançou um `TypeError` dizendo que não pode atribuir string a uma propriedade do tipo int, e o programa parou.

## 3. Perguntas

**a) Quantas classes e quantos objetos existem no seu `livro.php`?**

Uma classe (`Livro`) e dois objetos (`$livro1` e `$livro2`).

**b) No `var_dump`, o que significam `object(Livro)#2` e o `(5)`?**

`object(Livro)` diz que é um objeto da classe `Livro`; `#2` é o número de identificação do objeto, pois ele foi o segundo criado. O `(5)` é a quantidade de atributos do objeto.

**c) O que o `declare(strict_types=1)` mudou no resultado do item 5?**

Com o modo estrito o PHP não converte o texto `'1938'` para o número 1938 automaticamente; ele recusa e gera o erro. Sem o `strict_types` o PHP faria a conversão e o programa rodaria normalmente.
