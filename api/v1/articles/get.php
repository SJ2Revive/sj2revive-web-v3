<?php
require("../../../config.php");
$db = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname, $dbport);

$result = $db->query("SELECT * FROM articles ORDER BY id DESC");
header('Content-Type: text/json');
if ($result->num_rows > 0) {
    $articles = array();
    while ($row = $result->fetch_assoc()) {
        $article = array(
            "name" => $row['Nazwa'],
            "content" => $row['Zawartosc'],
            "date" => $row['Date'],
            "id" => $row["id"],
        );
        $articles[] = $article;
    }
    echo json_encode($articles);
} else {
    echo json_encode(array("error" => "no_articles"));
}
?>
