<?php
function db_connect() {
    $servername = "localhost";  // Endereço do servidor de banco de dados
    $username = "root";  // Usuário do banco de dados
    $password = "";    // Senha do banco de dados
    $dbname = "postagem"; // Nome do banco de dados

    // Cria a conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }   

    return $conn;
}
?>