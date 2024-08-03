<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $postId = intval($_GET['id']);
    $conn = db_connect();

    $sql = "DELETE FROM postagens WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postId);

    if ($stmt->execute()) {
        header("Location: gerenciarPostagens.php");
        exit;
    } else {
        echo "Erro ao deletar postagem: " . $stmt->error;
    }

    $conn->close();
} else {
    echo "ID da postagem não fornecido.";
    exit;
}
?>
