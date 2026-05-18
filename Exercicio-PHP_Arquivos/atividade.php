<?php
echo "<pre>";
$arquivo = "arquivo.txt";


$texto_completo = file_get_contents($arquivo);

// Variáveis auxiliares 
$vogais = "aeiouAEIOU";
$tam_vogais = strlen($vogais);
$alfabeto_min = "abcdefghijklmnopqrstuvwxyz";
$alfabeto_mai = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";


// LÓGICA : Separar o texto gigante em um "array" de linhas

$linhas = [];
$qtd_linhas = 0;
$linha_atual = "";
$tam_texto = strlen($texto_completo);

for ($i = 0; $i < $tam_texto; $i++) {
    $char = substr($texto_completo, $i, 1);
    if ($char == "\n") {
        $linhas[$qtd_linhas] = $linha_atual;
        $qtd_linhas++;
        $linha_atual = "";
    } else if ($char != "\r") {
        $linha_atual .= $char;
    }
}
if (strlen($linha_atual) > 0) {
    $linhas[$qtd_linhas] = $linha_atual;
    $qtd_linhas++;
}

// a) Lê o arquivo e exibe na tela
echo "// a) Lê o arquivo e exibe na tela\n";
for ($i = 0; $i < $qtd_linhas; $i++) {
    echo ($i + 1) . ": " . $linhas[$i] . "\n";
}

// b) Reescreve o arquivo com cada frase na ordem inversa
$conteudo_b = "";
for ($i = 0; $i < $qtd_linhas; $i++) {
    $linha = $linhas[$i];
    $tam_linha = strlen($linha);
    $palavras = [];
    $qtd_pal = 0;
    $pal_atual = "";
    
    for ($j = 0; $j < $tam_linha; $j++) {
        $char = substr($linha, $j, 1);
        if ($char == " ") {
            if (strlen($pal_atual) > 0) {
                $palavras[$qtd_pal] = $pal_atual;
                $qtd_pal++;
                $pal_atual = "";
            }
        } else {
            $pal_atual .= $char;
        }
    }
    if (strlen($pal_atual) > 0) {
        $palavras[$qtd_pal] = $pal_atual;
        $qtd_pal++;
    }
    
    // Inverte a ordem preenchendo a string de trás para frente
    for ($k = $qtd_pal - 1; $k >= 0; $k--) {
        $conteudo_b .= $palavras[$k];
        if ($k > 0) $conteudo_b .= " ";
    }
    $conteudo_b .= "\n";
}
file_put_contents("b_inverso.txt", $conteudo_b);


// c) Exiba na tela a linha 15 do arquivo lido na vertical.
echo "\n// c) Exiba na tela a linha 15 do arquivo lido na vertical.\n";
if ($qtd_linhas >= 15) {
    $linha15 = $linhas[14];
    $tam15 = strlen($linha15);
    for ($i = 0; $i < $tam15; $i++) {
        echo substr($linha15, $i, 1) . "\n";
    }
}


// d) Exiba na tela a linha 11 do arquivo lido na diagonal.
echo "\n// d) Exiba na tela a linha 11 do arquivo lido na diagonal.\n";
if ($qtd_linhas >= 11) {
    $linha11 = $linhas[10];
    $tam11 = strlen($linha11);
    for ($i = 0; $i < $tam11; $i++) {
        for ($s = 0; $s < $i; $s++) echo " ";
        echo substr($linha11, $i, 1) . "\n";
    }
}


// e) Exiba na tela a linha 3 na diagonal invertida.
echo "\n// e) Exiba na tela a linha 3 na diagonal invertida.\n";
if ($qtd_linhas >= 3) {
    $linha3 = $linhas[2];
    $tam3 = strlen($linha3);
    for ($i = 0; $i < $tam3; $i++) {
        for ($s = 0; $s < ($tam3 - 1 - $i); $s++) echo " ";
        echo substr($linha3, $i, 1) . "\n";
    }
}


// f) Reescreva o arquivo alternando palavras em maiúsculas e minúsculas
$conteudo_f = "";
for ($i = 0; $i < $qtd_linhas; $i++) {
    $linha = $linhas[$i];
    $tam_linha = strlen($linha);
    $contador_palavra = 0;
    $dentro_palavra = false;
    
    for ($j = 0; $j < $tam_linha; $j++) {
        $char = substr($linha, $j, 1);
        if ($char == " ") {
            $conteudo_f .= " ";
            $dentro_palavra = false;
        } else {
            if (!$dentro_palavra) {
                $contador_palavra++;
                $dentro_palavra = true;
            }
            
            $novo_char = $char;
            for ($x = 0; $x < 26; $x++) {
                if ($contador_palavra % 2 != 0) { 
                    if ($char == substr($alfabeto_min, $x, 1)) $novo_char = substr($alfabeto_mai, $x, 1);
                } else { 
                    if ($char == substr($alfabeto_mai, $x, 1)) $novo_char = substr($alfabeto_min, $x, 1);
                }
            }
            $conteudo_f .= $novo_char;
        }
    }
    $conteudo_f .= "\n";
}
file_put_contents("f_alternado.txt", $conteudo_f);


