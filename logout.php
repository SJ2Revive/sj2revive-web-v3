<?php
session_start();
$_SESSION = array();
session_destroy();
session_unset();
$path = $_GET['r'];
Header("Location: $path");
die();
?>