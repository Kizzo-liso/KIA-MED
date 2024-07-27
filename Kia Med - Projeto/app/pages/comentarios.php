<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KiaMed - Comentários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            color: #555;
        }
        form {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }
        textarea {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            width: 100%;
            resize: vertical;
            height: 100px;
        }
        button {
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .comentario {
            margin-bottom: 20px;
        }
        .comentario h4 {
            margin: 0;
            color: #007BFF;
        }
        .comentario p {
            margin: 5px 0;
            color: #333;
        }
        hr {
            border: 0;
            height: 1px;
            background: #ccc;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Comentários</h1>

        <?php
        session_start();

        // Verifica se o usuário está logado
        if (!isset($_SESSION['logado']) || !$_SESSION['logado']) {
            echo "<p>Você precisa estar logado para comentar.</p>";
            exit();
        }

        // Verifica se o ID do post está presente na URL
        if (!isset($_GET['post_id'])) {
            echo "<p>ID do post não especificado.</p>";
            exit();
        }

        $post_id = $_GET['post_id'];
        ?>

        <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['nome_usuario']); ?>!</p>

        <form action="../actions/enviar_comentario.php" method="post">
            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
            <textarea name="comentario" placeholder="Digite seu comentário" required></textarea>
            <button type="submit">Enviar Comentário</button>
        </form>

        <?php 
            include 'exibir_comentarios.php';
        ?>
    </div>
</body>
</html>
