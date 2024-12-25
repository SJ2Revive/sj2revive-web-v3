<?php
require("src/whitelist.php");
session_start();
if (isset($_SESSION["token"])) {
    Header("Location: /");
    die();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SJ2Revive</title>
    <style>
        @import url("static/css/main.css");
        @import url("static/css/shoutbox.css");
    </style>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
    function onSubmit(token) {
        document.getElementById("loginbox").submit();
    }

    function showCaptcha() {
        document.getElementById("recaptcha-container").style.display = 'block';
        grecaptcha.render('recaptcha-container', {
            'sitekey': '<?php include("config.php"); echo $sitekey;?>',
            'callback': onSubmit
        });
    }

    function validate(event) {
        <?php if($toggleCaptcha == false) {echo "document.getElementById('loginbox').submit();";} ?>
        event.preventDefault(); 
        showCaptcha();  
    }
    </script>
</head>
<body>
    <div class="sidebar">
        <?php include("elements/nav.php"); DrawNavBarHeader();?>
        <p style="font-size: 12px;text-align: center;color: yellowgreen;">Jedyna strona z modami do <span style="color: #086ed3;">Symulatora Jazdy 2</span></p>
        <a href="/">Strona Główna</a>
        <a href="/faq.php">FAQ</a>
        <a href="/nowosci.php">Nowości</a>
        <a href="/modyfikacje.php">Modyfikacje</a>
        <a href="/launcher.php">Launcher</a>
        <a href="/oa.php">Aktualizacje</a>
        <a href="/ustawienia.php">Ustawienia</a>
        <?php
        processtabs()
        ?>
    </div>
    <div class="main-content">
        <h1></h1>
        <h3>Zaloguj się</h3>
        <form action="api/v1/auth/auth.php" id="loginbox" method="POST">
                <input name="username" placeholder="Nazwa użytkownika"/>
                <input name="password" type="password" placeholder="Hasło"/>
                <div id="recaptcha-container" class="g-recaptcha" data-callback="onSubmit"></div>
                <br/>
                <input type="button" onclick="validate(event)" value="Prześlij"></input>
                </form>
    </div>
</body>
</html>
