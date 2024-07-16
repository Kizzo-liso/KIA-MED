<?php

include_once("../config/conecta.php");

if(empty($_POST['usuario']) || empty($_POST['senha'])){
    header("location: ../pages/login.php?msgLogin=Preencha todos os campos!");

}else{

    $login = $_POST['login'];
    $senha = $_POST['senha'];

    conecta(); //Abrindo a conexão com o bd

    $sql = "SELECT * FROM USUARIO WHERE email = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $login);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows == 1){
        //continuar com a rotina de autenticação

        $pessoa = $result->fetch_object();

        if(password_verify($senha, $pessoa->senha)){
            //prosseguir com a rotina de autenticação

            session_start();
            $_SESSION['nome_usuario'] = $pessoa->nome;
            $_SESSION['logado'] = true;
            $_SESSION['id_usuario'] = $pessoa->idpessoa;
            header("location: ../pages/home.php");

        }else{
            header("location: ../pages/login.php?msgLogin=Usuário ou senha incorretos!");
        }

    }else{
        header("location: ../pages/login.php?msgLogin=Usuário ou senha incorretos!");
    }



}
