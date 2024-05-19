<?php
require("../../../config.php");
$db = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname, $dbport);
$sql = "SELECT COUNT(*) AS count FROM shoutbox";
$result = mysqli_query($db, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $rowCount = $row['count'];
    if($rowCount > 7)
    {
        $db->query('DELETE FROM shoutbox'); // wiem ze malo bezpieczne, no ale coz
    }
}
if(isset($_GET['author']) && isset($_GET['content'])) {
    $author = $_GET['author'];
    $content = $_GET['content'];
    $sql = "INSERT INTO shoutbox (author, content) VALUES (?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ss", $author, $content);
    if($stmt->execute()) {
        Header("Location: /");
        die();
    } else {
        echo json_encode(array("error" => "message_not_added"));
    }
    exit; 
}
?>
