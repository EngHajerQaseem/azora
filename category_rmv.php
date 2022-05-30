<?php
include "connect.php";

$id = $_POST['catid'];
if ($id > 0) {

	// Check record exists
	$checkRecord = mysqli_query($mysqli, "SELECT * FROM category WHERE id=" . $id);
	$totalrows = mysqli_num_rows($checkRecord);

	if ($totalrows > 0) {
		// Delete record
		$query = "DELETE FROM category WHERE id=" . $id;
		mysqli_query($mysqli, $query);
		echo 'Success';
		exit;
	}
}

echo "Failed";
exit;
