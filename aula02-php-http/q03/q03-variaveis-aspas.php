<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $nome = "Davis";
        $curso = "ADS";
        $semestre = 2;
    ?>
    <p><?php echo "Aluna: " . $nome; ?></p>
    <p><?php echo "Aluna: $nome"; ?></p>
    <p><?php echo 'Aluna: $nome'; ?></p>
    <p><?php echo "Cursa o {$semestre}º semestre de $curso"; ?></p>
    <p><?php echo $nome . $curso; ?></p>
    <p>Atalho: <?= $nome ?></p>
</body>
</html>
