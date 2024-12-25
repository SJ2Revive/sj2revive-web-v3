<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SJ2Revive</title>
    <style>
        @import url("static/css/main.css");
        @import url("static/css/shoutbox.css");
        .article {
            text-align: left;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            cursor: pointer;
            width: 20%;
            display: inline-block;
        }
        .g-recaptcha {
            display: none;
        }
    </style>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
    function onSubmit(token) {
        document.getElementById("chatbox").submit();
    }

    function showCaptcha() {
        document.getElementById("recaptcha-container").style.display = 'block';
        grecaptcha.render('recaptcha-container', {
            'sitekey': '<?php include("config.php"); echo $sitekey;?>',
            'callback': onSubmit
        });
    }

    function validate(event) {
        event.preventDefault(); 
        showCaptcha(); 
    }
    </script>
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
        processtabs();
        ?>
    </div>
    <div class="main-content">
        <h1></h1>
        <h3>Witamy na odnowionej stronie projektu SJ2REVIVE</h3>
        <h5>Wybierz kategorie która cię interesuje</h5>
        <img src="https://media.tenor.com/ZZIk4A2HY4sAAAAi/cockroach-spinning.gif" width="256" height="256"/>
        <?php
            if($toggleShoutbox == true) {
                echo "
                <div class='shoutboxcontainer'>
                <p align='center'>Shoutbox</p>
                <div class='shoutbox'>
                </div>
                <br/>
                <form action='api/v1/shoutbox/add.php' id='chatbox' method='post'>
                    <input name='author' placeholder='Nazwa użytkownika' required/>
                    <input name='content' placeholder='Wiadomość' required/>
                    <div id='recaptcha-container' class='g-recaptcha' data-callback='onSubmit'></div>
                    <br/>
                    <input type='button' onclick='validate(event)' value='Prześlij'></input>
                </form>";
                    if(CheckSessionPerms('admin'))
                    {
                        echo "<a href='api/v1/shoutbox/clear.php'><button style='width:100%'>Wyczyść czat</button></a>";
                    }
                echo "</div>";
            }
        ?>
        <br/>
        <h3>Najnowszy post na blogu</h3>
        <div class="article-wrapper">
            <div id="article-container"></div>
        </div>
        <script src="static/js/getShoutbox.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
            fetch('api/v1/articles/get.php')
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) return;
                    let highestIdArticle = data.reduce((prev, current) => (parseInt(prev.id) > parseInt(current.id)) ? prev : current);
                    let tempElement = document.createElement('div');
                    tempElement.innerHTML = highestIdArticle.content;
                    let textContent = tempElement.textContent || tempElement.innerText || "";
                    let words = textContent.trim().split(/\s+/);
                    let shortenedContent = words.slice(0, 10).join(' ');
                    if (words.length > 10) {
                        shortenedContent += '...';
                    }
                    let articleDiv = document.createElement('div');
                    articleDiv.className = 'article';
                    articleDiv.innerHTML = `
                        <h2>${highestIdArticle.name}</h2>
                        <p>${shortenedContent}</p>
                        <p><em>${highestIdArticle.date}</em></p>
                    `;
                    articleDiv.addEventListener('click', () => {
                        window.location.href = `blog.php?id=${highestIdArticle.id}`;
                    });
                    document.getElementById('article-container').appendChild(articleDiv);
                })
                .catch(error => console.error('Błąd fetchowania artykułu', error));
        });
        </script>
    </div>
</body>
</html>
