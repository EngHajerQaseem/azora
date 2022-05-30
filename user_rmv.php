<?php 
include "connect.php";

$id = $_POST['usrid'];

if($id > 0){

	// Check record exists
	$checkRecord = mysqli_query($mysqli,"SELECT * FROM user WHERE id=".$id);
	$totalrows = mysqli_num_rows($checkRecord);

	if($totalrows > 0){
		// Delete record
		$query = "DELETE FROM user WHERE id=".$id;
		if(mysqli_query($mysqli,$query)){
			echo 'Deleted Successfully';
		} 
		exit;
	}
}

echo 0;
exit;