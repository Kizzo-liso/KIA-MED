<?php
include '../../app/config/conecta.php';
conecta();

$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$conteudo = $_POST['conteudo'];
$categoria = $_POST['categoria'];

$stmt = $mysqli->prepare("INSERT INTO POSTAGENS (titulo, descricao, conteudo) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $titulo, $descricao, $conteudo);
$stmt->execute();

$postagem_id = $mysqli->insert_id;

$stmt = $mysqli->prepare("INSERT INTO CATCONT (cod_conteudo, cod_categoria) VALUES (?, ?)");
$stmt->bind_param("ii", $postagem_id, $categoria);
$stmt->execute();

desconecta();
header("Location: gerenciamento.php");
?>
