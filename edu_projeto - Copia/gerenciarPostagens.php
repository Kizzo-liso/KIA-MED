<?php
include 'conexao.php';

function listarPostagens($search = '', $categoria = '') {
    $conn = db_connect();
    $sql = "SELECT p.id, p.titulo, c.nome AS categoria FROM postagens p INNER JOIN categorias c ON p.categoria_id = c.id WHERE 1=1";

    if ($search) {
        $sql .= " AND p.titulo LIKE ?";
        $searchParam = '%' . $search . '%';
    }

    if ($categoria) {
        $sql .= " AND c.id = ?";
    }

    $stmt = $conn->prepare($sql);

    if ($search && $categoria) {
        $stmt->bind_param('si', $searchParam, $categoria);
    } elseif ($search) {
        $stmt->bind_param('s', $searchParam);
    } elseif ($categoria) {
        $stmt->bind_param('i', $categoria);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $postagens = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $postagens[] = $row;
        }
    }
    $stmt->close();
    $conn->close();
    return $postagens;
}

function listarCategorias() {
    $conn = db_connect();
    $sql = "SELECT id, nome FROM categorias";
    $result = $conn->query($sql);
    $categorias = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categorias[] = $row;
        }
    }
    $conn->close();
    return $categorias;
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$postagens = listarPostagens($search, $categoria);
$categorias = listarCategorias();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Postagens</title>
    <link rel="stylesheet" href="teste.css">
</head>
<body>
    <header>
        <h1>Gerenciar Postagens</h1>
    </header>
    <main>
        <a href="criarPostagens.php">Criar Nova Postagem</a>
        <form method="GET" action="gerenciarPostagens.php">
            <input type="text" name="search" placeholder="Pesquisar por título..." value="<?php echo htmlspecialchars($search); ?>">
            <select name="categoria">
                <option value="">Todas as Categorias</option>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?php echo $cat['id']; ?>" <?php if ($categoria == $cat['id']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($cat['nome']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Pesquisar/Filtrar</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Categoria</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($postagens) > 0): ?>
                    <?php foreach ($postagens as $postagem): ?>
                    <tr>
                        <td><?php echo intval($postagem['id']); ?></td>
                        <td><?php echo htmlspecialchars($postagem['titulo']); ?></td>
                        <td><?php echo htmlspecialchars($postagem['categoria']); ?></td>
                        <td>
                            <a href="editarPostagens.php?id=<?php echo intval($postagem['id']); ?>">Editar</a>
                            <a href="deletarPostagens.php?id=<?php echo intval($postagem['id']); ?>" onclick="return confirm('Tem certeza que deseja deletar esta postagem?')">Deletar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Nenhuma postagem encontrada.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
