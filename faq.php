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
        <h1 > FAQ </h1>
        
        <p > Co to? </p>
        <p > - Jest to projekt w którym Ja(<a href="https://www.youtube.com/channel/UCr5BqK36fL0dx_OFHN0xNuw">Zordon1337</a>) i <a href="https://www.youtube.com/channel/UCZpCDxbAiJCrxgJBMR1cVQA">Qwertyuiop123</a> próbujemy ożywić grę "Symulator Jazdy 2" za pomocą nieoficjalnych modyfikacji, niestandardowego launchera oraz całkiem nowej zawartości do pobrania. </p>
        <p > Jak zainstalować mody? </p>
        <p > - Rozpakowujemy plik Zip, czytamy dołączony do niego plik "Poradnik.txt" lub "Readme.txt", i postępujemy zgodnie z zawartą w nich instrukcją. </p>
        <p> Jak zaktualizować Launcher? </p>
        <p> - z racji że już nie aktualizujemy go na stronie musisz użyć Auto Updater'a </p>
    </div>
</body>
</html>
