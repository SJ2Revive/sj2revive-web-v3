<?php
require("../../../config.php");

if($toggleShoutbox == false) {http_response_code(403); die();}
$db = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname, $dbport);
$result = $db->query("SELECT * FROM shoutbox LIMIT 8");
header('Content-Type: text/json');
if ($result->num_rows > 0) {
    $articles = array();
    while ($row = $result->fetch_assoc()) {
        $article = array(
            "author" => $row['author'],
            "content" => $row['content']
        );
        $articles[] = $article;
    }
    echo json_encode($articles);
} else {
    echo json_encode(array("error" => "no_messages"));
}
?>
