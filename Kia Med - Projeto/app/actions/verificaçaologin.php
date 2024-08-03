<?php

include_once("../config/conecta.php");

session_start();

if(empty($_POST['email']) || empty($_POST['senha'])){
    header("Location: ../pages/login.php?msgLogin=Preencha todos os campos!");
    exit();
}

$login = $_POST['email'];
$senha = $_POST['senha'];

conecta(); // Abrindo a conexão com o banco de dados
global $mysqli;

// Prepara a instrução SQL
$sql = "SELECT * FROM USUARIO WHERE email = ?";
$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    die("Erro ao preparar a instrução SQL: " . $mysqli->error);
}

$stmt->bind_param("s", $login);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows === 1){
    // Obtém os dados do usuário
    $pessoa = $result->fetch_object();

    // Verifica a senha
    if(password_verify($senha, $pessoa->senha)){
        // Inicia a sessão e armazena os dados do usuário
        $_SESSION['nome_usuario'] = $pessoa->nome;
        $_SESSION['logado'] = true;
        $_SESSION['id_usuario'] = $pessoa->cod_usuario; // Corrigido para cod_usuario
        header("Location: ../pages/home.php");
        exit();
    } else {
        header("Location: ../pages/login.php?msgLogin=Usuário ou senha incorretos!");
        exit();
    }

} else {
    header("Location: ../pages/login.php?msgLogin=Usuário ou senha incorretos!");
    exit();
}

// Fecha a conexão
$stmt->close();
desconecta();
?>
