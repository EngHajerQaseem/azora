<?php include('connect.php');?>

<?php
if (isset($_POST['catId'])) {
	
    $qry = "SELECT id,name FROM subcategory WHERE category_id=".mysqli_real_escape_string($mysqli,$_POST['catId'])." order by name";
	$res = mysqli_query($mysqli, $qry);
	if(mysqli_num_rows($res) > 0) {
		while($rowSub = mysqli_fetch_object($res)) {
            echo '<option value="'.$rowSub->id.'">'.$rowSub->name.'</option>';           
		}
	} else {
		echo '<option value="">No Record</option>';
	}

} 
?>