<?php
require("../../../config.php");
require("../../../src/whitelist.php");

if($toggleShoutbox == false) {http_response_code(403); die();}
if(!CheckSessionPerms("admin")) 
{
    header("location: /");
    die();
}
$db = new mysqli($dbhost, $dbuser, $dbpassword, $dbname, $dbport);
$db->query("DELETE FROM shoutbox");
$db->close();
header("location: /");
die();
