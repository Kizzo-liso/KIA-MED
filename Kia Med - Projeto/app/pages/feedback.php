<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="stylesheet" href="../public/css/feedback.css">
</head>
<body>
    <!-- criando o container (caixa) -->
    <div id="container">
       
    <form action="../actions/enviar_feedback.php" method="post">
        <h1>Feedback</h1>
        <div>
            <label for="feedback">Informe no campo abaixo sua opinião:</label>
            <textarea name="feedback" id="feedback" cols="30" rows="10" placeholder="Escreva aqui..." required></textarea><br>
        </div>
        <button type="submit">Enviar</button>
    </form>

    </div>
    
</body>
</html>