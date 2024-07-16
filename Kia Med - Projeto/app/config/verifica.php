<?php

require_once("conecta.php");

//Função que verifica se o email já foi cadastrado
//Retorna true caso já exista uma pessoa castrada com o email informado
function verificaEmail($email){

    conecta();

    global $mysqli;

    $sql = "SELECT Cod_USUARIO FROM USUARIO WHERE email = ?;";

    $stmt = $mysqli->prepare($sql);
    
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $retorno = $stmt->get_result();

    desconecta();

    if($retorno->num_rows == 1){
        return true;
    }else{
        return false;
    }  
}

?>