<?php
include_once("connect.php");
if($_REQUEST['suppid']) {
	$sql = "DELETE FROM suppliers WHERE id='".$_REQUEST['suppid']."'";
	$resultset = mysqli_query($mysqli, $sql) or die("database error:". mysqli_error($mysqli));	
	if($resultset) {
		echo "supplier Deleted";
	}
}
?>