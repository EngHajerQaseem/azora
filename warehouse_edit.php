<?php

include_once("includes/template/language.php");

    require('connect.php');
    $id = $_GET['id'];

    if (isset($_POST['submit'])) {
    	$id = $_POST['id'];
      	$name = $_POST['name'];
      	$address = $_POST['address'];
      	$capacity = $_POST['capacity'];
      	$size = $_POST['size'];
      	$type = $_POST['type'];

    	$mysqli->query("UPDATE `warehouse` SET `name`='$name', `address`='$address', `capacity`='$capacity', `size`='$size', `type`='$type' WHERE `id`=$id");
    	header("location:inventory.php");
    }

    $query = $mysqli->query("SELECT * FROM `warehouse` WHERE `id`='$id'");
    $invent = mysqli_fetch_assoc($query);

?>
<form method="post" action="warehouse_edit.php" role="form">
  	<div class="modal-body">
		<div class="form-group">			
			<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $invent['id'];?>" readonly="true"/>
		</div>
		<div class="form-group">
			<label for="name"><?php echo _("warehouse_edit_add_name_of_area");?></label>
			<input type="text" class="form-control" id="name" name="name" value="<?php echo $invent['name'];?>" />
		</div>
   		<div class="form-group">
			<label for="address"><?php echo _("warehouse_edit_add_location_of_area");?></label>
			<input type="text" class="form-control" id="address" name="address" value="<?php echo $invent['address'];?>" />
		</div>
    	<div class="form-group">
			<label for="capacity"><?php echo _("warehouse_edit_add_capacity_of_area");?></label>
			<input type="text" class="form-control" id="capacity" name="capacity" value="<?php echo $invent['capacity'];?>" />
		</div>
    	<div class="form-group">
			<label for="size"><?php echo _("warehouse_edit_add_size_of_area");?></label>
			<input type="number" class="form-control" id="size" name="size" value="<?php echo $invent['size'];?>" />
		</div>
    	<div class="form-group">
			<label for="type"><?php echo _("warehouse_edit_add_type_of_area");?></label>
			<input type="text" class="form-control" id="type" name="type" value="<?php echo $invent['type'];?>" />
		</div>
	</div>
	<div class="modal-footer">
		<input type="submit" class="btn btn-primary" name="submit" value="<?php echo _("warehouse_edit_add_update");?>" />&nbsp;
		<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _("warehouse_edit_add_close");?></button>
	</div>
</form>

