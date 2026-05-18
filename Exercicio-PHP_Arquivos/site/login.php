<?php
require_once 'config.php';

$mensagem = "";

// Verificando requisição via GET
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['email']) && isset($_GET['senha'])) {
    $email = $_GET['email'] ?? '';
    $senha = $_GET['senha'] ?? '';

    if (!empty($email) && !empty($senha)) {
        // Busca o usuário no MySQL
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica a senha obedecendo à segurança hash padrão
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            // Renova ou valida os cookies ativos
            setcookie("usuario_nome", $usuario['nome'], time() + 3600, "/");

            // Redireciona para a Home Estelar
            header("Location: index.php");
            exit;
        } else {
            $mensagem = "<p style='color: red;'>E-mail ou senha incorretos!</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Batcaverna</title>
    <style>
        body { 
            background-color: #121212; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            color: #FFD700; 
            text-align: center; 
            margin-top: 40px; 
        }
        .bat-box-login { 
            background: #1e1e1e; 
            padding: 30px; 
            border-radius: 12px; 
            width: 350px; 
            margin: 0 auto; 
            box-shadow: 0px 4px 15px rgba(255, 215, 0, 0.15); 
            border: 1px solid #333;
        }
        .bat-avatar { 
            width: 120px; 
            height: 120px; 
            border-radius: 50%; 
            object-fit: cover; 
            display: block; 
            margin: 0 auto 10px auto; 
            border: 4px solid #FFD700; 
        }
        h1 { 
            font-size: 1.8rem; 
            margin: 0 0 20px 0; 
            color: #FFD700; 
            letter-spacing: 1.5px;
        }
        input { 
            width: 100%; 
            padding: 10px; 
            margin: 10px 0; 
            background-color: #2c2c2c; 
            color: #ffffff; 
            border: 1px solid #555; 
            border-radius: 6px; 
            box-sizing: border-box; 
        }
        input::placeholder {
            color: #aaaaaa;
        }
        button { 
            background-color: #FFD700; 
            color: #121212; 
            border: none; 
            padding: 12px; 
            width: 100%; 
            border-radius: 6px; 
            cursor: pointer; 
            font-weight: bold; 
            transition: background 0.3s;
        }
        button:hover { 
            background-color: #e6c200; 
        }
        a {
            color: #FFD700;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<img src="imagens/batman.png" alt="Batman" class="bat-avatar">
<h1>Acesso à Batcaverna</h1>

<div class="bat-box-login">
    <?php echo $mensagem; ?>
    <form action="login.php" method="GET">
        <input type="email" name="email" placeholder="Digite seu E-mail" required>
        <input type="password" name="senha" placeholder="Digite sua Senha" required>
        <button type="submit">Acessar Sistema</button>
    </form>
    <p><a href="cadastro.php">Não tem cadastro? Crie aqui</a></p>
</div>

</body>
</html>