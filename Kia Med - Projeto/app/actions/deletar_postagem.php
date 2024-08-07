<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Postagem</title>
    <link rel="stylesheet" href="../../public/css/estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        function confirmDelete(postId, postTitle) {
            if (confirm('Você realmente deseja apagar a postagem "' + postTitle + '"?')) {
                window.location.href = 'processa_delecao.php?id=' + postId;
            }
        }
    </script>
</head>
<body>
    <header>
        <h1>Deletar Postagem</h1>
    </header>
    <main>
    <div class="search-filter">
            <form method="GET" action="deletar_postagem.php" >
                <div class="search-input-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" name="search" placeholder="Buscar por título" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                </div>
                <select name="category">
                    <option value="">Todas as categorias</option>
                    <?php
                    include '../../app/config/conecta.php';
                    conecta();
                    $categorias = $mysqli->query("SELECT * FROM CATEGORIA");
                    while ($categoria = $categorias->fetch_assoc()) {
                        echo '<option value="' . $categoria['cod_categoria'] . '"' . (isset($_GET['category']) && $_GET['category'] == $categoria['cod_categoria'] ? ' selected' : '') . '>' . htmlspecialchars($categoria['tipo_categoria']) . '</option>';
                    }
                    desconecta();
                    ?>
                </select>
                <button type="submit">Filtrar</button>
            </form>
        </div>

        <?php
        conecta();

        // Construir query dinâmica baseada em filtros
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $category = isset($_GET['category']) ? $_GET['category'] : '';

        $query = "
            SELECT p.cod_conteudo, p.titulo, p.data_criacao, c.tipo_categoria 
            FROM POSTAGENS p
            LEFT JOIN CATCONT cc ON p.cod_conteudo = cc.cod_conteudo
            LEFT JOIN CATEGORIA c ON cc.cod_categoria = c.cod_categoria
            WHERE 1=1
        ";

        if ($search) {
            $query .= " AND p.titulo LIKE '%" . $mysqli->real_escape_string($search) . "%'";
        }

        if ($category) {
            $query .= " AND c.cod_categoria = " . (int)$category;
        }

        $resultado = $mysqli->query($query);
        ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Data de Criação</th>
                    <th>Categoria</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($postagem = $resultado->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $postagem['cod_conteudo']; ?></td>
                        <td><?php echo htmlspecialchars($postagem['titulo']); ?></td>
                        <td><?php echo $postagem['data_criacao']; ?></td>
                        <td><?php echo htmlspecialchars($postagem['tipo_categoria']); ?></td>
                        <td>
                            <a href="#" onclick="confirmDelete(<?php echo $postagem['cod_conteudo']; ?>, '<?php echo htmlspecialchars(addslashes($postagem['titulo'])); ?>')">Deletar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php desconecta(); ?>
    </main>
</body>
</html>