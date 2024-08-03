<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Postagem</title>
    <link rel="stylesheet" href="gerenciarPostagens.css">
    <script src="tinymce/tinymce.min.js"></script>
</head>
<body>
    <header>
        <h1>Criar Postagem</h1>
    </header>
    <main>
        <form action="gerenciarAdmin.php" method="post" id="postForm">
            <input type="hidden" id="id" name="id">
            
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>

            <label for="descricao">Descrição:</label>
            <input type="text" id="descricao" name="descricao" required>

            <label for="conteudo">Conteúdo:</label>
            <textarea id="conteudo" name="conteudo" required></textarea>

            <label for="categoria">Categoria:</label>
            <select id="categoria" name="categoria" required>
                <?php
                include 'conexao.php';
                $conn = db_connect();
                $sql = "SELECT id, nome FROM categorias";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<option value="'.$row['id'].'">'.htmlspecialchars($row['nome']).'</option>';
                    }
                } else {
                    echo '<option value="">Nenhuma categoria encontrada</option>';
                }
                $conn->close();
                ?>
            </select>

            <button type="submit" id="createButton">Criar Postagem</button>
            <button type="button" id="editButton" style="display: none;">Editar Postagem</button>
            <button type="button" id="deleteButton" style="display: none;">Deletar Postagem</button>
        </form>
    </main>

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
</body>
</html>
