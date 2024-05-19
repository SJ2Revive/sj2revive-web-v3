<?php
require("../../../config.php");
$db = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname, $dbport);
$id = $_GET['i'];
$result = $db->query("SELECT * FROM art_comments WHERE id = '$id'");
header('Content-Type: text/json');
if ($result->num_rows > 0) {
    $articles = array();
    while ($row = $result->fetch_assoc()) {
        $article = array(
            "sender" => $row['sender'],
            "content" => $row['content'],
            "date" => $row["date"],
        );
        $articles[] = $article;
    }
    echo json_encode($articles);
} else {
    echo json_encode(array("error" => "no_articles"));
}
?>
