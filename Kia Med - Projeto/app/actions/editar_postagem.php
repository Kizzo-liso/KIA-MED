<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Postagem</title>
    <link rel="stylesheet" href="../../public/css/estilo.css">
</head>
<body>
    <header>
        <h1>Editar Postagem</h1>
    </header>
    <main>
        <?php
        include '../../app/config/conecta.php';
        conecta();

        $query = "
            SELECT p.cod_conteudo, p.titulo, p.data_criacao, c.tipo_categoria 
            FROM POSTAGENS p
            JOIN CATCONT cc ON p.cod_conteudo = cc.cod_conteudo
            JOIN CATEGORIA c ON cc.cod_categoria = c.cod_categoria
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
                        <td><a href="editar_postagem.php?id=<?php echo $postagem['cod_conteudo']; ?>">Editar</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php desconecta(); ?>
    </main>
</body>
</html>