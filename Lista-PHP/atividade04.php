<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Questão 4 - Somatório</title>
</head>
<body>
    <h1>Questão 4 - Somatório S</h1>

    <?php
    $termos = rand(1, 10); 
    echo "<p>Quantidade de termos: $termos</p>";

    $S = 0;
    $numerador = 1;
    $denominador = 2;

    for ($i = 0; $i < $termos; $i++) {
        

        $fatorial = 1;
        for ($f = $denominador; $f > 1; $f--) {
            $fatorial *= $f;
        }

        $termoAtual = $numerador / $fatorial;
        
  
        if ($i % 4 == 0 || $i % 4 == 1) {
            $sinal = 1;
        } else {
            $sinal = -1;
        }
 
        $operador = ($sinal == 1) ? '+' : '-';
        if ($i == 0) $operador = ''; 
        echo "$operador ($numerador / $denominador!) ";

       
        $S += $sinal * $termoAtual;

     
        $numerador += 2;
        $denominador += 2;
    }

    echo "<br><br><p><strong>Valor final de S: $S</strong></p>";
    ?>
</body>
</html>