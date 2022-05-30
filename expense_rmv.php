<?php 
include "connect.php";

$id = $_POST['expid'];
if($id > 0){

	// Check record exists
	$checkRecord = mysqli_query($mysqli,"SELECT * FROM expense WHERE id=".$id);
	$totalrows = mysqli_num_rows($checkRecord);

	if($totalrows > 0){
		// Delete record
		$query = "DELETE FROM expense WHERE id=".$id;
		mysqli_query($mysqli,$query);
		echo 'Success';
		exit;
	}
}

echo "Failed";
exit;