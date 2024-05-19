<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SJ2Revive</title>
    <style>
        @import url("static/css/main.css");
        @import url("static/css/shoutbox.css");
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
        <h1></h1>
        <h3>Witamy na odnowionej stronie projektu SJ2REVIVE</h3>
        <h5>Wybierz kategorie która cię interesuje</h5>
        <img src="https://media.tenor.com/ZZIk4A2HY4sAAAAi/cockroach-spinning.gif" width="256" height="256"/>
        <div class="shoutboxcontainer">
            <p align="center">Shoutbox</p>
            <div class="shoutbox">
            </div>
            <br/>
            <form action="api/v1/shoutbox/add.php" method="get">
                <input name="author" placeholder="Nazwa użytkownika"/>
                <input name="content" placeholder="Wiadomość"/>
                <input type="submit"/>
                
            </form>
            <?php
                if(checkifwhitelisted())
                {
                    echo "<a href='api/v1/shoutbox/clear.php'><button style='width:100%'>Wyczyść czat</button></a>";
                }
                ?>
        </div>
        <script src="static/js/getShoutbox.js"></script>
    </div>
</body>
</html>
