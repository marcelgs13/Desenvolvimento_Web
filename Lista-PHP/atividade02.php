<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Questão 2 - Operações com Vetores</title>
</head>
<body>
    <h1>Questão 2 - Conjuntos</h1>

    <?php
    $A = [];
    $B = [];
    $tamanhoA = rand(3, 10);
    $tamanhoB = rand(3, 10);

    for ($i = 0; $i < $tamanhoA; $i++) {
        $A[$i] = rand(1, 15);
    }
    for ($i = 0; $i < $tamanhoB; $i++) {
        $B[$i] = rand(1, 15);
    }

    function printVetor($nome, $vetor) {
        echo "<p>Vetor $nome: { ";
        $tamanho = 0;
        foreach($vetor as $v) $tamanho++;
        
        $i = 0;
        foreach ($vetor as $v) {
            echo $v;
            if ($i < $tamanho - 1) echo ", ";
            $i++;
        }
        echo " }</p>";
    }

    printVetor("A", $A);
    printVetor("B", $B);

    // Interseção (A ∩ B)
    $intersecao = [];
    $idxInt = 0;
    foreach ($A as $valA) {
        $existeB = false;
        foreach ($B as $valB) {
            if ($valA == $valB) {
                $existeB = true;
                break;
            }
        }
        if ($existeB) {
            $jaExiste = false;
            foreach ($intersecao as $valI) {
                if ($valI == $valA) $jaExiste = true;
            }
            if (!$jaExiste) {
                $intersecao[$idxInt] = $valA;
                $idxInt++;
            }
        }
    }
    printVetor("Interseção (A ∩ B)", $intersecao);

    // União (A U B)
    $uniao = [];
    $idxUniao = 0;
    foreach ($A as $valA) {
        $jaExiste = false;
        foreach ($uniao as $valU) {
            if ($valU == $valA) $jaExiste = true;
        }
        if (!$jaExiste) {
            $uniao[$idxUniao] = $valA;
            $idxUniao++;
        }
    }
    foreach ($B as $valB) {
        $jaExiste = false;
        foreach ($uniao as $valU) {
            if ($valU == $valB) $jaExiste = true;
        }
        if (!$jaExiste) {
            $uniao[$idxUniao] = $valB;
            $idxUniao++;
        }
    }
    printVetor("União (A U B)", $uniao);

    // Diferença (A - B)
    $diferenca = [];
    $idxDif = 0;
    foreach ($A as $valA) {
        $existeB = false;
        foreach ($B as $valB) {
            if ($valA == $valB) {
                $existeB = true;
                break;
            }
        }
        if (!$existeB) {
            $jaExiste = false;
            foreach ($diferenca as $valD) {
                if ($valD == $valA) $jaExiste = true;
            }
            if (!$jaExiste) {
                $diferenca[$idxDif] = $valA;
                $idxDif++;
            }
        }
    }
    printVetor("Diferença (A - B)", $diferenca);

    // Verificar se A contido em B ou B contido em A
    $A_contido_B = true;
    foreach ($A as $valA) {
        $existeB = false;
        foreach ($B as $valB) {
            if ($valA == $valB) $existeB = true;
        }
        if (!$existeB) $A_contido_B = false;
    }

    $B_contido_A = true;
    foreach ($B as $valB) {
        $existeA = false;
        foreach ($A as $valA) {
            if ($valB == $valA) $existeA = true;
        }
        if (!$existeA) $B_contido_A = false;
    }

    if ($A_contido_B) echo "<p>O conjunto A é subconjunto de B (A ⊂ B).</p>";
    else if ($B_contido_A) echo "<p>O conjunto B é subconjunto de A (B ⊂ A).</p>";
    else echo "<p>Nenhum dos conjuntos é subconjunto do outro.</p>";
    ?>
</body>
</html>