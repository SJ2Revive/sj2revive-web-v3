<?php
require("../../../config.php");
require("../../../src/whitelist.php");
if(!CheckSessionPerms("admin"))
{
    header("location: /");
    die();
}
if(!isset($_POST["id"])||!isset($_POST["title"])||!isset($_POST["desc"]))
{
    header("Location: /");
    die();
}
$id = ($_POST["id"]);
$title = ($_POST["title"]);
$desc = ($_POST["desc"]);
$db = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname, $dbport);
$r = $db->query("UPDATE `articles` SET `Nazwa`='$title',`Zawartosc`='$desc' WHERE id = $id");
Header("Location: /blog.php?id=$id");
die();
