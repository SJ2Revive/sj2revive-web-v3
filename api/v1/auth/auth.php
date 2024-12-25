<?php
if(!isset($_POST['username'])||!isset($_POST['password']))
{
    http_response_code(403);
    die();
}
$username = $_POST['username'];
$password = $_POST['password'];
require("../../../src/whitelist.php");
require("../../../config.php");
if (isset($_POST['g-recaptcha-response']) || $toggleCaptcha == false) {
    if($toggleCaptcha == true)
    {
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptcha_secret = $captchasecret;
        $recaptcha_response = $_POST['g-recaptcha-response'];
        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
        $recaptcha = json_decode($recaptcha);
        $responseKeys = json_decode($recaptcha);
    }

    if ($responseKeys["success"] || $toggleCaptcha == false) {
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
    }
}
