<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KIA MED</title>
    <link rel="stylesheet" href="../public/css/aleatorio.css" />
  </head>
  <body>
    <?php 
    if(isset($_GET['msg'])){
      echo $_GET['msg'];
  } 
    ?>
    <div class="container">
      <header>
        <div class="menu-icon">
          <div class="menu-line"></div>
          <div class="menu-line"></div>
          <div class="menu-line"></div>
        </div>
        <div class="logo">KIA MED</div>
        <button class="home-button"><a href="../pages/home pogers.php">Página Inicial</a></button>
      </header>
      <main>
        <div class="logo-image">
          <img src="../public/img/kiamed.png" alt="KIA MED Logo" />
        </div>
        <div class="form-container">
          <h2>Criar Conta</h2>
          <form id="signup-form" action="../actions/cadastro.php" method="post">
            <input type="text" id="username" name="username" placeholder="Nome do Usuário" required />
            <input type="email" id="email" name="email" placeholder="Email" required />
            <input type="password" id="password" name="password" placeholder="Senha" required />
            <button type="submit">Cadastrar</button>
          </form>
        </div>
      </main>
      <footer>
        <div class="footer-content">
          <img src="../public/img/kiamed.png" alt="KIA MED Footer Logo" />
          <span>2023, <span class="footer-logo-text">KIA MED</span></span>
        </div>
      </footer>
    </div>
    <script src="scripts.js"></script>
  </body>
</html>
