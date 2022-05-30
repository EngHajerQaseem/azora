<?php
include('connect.php');

$id = $_POST['id'];

if($id > 0){
    $checkRecord = mysqli_query($mysqli,"SELECT * FROM inventory WHERE id=".$id);
    $row = mysqli_fetch_assoc($checkRecord);
	$totalrows = mysqli_num_rows($checkRecord);

	if($totalrows > 0){
        $value = '';
        if($row['status'] == 0){
            $value = 1;
        } else {
            $value = 0;
        }
		// Delete record
		$query = "UPDATE inventory SET status =$value WHERE id=".$id;
        if(mysqli_query($mysqli,$query)){
            echo "Success";
        } else {
            echo $mysqli->error;
        }
		exit;
	}
}

echo 'Failed';
?>