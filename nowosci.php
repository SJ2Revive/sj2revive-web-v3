<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SJ2Revive</title>
    <link rel="stylesheet" href="static/css/main.css">
    <link rel="stylesheet" href="static/css/components/article.css">
    <script src="/static/js/mobile.js"></script>
</head>
<body>
    <div class="sidebar">
        <?php include("elements/nav.php"); DrawNavBarHeader();?>
        <p style="font-size: 12px;text-align: center;color: yellowgreen;">Jedyna strona z modami do <span style="color: #086ed3;">Symulatora Jazdy 2</span></p>
        <a href="/">Strona Główna</a>
        <a href="/faq.php">FAQ</a>
        <a href="/nowosci.php">Nowości</a>
        <a href="/modyfikacje.php">Modyfikacje</a>
        <a href="/launcher.php">Launcher</a>
        <a href="/oa.php">Aktualizacje</a>
        <?php
        include("src/whitelist.php");
        processtabs();
        ?>
    </div>
    <div class="main-content">
        <h1></h1>
        <h3>Blog</h3>
        <h5>Tutaj znajdziesz newsy na temat SJ2Revive</h5>
        <div class="news">
        </div>
    </div>

    <script>
        
        fetch('/api/v1/articles/get.php')
            .then(response => response.json())
            .then(data => {
                const newsDiv = document.querySelector('.news');
                if (data.error) {
                    newsDiv.innerHTML = '<p>Nie udało się uzyskać newsów</p>';
                } else {
                    let newsHTML = '';
                    data.forEach(article => {
                        let tempElement = document.createElement('div');
                        tempElement.innerHTML = article.content;
                        let textContent = tempElement.textContent || tempElement.innerText || "";
                        let words = textContent.trim().split(/\s+/);
                        let shortenedContent = words.slice(0, 13).join(' ');
                        if (words.length > 10) {
                            shortenedContent += '...';
                        }
                        newsHTML += `<a href='/blog.php?id=${article.id}'>
                        <div class='articlebigger'>
                        <h2>${article.name}</h2>
                        <p>${shortenedContent}</p>
                        <p><em>${article.date}</em></p>
                        </div>
                        </a>
                        <br>`;
                    });
                    newsDiv.innerHTML = newsHTML;
                }
            })
            .catch(error => {
                const newsDiv = document.querySelector('.news');
                newsDiv.innerHTML = '<p>Nie udało się uzyskać newsów</p>';
            });
    </script>
</body>
</html>
