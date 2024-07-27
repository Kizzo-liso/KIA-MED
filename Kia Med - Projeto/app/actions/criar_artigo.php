<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Novo Artigo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        main {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin: 10px 0 5px;
            color: #333;
        }
        input[type="text"], textarea, select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            width: 100%;
        }
        input[type="file"] {
            padding: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            width: 100%;
        }
        input[type="submit"] {
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
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

            if ($conn->connect_error) {
                die("Conexão falhou: " . $conn->connect_error);
            }

            $sql = "SELECT id, nome FROM categorias";
            $result = $conn->query($sql);

            if ($result === false) {
                echo "<option value=''>Erro ao carregar categorias: " . $conn->error . "</option>";
            } else {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["id"] . "'>" . htmlspecialchars($row["nome"]) . "</option>";
                    }
                } else {
                    echo "<option value=''>Nenhuma categoria disponível</option>";
                }
            }

            $conn->close();
            ?>
        </select>

        <input type="submit" value="Criar">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include '../includes/db.php';

        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        $titulo = $conn->real_escape_string($_POST['titulo']);
        $descricao = $conn->real_escape_string($_POST['descricao']);
        $conteudo = $conn->real_escape_string($_POST['conteudo']);
        $categoria_id = (int)$_POST['categoria'];

        $imagem = null;
        if (!empty($_FILES["imagem"]["name"])) {
            $target_dir = "../public/imgs/";
            $target_file = $target_dir . basename($_FILES["imagem"]["name"]);
            if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
                $imagem = basename($_FILES["imagem"]["name"]);
            } else {
                echo "Erro ao fazer upload da imagem.";
            }
        }

        $sql = "INSERT INTO posts (titulo, descricao, conteudo, imagem, categoria_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Erro ao preparar a instrução SQL: " . $conn->error);
        }
        $stmt->bind_param("ssssi", $titulo, $descricao, $conteudo, $imagem, $categoria_id);

        if ($stmt->execute()) {
            echo "Novo artigo criado com sucesso";
        } else {
            echo "Erro: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</main>
</body>
</html>
