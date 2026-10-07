<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $palavra = $_GET['palavra'] ?? "Ceara";

    echo "<p>Palavra: $palavra</p>";
    echo "<p>strlen: " . strlen($palavra) . "</p>";
    echo "<p>mb_strlen: " . mb_strlen($palavra) . "</p>";
    echo "<p>strtoupper: " . strtoupper($palavra) . "</p>";
    echo "<p>mb_strtoupper: " . mb_strtoupper($palavra) . "</p>";

    if (mb_strlen($palavra) <= 5) {
        echo "<p>Classificação: palavra curta</p>";
    } else {
        echo "<p>Classificação: palavra longa</p>";
    }
    ?>
</body>
</html>
