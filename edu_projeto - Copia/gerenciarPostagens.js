document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("postForm");
    const createButton = document.getElementById("createButton");
    const editButton = document.getElementById("editButton");
    const deleteButton = document.getElementById("deleteButton");

    const urlParams = new URLSearchParams(window.location.search);
    const postId = urlParams.get('id');

    if (postId) {
        // Carregar dados da postagem para edição
        fetch(`carregar_postagem.php?id=${postId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById("id").value = data.id;
                document.getElementById("titulo").value = data.titulo;
                document.getElementById("descricao").value = data.descricao;
                document.getElementById("conteudo").value = data.conteudo;

                createButton.style.display = "none";
                editButton.style.display = "block";
                deleteButton.style.display = "block";
            });
    }

    editButton.addEventListener("click", () => {
        form.action = "gerenciar_postagem.php";
        form.method = "post";
        form.submit();
    });

    deleteButton.addEventListener("click", () => {
        const titulo = document.getElementById("titulo").value;
        if (confirm(`Tem certeza que quer apagar "${titulo}"?`)) {
            fetch('gerenciar_postagem.php', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${postId}`
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                window.location.href = "artigos.php";
            });
        }
    });
});
