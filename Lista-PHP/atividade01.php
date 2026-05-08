<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Questão 1 - Matriz 7x7</title>
</head>
<body>
    <h1>Questão 1 - Matriz 7x7</h1>

    <?php
    $matriz = [];
    $n = rand(2, 5); 
    echo "<p>Valor inteiro gerado: <strong>$n</strong></p>";

    // Gerando a matriz 7x7
    for ($i = 0; $i < 7; $i++) {
        for ($j = 0; $j < 7; $j++) {
            $matriz[$i][$j] = rand(1, 10);
        }
    }

    
    for ($k = 0; $k < 7; $k++) {
        $matriz[3][$k] = $matriz[3][$k] * $n;
        $matriz[$k][3] = $matriz[$k][3] / $n;
    }

    // Imprimindo a matriz
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    for ($i = 0; $i < 7; $i++) {
        echo "<tr>";
        for ($j = 0; $j < 7; $j++) {
            $valor = number_format($matriz[$i][$j], 2, ',', '');
            echo "<td>$valor</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    ?>
</body>
</html>