// g) Reescreva o arquivo sem espaços em branco.
$conteudo_g = "";
for ($i = 0; $i < $qtd_linhas; $i++) {
    $linha = $linhas[$i];
    $tam = strlen($linha);
    for ($j = 0; $j < $tam; $j++) {
        $char = substr($linha, $j, 1);
        if ($char != " ") $conteudo_g .= $char;
    }
    $conteudo_g .= "\n";
}
file_put_contents("g_sem_espaco.txt", $conteudo_g);


// h) Reescreva o arquivo sem vogais.
$conteudo_h = "";
for ($i = 0; $i < $qtd_linhas; $i++) {
    $linha = $linhas[$i];
    $tam = strlen($linha);
    for ($j = 0; $j < $tam; $j++) {
        $char = substr($linha, $j, 1);
        $eh_vogal = false;
        for ($v = 0; $v < $tam_vogais; $v++) {
            if ($char == substr($vogais, $v, 1)) $eh_vogal = true;
        }
        if (!$eh_vogal) $conteudo_h .= $char;
    }
    $conteudo_h .= "\n";
}
file_put_contents("h_sem_vogais.txt", $conteudo_h);


// i) Reescreva o arquivo substituindo as vogais por "*".
$conteudo_i = "";
for ($i = 0; $i < $qtd_linhas; $i++) {
    $linha = $linhas[$i];
    $tam = strlen($linha);
    for ($j = 0; $j < $tam; $j++) {
        $char = substr($linha, $j, 1);
        $eh_vogal = false;
        for ($v = 0; $v < $tam_vogais; $v++) {
            if ($char == substr($vogais, $v, 1)) $eh_vogal = true;
        }
        if ($eh_vogal) $conteudo_i .= "*";
        else $conteudo_i .= $char;
    }
    $conteudo_i .= "\n";
}
file_put_contents("i_asterisco.txt", $conteudo_i);


// j) Informe quantas palavras existem no arquivo lido.
echo "\n// j) Informe quantas palavras existem no arquivo lido.\n";
$total_palavras_j = 0;
for ($i = 0; $i < $qtd_linhas; $i++) {
    $linha = $linhas[$i];
    $tam = strlen($linha);
    $dentro = false;
    for ($j = 0; $j < $tam; $j++) {
        $char = substr($linha, $j, 1);
        if ($char != " ") {
            if (!$dentro) { $total_palavras_j++; $dentro = true; }
        } else { $dentro = false; }
    }
}
echo "Total de palavras: $total_palavras_j\n";


// k) Informe qual é a maior palavra existente no arquivo.
echo "\n// k) Informe qual é a maior palavra existente no arquivo.\n";
$maior_palavra = "";
for ($i = 0; $i < $qtd_linhas; $i++) {
    $linha = $linhas[$i];
    $tam = strlen($linha);
    $pal_atual = "";
    for ($j = 0; $j <= $tam; $j++) {
        $char = $j < $tam ? substr($linha, $j, 1) : " ";
        if ($char == " ") {
            if (strlen($pal_atual) > strlen($maior_palavra)) {
                $maior_palavra = $pal_atual;
            }
            $pal_atual = "";
        } else {
            $pal_atual .= $char;
        }
    }
}
echo "Maior palavra: $maior_palavra\n";


// l) Leia duas palavras; verifique se a primeira está presente e substitua
$busca_l = "sol";
$subst_l = "astro";
$tam_busca = strlen($busca_l);
$conteudo_l = "";

