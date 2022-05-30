<?php 

// $servername = "localhost";
// $username = "azora_himAzora";
// $password = "ekLI3g7ilWI16NN52b";
// $db="azora_azora";

// // Create connection
// $conn = new mysqli($servername, $username, $password,$db);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);ownloads
// }

  $id = $_SESSION["id"];
  $db = "azora_";
  $db .=$id;
  $db .= "db";


// Main Line
// $mysqli = new mysqli("server1.azora.tech", "azora_himAzora", "Toaqd0Xwix,X", $db);
$mysqli = new mysqli("localhost", "root", "", "azora_2db");

// $mysqli = new mysqli("azorasql.mysql.database.azure.com", "maqalaqil@azorasql", "159392maAL@@", $id);
// $mysqli = new mysqli("localhost", "root", "", $id);
// $mysqli = new mysqli("localhost", "root", "", "azora_2db");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}else {
    mysqli_set_charset($mysqli, "utf8");
}   

// function OpenCon() {
// 	$dbhost = "localhost";
// 	$dbuser = "root";
// 	$dbpass = "";
// 	$db = "azora";
// 	$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
	
// 	return $conn;
// }

// function CloseCon($conn) {
// 	$conn -> close();
// }

   
?>