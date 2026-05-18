<?php
// Proteção de página: Se o cookie não existir, joga de volta para o login
if (!isset($_COOKIE['usuario_nome'])) {
    header("Location: login.php");
    exit;
}

$nomeUsuario = $_COOKIE['usuario_nome'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Home - Batcaverna</title>
    <style>
        body {
            background-color: #121212;
            font-family: 'Century Gothic', sans-serif;
            color: #ffffff;
            text-align: center;
            margin: 0;
            padding: 50px 20px;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
        }
        .bat-container {
            max-width: 800px;
            margin: 0 auto;
        }
        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            letter-spacing: 2px;
            color: #FFD700;
        }
        .bat-message {
            font-size: 1.5rem;
            margin-bottom: 50px;
            background: rgba(255, 215, 0, 0.1);
            border: 1px solid rgba(255, 215, 0, 0.3);
            padding: 15px;
            border-radius: 8px;
            display: inline-block;
        }
        .bat-operator-info {
            font-size: 1.8rem;
            font-weight: bold;
            margin-top: 40px;
            color: #FFD700;
            text-shadow: none;
        }
        .bat-avatar {
            width: 250px;
            border-radius: 15px;
            margin-top: 20px;
            box-shadow: 0 8px 16px rgba(255, 215, 0, 0.15);
            display: block;
            margin: 20px auto 0 auto;
        }
        .bat-logout {
            display: inline-block;
            margin-top: 20px;
            color: #121212;
            text-decoration: none;
            font-weight: bold;
            background: #FFD700;
            padding: 8px 16px;
            border-radius: 20px;
            transition: background 0.3s;
        }
        .bat-logout:hover {
            background: #e6c200;
        }
    </style>
</head>
<body>

<div class="bat-container">
    <h1>Bem-Vindo à Batcaverna</h1>

    <div class="bat-message">
        🦇 Você se conectou com sucesso à rede segura da Batcaverna!
    </div>

    <div class="bat-operator-info">
        Batcomputador operado por: <span style="color: white;"><?php echo htmlspecialchars($nomeUsuario); ?></span>
    </div>

    <img src="imagens/batman-logado.png" alt="Batman Logado" class="bat-avatar">

    <br>
    <a href="login.php" class="bat-logout">Sair do Sistema</a>
</div>

</body>
</html>