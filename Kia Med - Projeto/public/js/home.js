document.addEventListener("DOMContentLoaded", function() {
  const toggleButton = document.getElementById("toggle-dark-mode");
  const body = document.body;

  // Verifique se há uma preferência salva e aplique
  if (localStorage.getItem("dark-mode") === "enabled") {
      body.classList.add("dark-mode");
  }

  // Atualizar ícones com base no modo atual
  function updateIcons() {
      const moonIcon = toggleButton.querySelector('.bi-moon-fill');
      const sunIcon = toggleButton.querySelector('.bi-brightness-high-fill');

      if (body.classList.contains("dark-mode")) {
          moonIcon.style.display = 'none';
          sunIcon.style.display = 'inline';
          localStorage.setItem("icon-mode", "sun");
      } else {
          moonIcon.style.display = 'inline';
          sunIcon.style.display = 'none';
          localStorage.setItem("icon-mode", "moon");
      }
  }

  // Função para alternar o modo dark
  toggleButton.addEventListener('click', function() {
      body.classList.toggle("dark-mode");

      // Salve a preferência do usuário
      if (body.classList.contains("dark-mode")) {
          localStorage.setItem("dark-mode", "enabled");
      } else {
          localStorage.removeItem("dark-mode");
      }

      // Alternar ícones
      updateIcons();
  });

  // Inicializar ícones na primeira carga
  if (localStorage.getItem("dark-mode") === "enabled") {
      toggleButton.querySelector('.bi-moon-fill').style.display = 'none';
      toggleButton.querySelector('.bi-brightness-high-fill').style.display = 'inline';
  } else {
      toggleButton.querySelector('.bi-moon-fill').style.display = 'inline';
      toggleButton.querySelector('.bi-brightness-high-fill').style.display = 'none';
  }
});


document.addEventListener("DOMContentLoaded", function() {
    const dropdownButton = document.getElementById("dropdownButton");
    const dropdownContent = document.getElementById("dropdownContent");

    dropdownButton.addEventListener("click", function() {
        dropdownContent.classList.toggle("show");
    });

    // Fechar o dropdown se clicar fora dele
    window.addEventListener("click", function(event) {
        if (!event.target.matches('.dropbtn')) {
            if (dropdownContent.classList.contains('show')) {
                dropdownContent.classList.remove('show');
            }
        }
    });
});
