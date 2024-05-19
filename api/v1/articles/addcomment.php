<?php
/*
CREATE TABLE `sj2revive`.`art_comments` (`id` INT NOT NULL , `sender` TEXT NOT NULL , `content` TEXT NOT NULL , `date` TEXT NOT NULL ) ENGINE = InnoDB;
*/
require("../../../config.php");
require("../../../src/whitelist.php");
if(!checkifwhitelisted())
{
    header("location: /");
    die();
}
$db = new mysqli($dbhost, $dbuser, $dbpassword, $dbname, $dbport);
$id = $_GET['id'];
$sender = $_GET['sender'];
$content = $_GET['content'];
$date = date('Y-m-d H:i:s'); 
if (empty($sender) || empty($content)) {
    echo json_encode(array("error" => "bad_params"));
    exit();
}
$stmt = $db->prepare("INSERT INTO art_comments ( id, sender, content, date) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $id, $sender, $content,$date);

if ($stmt->execute()) {
    Header("location: /blog.php?id=$id");
    die();
} else {
    echo json_encode(array("error" => "fail"));
}
$stmt->close();
$db->close();
?>
