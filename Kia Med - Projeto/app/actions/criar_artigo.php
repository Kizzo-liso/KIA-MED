
<main>
    <h2>Criar Novo Artigo</h2>
    <form action="create.php" method="post" enctype="multipart/form-data">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required>

        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" required>

        <label for="conteudo">Conteúdo:</label>
        <textarea id="conteudo" name="conteudo" required></textarea>

        <label for="imagem">Imagem:</label>
        <input type="file" id="imagem" name="imagem">

        <label for="categoria">Categoria:</label>
        <select id="categoria" name="categoria" required>
            <?php
            include '../includes/db.php';
            $sql = "SELECT id, nome FROM categorias";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["nome"] . "</option>";
                }
            } else {
                echo "<option value=''>Nenhuma categoria disponível</option>";
            }
            $conn->close();
            ?>
        </select>

        <input type="submit" value="Criar">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include '../includes/db.php';
        
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $conteudo = $_POST['conteudo'];
        $categoria_id = $_POST['categoria'];
        
        $target_dir = "../public/imgs/";
        $target_file = $target_dir . basename($_FILES["imagem"]["name"]);
        move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file);
        
        $imagem = basename($_FILES["imagem"]["name"]);
        
        $sql = "INSERT INTO posts (titulo, descricao, conteudo, imagem, categoria_id) VALUES ('$titulo', '$descricao', '$conteudo', '$imagem', '$categoria_id')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Novo artigo criado com sucesso";
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }
    ?>
</main>

