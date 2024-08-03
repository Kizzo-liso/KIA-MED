<?php
include 'carregarPostagens.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $conn = db_connect();
    $stmt = $conn->prepare("SELECT id, titulo, descricao, conteudo FROM postagens WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $postagem = $result->fetch_assoc();
        echo json_encode($postagem);
    } else {
        echo json_encode([]);
    }

    $stmt->close();
    $conn->close();
}
?>
