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
        <div style="margin-top: 20vh">
            <a href="/admin/panel.php?p=addmod">
                <button>Dodaj moda</button>
            </a>
            <a href="/admin/panel.php?p=addblog">
                <button>Dodaj wpis na blog'a</button>
            </a>
        </div>
        <br/>
        <?php
            if(isset($_GET["p"]))
            {
                $p = $_GET["p"];
                switch($p) 
                {
                    case "editblog":
                    {
                        echo "<form action='../api/v1/articles/edit.php' method='POST'>";
                        $id = $_GET['id'];
                        echo "<input name='id' type='hidden' value='$id'>$id</input>";
                        require("..\\config.php");
                        $db = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname, $dbport);
                        $stmt = $db->prepare('SELECT * FROM articles WHERE id = ?');
                        $stmt->bind_param('i', $id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if( $result->num_rows > 0)
                        {
                            while($row = $result->fetch_assoc())
                            {
                                $title = $row['Nazwa'];
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
                        echo "</form>";
                        break;     
                    }
                    case "delblog":
                        {
                            require(ROOT_PATH.'/config.php');
                            if(!isset($_GET["id"]))
                            {
                                header("Location: /");
                                die();
                            }
                            $id = ($_GET["id"]);
                            $db = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname, $dbport);
                            $r = $db->query("DELETE FROM `articles` WHERE id = $id");
                            Header("Location: /nowosci.php");
                            die();

                        }
                    case "addmod":
                        {
                            echo "
                            <form action='/api/v1/mods/add.php' method='POST' enctype='multipart/form-data'>
                                <input name='name' placeholder='Nazwa moda' required><br>
                                <textarea name='shortdesc' placeholder='Krótki opis moda' required></textarea><br>
                                <textarea name='desc' placeholder='Opis moda' required></textarea><br>
                                <label for='zdj'>Zdjęcie (JPG, JPEG, PNG, GIF):</label><br>
                                <input type='file' id='zdj' name='zdj' accept='image/*' required><br><br>
                                <label for='mod'>Mod (ZIP, RAR, 7Z):</label><br>
                                <input type='file' id='mod' name='mod' accept='.zip,.rar,.7z' required><br><br>
                                <input type='submit' value='Dodaj Mod'>
                            </form>";
                            break;
                        }
                    case "addblog":{
                        echo "
                        <form action='../api/v1/articles/add.php' method='POST'>
                            <p>Nazwa posta</p>
                            <input name='name'/>
                            <br/>
                            <br/>
                            <p>Zawartość posta</p>
                            <textarea name='content' width='500' height='500'></textarea>
                            <br/>
                            <br/>
                            <input type='submit'/>
                        </form>";
                        break;
                    }
                }
            }
        ?>
       
    </div>
</body>
</html>
