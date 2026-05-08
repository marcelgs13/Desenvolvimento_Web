<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Questão 5 - Fábrica</title>
</head>
<body>
    <h1>Questão 5 - Relatório da Fábrica</h1>

    <?php
    $salarioMinimo = 1320.00; 
    $folhaPagamento = 0;
    $totalPecasFabrica = 0;

    $mulheresA = 0; $pecasMulheresA = 0;
    $mulheresB = 0; $pecasMulheresB = 0;
    $mulheresC = 0; $pecasMulheresC = 0;

    $maiorSalario = 0; $idMaiorSalario = 0;
    $maiorQtdPecas = -1; $idMaiorPecas = 0;
    $menorQtdPecas = 999999; $idMenorPecas = 0;

    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Nº Operário</th><th>Peças</th><th>Sexo</th><th>Salário (R$)</th></tr>";

    $idOperario = 1;
    while (true) {
        $chanceParada = rand(1, 15);
        if ($idOperario > 8 && $chanceParada > 12) {
            $idOperario = 0; 
        }

        if ($idOperario == 0) {
            break;
        }

        $pecas = rand(15, 50);
        $sexo = (rand(0, 1) == 0) ? 'M' : 'F';
        $salario = $salarioMinimo;
        
        if ($pecas <= 30) {
            if ($sexo == 'F') { $mulheresA++; $pecasMulheresA += $pecas; }
        } else if ($pecas >= 31 && $pecas <= 35) {
            $salario += ($salarioMinimo * 0.03) * ($pecas - 30);
            if ($sexo == 'F') { $mulheresB++; $pecasMulheresB += $pecas; }
        } else {
            $salario += ($salarioMinimo * 0.05) * ($pecas - 35);
            if ($sexo == 'F') { $mulheresC++; $pecasMulheresC += $pecas; }
        }

        $folhaPagamento += $salario;
        $totalPecasFabrica += $pecas;

        if ($salario > $maiorSalario) { $maiorSalario = $salario; $idMaiorSalario = $idOperario; }
        if ($pecas > $maiorQtdPecas) { $maiorQtdPecas = $pecas; $idMaiorPecas = $idOperario; }
        if ($pecas < $menorQtdPecas) { $menorQtdPecas = $pecas; $idMenorPecas = $idOperario; }

        echo "<tr>";
        echo "<td>$idOperario</td><td>$pecas</td><td>$sexo</td>";
        echo "<td>" . number_format($salario, 2, ',', '.') . "</td>";
        echo "</tr>";

        $idOperario++;
    }
    echo "</table>";

    $mediaA = ($mulheresA > 0) ? ($pecasMulheresA / $mulheresA) : 0;
    $mediaB = ($mulheresB > 0) ? ($pecasMulheresB / $mulheresB) : 0;
    $mediaC = ($mulheresC > 0) ? ($pecasMulheresC / $mulheresC) : 0;
    $percentual = ($folhaPagamento > 0) ? ($maiorSalario / $folhaPagamento) * 100 : 0;

    echo "<ul>";
    echo "<li><strong>Total da folha:</strong> R$ " . number_format($folhaPagamento, 2, ',', '.') . "</li>";
    echo "<li><strong>Total de peças:</strong> $totalPecasFabrica</li>";
    echo "<li><strong>Média de peças (Mulheres):</strong> Classe A ($mediaA), Classe B ($mediaB), Classe C ($mediaC)</li>";
    echo "<li><strong>Maior salário:</strong> Operário(a) Nº $idMaiorSalario</li>";
    echo "<li><strong>Maior produção:</strong> Operário(a) Nº $idMaiorPecas ($maiorQtdPecas peças)</li>";
    echo "<li><strong>Menor produção:</strong> Operário(a) Nº $idMenorPecas ($menorQtdPecas peças)</li>";
    echo "<li><strong>% do maior salário na folha:</strong> " . number_format($percentual, 2) . "%</li>";
    echo "<li><strong>Diferença de produção (Maior - Menor):</strong> " . ($maiorQtdPecas - $menorQtdPecas) . "</li>";
    echo "</ul>";
    ?>
</body>
</html>