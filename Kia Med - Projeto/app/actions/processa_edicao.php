<?php
include '../../app/config/conecta.php';
conecta();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $conteudo = $_POST['conteudo'];
    $categoria = $_POST['categoria'];

    // Atualizar a postagem na tabela POSTAGENS
    $stmt = $mysqli->prepare("UPDATE POSTAGENS SET titulo = ?, descricao = ?, conteudo = ? WHERE cod_conteudo = ?");
    $stmt->bind_param("sssi", $titulo, $descricao, $conteudo, $id);
    $stmt->execute();

    // Atualizar a relação na tabela CATCONT
    $stmt = $mysqli->prepare("UPDATE CATCONT SET cod_categoria = ? WHERE cod_conteudo = ?");
    $stmt->bind_param("ii", $categoria, $id);
    $stmt->execute();

    desconecta();

    header("Location: gerenciamento.php");
    exit;
} else {
    desconecta();
    echo "Método de requisição inválido.";
}
?>