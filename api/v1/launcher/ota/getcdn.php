<?php
/*
wg. moich planów, launcher będzie pobierał z tego endpointu informacje o serwerze aktualizacji
*/
$pliki = [
    "updateServer" => "https://up.sj2revive.top/",
];
echo json_encode($pliki);
?>