for ($i = 0; $i < $qtd_linhas; $i++) {
    $linha = $linhas[$i];
    $tam_linha = strlen($linha);
    for ($j = 0; $j < $tam_linha; $j++) {
        $encontrou = true;
        for ($k = 0; $k < $tam_busca; $k++) {
            if ($j + $k >= $tam_linha) { $encontrou = false; break; }
            
            $c_linha = substr($linha, $j + $k, 1);
            $c_busca = substr($busca_l, $k, 1);
            
            // Iguala manualmente para case insensitive
            for ($x=0; $x<26; $x++) {
                if ($c_linha == substr($alfabeto_mai, $x, 1)) $c_linha = substr($alfabeto_min, $x, 1);
                if ($c_busca == substr($alfabeto_mai, $x, 1)) $c_busca = substr($alfabeto_min, $x, 1);
            }
            
            if ($c_linha != $c_busca) {
                $encontrou = false;
                break;
            }
        }
        
        if ($encontrou) {
            $conteudo_l .= $subst_l;
            $j += ($tam_busca - 1);
        } else {
            $conteudo_l .= substr($linha, $j, 1);
        }
    }
    $conteudo_l .= "\n";
}
file_put_contents("l_substituido.txt", $conteudo_l);


// m) Reescreva cada palavra do arquivo com primeira letra maiúscula.
$conteudo_m = "";
for ($i = 0; $i < $qtd_linhas; $i++) {
    $linha = $linhas[$i];
    $tam = strlen($linha);
    $nova_palavra = true;
    for ($j = 0; $j < $tam; $j++) {
        $char = substr($linha, $j, 1);
        if ($char == " ") {
            $nova_palavra = true;
            $conteudo_m .= " ";
        } else {
            $novo_char = $char;
            if ($nova_palavra) {
                for ($x = 0; $x < 26; $x++) {
                    if ($char == substr($alfabeto_min, $x, 1)) $novo_char = substr($alfabeto_mai, $x, 1);
                }
                $nova_palavra = false;
            } else {
                for ($x = 0; $x < 26; $x++) {
                    if ($char == substr($alfabeto_mai, $x, 1)) $novo_char = substr($alfabeto_min, $x, 1);
                }
            }
            $conteudo_m .= $novo_char;
        }
    }
    $conteudo_m .= "\n";
}
file_put_contents("m_maiuscula.txt", $conteudo_m);


// n) Exiba na tela a linha 22 com cada palavra na vertical.
echo "\n// n) Exiba na tela a linha 22 com cada palavra na vertical.\n";
if ($qtd_linhas >= 22) {
    $linha22 = $linhas[21];
    $tam = strlen($linha22);
    for ($j = 0; $j < $tam; $j++) {
        $char = substr($linha22, $j, 1);
        if ($char == " ") echo "---\n";
        else echo $char . "\n";
    }
    echo "---\n";
}


// o) Leia um caractere qualquer e informe quantas vezes ele aparece
echo "\n// o) Leia um caractere... e informe quantas vezes aparece\n";
$char_busca_o = "a";
$cont_o = 0;
for ($i = 0; $i < $tam_texto; $i++) {
    $c = substr($texto_completo, $i, 1);
    $c_min = $c;
    $busca_min = $char_busca_o;
    for ($x=0; $x<26; $x++) {
        if ($c == substr($alfabeto_mai, $x, 1)) $c_min = substr($alfabeto_min, $x, 1);
        if ($char_busca_o == substr($alfabeto_mai, $x, 1)) $busca_min = substr($alfabeto_min, $x, 1);
    }
    if ($c_min == $busca_min) $cont_o++;
}
echo "O caractere '$char_busca_o' aparece $cont_o vezes.\n";


// p) Reescreva o arquivo alternando: esq->dir e dir->esq
$conteudo_p = "";
for ($i = 0; $i < $qtd_linhas; $i++) {
    $linha = $linhas[$i];
    $tam = strlen($linha);
    $palavras = []; $qtd_pal = 0; $pal = "";
    for ($j = 0; $j <= $tam; $j++) {
        $c = $j < $tam ? substr($linha, $j, 1) : " ";
        if ($c == " ") {
            if (strlen($pal) > 0) { $palavras[$qtd_pal] = $pal; $qtd_pal++; $pal = ""; }
        } else { $pal .= $c; }
    }
    
    for ($k = 0; $k < $qtd_pal; $k++) {
        if ($k % 2 == 0) {
            $conteudo_p .= $palavras[$k] . " ";
        } else {
            $p_atual = $palavras[$k];
            $t_p = strlen($p_atual);
            for ($y = $t_p - 1; $y >= 0; $y--) {
                $conteudo_p .= substr($p_atual, $y, 1);
            }
            $conteudo_p .= " ";
        }
    }
    $conteudo_p .= "\n";
}
file_put_contents("p_direcao.txt", $conteudo_p);


