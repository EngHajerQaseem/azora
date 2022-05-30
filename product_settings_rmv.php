<?php
include_once("connect.php");

if($_REQUEST['id']) {
	$sql = "DELETE FROM ".$_REQUEST['type']." WHERE id='".$_REQUEST['id']."'";
	$resultset = mysqli_query($mysqli, $sql) or die("database error:". mysqli_error($mysqli));	
	if($resultset) {
		echo "Deleted Successfully";
	}
}
?>