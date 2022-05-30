<?php 


$mysqli = new mysqli("localhost", "root", "", "azora_dashazora");
// $mysqli = new mysqli("server1.azora.tech", "azora_himAzora", "Toaqd0Xwix,X", 'azora_dashAzora');


/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}else {
    mysqli_set_charset($mysqli, "utf8");
}




?>