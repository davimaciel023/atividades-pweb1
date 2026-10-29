<?php

    declare(strict_types=1);

    // 1. Classes

    class Projeto
    {
        private string $titulo;
        private string $descricao;
        private string $tecnologias;

        public function __construct(string $titulo, string $descricao, string $tecnologias)
        {
            if (trim($titulo) === '') {
                throw new Exception('O projeto precisa de um título.');
            }
            $this->titulo = $titulo;
            $this->descricao = $descricao;
            $this->tecnologias = $tecnologias;
        }

        public function getTitulo(): string
        {
            return $this->titulo;
        }

        public function getDescricao(): string
        {
            return $this->descricao;
        }

        public function getTecnologias(): string
        {
            return $this->tecnologias;
        }

        public function paraArray(): array
        {
            return [
                'titulo' => $this->titulo,
                'descricao' => $this->descricao,
                'tecnologias' => $this->tecnologias,
            ];
        }
    }

    class Perfil
    {
        private string $nome;
        private string $curso;
        private string $campus;
        private string $cidade;
        private string $apresentacao;
        private array $habilidades;
        private array $projetos = [];

        public function __construct(
            string $nome,
            string $curso,
            string $campus,
            string $cidade,
            string $apresentacao,
            array $habilidades
        ) {
            if (count($habilidades) < 5) {
                throw new Exception('O perfil precisa de pelo menos 5 habilidades.');
            }
            $this->nome = $nome;
            $this->curso = $curso;
            $this->campus = $campus;
            $this->cidade = $cidade;
            $this->apresentacao = $apresentacao;
            $this->habilidades = $habilidades;
        }

        public function getNome(): string
        {
            return $this->nome;
        }

        public function getCurso(): string
        {
            return $this->curso;
        }

        public function getCampus(): string
        {
            return $this->campus;
        }

        public function getCidade(): string
        {
            return $this->cidade;
        }

        public function getApresentacao(): string
        {
            return $this->apresentacao;
        }

        public function getHabilidades(): array
        {
            return $this->habilidades;
        }

        public function getProjetos(): array
        {
            return $this->projetos;
        }

        public function adicionarProjeto(Projeto $projeto): void
        {
            $this->projetos[count($this->projetos) + 1] = $projeto;
        }

        public function getProjeto(int $id): Projeto
        {
            if (!isset($this->projetos[$id])) {
                throw new Exception('Projeto não encontrado.');
            }
            return $this->projetos[$id];
        }

        public function paraArray(): array
        {
            $projetos = [];
            foreach ($this->projetos as $numero => $projeto) {
                $projetos[$numero] = $projeto->paraArray();
            }

            return [
                'nome' => $this->nome,
                'curso' => $this->curso,
                'campus' => $this->campus,
                'apresentacao' => $this->apresentacao,
                'cidade' => $this->cidade,
                'habilidades' => $this->habilidades,
                'projetos' => $projetos,
            ];
        }
    }

    // 2. Os objetos

    $perfil = new Perfil(
        'Davi Maciel',
        'ADS - Análise e desenvolvimento de sistemas',
        'Boa Viagem',
        'Boa Viagem',
        'Meu nome é Davi Maciel, sou estudante de Análise e Desenvolvimento de Sistemas (ADS). Tenho interesse em tecnologia e desenvolvimento web, e estou evoluindo  na criação de páginas e sistemas utilizando PHP, HTML e CSS. Meu objetivo é aprimorar minhas habilidades e desenvolver projetos cada vez melhores.',
        ['HTML', 'CSS', 'PHP', 'JAVASCRIPT', 'ANGULAR', 'IONIC', 'PYTHON', 'DJANGO', 'FASTAPI']
    );

    $perfil->adicionarProjeto(new Projeto(
        'Aplicativo para Escola de Jiu-Jitsu',
        'Aplicativo mobile para modernizar a gestão de uma escola de Jiu-Jitsu, facilitando o acompanhamento de alunos, turmas, treinos e informações administrativas.',
        'Ionic, Angular e FastAPI'
    ));

    $perfil->adicionarProjeto(new Projeto(
        'Vantage',
        'Plataforma digital desenvolvida para ajudar o pequeno empreendedor a controlar as finanças da sua empresa.',
        'Ionic, Angular e FastAPI'
    ));

    $perfil->adicionarProjeto(new Projeto(
        'Sistema de Gestão Lunare Joias',
        'Sistema de gestão para uma joalheria, com foco na organização de produtos, controle de estoque, cadastro de clientes e acompanhamento das operações comerciais.',
        'Angular e Django'
    ));

    $perfil->adicionarProjeto(new Projeto(
        'PrevFácil',
        'Sistema voltado à organização de informações previdenciárias, permitindo estruturar cadastros, acompanhar solicitações e centralizar dados para facilitar a gestão dos atendimentos.',
        'Angular e Django'
    ));

    // 3. Tema claro ou escuro

    $tema = $_GET['tema'] ?? $_COOKIE['tema'] ?? 'claro';
    if (!is_string($tema) || ($tema !== 'claro' && $tema !== 'escuro')) {
        $tema = 'claro';
    }
    setcookie(
        'tema', $tema, time() + 60 * 60 * 24 * 30, '/'
    );

    $outroTema = $tema === 'claro' ? 'escuro' : 'claro';

    function e(string $texto): string {
        return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
    }

    // 4. Rota JSON

    if (($_GET['formato'] ?? '') === 'json') {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(
            $perfil,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
        exit;
    }

    // 5. Qual página mostrar

    $pagina = $_GET['pagina'] ?? 'inicio';
    if (!is_string($pagina)) {
        $pagina = '';
    }
    $paginaPedida = $pagina;

    $titulo = 'Meu Perfil';
    $id = 0;
    $projetoAtual = null;

    if (!in_array($pagina, ['inicio', 'habilidades', 'projetos', 'projeto'], true)) {
        http_response_code(404);
        $pagina = 'nao-encontrado';
        $titulo = 'Página não encontrada';
    } elseif ($pagina === 'projeto') {
        $id = (int) ($_GET['id'] ?? 0);

        try {
            $projetoAtual = $perfil->getProjeto($id);
            $titulo = $projetoAtual->getTitulo();
        } catch (Exception $e) {
            http_response_code(404);
            $pagina = 'nao-encontrado';
            $titulo = $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($titulo) ?></title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body class="tema-<?= e($tema) ?>">

    <header class="cabecalho">
        <div class="container">

            <div class="identidade">
                <h1><?= e($perfil->getNome()) ?></h1>
                <p><?= e($perfil->getCurso()) ?></p>
            </div>

            <nav class="menu">
                <a href="?pagina=inicio"<?= $pagina === 'inicio' ? ' class="ativo"' : '' ?>>Início</a>
                <a href="?pagina=habilidades"<?= $pagina === 'habilidades' ? ' class="ativo"' : '' ?>>Habilidades</a>
                <a href="?pagina=projetos"<?= ($pagina === 'projetos' || $pagina === 'projeto') ? ' class="ativo"' : '' ?>>Projetos</a>
                <a class="botao-tema" href="?pagina=<?= e(urlencode($paginaPedida)) ?><?= $paginaPedida === 'projeto' ? '&amp;id=' . $id : '' ?>&amp;tema=<?= e($outroTema) ?>">Tema <?= e($outroTema) ?></a>
            </nav>

        </div>
    </header>

    <main class="container">
        <?php if ($pagina === 'inicio'): ?>
            <h2>Sobre mim</h2>
            <p><?= e($perfil->getApresentacao()) ?></p>

            <ul class="dados">
                <li><strong>Nome:</strong> <?= e($perfil->getNome()) ?></li>
                <li><strong>Curso:</strong> <?= e($perfil->getCurso()) ?></li>
                <li><strong>Campus:</strong> <?= e($perfil->getCampus()) ?></li>
                <li><strong>Cidade:</strong> <?= e($perfil->getCidade()) ?></li>
            </ul>

        <?php elseif ($pagina === 'habilidades'): ?>
            <h2>Habilidades</h2>
            <p>Total: <strong><?= count($perfil->getHabilidades()) ?></strong> habilidades.</p>
            <p><?= e(implode(', ', $perfil->getHabilidades())) ?>.</p>

            <ul class="etiquetas">
                <?php foreach ($perfil->getHabilidades() as $habilidade): ?>
                    <li><?= e($habilidade) ?></li>
                <?php endforeach; ?>

            </ul>
        <?php elseif ($pagina === 'projetos'): ?>
            <h2>Projetos</h2>
            <div class="cartoes">
                <?php foreach ($perfil->getProjetos() as $numero => $projeto): ?>
                <article class="cartao">
                    <h3><?= e($projeto->getTitulo()) ?></h3>
                    <p><?= e($projeto->getDescricao()) ?></p>
                    <a href="?pagina=projeto&amp;id=<?= $numero ?>">Ver detalhes</a>
                </article>

                <?php endforeach; ?>

            </div>

        <?php elseif ($pagina === 'projeto'): ?>

            <h2><?= e($projetoAtual->getTitulo()) ?></h2>
            <p><?= e($projetoAtual->getDescricao()) ?></p>
            <p><strong>Tecnologias:</strong> <?= e($projetoAtual->getTecnologias()) ?></p>
            <p><a href="?pagina=projetos">&larr; Voltar aos projetos</a></p>

        <?php elseif ($paginaPedida === 'projeto'): ?>

            <h2><?= e($titulo) ?></h2>
            <p>Não existe projeto com esse número.</p>

            <p><a href="?pagina=projetos">&larr; Voltar aos projetos</a></p>
        <?php else: ?>

            <h2><?= e($titulo) ?></h2>
            <p>A página que você procurou não existe.</p>
            <p><a href="?pagina=inicio">&larr; Ir para o início</a></p>

        <?php endif; ?>
    </main>

    <footer class="rodape">

        <div class="container">
            <span>Tema atual: <?= e($tema) ?></span>
            <a href="?formato=json">Ver dados em JSON</a>
            <span>&copy; <?= date('Y') ?></span>
        </div>

    </footer>
</body>
</html>
