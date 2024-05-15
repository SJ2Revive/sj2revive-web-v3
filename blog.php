<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SJ2Revive</title>
    <style>
        @import url("static/css/main.css");
    </style>
</head>
<body>
    <div class="sidebar">
        <h2 class="logo">
            <span style="color: #086ed3;">SJ2</span>
            <span style="color: green;">Revive</span>
            <span style="color: yellow;">.top</span>
        </h2>
        <p style="font-size: 12px;text-align: center;color: yellowgreen;">Jedyna strona z modami do <span style="color: #086ed3;">Symulatora Jazdy 2</span></p>
        <a href="/">Strona Główna</a>
        <a href="/faq.php">FAQ</a>
        <a href="/nowosci.php">Nowości</a>
        <a href="/modyfikacje.php">Modyfikacje</a>
        <a href="/launcher.php">Launcher</a>
        <a href="/oa.php">Aktualizacje</a>
        <a href="/ustawienia.php">Ustawienia</a>
        <?php
        include("src/whitelist.php");
        render();
        ?>
    </div>
    <div class="main-content">
        <h3 id="blogTitle"></h3>
        <h5 id="blogDate"></h5>
        <p id="blogContent"></p>
    </div>

    <script>
        fetch('/api/v1/articles/get.php')
            .then(response => response.json())
            .then(data => {
                console.log(data);
                const blogTitle = document.getElementById('blogTitle');
                const blogDate = document.getElementById('blogDate');
                const blogContent = document.getElementById('blogContent');

                if (data.error) {
                    blogTitle.textContent = 'Błąd pobierania bloga';
                    blogDate.textContent = '';
                    blogContent.textContent = 'Wystąpił błąd podczas pobierania zawartości bloga.';
                } else {
                    const articleId = new URLSearchParams(window.location.search).get('id');
                    const article = data.find(item => item.id === articleId);
                    if (article) {
                        blogTitle.textContent = article.name;
                        blogDate.innerHTML = article.date;
                        blogContent.textContent = article.content;
                    } else {
                        blogTitle.textContent = 'Błąd pobierania bloga';
                        blogDate.textContent = '';
                        blogContent.textContent = 'Wystąpił błąd podczas pobierania zawartości bloga.';
                    }
                }
            })
            .catch(error => {
                console.error('Błąd podczas pobierania zawartości bloga:', error);
                const blogTitle = document.getElementById('blogTitle');
                const blogDate = document.getElementById('blogDate');
                const blogContent = document.getElementById('blogContent');
                blogTitle.textContent = 'Błąd pobierania bloga';
                blogDate.textContent = '';
                blogContent.textContent = 'Wystąpił błąd podczas pobierania zawartości bloga.';
            });
    </script>
</body>
</html>
