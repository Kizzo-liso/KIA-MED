<?php

include '../config/conecta.php'; // Inclua o arquivo de conexão

conecta(); // Abrindo a conexão com o banco de dados
global $mysqli;

// Verifica se o ID do post está presente na URL
if (!isset($_GET['post_id'])) {
    echo "<p>ID do post não especificado.</p>";
    exit();
}

$post_id = $_GET['post_id'];

// Corrija o nome da coluna na consulta SQL
$sql = "SELECT u.nome, c.texto_comentario, c.data_comentario 
        FROM COMENTARIO c 
        JOIN USUARIO u ON c.cod_usuario = u.cod_usuario 
        WHERE c.cod_post = ?
        ORDER BY c.data_comentario DESC";

$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    die("Erro ao preparar a instrução SQL: " . $mysqli->error);
}

$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();

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

$stmt->close();
desconecta();
?>
