<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: ../pages/login.php?msgLogin=Você precisa estar logado para acessar esta página.");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="stylesheet" href="../../public/css/feedback.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 
    <!-- /Google Fonts -->
</head>
<body>
    <!-- criando o container (caixa) -->
    <div id="container">
        <form action="" method="post">
            <div class="box-feedback">
                <h1>Feedback</h1>   
                <label for="">Informe no campo abaixo sua opinião:</label>
                <textarea name="" id="" cols="30" rows="10" placeholder="" required></textarea>
                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>
</body>
</html>