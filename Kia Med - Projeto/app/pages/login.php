<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KiaMed - Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="../actions/verificaçaologin.php" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Digite seu email" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
        <br>
        <button type="submit">Logar</button>
    </form>
</body>
</html>
