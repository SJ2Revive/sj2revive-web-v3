<?php
if(!isset($_POST['username'])||!isset($_POST['password']))
{
    http_response_code(403);
    die();
}
$username = $_POST['username'];
$password = $_POST['password'];
require("../../../src/whitelist.php");
if(ValidateLogin($username, $password,false))
{
    session_start();
    $_SESSION['token'] = GetTokenByUsername($username);
    Header("Location: /");
    die();
} else {
    Header("Location: /login.php");
    die();
}