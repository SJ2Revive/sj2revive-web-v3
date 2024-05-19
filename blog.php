<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SJ2Revive</title>
    <style>
        @import url("static/css/blogpost.css");
    </style>
</head>
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
        <div class="comments">
        
        <br/>
        
    </div>


    <script src="static/js/getBlog.js"></script>
    <script src="static/js/getBlogComments.js"></script>
</body>
</html>
