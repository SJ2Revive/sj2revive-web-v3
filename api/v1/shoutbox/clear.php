<?php
require("../../../config.php");
require("../../../src/whitelist.php");
if(!checkifwhitelisted())
{
    header("location: /");
    die();
}
$db = new mysqli($dbhost, $dbuser, $dbpassword, $dbname, $dbport);
$db->query("DELETE FROM shoutbox");
$db->close();
header("location: /");
die();
?>