// q) Reescreva o arquivo deixando apenas as vogais em maiúsculo.
$conteudo_q = "";
for ($i = 0; $i < $qtd_linhas; $i++) {
    $linha = $linhas[$i];
    $tam = strlen($linha);
    for ($j = 0; $j < $tam; $j++) {
        $c = substr($linha, $j, 1);
        $eh_vogal = false;
        
        for ($v = 0; $v < $tam_vogais; $v++) { 
            if ($c == substr($vogais, $v, 1)) $eh_vogal = true;
        }
        
        $novo_char = $c;
        if ($eh_vogal) {
            for ($x=0; $x<26; $x++) {
                if ($c == substr($alfabeto_min, $x, 1)) $novo_char = substr($alfabeto_mai, $x, 1);
            }
        } else {
            for ($x=0; $x<26; $x++) {
                if ($c == substr($alfabeto_mai, $x, 1)) $novo_char = substr($alfabeto_min, $x, 1);
            }
        }
        $conteudo_q .= $novo_char;
    }
    $conteudo_q .= "\n";
}
file_put_contents("q_vogais_maiusc.txt", $conteudo_q);


// r) Leia uma frase... separe palavras com sílabas de 2 caracteres
echo "\n// r) Frase com sílabas de 2 chars\n";
$frase_r = "Casa bonita";
$tam_r = strlen($frase_r);
$pal_r = "";
for ($i = 0; $i <= $tam_r; $i++) {
    $c = $i < $tam_r ? substr($frase_r, $i, 1) : " ";
    if ($c == " ") {
        if (strlen($pal_r) > 0) {
            $t_p = strlen($pal_r);
            for ($j = 0; $j < $t_p; $j+=2) {
                echo substr($pal_r, $j, 2);
                if ($j + 2 < $t_p) echo "-";
            }
            echo " ";
            $pal_r = "";
        }
    } else {
        $pal_r .= $c;
    }
}
echo "\n";


// s) Informe a última posição em que existe uma vogal em cada frase
echo "\n// s) Informe a última posição em que existe uma vogal em cada frase\n";
for ($i = 0; $i < $qtd_linhas; $i++) {
    $linha = $linhas[$i];
    $tam = strlen($linha);
    $ult_pos = -1;
    for ($j = 0; $j < $tam; $j++) {
        $c = substr($linha, $j, 1);
        for ($v = 0; $v < $tam_vogais; $v++) {
            if ($c == substr($vogais, $v, 1)) $ult_pos = $j;
        }
    }
    echo "Linha " . ($i+1) . ": $ult_pos\n";
}


// t) Some os índices de todos os caracteres que não sejam vogais.
echo "\n// t) Some os índices de todos os caracteres que não sejam vogais.\n";
$soma_t = 0;
$idx_global = 0;
for ($i = 0; $i < $qtd_linhas; $i++) {
    $linha = $linhas[$i];
    $tam = strlen($linha);
    for ($j = 0; $j < $tam; $j++) {
        $c = substr($linha, $j, 1);
        $eh_vogal = false;
        for ($v = 0; $v < $tam_vogais; $v++) {
            if ($c == substr($vogais, $v, 1)) $eh_vogal = true;
        }
        if (!$eh_vogal) $soma_t += $idx_global;
        $idx_global++;
    }
    $idx_global++; 
}
echo "Soma: $soma_t\n";


// u) Leia uma frase com qtd ímpar de palavras e informe a palavra central.
echo "\n// u) Palavra central\n";
$frase_u = "O sol brilha forte hoje";
$tam_u = strlen($frase_u);
$pals_u = []; $q_pals_u = 0; $p_u = "";
for ($i = 0; $i <= $tam_u; $i++) {
    $c = $i < $tam_u ? substr($frase_u, $i, 1) : " ";
    if ($c == " ") {
        if (strlen($p_u) > 0) { $pals_u[$q_pals_u] = $p_u; $q_pals_u++; $p_u = ""; }
    } else { $p_u .= $c; }
}
if ($q_pals_u % 2 != 0) {
    $meio = 0;
    // Conta manualmente metade para evitar funções float como round/floor
    for ($x = 1; $x < $q_pals_u; $x += 2) $meio++;
    echo "Central: " . $pals_u[$meio] . "\n";
}


// v) Leia uma frase e exiba a primeira e a última palavra na diagonal.
echo "\n// v) Primeira e última na diagonal\n";
$frase_v = "Programacao em PHP e muito divertida";
$tam_v = strlen($frase_v);
$pals_v = []; $q_v = 0; $p_v = "";
for ($i = 0; $i <= $tam_v; $i++) {
    $c = $i < $tam_v ? substr($frase_v, $i, 1) : " ";
    if ($c == " ") {
        if (strlen($p_v) > 0) { $pals_v[$q_v] = $p_v; $q_v++; $p_v = ""; }
    } else { $p_v .= $c; }
}
if ($q_v > 0) {
    $prim = $pals_v[0];
    $ult = $pals_v[$q_v - 1];
    
    $t_prim = strlen($prim);
    for($i=0; $i<$t_prim; $i++) {
        for($s=0; $s<$i; $s++) echo " ";
        echo substr($prim, $i, 1) . "\n";
    }
    
    $t_ult = strlen($ult);
    for($i=0; $i<$t_ult; $i++) {
        for($s=0; $s<$i; $s++) echo " ";
        echo substr($ult, $i, 1) . "\n";
    }
}


