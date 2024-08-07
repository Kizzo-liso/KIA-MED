<?php
// session_start(); // Iniciar a sessão no início do arquivo
?>

<link rel="stylesheet" href="../../public/css/header.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<header>
    <button style="background: none; border: none" id="toggle-dark-mode">
        <i class="bi bi-moon-fill"></i>
        <i class="bi bi-brightness-high-fill"></i>
    </button>

    <div id="titulo">
        <h1><a href="home.php">Kia Med</a></h1>
    </div>
    <nav>
        <ul>
            <a href="categoria.php"><li>Categorias</li></a>
            <a href="artigos.php">Artigos</a>
            <a href="../pages/feedback.php"><li>Feedback</li></a>
            <?php if (isset($_SESSION['nome_usuario'])): ?>
                <li class="dropdown">
                    <button class="dropbtn" id="dropdownButton">Olá, <?php echo htmlspecialchars($_SESSION['nome_usuario']); ?></button>
                    <div class="dropdown-content" id="dropdownContent">
                        <a href="../actions/logout.php">Sair</a>
                        <?php if (isset($_SESSION['usuario_admin']) && $_SESSION['usuario_admin']): ?>
                            <a href="../actions/gerenciamento.php">Gerenciamento</a>
                        <?php endif; ?>
                    </div>
                </li>
            <?php else: ?>
                <a href="../pages/login.php" id="inscreva-se"><li>Já tem uma conta?</li></a>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<script src="../../public/js/home.js"></script>
