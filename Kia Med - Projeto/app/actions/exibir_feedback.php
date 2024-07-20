<?php

include_once("../config/conecta.php");
session_start();

conecta(); // Abrindo a conexão com o banco de dados
global $mysqli;

// Prepara a instrução SQL para obter todos os feedbacks
$sql = "SELECT u.nome, f.texto_feedback, f.data_feedback
        FROM FEEDBACK f
        JOIN USUARIO u ON f.cod_usuario = u.cod_usuario
        ORDER BY f.data_feedback DESC";

$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    die("Erro ao preparar a instrução SQL: " . $mysqli->error);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($feedback = $result->fetch_assoc()) {
        echo "<div>";
        echo "<p><strong>" . htmlspecialchars($feedback['nome']) . "</strong> enviou feedback em " . htmlspecialchars($feedback['data_feedback']) . ":</p>";
        echo "<p>" . htmlspecialchars($feedback['texto_feedback']) . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>Sem feedbacks disponíveis.</p>";
}

// Fecha a conexão
$stmt->close();
desconecta();
?>
