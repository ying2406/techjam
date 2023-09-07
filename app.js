const articles = document.querySelectorAll('.news article');

articles.forEach(article => {
    article.addEventListener('click', () => {
        alert('You clicked on a news article!');
    });
});
