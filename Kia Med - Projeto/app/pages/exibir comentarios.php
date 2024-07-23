<?php

include '../config/conecta.php'; // Inclua o arquivo de conexão

conecta(); // Abrindo a conexão com o banco de dados
global $mysqli;

// Corrija o nome da coluna na consulta SQL
$sql = "SELECT u.nome, c.texto_comentario, c.data_comentario 
        FROM COMENTARIO c 
        JOIN USUARIO u ON c.cod_usuario = u.cod_usuario 
        ORDER BY c.data_comentario DESC";

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='comentario'>";
        echo "<h4>" . htmlspecialchars($row['nome']) . " - " . htmlspecialchars($row['data_comentario']) . "</h4>";
        echo "<p>" . htmlspecialchars($row['texto_comentario']) . "</p>";
        echo "</div><hr>";
    }
} else {
    echo "<p>Sem comentários ainda.</p>";
}

desconecta();
?>
