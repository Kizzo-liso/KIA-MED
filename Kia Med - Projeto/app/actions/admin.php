
<main>
    <h2>Administração</h2>
    <a href="create.php">Criar Novo Artigo</a>
    <h3>Lista de Artigos</h3>
    <ul>
        <!-- Lista de artigos será carregada aqui -->
        <?php
        include '../includes/db.php';
        $sql = "SELECT posts.id, posts.titulo, categorias.nome AS categoria FROM posts JOIN categorias ON posts.categoria_id = categorias.id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<li>" . $row["titulo"] . " - " . $row["categoria"] . " <a href='edit.php?id=" . $row["id"] . "'>Editar</a> <a href='delete.php?id=" . $row["id"] . "'>Excluir</a></li>";
            }
        } else {
            echo "0 resultados";
        }
        $conn->close();
        ?>
    </ul>
</main>

