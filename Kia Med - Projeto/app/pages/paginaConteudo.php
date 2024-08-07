<?php
include '../../app/config/conecta.php';
conecta();

// Obtém o ID da postagem da query string
$postId = $_GET['id'] ?? null;

if ($postId) {
    // Consulta para buscar a postagem com base no ID
    $query = "SELECT titulo, descricao, conteudo, data_criacao FROM POSTAGENS WHERE cod_conteudo = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $postagem = $resultado->fetch_assoc();

    if (!$postagem) {
        echo "Postagem não encontrada.";
        exit;
    }
} else {
    echo "ID da postagem não fornecido.";
    exit;
}

desconecta();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($postagem['titulo']); ?></title>
    <link rel="stylesheet" href="../../public/css/conteudo.css">
</head>
<body>
    <div class="container">
        <div class="post">
            <h1><?php echo htmlspecialchars($postagem['titulo']); ?></h1>
            <p class="descricao"><?php echo htmlspecialchars($postagem['descricao']); ?></p>
            <div class="conteudo">
                <?php echo htmlspecialchars_decode($postagem['conteudo']); // Decodifica HTML especial ?>
            </div>
            <p class="data-criacao">Publicado em: <?php echo date("d/m/Y", strtotime($postagem['data_criacao'])); ?></p>
        </div>
    </div>
</body>
</html>
