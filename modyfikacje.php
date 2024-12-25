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
        <?php include("elements/nav.php"); DrawNavBarHeader();?>
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
        <h3>Modyfikacje</h3>
        <h5>Tutaj znajdziesz mody na temat SJ2Revive</h5>
        <div class="mods">
        </div>
    </div>

    <script>
        fetch('/api/v1/mods/get.php')
            .then(response => response.json())
            .then(data => {
                const modsDiv = document.querySelector('.mods');
                if (data.error) {
                    modsDiv.innerHTML = '<p>Nie udało się uzyskać modów</p>';
                } else {
                    let modsHTML = '';
                    data.forEach(mod => {
                        modsHTML += `<div class='mod'><img src="static/img/mods/${mod.id}.png" height="256" width="256"/><br/><a href='/getmod.php?id=${mod.id}'>${mod.name} - ${mod.shortdesc}</a><br></div>`;
                    });
                    modsDiv.innerHTML = modsHTML;
                }
            })
            .catch(error => {
                const modsDiv = document.querySelector('.mods');
                modsDiv.innerHTML = '<p>Nie udało się uzyskać modów</p>';
            });
    </script>
</body>
</html>