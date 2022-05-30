<?php
include_once("connect.php");
if($_REQUEST['prdctid']) {
	$sql = "DELETE FROM product WHERE id='".$_REQUEST['prdctid']."'";
	$resultset = mysqli_query($mysqli, $sql) or die("database error:". mysqli_error($mysqli));	
	if($resultset) {
		echo "supplier Deleted";
	}
}
?>