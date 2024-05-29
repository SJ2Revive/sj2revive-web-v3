<?php
require("../../../config.php");

$name = trim($_POST['name']);
$shortdesc = trim($_POST['shortdesc']);
$desc = trim($_POST['desc']);

$db = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname, $dbport);
if (!$db) {
    die(json_encode(array("error" => "Nie udało się połączyć z bazą danych")));
}

if (empty($name) || empty($shortdesc) || empty($desc)) {
    die(json_encode(array("error" => "Wszystkie pola są wymagane")));
}

$name = mysqli_real_escape_string($db, $name);
$shortdesc = mysqli_real_escape_string($db, $shortdesc);
$desc = mysqli_real_escape_string($db, $desc);

$targetDirImages = __DIR__ . "/../../../static/img/mods/";
$targetDirMods = __DIR__ . "/../../../mods/";

if (!is_dir($targetDirImages)) {
    mkdir($targetDirImages, 0755, true);
}
if (!is_dir($targetDirMods)) {
    mkdir($targetDirMods, 0755, true);
}

$imageFile = $_FILES['zdj'];
$modFile = $_FILES['mod'];

if ($imageFile['error'] != UPLOAD_ERR_OK || $modFile['error'] != UPLOAD_ERR_OK) {
    die(json_encode(array("error" => "Wystąpił bląd")));
}

$imageFileType = strtolower(pathinfo($imageFile['name'], PATHINFO_EXTENSION));
$modFileType = strtolower(pathinfo($modFile['name'], PATHINFO_EXTENSION));
$validImageTypes = array('jpg', 'jpeg', 'png', 'gif');
$validModTypes = array('zip', 'rar', '7z');

if (!in_array($imageFileType, $validImageTypes)) {
    die(json_encode(array("error" => "Zły typ obrazu")));
}
if (!in_array($modFileType, $validModTypes)) {
    die(json_encode(array("error" => "Zły typ pliku moda")));
}
$result = $db->query("SELECT MAX(id) AS max_id FROM mods");
$row = $result->fetch_assoc();
$next_id = $row['max_id'] + 1;
$imagePath = "static/img/mods/$next_id.png";
$modPath = "mods/$name.zip";
if (!move_uploaded_file($imageFile['tmp_name'], $targetDirImages . "$next_id.png")) {
    die(json_encode(array("error" => "Wystąpił błąd przy przesyłaniu obrazu")));
}
if (!move_uploaded_file($modFile['tmp_name'], $targetDirMods . "$name.zip")) {
    die(json_encode(array("error" => "Wystąpił błąd przy przesyłaniu moda")));
}
$query = "INSERT INTO `mods`(`id`, `name`, `shortdesc`, `description`, `filename`) VALUES (?, ?, ?, ?, ?)";
$stmt = $db->prepare($query);
if (!$stmt) {
    die(json_encode(array("error" => "Failed to prepare SQL statement")));
}

$stmt->bind_param('issss', $next_id, $name, $shortdesc, $desc, $modPath);
if ($stmt->execute()) {
    header("Location: /getmod.php?id=$next_id");
    die();
} else {
    echo json_encode(array("error" => "Failed to execute SQL statement"));
}

$stmt->close();
$db->close();
?>
