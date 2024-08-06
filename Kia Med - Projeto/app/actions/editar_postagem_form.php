<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Postagem</title>
    <link rel="stylesheet" href="../../public/css/estilo.css">
    <script src="../../tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            tinymce.init({
                selector: 'textarea#conteudo',
                setup: function (editor) {
                    editor.on('change', function () {
                        tinymce.triggerSave();
                    });
                }
            });

            const form = document.getElementById('postForm');
            form.addEventListener('submit', function (e) {
                tinymce.triggerSave(); // Garante que o conteúdo do TinyMCE seja salvo no textarea
                if (!form.checkValidity()) {
                    e.preventDefault(); // Impede o envio do formulário se não for válido
                }
            });
        });

        function validateForm() {
            tinymce.triggerSave(); // Garante que o conteúdo do TinyMCE seja salvo no textarea
            return true;
        }
    </script>
</head>
<body>
    <header>
        <h1>Editar Postagem</h1>
    </header>
    <main>
        <?php
        include '../../app/config/conecta.php';
        conecta();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $stmt = $mysqli->prepare("SELECT * FROM POSTAGENS WHERE cod_conteudo = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $postagem = $resultado->fetch_assoc();

            if ($postagem) {
                $titulo = $postagem['titulo'];
                $descricao = $postagem['descricao'];
                $conteudo = $postagem['conteudo'];

                // Recupera a categoria atual da postagem
                $stmt_categoria = $mysqli->prepare("SELECT cod_categoria FROM CATCONT WHERE cod_conteudo = ?");
                $stmt_categoria->bind_param("i", $id);
                $stmt_categoria->execute();
                $resultado_categoria = $stmt_categoria->get_result();
                $categoria_atual = $resultado_categoria->fetch_assoc()['cod_categoria'];
            } else {
                echo "Postagem não encontrada.";
                exit;
            }
        } else {
            echo "ID da postagem não fornecido.";
            exit;
        }
        ?>
        <form action="processa_edicao.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($titulo); ?>" required>
            
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required><?php echo htmlspecialchars($descricao); ?></textarea>
            
            <label for="conteudo">Conteúdo:</label>
            <textarea id="conteudo" name="conteudo" required><?php echo htmlspecialchars($conteudo); ?></textarea>
            
            <label for="categoria">Categoria:</label>
            <select id="categoria" name="categoria" required>
                <option value="">Selecione uma categoria</option>
                <?php
                $resultado = $mysqli->query("SELECT * FROM CATEGORIA");
                while ($categoria = $resultado->fetch_assoc()) {
                    $selected = ($categoria['cod_categoria'] == $categoria_atual) ? 'selected' : '';
                    echo "<option value=\"{$categoria['cod_categoria']}\" $selected>{$categoria['tipo_categoria']}</option>";
                }
                desconecta();
                ?>
            </select>

            <button type="submit">Salvar Alterações</button>
        </form>
    </main>
</body>
</html>