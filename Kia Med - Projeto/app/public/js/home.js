
  document.addEventListener("DOMContentLoaded", function() {
    const toggleButton = document.getElementById("toggle-dark-mode");
    const body = document.body;

    // Verifique se há uma preferência salva e aplique
    if (localStorage.getItem("dark-mode") === "enabled") {
      body.classList.add("dark-mode");
    }

    // Função para alternar o modo dark
    toggleButton.addEventListener("click", function() {
      body.classList.toggle("dark-mode");

      // Salve a preferência do usuário
      if (body.classList.contains("dark-mode")) {
        localStorage.setItem("dark-mode", "enabled");
      } else {
        localStorage.removeItem("dark-mode");
      }
    });
  });

