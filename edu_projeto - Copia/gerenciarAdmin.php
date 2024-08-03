<?php
include 'conexao.php'; // Inclua a conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebendo os dados do formulário
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $conteudo = $_POST['conteudo'];
    $categoria_id = intval($_POST['categoria']); // Adicionando o ID da categoria

    // Conectando ao banco de dados
    $conn = db_connect();

    if ($id > 0) {
        // Editar Postagem
        $stmt = $conn->prepare("UPDATE postagens SET titulo=?, descricao=?, conteudo=?, categoria_id=? WHERE id=?");
        $stmt->bind_param("sssii", $titulo, $descricao, $conteudo, $categoria_id, $id);
        $stmt->execute();
        echo "Postagem editada com sucesso!";
    } else {
        // Criar Postagem
        $stmt = $conn->prepare("INSERT INTO postagens (titulo, descricao, conteudo, categoria_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $titulo, $descricao, $conteudo, $categoria_id);
        $stmt->execute();
        header ("location: artigos.php");
    }

    $stmt->close();
    $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($id > 0) {
        $conn = db_connect();
        $stmt = $conn->prepare("DELETE FROM postagens WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        echo "Postagem deletada com sucesso!";
    }
}
?>
