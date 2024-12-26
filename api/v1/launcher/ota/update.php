<?php
$pliki = [
    "test.exe" => "jakiesmd5pliku",
];
foreach($pliki as $nazwa => $md5) {
    echo "$nazwa=>$md5";
}
/*
zarezerwowanie dla updatowania Launchera,
cos tam dodaje wstepnie jako szkic, bo samego launchera jeszcze nie robie
*/
?>