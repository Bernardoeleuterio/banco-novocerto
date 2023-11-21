<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login Gerente</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
</head>
<center>
<body class="index">
    <div class="login-container">
        <h2>Bem-vindo</h2>
        <form action="processar_login.php" method="POST">
        <div class="input-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="Digite seu email" required><br><br>
            </div>
            
            <div class="input-group">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required><br><br>
            </div>

            <button type="submit" name="submit">Entrar</button>
        </form>
    </div>
</center>
</body>
</html>



