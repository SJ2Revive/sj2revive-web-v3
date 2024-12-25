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
        <?php
        include("src/whitelist.php");
        processtabs();
        ?>
    </div>
    <div class="main-content">
        <h1></h1>
        <h3>Oficjalne aktualizacje SJ2 (1.01-1.03)</h3>
        <h5>Wybierz kategorie która cię interesuje</h5>
        <h4> Reupload oficjalnych aktualizacji do SJ2 ponieważ pobranie ich już nie jest możliwe </h4>
        <h4> Opis: </h4>
        <p>
        Archiwum HASŁO: 'chomik almerczak'<br />
        Po kolei podmieniaj pliki z originalnym folderem gry (każda aktualizacja osobno po kolei)<br />
        <a href='https://chomikuj.pl/c7179019/Aktualizacje+Symulator+Jazdy+2,2304492196.rar(archive)'>Źródło</a></br />
        <a href='https://www.youtube.com/watch?v=t_CQVoO1BGE'>PORADNIK WIDEO INSTALACJI AKTUALIZACJI</a><br />
        <br />
        <br />
        <a style="text-align:center;" href='mods/patch - SJ2Revive.zip'>
            <button style="text-align:center;">Pobierz</button>
        </a>
    </div>
</body>
</html>
