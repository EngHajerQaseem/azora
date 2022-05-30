<?php
    require('connect.php');
    $id = $_GET['id'];

    if (isset($_POST['submit'])) {
    	$id = $_POST['id'];
    	$price = $_POST['price'];
    	$mysqli->query("UPDATE `product` SET `price` = '$price' WHERE `id`=$id");
    	header("location:products.php");
    }

    $query = $mysqli->query("SELECT * FROM `product` WHERE `id`='$id'");
    $prdct = mysqli_fetch_assoc($query);

?>
<form method="post" action="product_update.php" role="form">
	<div class="modal-body">
		<div class="form-group">			
			<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $prdct['id'];?>" readonly="true"/>
		</div>
		<div class="form-group">
			<label for="phone"><?php echo _("product_update_price_input");?>:</label>
				<input type="number" class="form-control" id="price" name="price" value="<?php echo $prdct['price'];?>" />
		</div>
	</div>
	<div class="modal-footer">
		<input type="submit" class="btn btn-primary" name="submit" value="<?php echo _("product_update_update_btn");?>" />&nbsp;
		<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _("product_update_close_btn");?></button>
	</div>
</form>

