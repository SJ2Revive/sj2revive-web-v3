<?php
require("../src/whitelist.php");
if(!CheckSessionPerms("admin"))
{
    header("location: /");
    die();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SJ2Revive</title>
    <style>
        @import url("../static/css/blogpost.css");
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
        processtabs();
        ?>
    </div>
    <div class="main-content">
        <h2>Dodaj Mod</h2>
        <form action="/api/v1/mods/add.php" method="POST" enctype="multipart/form-data">
            <input name="name" placeholder="Nazwa moda" required><br>
            <textarea name="shortdesc" placeholder="Krótki opis moda" required></textarea><br>
            <textarea name="desc" placeholder="Opis moda" required></textarea><br>
            <label for="zdj">Zdjęcie (JPG, JPEG, PNG, GIF):</label><br>
            <input type="file" id="zdj" name="zdj" accept="image/*" required><br><br>
            <label for="mod">Mod (ZIP, RAR, 7Z):</label><br>
            <input type="file" id="mod" name="mod" accept=".zip,.rar,.7z" required><br><br>
            <input type="submit" value="Dodaj Mod">
        </form>
    </div>
</body>
</html>
