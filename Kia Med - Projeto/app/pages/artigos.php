<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/style.css">
    <title>Artigos</title>
</head>
<body>
    <main>
        <h2>Artigos</h2>
        <?php
        include '../config/conecta.php';
        $sql = "SELECT categorias.nome AS categoria, GROUP_CONCAT(posts.titulo, '|', posts.descricao, '|', posts.imagem SEPARATOR ';') AS posts FROM posts JOIN categorias ON posts.categoria_id = categorias.id GROUP BY categorias.nome";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<h3>" . $row["categoria"] . "</h3>";
                $posts = explode(";", $row["posts"]);
                echo "<div class='categoria'>";
                foreach ($posts as $post) {
                    list($titulo, $descricao, $imagem) = explode("|", $post);
                    echo "<div class='post'>";
                    echo "<img src='/public/imgs/$imagem' alt='$titulo'>";
                    echo "<h4>$titulo</h4>";
                    echo "<p>$descricao</p>";
                    echo "</div>";
                }
                echo "</div>";
            }
        } else {
            echo "Nenhum artigo disponível";
        }
        $conn->close();
        ?>
    </main>
</body>
</html>


