<?php

include_once("../config/conecta.php");
session_start();

if (!isset($_SESSION['logado']) || !$_SESSION['logado']) {
    header("Location: ../pages/login.php?msgLogin=Você precisa estar logado para comentar.");
    exit();
}

if (empty($_POST['comentario']) || empty($_POST['post_id'])) {
    header("Location: ../pages/comentarios.php?msg=O comentário ou ID do post não podem estar vazios.");
    exit();
}

$comentario = $_POST['comentario'];
$post_id = $_POST['post_id'];
$id_usuario = $_SESSION['id_usuario']; // ID do usuário logado
$data_comentario = date('Y-m-d');

conecta(); // Abrindo a conexão com o banco de dados
global $mysqli;

// Prepara a instrução SQL
$sql = "INSERT INTO COMENTARIO (texto_comentario, data_comentario, cod_usuario, cod_post) VALUES (?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    die("Erro ao preparar a instrução SQL: " . $mysqli->error);
}

$stmt->bind_param("ssii", $comentario, $data_comentario, $id_usuario, $post_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    header("Location: ../pages/comentarios.php?post_id=$post_id&msg=Comentário enviado com sucesso.");
} else {
    header("Location: ../pages/comentarios.php?post_id=$post_id&msg=Não foi possível enviar o comentário.");
}

// Fecha a conexão
$stmt->close();
desconecta();
exit();
?>
