<?php
require("../../../config.php");
require("../../../src/whitelist.php");
if(!CheckSessionPerms("admin"))
{
    header("location: /");
    die();
}
// Get parameters from GET request
$name = isset($_GET['name']) ? $_GET['name'] : '';
$content = isset($_GET['content']) ? $_GET['content'] : '';
$content = str_replace("\n","<br/>",$content);
$date = date('Y-m-d H:i:s'); 
if (empty($name) || empty($content) || empty($date)) {
    echo json_encode(array("error" => "bad_params"));
    exit();
}
$db = new mysqli($dbhost, $dbuser, $dbpassword, $dbname, $dbport);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
$result = $db->query("SELECT COUNT(*) AS count FROM articles");
$row = $result->fetch_assoc();
$next_id = $row['count'] + 1;
$stmt = $db->prepare("INSERT INTO articles ( Nazwa, Zawartosc, Date,id) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssi", $name, $content, $date,$next_id);

if ($stmt->execute()) {
    Header("location: /blog.php?id=$next_id");
    die();
} else {
    echo json_encode(array("error" => "fail"));
}
$stmt->close();
$db->close();
?>
