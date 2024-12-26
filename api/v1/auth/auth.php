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
        $recaptcha = $_POST['g-recaptcha-response'];
        $secret_key = $captchasecret;
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = [
            'secret' => $secret_key,
            'response' => $recaptcha
        ];
        
        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded",
                'method'  => 'POST',
                'content' => http_build_query($data)
            ]
        ];
        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $responseKeys = json_decode($response, true);
        if(!$responseKeys["success"] ) {
            Header("Location: /login.php");
            die();
        }
    }

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
