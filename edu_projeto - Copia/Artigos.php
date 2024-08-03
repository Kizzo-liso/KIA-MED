<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artigos</title>
    <link rel="stylesheet" href="artigos.css">
    <script src="artigos.js" defer></script>
</head>
<body>
    <header>
        <h1>Artigos</h1>
    </header>
    <main>
        <!-- Barra de Pesquisa -->
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Pesquisar por título...">
            <button onclick="searchPosts()">Pesquisar</button>
        </div>

        <!-- Container para os blocos de categorias -->
        <div class="categories-container">
            <?php
            include 'conexao.php';
            $conn = db_connect();

            // Busca todas as categorias
            $sqlCategorias = "SELECT * FROM categorias";
            $resultCategorias = $conn->query($sqlCategorias);

            if ($resultCategorias->num_rows > 0) {
                while ($categoria = $resultCategorias->fetch_assoc()) {
                    $categoriaId = intval($categoria['id']);
                    $categoriaNome = htmlspecialchars($categoria['nome']);

                    echo '<div class="category-section">';
                    echo '<h2 class="category-title">'.$categoriaNome.'</h2>';

                    // Adiciona botão de scroll para a esquerda e para a direita
                    echo '<button class="scroll-button left" onclick="scrollLeft(\''.$categoriaId.'\')">&#9664;</button>';
                    echo '<button class="scroll-button right" onclick="scrollRight(\''.$categoriaId.'\')">&#9654;</button>';

                    // Container para os blocos da categoria
                    echo '<div id="category-'.$categoriaId.'" class="category-blocks-wrapper">';
                    
                    // Busca postagens para cada categoria
                    $sqlPostagens = "SELECT * FROM postagens WHERE categoria_id = $categoriaId";
                    $resultPostagens = $conn->query($sqlPostagens);

                    if ($resultPostagens->num_rows > 0) {
                        while ($postagem = $resultPostagens->fetch_assoc()) {
                            echo '<div class="category-block">';
                            echo '<h3>'.htmlspecialchars($postagem['titulo']).'</h3>';
                            echo '<p>'.htmlspecialchars($postagem['descricao']).'</p>';
                            echo '<a href="paginaConteudo.php?id='.intval($postagem['id']).'">Leia mais</a>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>Nenhuma postagem encontrada para esta categoria.</p>';
                    }

                    echo '</div>'; // Fecha category-blocks-wrapper
                    echo '</div>'; // Fecha category-section
                }
            } else {
                echo '<p>Nenhuma categoria encontrada.</p>';
            }

            $conn->close();
            ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Seu Site. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
