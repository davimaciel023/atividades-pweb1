<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    const MEDIA_APROVACAO = 7;

    $n1 = (float) ($_GET['n1'] ?? 0);
    $n2 = (float) ($_GET['n2'] ?? 0);
    $media = ($n1 + $n2) / 2;
    $situacao = $media >= MEDIA_APROVACAO ? "Aprovado" : "Em recuperação";
    ?>
    <p>Notas: <?= $n1 ?> e <?= $n2 ?></p>
    <p>Média: <?= $media ?></p>
    <p>Situação: <?= $situacao ?></p>
</body>
</html>
