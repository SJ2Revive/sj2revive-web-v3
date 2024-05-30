<?php
require("../src/whitelist.php");
session_start();
if (!isset($_SESSION["token"])) {
    Header("Location: /login.php");
    die();
}
if(!CheckIfHasPerms($_SESSION['token'],"admin",true))
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
        <br/>
        <br/>
    <form action="../api/v1/articles/edit.php" method="POST">
        <?php
        
            $id = $_GET["id"];
            echo "<input name='id' type='hidden' value='$id'>$id</input>";
            require(ROOT_PATH."/config.php");
            $db = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname, $dbport);
            $stmt = $db->prepare("SELECT * FROM articles WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if( $result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $title = $row["Nazwa"];
                    $desc = $row['Zawartosc'];
                    echo "<p>Nazwa posta</p>
                    <input name='title' value='$title'/>
                    <br/>
                    <br/>
                    <p>Zawartość posta</p>
                    <textarea name='desc' width='500' height='500'>$desc</textarea>
                    <br/>
                    <br/>
                    <input type='submit'/>";
                }
            }
            
            
        ?>
    </form>
    </div>
</body>
</html>
