<?php
require("../../../config.php");
$db = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname, $dbport);

$result = $db->query("SELECT * FROM mods");
header('Content-Type: text/json');
if ($result->num_rows > 0) {
    $articles = array();
    while ($row = $result->fetch_assoc()) {
        $article = array(
            "id" => $row['id'],
            "name" => $row['name'],
            "shortdesc" => $row['shortdesc'],
            "description" => $row["description"],
            "filename" => $row["filename"],
        );
        $articles[] = $article;
    }
    echo json_encode($articles);
} else {
    echo json_encode(array("error" => "no_mods"));
}
?>
