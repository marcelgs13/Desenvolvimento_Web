<?php


// Questão 01
// Leia uma frase e escreva sem espaços em branco

echo "<h3>Questão 01</h3>";
$frase01 = "Esta e uma frase de teste";
$resultado01 = "";
$tamanho01 = strlen($frase01);

for ($i = 0; $i < $tamanho01; $i++) {
    $letra = substr($frase01, $i, 1);
    if ($letra != " ") {
        $resultado01 .= $letra;
    }
}
echo "Original: $frase01 <br>";
echo "Resultado: $resultado01 <br><hr>";



// Questão 02
// Leia uma frase e informe quantas palavras existem na frase lida

echo "<h3>Questão 02</h3>";
$frase02 = "Contando as palavras desta frase";
$qtdPalavras = 0;
$dentroDaPalavra = false;
$tamanho02 = strlen($frase02);

for ($i = 0; $i < $tamanho02; $i++) {
    $letra = substr($frase02, $i, 1);
    if ($letra != " ") {
        if (!$dentroDaPalavra) {
            $qtdPalavras++; 
            $dentroDaPalavra = true;
        }
    } else {
        $dentroDaPalavra = false; 
    }
}
echo "Frase: '$frase02' <br>";
echo "Quantidade de palavras: $qtdPalavras <br><hr>";



// Questão 03
// Leia uma frase e informe quantos caracteres são vogais

echo "<h3>Questão 03</h3>";
$frase03 = "Exemplo de frase para contar vogais";
$vogais03 = "aeiouAEIOU";
$qtdVogais = 0;
$tamanho03 = strlen($frase03);
$tamanhoVogais03 = strlen($vogais03);

for ($i = 0; $i < $tamanho03; $i++) {
    $letraDaFrase = substr($frase03, $i, 1);
    

    for ($j = 0; $j < $tamanhoVogais03; $j++) {
        if ($letraDaFrase == substr($vogais03, $j, 1)) {
            $qtdVogais++;
            break; 
        }
    }
}
echo "Frase: $frase03 <br>";
echo "Total de vogais: $qtdVogais <br><hr>";



// Questão 04
// Leia uma frase e duas palavras; Verifique se a primeira palavra está 
// presente na frase; Caso esteja, substitua pela segunda palavra

echo "<h3>Questão 04</h3>";
$frase04 = "O rato roeu a roupa do rei";
$palavraAntiga = "rato";
$palavraNova = "gato";
$resultado04 = "";

$tamFrase04 = strlen($frase04);
$tamAntiga = strlen($palavraAntiga);

for ($i = 0; $i < $tamFrase04; $i++) {
    $encontrou = true;
    
   
    for ($j = 0; $j < $tamAntiga; $j++) {

        if (($i + $j) >= $tamFrase04 || substr($frase04, $i + $j, 1) != substr($palavraAntiga, $j, 1)) {
            $encontrou = false;
            break;
        }
    }
    
    if ($encontrou) {
        $resultado04 .= $palavraNova;
        $i += ($tamAntiga - 1); 
    } else {
        $resultado04 .= substr($frase04, $i, 1); 
    }
}
echo "Frase: $frase04 <br>";
echo "Resultado: $resultado04 <br><hr>";



// Questão 05
// Leia uma frase e escreva as vogais em maiúsculo

echo "<h3>Questão 05</h3>";
$frase05 = "transformando as vogais";
$minusculas = "aeiou";
$maiusculas = "AEIOU";
$resultado05 = "";
$tamanho05 = strlen($frase05);

for ($i = 0; $i < $tamanho05; $i++) {
    $letra = substr($frase05, $i, 1);
    $ehVogal = false;
    
  
    for ($j = 0; $j < 5; $j++) {
        if ($letra == substr($minusculas, $j, 1)) {
            $resultado05 .= substr($maiusculas, $j, 1); 
            $ehVogal = true;
            break;
        }
    }
    
    if (!$ehVogal) {
        $resultado05 .= $letra; 
    }
}
echo "Frase: $frase05 <br>";
echo "Resultado: $resultado05 <br><hr>";



// Questão 06
// Leia uma palavra e escreva essa palavra na vertical

echo "<h3>Questão 06</h3>";
$palavra06 = "VERTICAL";
$tamanho06 = strlen($palavra06);

echo "Palavra original: $palavra06 <br><br>";
for ($i = 0; $i < $tamanho06; $i++) {
    echo substr($palavra06, $i, 1) . "<br>";
}
echo "<hr>";


// Questão 07
// Leia uma frase e escreva as vogais com a cor vermelha

echo "<h3>Questão 07</h3>";
$frase07 = "Destacando cores";
$vogais07 = "aeiouAEIOU";
$tamVogais07 = strlen($vogais07);
$tamanho07 = strlen($frase07);

echo "Resultado: ";
for ($i = 0; $i < $tamanho07; $i++) {
    $letra = substr($frase07, $i, 1);
    $ehVogal = false;
    
    for ($j = 0; $j < $tamVogais07; $j++) {
        if ($letra == substr($vogais07, $j, 1)) {
            $ehVogal = true;
            break;
        }
    }
    
    if ($ehVogal) {

        echo "<span style='color:red;'>" . $letra . "</span>";
    } else {
        echo $letra;
    }
}
echo "<br><hr>";



// Questão 08
// Leia uma palavra e escreva de trás para frente

echo "<h3>Questão 08</h3>";
$palavra08 = "PROGRAMACAO";
$resultado08 = "";
$tamanho08 = strlen($palavra08);


for ($i = $tamanho08 - 1; $i >= 0; $i--) {
    $resultado08 .= substr($palavra08, $i, 1);
}

echo "Palavra original: $palavra08 <br>";
echo "Inverso: $resultado08 <br><hr>";

?>