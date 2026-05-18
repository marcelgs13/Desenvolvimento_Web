<?php
require_once 'config.php';

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Validação padrão de segurança da senha (Mínimo 8 caracteres, 1 Letra Maiúscula, 1 Número)
    if (strlen($senha) < 8 || !preg_match("/[A-Z]/", $senha) || !preg_match("/[0-9]/", $senha)) {
        $mensagem = "<p style='color: red;'>A senha deve ter pelo menos 8 caracteres, incluindo uma letra maiúscula e um número.</p>";
    } elseif (!empty($nome) && !empty($email) && !empty($senha)) {

        // Criptografia segura da senha (Hash)
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        try {
            // Insere no banco MySQL
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
            $stmt->execute([$nome, $email, $senhaHash]);

            // Define cookies com tempo de expiração de 1 hora (3600 segundos)
            $tempoDestruicao = time() + 3600;
            setcookie("usuario_nome", $nome, $tempoDestruicao, "/");
            setcookie("usuario_email", $email, $tempoDestruicao, "/");

            // Grava as informações do tempo de destruição do cadastro em um arquivo .txt
            $linhaTxt = "Usuario: $nome | Email: $email | Cookie expira em: " . date("Y-m-d H:i:s", $tempoDestruicao) . PHP_EOL;
            file_put_contents("expiracao_cookies.txt", $linhaTxt, FILE_APPEND);

            $mensagem = "<p style='color: green;'>Cadastro realizado com sucesso! <a href='login.php'>Ir para o Login</a></p>";
        } catch (PDOException $e) {
            $mensagem = "<p style='color: red;'>Erro ao cadastrar. Talvez o e-mail já esteja em uso.</p>";
        }
    } else {
        $mensagem = "<p style='color: red;'>Por favor, preencha todos os campos.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - Batcaverna</title>
    <style>
        body { 
            background-color: #121212; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            color: #FFD700; 
            display: block; 
            text-align: center; 
            margin: 50px auto; 
        }
        .bat-box-cadastro { 
            background: #1e1e1e; 
            padding: 30px; 
            border-radius: 12px; 
            width: 350px; 
            margin: 0 auto; 
            box-shadow: 0px 4px 15px rgba(255, 215, 0, 0.15); 
            border: 1px solid #333;
        }
        h2 {
            color: #FFD700;
            letter-spacing: 1.5px;
            margin-top: 0;
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

<div class="bat-box-cadastro">
    <h2>Registro na Batcaverna</h2>
    <?php echo $mensagem; ?>
    <form action="cadastro.php" method="POST">
        <input type="text" name="nome" placeholder="Nome Completo" required>
        <input type="email" name="email" placeholder="Seu E-mail" required>
        <input type="password" name="senha" placeholder="Senha (8+ char, 1 Maiúscula, 1 Número)" required>
        <button type="submit">Cadastrar Aliado</button>
    </form>
    <p><a href="login.php">Já tem acesso? Entrar no Sistema</a></p>
</div>

</body>
</html>