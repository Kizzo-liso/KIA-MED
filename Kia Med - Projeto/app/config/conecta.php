<?php

define('user','root');
define('password','');
define('host','localhost');
define('db','Kiamed');

$mysqli;

function conecta(){

    global $mysqli;

    $mysqli = new mysqli(host,user,password,db);
    if($mysqli->connect_errno){
        die("Falha ao conectar {$mysqli->connect_errno}");
    }
}

function desconecta(){
    global $mysqli;
    $mysqli->close();
}
