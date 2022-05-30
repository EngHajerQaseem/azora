<?php

include_once("includes/template/language.php");

    require('connect.php');
    $id = $_GET['id'];

    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
		$warehouse_id = $_POST['warehouse_id'];
        $quantity = $_POST['quantity'];
    	$expiry_date = $_POST['expiry_date'];
    	$mysqli->query("UPDATE `inventory` SET `warehouse_id` = '$warehouse_id',`quantity` = '$quantity',`expiry_date` = '$expiry_date' WHERE `id`=$id");
    	header("location:inventory.php");
    }

    $query = $mysqli->query("SELECT * FROM `inventory` WHERE `id`='$id'");
    $invent = mysqli_fetch_assoc($query);
?>
<form method="post" action="inventory_edit.php" role="form">
	<div class="modal-body">
		<div class="form-group">			
			<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $invent['id'];?>" readonly="true"/>
        </div>
        <div class="form-group">
			<?php 
				$sql = "SELECT id AS prodId, name AS prodName FROM product WHERE id = '".$invent["product_id"]."' " ;
				$res = mysqli_query($mysqli, $sql);
				$rowsql = mysqli_fetch_array($res);	   
			?>
			<label for="name"><?php echo _("inventory_edit_name");?></label>
			<div class="form-control" id="name" name="name"><?php echo $rowsql['prodName'];?></div>
        </div>
        <div class="form-group">
			<label for="quantity"><?php echo _("inventory_edit_quantity");?></label>
			<input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $invent['quantity'];?>" />
		</div>
		<div class="form-group">
			<label for="expiry_date"><?php echo _("inventory_edit_change_area");?></label>
			<select name="warehouse_id" class="form-control" id="warehouse_id">
				<?php 
					$queryCategories = "SELECT id as warehouseId,name AS warehouseName FROM warehouse";                      
					$resultCategories = $mysqli->query($queryCategories);
					while ($rowCats = $resultCategories->fetch_assoc()) { ?>                    
						<option value="<?php echo $rowCats['warehouseId']; ?>"<?php if (!(strcmp($rowCats['warehouseId'], $invent['warehouse_id']))) { echo " selected=\"selected\""; } ?>>
							<?php echo $rowCats['warehouseName'];?>
						</option>
					<?php }                    
				?>                              
			</select>
			<!-- <input type="text" class="form-control" id="warehouse_id" name="warehouse_id" value="<?php echo $invent['warehouse_id'];?>" /> -->
		</div>
		<div class="form-group">
			<label for="expiry_date"><?php echo _("inventory_edit_expiry_date");?></label>
			<input type="text" class="form-control" id="date" name="expiry_date" value="<?php echo $invent['expiry_date'];?>" />
		</div>
	</div>
	<div class="modal-footer">
		<input type="submit" class="btn btn-primary" name="submit" value="<?php echo _("inventory_edit_update");?>" />&nbsp;
		<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _("inventory_edit_close");?></button>
	</div>
</form>





