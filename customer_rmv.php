<?php
include_once("connect.php");
if($_REQUEST['csrid']) {
	$sql = "DELETE FROM customer WHERE id='".$_REQUEST['csrid']."'";
	$resultset = mysqli_query($mysqli, $sql) or die("database error:". mysqli_error($mysqli));	
	if($resultset) {
		echo "Customer Deleted";
	}
}
?>