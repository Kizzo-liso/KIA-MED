<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Postagem</title>
    <link rel="stylesheet" href="../../public/css/estilo.css">
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
    <?php
        include '../../app/config/conecta.php';
        conecta();

        // Consulta para buscar postagens com suas categorias
        $query = "
            SELECT p.cod_conteudo, p.titulo, p.data_criacao, c.tipo_categoria 
            FROM POSTAGENS p
            LEFT JOIN CATCONT cc ON p.cod_conteudo = cc.cod_conteudo
            LEFT JOIN CATEGORIA c ON cc.cod_categoria = c.cod_categoria
        ";
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
