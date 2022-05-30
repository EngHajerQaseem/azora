<?php
	include_once("connect.php");
	if($_REQUEST['delete']) {
		$sql = "DELETE FROM warehouse WHERE id='".$_REQUEST['delete']."'";
		$resultset = mysqli_query($mysqli, $sql) or die("database error:". mysqli_error($mysqli));	
		if($resultset) {
			echo "warehouse Deleted";
		}
	}
?>