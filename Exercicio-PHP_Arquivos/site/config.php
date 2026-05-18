<?php
$host = '127.0.0.1'; // Usar o IP local ajuda a evitar problemas de DNS interno
$port = '3306';      // <-- DEFININDO A PORTA DO XAMPP QUE ESTÁ ATIVA
$db   = 'portal_ted';
$user = 'root';
$pass = '';

try {
    // Adicionamos o "port=$port" dentro da string de conexão (DSN)
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
?>