# Perfil do Estudante — Versão 1

**Autor:** Davi Maciel

Projeto desenvolvido em PHP para apresentar meu perfil acadêmico, minhas habilidades e meus projetos. A aplicação permite navegar entre páginas, alternar entre os temas claro e escuro e consultar os dados em formato JSON.

## Tecnologias utilizadas

- PHP
- HTML5
- CSS3
- JSON
- HTTP

## Como executar

**1.** Abra o terminal na pasta do projeto:

```bash
cd projeto/v1
```

**2.** Inicie o servidor de desenvolvimento do PHP:

```bash
php -S localhost:8000 -d display_errors=1 -d output_buffering=0
```

**3.** Abra o endereço no navegador:

[http://localhost:8000](http://localhost:8000)

> É necessário ter o PHP instalado e disponível no PATH do sistema.

## Estrutura do projeto

```text
v1/
├── index.php
├── style.css
├── README.md
└── prints/
    ├── claro.png
    └── escuro.png
```

- `index.php`: contém os dados do perfil, as rotas, a validação dos parâmetros, a lógica dos temas e a resposta JSON.
- `style.css`: define a aparência da aplicação, incluindo cores, cartões, navegação e responsividade.
- `prints/`: armazena capturas de tela da aplicação nos dois temas.

## Telas

| Tema claro | Tema escuro |
|---|---|
| ![Tela do tema claro](prints/claro.png) | ![Tela do tema escuro](prints/escuro.png) |

## 1. Mapa de rotas

A navegação é controlada pelo parâmetro `pagina`, recebido pela URL através de `$_GET`.

| URL | Funcionalidade | Status esperado |
|---|---|---|
| `/` | Apresentação do estudante | 200 |
| `/?pagina=inicio` | Exibe os dados do perfil | 200 |
| `/?pagina=habilidades` | Lista as habilidades e mostra a quantidade | 200 |
| `/?pagina=projetos` | Exibe os cartões dos projetos cadastrados | 200 |
| `/?pagina=projeto&id=1` | Exibe os detalhes do primeiro projeto | 200 |
| `/?pagina=projeto&id=99` | Exibe a mensagem de projeto não encontrado | 404 |
| `/?pagina=qualquercoisa` | Exibe a mensagem de página não encontrada | 404 |
| `/?tema=escuro` | Ativa o tema escuro | 200 |
| `/?tema=claro` | Ativa o tema claro | 200 |
| `/?formato=json` | Retorna os dados do perfil e dos projetos em JSON | 200 |

**Observação:** os status indicados são os esperados quando o código está configurado corretamente. O status 404 para páginas desconhecidas depende da implementação da validação da rota.

## 2. Funcionalidades implementadas

### 2.1 Perfil do estudante

Os dados do estudante são armazenados em um array associativo PHP chamado `$perfil`.

As informações apresentadas incluem:

- Nome;
- Curso;
- Campus;
- Cidade;
- Apresentação pessoal;
- Habilidades.

### 2.2 Navegação entre páginas

A aplicação utiliza o parâmetro `pagina` para determinar qual conteúdo deve ser exibido.

Exemplos:

```text
/?pagina=inicio
/?pagina=habilidades
/?pagina=projetos
```

A página inicial é carregada por padrão quando nenhum parâmetro de página é informado.

### 2.3 Listagem e detalhes dos projetos

Os projetos são armazenados no array `$projetos`, utilizando identificadores numéricos.

Na página de projetos, cada item apresenta seu título, sua descrição e um link para consultar os detalhes.

A página individual apresenta:

- Título do projeto;
- Descrição;
- Tecnologias utilizadas.

Quando o identificador não corresponde a um projeto cadastrado, a aplicação apresenta uma mensagem de erro e deve responder com o status HTTP 404.

### 2.4 Tema claro e escuro

A aplicação utiliza classes CSS para alternar a aparência da página:

```html
<body class="tema-claro">
```

ou:

```html
<body class="tema-escuro">
```

O tema é selecionado por meio do parâmetro `tema` na URL e pode ser armazenado em um cookie com validade de 30 dias.

Exemplos:

```text
/?tema=escuro
/?tema=claro
```

A aplicação valida os valores recebidos, aceitando apenas `claro` e `escuro`. Valores inválidos são substituídos por `claro`.

### 2.5 Consulta dos dados em JSON

A aplicação disponibiliza uma resposta JSON por meio da URL:

```text
/?formato=json
```

O código utiliza `json_encode()` para converter os dados PHP em JSON e define o cabeçalho:

```http
Content-Type: application/json; charset=utf-8
```

A resposta contém as chaves `perfil` e `projetos`, permitindo consultar os dados de forma estruturada sem renderizar a página HTML.

## 3. Testes HTTP

Os testes podem ser realizados com `curl.exe` no Windows, enquanto o servidor PHP estiver em execução.

### 3.1 Testar uma página existente

```powershell
curl.exe -i "http://localhost:8000/?pagina=habilidades"
```

Resultado esperado:

```http
HTTP/1.1 200 OK
Content-type: text/html; charset=UTF-8
```

O status 200 indica que a requisição foi processada com sucesso.

### 3.2 Testar um projeto inexistente

```powershell
curl.exe -i "http://localhost:8000/?pagina=projeto&id=99"
```

Resultado esperado:

```http
HTTP/1.1 404 Not Found
```

O status 404 indica que o identificador solicitado não corresponde a um projeto cadastrado.

### 3.3 Testar a troca de tema

```powershell
curl.exe -i "http://localhost:8000/?tema=escuro"
```

Procure no cabeçalho da resposta uma linha semelhante a:

```http
Set-Cookie: tema=escuro; expires=...; Max-Age=2592000; path=/
```

O cabeçalho `Set-Cookie` solicita ao navegador que armazene a preferência de tema.

### 3.4 Testar a resposta JSON

```powershell
curl.exe -i "http://localhost:8000/?formato=json"
```

Verifique se a resposta contém:

```http
Content-Type: application/json; charset=utf-8
```

O corpo deverá apresentar os dados do perfil e dos projetos em formato JSON, sem o HTML da página.

## 4. Conceitos de PHP aplicados

| Conceito | Aplicação no projeto |
|---|---|
| Arrays associativos | Armazenamento dos dados do perfil e dos projetos |
| `$_GET` | Leitura dos parâmetros enviados pela URL |
| `$_COOKIE` | Recuperação da preferência de tema |
| `if`, `elseif` e `else` | Controle da navegação e seleção do conteúdo |
| `isset()` | Verificação da existência de valores |
| `in_array()` | Verificação de valores permitidos, quando aplicada à validação de rotas |
| `count()` | Contagem das habilidades cadastradas |
| `implode()` | Transformação da lista de habilidades em texto |
| `foreach` | Exibição de listas de habilidades e projetos |
| `htmlspecialchars()` | Escape de textos exibidos no HTML |
| `setcookie()` | Armazenamento da preferência de tema |
| `http_response_code()` | Definição de códigos de resposta HTTP |
| `header()` | Definição do tipo de conteúdo da resposta |
| `json_encode()` | Conversão dos dados PHP para JSON |
| `exit` | Encerramento da execução após o envio do JSON |

## 5. Segurança e validação

O projeto utiliza algumas práticas básicas de segurança:

- Validação dos parâmetros recebidos pela URL;
- Restrição dos valores permitidos para o tema;
- Escape de textos com `htmlspecialchars()` antes da exibição no HTML;
- Verificação dos identificadores dos projetos;
- Separação da resposta JSON do conteúdo HTML.

Essas medidas ajudam a evitar a exibição indevida de conteúdo HTML e a aceitar apenas os valores previstos pela aplicação.

## 6. Aprendizados

O desenvolvimento deste projeto permite praticar conceitos fundamentais de desenvolvimento web com PHP, incluindo processamento de requisições HTTP, navegação por parâmetros, manipulação de arrays, persistência de preferências com cookies, códigos de status HTTP e serialização de dados em JSON.

O projeto também serve como base para evoluir para aplicações com banco de dados, autenticação, operações CRUD e integração com APIs.

---

**Autor:** Davi Maciel  
**Projeto:** Perfil do Estudante — Versão 1