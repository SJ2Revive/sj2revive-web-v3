<?php
// whitelista, ktora poprostu powoduje ze tylko wyznaczone adresy ip maja dostep do panelu (nie chce mi sie implementowac logowania)
function getwhitelist()
{
    $var = array('127.0.0.1','::1');
    return $var;
}
function render()
{
    if(in_array($_SERVER['REMOTE_ADDR'],getwhitelist()))
    {
        echo "<a href='admin/addblog.php'>Dodaj Post</a>";
        echo "<a href='admin/modpost.php'>Dodaj moda</a>";
    } else {
        
    }
}
function checkifwhitelisted()
{
    if(in_array($_SERVER['REMOTE_ADDR'],getwhitelist()))
    {
        return true;
    } else {
        return false;
    }
}

