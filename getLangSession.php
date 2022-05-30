<?php session_start();
if(isset($_SESSION["language"]))
echo json_encode($_SESSION["language"]);
else echo json_encode("en_US");
?>