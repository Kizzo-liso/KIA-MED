<?php
include '../../app/config/conecta.php';
conecta();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Primeiro, remover a relação da tabela CATCONT
    $stmt = $mysqli->prepare("DELETE FROM CATCONT WHERE cod_conteudo = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    // Depois, remover a postagem da tabela POSTAGENS
    $stmt = $mysqli->prepare("DELETE FROM POSTAGENS WHERE cod_conteudo = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    desconecta();

    header("Location: deletar_postagem.php");
    exit;
} else {
    desconecta();
    echo "ID inválido.";
}
?>
