<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SJ2Revive</title>
    <link rel="stylesheet" href="static/css/main.css">
    <link rel="stylesheet" href="static/css/blogpost.css">
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
        <h3 id="blogTitle"></h3>
        <h5 id="blogDate"></h5>
        <p id="blogContent"></p>
        <div class="comments">
        <br/>
    </div>
    <?php
        if(CheckSessionPerms("admin"))
        {
            $id = $_GET['id'];
            echo "<a href='/admin/panel.php?p=editblog&id=$id'><button class='danger'>Edytuj post</button></a><br/><br/>";
            echo "<a href='/admin/panel.php?p=delblog&id=$id'><button class='danger'>Usuń post</button></a>";
        }
    ?>
    <script src="static/js/getBlog.js"></script>
    <script src="static/js/getBlogComments.js"></script>
</body>
</html>