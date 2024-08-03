function scrollLeft(categoriaId) {
    const container = document.getElementById('category-' + categoriaId);
    container.scrollBy({
        left: -250, // Ajuste conforme necessário
        behavior: 'smooth'
    });
}

function scrollRight(categoriaId) {
    const container = document.getElementById('category-' + categoriaId);
    container.scrollBy({
        left: 250, // Ajuste conforme necessário
        behavior: 'smooth'
    });
}

function searchPosts() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const blocks = document.querySelectorAll('.category-block');

    blocks.forEach(block => {
        const title = block.querySelector('h3').textContent.toLowerCase();
        if (title.includes(searchInput)) {
            block.style.display = 'block';
        } else {
            block.style.display = 'none';
        }
    });
}
