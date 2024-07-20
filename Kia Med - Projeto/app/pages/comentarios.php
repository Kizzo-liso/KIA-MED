<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KiaMed - Comentários</title>
</head>
<body>
    <h1>Comentários</h1>

    <?php
    session_start();

    // Verifica se o usuário está logado
    if (!isset($_SESSION['logado']) || !$_SESSION['logado']) {
        echo "<p>Você precisa estar logado para comentar.</p>";
        exit();
    }
    ?>

    <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['nome_usuario']); ?>!</p>

    <form action="../actions/enviar_comentario.php" method="post">
        <textarea name="comentario" placeholder="Digite seu comentário" required></textarea>
        <br>
        <button type="submit">Enviar Comentário</button>
    </form>

    <?php 
        include_once 'exibir comentarios.php';
    ?>
</body>
</html>
