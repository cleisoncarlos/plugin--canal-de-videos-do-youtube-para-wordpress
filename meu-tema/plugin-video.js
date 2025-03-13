document.addEventListener('DOMContentLoaded', function() {
    // Seleciona todos os itens da lista
    const videoItems = document.querySelectorAll('.d-flex');
    const iframe = document.querySelector('.ratio iframe');
    const titleElement = document.querySelector('.col-lg-6 h4');

    // Adiciona evento de clique a cada item
    videoItems.forEach(function(item) {
        item.addEventListener('click', function() {
            // Extrai o videoId da URL do thumbnail
            const thumbnailSrc = this.querySelector('img').getAttribute('src');
            const videoIdMatch = thumbnailSrc.match(/vi\/(.+)\//);
            const videoId = videoIdMatch ? videoIdMatch[1] : '';

            // Pega o título do elemento .flex-grow-1
            const title = this.querySelector('.flex-grow-1').textContent.trim();

            // Atualiza o iframe e o título
            if (videoId) {
                iframe.setAttribute('src', 'https://www.youtube.com/embed/' + videoId);
                titleElement.textContent = title;
            }
        });
    });
});