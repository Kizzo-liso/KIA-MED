<?php
include 'conexao.php';

$conn = db_connect();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $stmt = $conn->prepare("SELECT titulo, descricao, conteudo, data_criacao FROM postagens WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($titulo, $descricao, $conteudo, $data_criacao);
    $stmt->fetch();
    $stmt->close();
} else {
    echo "Postagem não encontrada.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($titulo); ?></title>
    <link rel="stylesheet" href="teste.css">
</head>
<body>
    <header>
        <h1><?php echo htmlspecialchars($titulo); ?></h1>
    </header>
    <main>
        <article>
            <h2><?php echo htmlspecialchars($descricao); ?></h2>
            <!-- Aqui estamos exibindo o conteúdo do TinyMCE sem escapar HTML -->
            <div><?php echo $conteudo; ?></div>
            <p><small>Publicado em: <?php echo date('d/m/Y H:i', strtotime($data_criacao)); ?></small></p>
        </article>
        <section id="comments">
            <!-- Seção para comentários -->
        </section>
    </main>
</body>
</html>