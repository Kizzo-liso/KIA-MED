<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $postId = intval($_GET['id']);
    $conn = db_connect();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $conteudo = $_POST['conteudo'];
        $categoriaId = intval($_POST['categoria_id']);

        $sql = "UPDATE postagens SET titulo = ?, descricao = ?, conteudo = ?, categoria_id = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssii", $titulo, $descricao, $conteudo, $categoriaId, $postId);

        if ($stmt->execute()) {
            header("Location: gerenciarPostagens.php");
            exit;
        } else {
            echo "Erro ao atualizar postagem: " . $stmt->error;
        }
    }

    $sql = "SELECT * FROM postagens WHERE id = $postId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $postagem = $result->fetch_assoc();
    } else {
        echo "Postagem não encontrada.";
        exit;
    }

    $sqlCategorias = "SELECT * FROM categorias";
    $resultCategorias = $conn->query($sqlCategorias);
    $categorias = $resultCategorias->fetch_all(MYSQLI_ASSOC);

    $conn->close();
} else {
    echo "ID da postagem não fornecido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Postagem</title>
    <link rel="stylesheet" href="teste.css">
    <script src="tinymce/tinymce.min.js"></script>
</head>
<body>
    <header>
        <h1>Editar Postagem</h1>
    </header>
    <main>
        <form action="editarPostagem.php?id=<?php echo $postId; ?>" method="post">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($postagem['titulo']); ?>" required>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required><?php echo htmlspecialchars($postagem['descricao']); ?></textarea>

            <label for="conteudo">Conteúdo:</label>
            <textarea id="conteudo" name="conteudo" required><?php echo htmlspecialchars($postagem['conteudo']); ?></textarea>

            <label for="categoria_id">Categoria:</label>
            <select id="categoria_id" name="categoria_id" required>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?php echo intval($categoria['id']); ?>" <?php if ($categoria['id'] == $postagem['categoria_id']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($categoria['nome']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Salvar Alterações</button>
        </form>
    </main>
    <script>
        tinymce.init({
            selector: '#conteudo'
        });
    </script>
</body>
</html>