// w) Criptografe o arquivo lido (Deslocamento Manual de 3).
$conteudo_w = "";
for ($i = 0; $i < $tam_texto; $i++) {
    $c = substr($texto_completo, $i, 1);
    $novo_c = $c;
    
    for ($x = 0; $x < 26; $x++) {
        if ($c == substr($alfabeto_min, $x, 1)) {
            $novo_idx = $x + 3;
            if ($novo_idx >= 26) $novo_idx -= 26;
            $novo_c = substr($alfabeto_min, $novo_idx, 1);
        }
    }
    for ($x = 0; $x < 26; $x++) {
        if ($c == substr($alfabeto_mai, $x, 1)) {
            $novo_idx = $x + 3;
            if ($novo_idx >= 26) $novo_idx -= 26;
            $novo_c = substr($alfabeto_mai, $novo_idx, 1);
        }
    }
    $conteudo_w .= $novo_c;
}
file_put_contents("w_criptografado.txt", $conteudo_w);


// x) Descriptografe o arquivo criptografado.
$conteudo_x = "";
$tam_w = strlen($conteudo_w);
for ($i = 0; $i < $tam_w; $i++) {
    $c = substr($conteudo_w, $i, 1);
    $novo_c = $c;
    
    for ($x = 0; $x < 26; $x++) {
        if ($c == substr($alfabeto_min, $x, 1)) {
            $novo_idx = $x - 3;
            if ($novo_idx < 0) $novo_idx += 26;
            $novo_c = substr($alfabeto_min, $novo_idx, 1);
        }
    }
    for ($x = 0; $x < 26; $x++) {
        if ($c == substr($alfabeto_mai, $x, 1)) {
            $novo_idx = $x - 3;
            if ($novo_idx < 0) $novo_idx += 26;
            $novo_c = substr($alfabeto_mai, $novo_idx, 1);
        }
    }
    $conteudo_x .= $novo_c;
}
file_put_contents("x_descriptografado.txt", $conteudo_x);


// y) Escolha uma frase do arquivo e exiba a primeira e a última na vertical.
echo "\n// y) Primeira e última palavra na vertical\n";
if ($qtd_linhas > 0) {
    $linha = $linhas[0];
    $tam = strlen($linha);
    $pals = []; $q = 0; $p = "";
    for ($i = 0; $i <= $tam; $i++) {
        $c = $i < $tam ? substr($linha, $i, 1) : " ";
        if ($c == " ") {
            if (strlen($p) > 0) { $pals[$q] = $p; $q++; $p = ""; }
        } else { $p .= $c; }
    }
    if ($q > 0) {
        $prim = $pals[0]; $ult = $pals[$q-1];
        for ($i=0; $i<strlen($prim); $i++) echo substr($prim, $i, 1) . "\n";
        echo "---\n";
        for ($i=0; $i<strlen($ult); $i++) echo substr($ult, $i, 1) . "\n";
    }
}


// z) Escolha uma frase, primeira na diagonal e última na diagonal invertida.
echo "\n// z) Prim diagonal, ultima diagonal invertida\n";
if ($qtd_linhas > 1) {
    $linha = $linhas[1];
    $tam = strlen($linha);
    $pals = []; $q = 0; $p = "";
    for ($i = 0; $i <= $tam; $i++) {
        $c = $i < $tam ? substr($linha, $i, 1) : " ";
        if ($c == " ") {
            if (strlen($p) > 0) { $pals[$q] = $p; $q++; $p = ""; }
        } else { $p .= $c; }
    }
    if ($q > 0) {
        $prim = $pals[0]; $ult = $pals[$q-1];
        
        $t_prim = strlen($prim);
        for ($i=0; $i<$t_prim; $i++) {
            for ($s=0; $s<$i; $s++) echo " ";
            echo substr($prim, $i, 1) . "\n";
        }
        echo "---\n";
        
        $t_ult = strlen($ult);
        for ($i=0; $i<$t_ult; $i++) {
            for ($s=0; $s<($t_ult - 1 - $i); $s++) echo " ";
            echo substr($ult, $i, 1) . "\n";
        }
    }
}
?>