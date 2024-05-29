<?php
// Whitelist function to allow only certain IPs to access the panel
define('ROOT_PATH', __DIR__."\..");
function getwhitelist()
{
    return array('127.0.0.1', '::1');
}

function render()
{
    if (in_array($_SERVER['REMOTE_ADDR'], getwhitelist())) {
        echo "<a href='admin/addblog.php'>Dodaj Post</a>";
        echo "<a href='admin/modpost.php'>Dodaj moda</a>";
    }
}

function GetTokenByUsername($username)
{
    require(ROOT_PATH."/config.php");
    $db = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname, $dbport);
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $r = $stmt->get_result();
    if ($r->num_rows > 0) {
        $row = $r->fetch_assoc();
        return base64_encode($row["username"] . "|" . $row['password']);
    }
}

function GetUsernameByToken($token)
{
    return explode("|", base64_decode($token));
}

function CheckIfHasPerms($usernameOrToken, $perm, bool $isToken)
{
    $username = "";
    if ($isToken) {
        $username = GetUsernameByToken($usernameOrToken)[0];
        if(!CheckIfTokenIsValid($usernameOrToken))
        {
            Header("Location: /");
            die();
        }
    } else {
        $username = $usernameOrToken;
    }
    
    require(ROOT_PATH."/config.php");
    $db = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname, $dbport);
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $r = $stmt->get_result();
    if ($r->num_rows > 0) {
        $row = $r->fetch_assoc();
        $id = $row["id"];
        $query2 = "SELECT * FROM permissions WHERE id = ? AND permname = ?";
        $stmt2 = $db->prepare($query2);
        $stmt2->bind_param("is", $id, $perm);
        $stmt2->execute();
        $rs = $stmt2->get_result();
        return $rs->num_rows > 0;
    } else {
        return false;
    }
}

function CheckIfTokenIsValid(string $token)
{
    if(empty($token))
    {
        return false;
    }
    $username = GetUsernameByToken($token)[0];
    $password = GetUsernameByToken($token)[1];
    return ValidateLogin($username, $password,true);
}

function ValidateLogin(string $username, string $password, bool $isEncoded)
{
    require(ROOT_PATH."/config.php");
    $db = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname, $dbport);
    $username = trim($username);
    if($isEncoded)
    {
        $password = (trim($password));
    } else {
        $password = md5(trim($password));
    }
    if (strlen($username) == 0 || strlen($password) == 0) {
        return false;
    }

    $query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $r = $stmt->get_result();
    return $r->num_rows > 0;
}

function checkifwhitelisted($user, bool $isToken)
{
    return CheckIfHasPerms($user, "admin", $isToken);
}

function CheckSessionPerms(string $perm)
{
    if(session_status() == PHP_SESSION_NONE)
    {
        session_start();
    }
    if(!isset($_SESSION['token']))
    {
        return false;
    }
    if(CheckIfTokenIsValid($_SESSION['token']))
    {
        
        if(CheckIfHasPerms($_SESSION['token'],$perm,true))
        {
            return true;
        } else {
            return false;
        }
    }
    return false;
}

function processtabs()
{
    if(session_status() == PHP_SESSION_NONE)
    {
        session_start();
    }
    if (isset($_SESSION["token"])) {
        $token = $_SESSION["token"];
        if (CheckIfHasPerms($token, "admin", true)) {
            echo "<a href='/admin/addblog.php'>Dodaj Post</a>";
            echo "<a href='/admin/modpost.php'>Dodaj Moda</a>";
        } else {
        }
        echo "<a href='logout.php'>Wyloguj się</a>";
    } else {
        echo "<a href='/login.php'>Zaloguj się</a>";
    }
    
}
?>
