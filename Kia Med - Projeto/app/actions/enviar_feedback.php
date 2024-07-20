<?php

include_once("../config/conecta.php");
session_start();

if (!isset($_SESSION['logado']) || !$_SESSION['logado']) {
    header("Location: ../pages/login.php?msgLogin=Você precisa estar logado para enviar feedback.");
    exit();
}

if (empty($_POST['feedback'])) {
    header("Location: ../pages/feedback.php?msg=O feedback não pode estar vazio.");
    exit();
}

$feedback = $_POST['feedback'];
$id_usuario = $_SESSION['id_usuario']; // ID do usuário logado
$data_feedback = date('Y-m-d');

conecta(); // Abrindo a conexão com o banco de dados
global $mysqli;

// Prepara a instrução SQL
$sql = "INSERT INTO FEEDBACK (texto_feedback, data_feedback, cod_usuario) VALUES (?, ?, ?)";
$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    die("Erro ao preparar a instrução SQL: " . $mysqli->error);
}

$stmt->bind_param("ssi", $feedback, $data_feedback, $id_usuario);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    header("Location: ../pages/feedback.php?msg=Feedback enviado com sucesso.");
} else {
    header("Location: ../pages/feedback.php?msg=Não foi possível enviar o feedback.");
}

// Fecha a conexão
$stmt->close();
desconecta();
exit();
?>
