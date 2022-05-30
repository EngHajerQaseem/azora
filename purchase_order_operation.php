<?php 
include "connect.php";

$id = $_POST['purchaseid'];
$type = $_POST['operationType'];

if($id > 0){
	// Check record exists
	$checkRecord = mysqli_query($mysqli,"SELECT * FROM purchase WHERE id=".$id);
    $totalrows = mysqli_num_rows($checkRecord);
    $row = $checkRecord->fetch_assoc();

	if($totalrows > 0){
        if($type == "Cancel"){
            $query = "UPDATE purchase SET purchase_status_id = '3' WHERE id=".$id;
            mysqli_query($mysqli,$query);
            echo 'Purchase has been canceled suscessfully';
        }
        if ($row['purchase_status_id'] == 1){
            $query = "UPDATE purchase SET purchase_status_id = '2' WHERE id=".$id;
            mysqli_query($mysqli,$query);
            echo 'Status updated to sent suscessfully';
            exit;
        } else {
            echo "Purchase Status is not Open";
        } 
	}
} else {
    echo "Error something went wrong";
}
exit;