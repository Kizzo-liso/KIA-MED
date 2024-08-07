<?php

require_once("../config/conecta.php");
require_once("../config/verifica.php");

session_start(); // Iniciar a sessão

$msg = '';

if (empty($_POST['username'])) {
    $msg = "Preencha o campo nome";
} elseif (empty($_POST['email'])) {
    $msg = "Preencha o campo email";
} elseif (empty($_POST['password'])) {
    $msg = "Preencha o campo senha";
} elseif (verificaEmail($_POST['email'])) {
    $msg = "Email já cadastrado. Por favor, informe um email diferente";
} else {
    // Supondo que os campos no formulário são 'username' e 'password'
    $nome = $_POST['username'];
    $email = $_POST['email'];
    $senhaCrip = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Conecta ao banco de dados
    conecta();

    // Prepara a instrução SQL
    $sql = "INSERT INTO USUARIO(nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($sql);

    if (!$stmt) {
        die("Erro ao inserir. Problema no acesso ao banco de dados.");
    }

    // Vincula os parâmetros e executa a instrução
    $stmt->bind_param("sss", $nome, $email, $senhaCrip);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['username'] = $nome; // Armazenar o nome do usuário na sessão
        $msg = "Pessoa cadastrada com sucesso.";
    } else {
        $msg = "Não foi possível inserir.";
    }

    // Fecha a conexão
    desconecta();
}

// Redireciona para a página de cadastro com a mensagem
header("Location: ../pages/Cadastro.php?msg=" . urlencode($msg));
exit;

?>
