<?php

    $perfil = [
        'nome' => 'Davi Maciel',  
        'curso' => 'ADS - Análise e desenvolvimento de sistemas',  
        'campus' => 'Boa Viagem',  
        'apresentacao' => 'Meu nome é Davi Maciel, sou estudante de Análise e Desenvolvimento de Sistemas (ADS). Tenho interesse em tecnologia e desenvolvimento web, e estou evoluindo  na criação de páginas e sistemas utilizando PHP, HTML e CSS. Meu objetivo é aprimorar minhas habilidades e desenvolver projetos cada vez melhores.',  
        'cidade' => 'Boa Viagem',  
        'habilidades' => [
            'HTML',
            'CSS',
            'PHP',
            'JAVASCRIPT',
            'ANGULAR',
            'IONIC',
            'PYTHON',
            'DJANGO',
            'FASTAPI',
        ],  
    ];

    $projetos = [
        1 => [
            'titulo' => 'Aplicativo para Escola de Jiu-Jitsu',
            'descricao' => 'Aplicativo mobile para modernizar a gestão de uma escola de Jiu-Jitsu, facilitando o acompanhamento de alunos, turmas, treinos e informações administrativas.',
            'tecnologias' => 'Ionic, Angular e FastAPI',
        ],

        2 => [
            'titulo' => 'Vantage',
            'descricao' => 'Plataforma digital desenvolvida para ajudar o pequeno empreendedor a controlar as finanças da sua empresa.',
            'tecnologias' => 'Ionic, Angular e FastAPI',
        ],

        3 => [
            'titulo' => 'Sistema de Gestão Lunare Joias',
            'descricao' => 'Sistema de gestão para uma joalheria, com foco na organização de produtos, controle de estoque, cadastro de clientes e acompanhamento das operações comerciais.',
            'tecnologias' => 'Angular e Django',
        ],

        4 => [
            'titulo' => 'PrevFácil',
            'descricao' => 'Sistema voltado à organização de informações previdenciárias, permitindo estruturar cadastros, acompanhar solicitações e centralizar dados para facilitar a gestão dos atendimentos.',
            'tecnologias' => 'Angular e Django',
        ],
    ];

    $pagina = $_GET['pagina'] ?? 'inicio';
    if (!is_string($pagina)) {
        $pagina = '';
    };

    $id = 0;
    if ($pagina === 'projeto') {
        $id = (int) ($_GET['id'] ?? 0);

        if (!isset($projetos[$id])){
            http_response_code(404);
         }elseif (!in_array($pagina, ['inicio', 'habilidades', 'projetos'], true)) {
            http_response_code(404);
        }
    }

    function e(string $texto): string {
        return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <header class="cabecalho">
        <div class="container">

            <div class="identidade">
                <h1><?= e($perfil['nome']) ?></h1>
                <p><?= e($perfil['curso']) ?></p>
            </div>
        
            <nav class="menu">
                <a href="?pagina=inicio"<?= $pagina === 'inicio' ? ' class="ativo"' : '' ?>>Início</a>
                <a href="?pagina=habilidades"<?= $pagina === 'habilidades' ? ' class="ativo"' : '' ?>>Habilidades</a>
                <a href="?pagina=projetos"<?= ($pagina === 'projetos' || $pagina === 'projeto') ? ' class="ativo"' : '' ?>>Projetos</a>
            </nav>
    
        </div>
    </header>

    <main class="container">
        <?php if ($pagina === 'inicio'): ?>
            <h2>Sobre mim</h2>
            <p><?= e($perfil['apresentacao']) ?></p>
    
            <ul class="dados">
                <li><strong>Nome:</strong> <?= e($perfil['nome']) ?></li>
                <li><strong>Curso:</strong> <?= e($perfil['curso']) ?></li>
                <li><strong>Campus:</strong> <?= e($perfil['campus']) ?></li>
                <li><strong>Cidade:</strong> <?= e($perfil['cidade']) ?></li>
            </ul>
    
        <?php elseif ($pagina === 'habilidades'): ?>
            <h2>Habilidades</h2>
            <p>Total: <strong><?= count($perfil['habilidades']) ?></strong> habilidades.</p>
            <p><?= e(implode(', ', $perfil['habilidades'])) ?>.</p>

            <ul class="etiquetas">
                <?php foreach ($perfil['habilidades'] as $habilidade): ?>
                    <li><?= e($habilidade) ?></li>
                <?php endforeach; ?>

            </ul>
        <?php elseif ($pagina === 'projetos'): ?>
            <h2>Projetos</h2>
            <div class="cartoes">
                <?php foreach ($projetos as $numero => $projeto): ?>
                <article class="cartao">
                    <h3><?= e($projeto['titulo']) ?></h3>
                    <p><?= e($projeto['descricao']) ?></p>
                    <a href="?pagina=projeto&amp;id=<?= $numero ?>">Ver detalhes</a>
                </article>
                
                <?php endforeach; ?>
            
            </div>
        
        <?php elseif ($pagina === 'projeto' && isset($projetos[$id])): ?>
            
            <h2><?= e($projetos[$id]['titulo']) ?></h2>
            <p><?= e($projetos[$id]['descricao']) ?></p>
            <p><strong>Tecnologias:</strong> <?= e($projetos[$id]['tecnologias']) ?></p>
            <p><a href="?pagina=projetos">&larr; Voltar aos projetos</a></p>

        <?php elseif ($pagina === 'projeto'): ?>
        
            <h2>Projeto não encontrado</h2>
            <p>Não existe projeto com esse número.</p>
        
            <p><a href="?pagina=projetos">&larr; Voltar aos projetos</a></p>
        <?php else: ?>
        
            <h2>Página não encontrada</h2>
            <p>A página que você procurou não existe.</p>
            <p><a href="?pagina=inicio">&larr; Ir para o início</a></p>
      
        <?php endif; ?>
    </main>

    <footer class="rodape">
    
        <div class="container">
            <span>&copy; <?= date('Y') ?></span>
        </div>
        
    </footer>
</body>
</html>