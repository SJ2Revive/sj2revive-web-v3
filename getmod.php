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
    </div>
    <div class="main-content">
        <h3 id="ModTitle">test</h3>
        <?php
        $id = $_GET['id'];
        echo "<img src='static/img/mods/$id.png' height='768' width='1024'/>"
        ?>
        <h5 id="ModDesc">test</h5>
        <a href="" id="dloadbtn">
            <button>Pobierz</button>
        </a>
    </div>

    <script>
        fetch('/api/v1/mods/get.php')
            .then(response => response.json())
            .then(data => {
                console.log(data);
                const ModTitle = document.getElementById('ModTitle');
                const ModDesc = document.getElementById('ModDesc');
                const dload = document.getElementById("dloadbtn");
                if (data.error) {
                    ModTitle.textContent = 'Błąd pobierania bloga';
                    ModDesc.textContent = 'Wystąpił błąd podczas pobierania zawartości bloga.';
                } else {
                    const articleId = new URLSearchParams(window.location.search).get('id');
                    const article = data.find(item => item.id === articleId);
                    if (article) {
                        ModTitle.innerHTML = article.name;
                        ModDesc.innerHTML = article.description;
                        dload.href = article.filename
                    } else {
                        ModTitle.textContent = 'Błąd pobierania moda';
                        ModDesc.textContent = 'Wystąpił błąd podczas pobierania zawartości moda.';
                    }
                }
            })
            .catch(error => {
                console.error('Błąd podczas pobierania zawartości moda:', error);
                const ModTitle = document.getElementById('ModTitle');
                const ModDesc = document.getElementById('ModDesc');
                ModTitle.textContent = 'Błąd pobierania moda';
                ModDesc.textContent = 'Wystąpił błąd podczas pobierania zawartości moda.';
            });
    </script>
</body>
</html>
