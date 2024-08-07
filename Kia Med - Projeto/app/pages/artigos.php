<?php
session_start();
include_once("../config/conecta.php");

// Função para obter categorias e postagens
function obterCategoriasEPublicacoes() {
    global $mysqli;

    $categoriasEPostagens = [];

    // Obtém todas as categorias
    $sqlCategorias = "SELECT * FROM CATEGORIA";
    $resultCategorias = $mysqli->query($sqlCategorias);

    if ($resultCategorias->num_rows > 0) {
        while ($categoria = $resultCategorias->fetch_assoc()) {
            $codCategoria = $categoria['cod_categoria'];
            $tipoCategoria = $categoria['tipo_categoria'];

            // Obtém postagens para a categoria atual
            $sqlPostagens = "SELECT p.cod_conteudo, p.titulo, p.descricao, p.data_criacao
                             FROM POSTAGENS p
                             JOIN CATCONT cc ON p.cod_conteudo = cc.cod_conteudo
                             WHERE cc.cod_categoria = ?";
            $stmtPostagens = $mysqli->prepare($sqlPostagens);
            $stmtPostagens->bind_param("i", $codCategoria);
            $stmtPostagens->execute();
            $resultPostagens = $stmtPostagens->get_result();

            $postagens = [];
            while ($postagem = $resultPostagens->fetch_assoc()) {
                $postagens[] = $postagem;
            }

            $categoriasEPostagens[] = [
                'categoria' => $tipoCategoria,
                'postagens' => $postagens
            ];
        }
    }

    return $categoriasEPostagens;
}

// Conecta ao banco de dados
conecta();

// Obtém categorias e postagens
$categoriasEPostagens = obterCategoriasEPublicacoes();

// Desconecta do banco de dados
desconecta();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artigos - Kia Med</title>
    <link rel="stylesheet" href="../../public/css/artigos.css">
</head>
<body>

    <header>
        <h1>Sessão de Artigos do KIA MED</h1>


    </header>
    <main>
        <?php foreach ($categoriasEPostagens as $categoria): ?>
            <section class="category-section">
                <h2 class="category-title"><?php echo htmlspecialchars($categoria['categoria']); ?></h2>
                <div class="latest-posts-container">
                    <?php if (empty($categoria['postagens'])): ?>
                        <p>Sem postagens nesta categoria.</p>
                    <?php else: ?>
                        <?php foreach ($categoria['postagens'] as $postagem): ?>
                            <div class="latest-post-item">
                                <h3><?php echo htmlspecialchars($postagem['titulo']); ?></h3>
                                <p><?php echo htmlspecialchars(substr($postagem['descricao'], 0, 100)) . '...'; ?></p>
                                <a href="paginaConteudo.php?id=<?php echo $postagem['cod_conteudo']; ?>">Leia mais</a>
                                <p>Data: <?php echo date("d/m/Y", strtotime($postagem['data_criacao'])); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>
        <?php endforeach; ?>
    </main>
</body>
</html>
