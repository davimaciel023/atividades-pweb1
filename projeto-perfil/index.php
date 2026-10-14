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


    $pagina = $_GET['pagina'] ?? 'inicio';
    if (!is_string($pagina)) {
        $pagina = '';
    };


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