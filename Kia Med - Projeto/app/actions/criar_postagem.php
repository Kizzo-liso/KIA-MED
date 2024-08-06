<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Postagem</title>
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
        <h1>Criar Postagem</h1>
    </header>
    <main>
        <form action="processa_criacao.php" method="post">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required></textarea>

            <label for="conteudo">Conteúdo:</label>
            <textarea id="conteudo" name="conteudo"></textarea>

            <label for="categoria">Categoria:</label>
            <select id="categoria" name="categoria" required>
                <?php
                include '../../app/config/conecta.php';
                conecta();
                $resultado = $mysqli->query("SELECT * FROM CATEGORIA");
                while($categoria = $resultado->fetch_assoc()) {
                    echo "<option value=\"{$categoria['cod_categoria']}\">{$categoria['tipo_categoria']}</option>";
                }
                desconecta();
                ?>
            </select>

            <button type="submit">Criar</button>
        </form>
    </main>
</body>
</html>
