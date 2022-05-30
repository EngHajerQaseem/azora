<?php

include("includes/template/header.php");
include("connect.php");

$suppliersResult = $mysqli->query("SELECT CONCAT(fname, ' ', lname) AS 'name', id FROM suppliers");

$suppliers = $suppliersResult->fetch_all(MYSQLI_ASSOC);

$warehouseResult = $mysqli->query("SELECT name, id FROM warehouse");

$warehouses = $warehouseResult->fetch_all(MYSQLI_ASSOC);

$productsResult = $mysqli->query("SELECT id, name, price, local_image_path  FROM product");

$fetchProducts = $productsResult->fetch_all(MYSQLI_ASSOC);
?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="purchase_order.php"><?php echo _("PO_Purchase_orders");?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo _("PO_Add_New_Purchase_Order");?></li>
  </ol>
</nav>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $title = $_REQUEST['title'];
  $warehouse_id = $_REQUEST['warehouse'];
  // $created_at = $_REQUEST['orderDate'];
  // $delivery_date = $_REQUEST['deliveryDate'];
  $supplier_id = $_REQUEST['supplier'];
  $products = $_REQUEST['products'];
  $note = $_REQUEST['note'];

  // Prepare an insert statement
  $sql = "INSERT INTO purchase ( user_id, supplier_id, warehouse_id, purchase_status_id, title, note) VALUES (?, ?, ?, ?, ?, ?)";

  if ($stmt = mysqli_prepare($mysqli, $sql)) {

    $user_id = 2; // TODO: Take the current user ID here.
    $purchase_status_id = 1;

    mysqli_stmt_bind_param($stmt, "iiiiss", $user_id, $supplier_id, $warehouse_id, $purchase_status_id, $title, $note);

    if (mysqli_stmt_execute($stmt)) {
      $lastID = $mysqli->insert_id;
    } else {
      echo '<div class="fail-msg"> Sorry Something went wrong</div>';
    }
  }

  // Close statement
  mysqli_stmt_close($stmt);

  if ($lastID > 0) {

    $purchaseOrderSql = "INSERT INTO purchase_orders ( purchase_id, product_id, requested_quantity) VALUES (?, ?, ?)";

    if ($purchaseOrderStmt = mysqli_prepare($mysqli, $purchaseOrderSql)) {

      $user_id = 2; // TODO: Take the current user ID here.
      $purchase_status_id = 1;

      $counter = 0;

      foreach($products as $key => $value) {
        
        $key = str_replace("'", "", $key);
        $product_id = intval($key);
        $requested_quantity = (int)$value;
        mysqli_stmt_bind_param($purchaseOrderStmt, "iii", $lastID, $product_id, $requested_quantity);

        if (mysqli_stmt_execute($purchaseOrderStmt)) {
          
        } else {
          $counter++;
        }
      }

      if ($counter == 0) {
        echo '<div class="done-msg">'; echo _("PO_add_successfully_added"); echo'</div>';
      } else {
        echo '<div class="fail-msg">'; echo _("PO_add_something_went_wrong"); echo'</div>';
      }
    }

    // Close statement
    mysqli_stmt_close($purchaseOrderStmt);

    // Close connection
    mysqli_close($mysqli);
  }

}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" method="post">

  <div class="new-product">
    <h2><?php echo _("PO_header_Add_New_Purchase_Order");?></h2>

    <div class="row">
      <div class="col-sm-9">

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="title"><?php echo _("Add_New_PO_Title");?> *</label>
              <input type="text" class="form-control" id="title" name="title" required>

            </div>
          </div>

          <div class="col-sm-12">
            <div class="form-group">
              <label for="inv"><?php echo _("Add_New_PO_Inventory");?></label>
              <select class="form-control" name="warehouse" required>
                <option value="" disabled selected hidden><?php echo _("Add_New_PO_choose_Warehouse");?></option>
                <?php
                foreach ($warehouses as $warehouse) {
                  echo '<option value="' . $warehouse['id'] . '">' . $warehouse['name'] . '</option>';
                }
                ?>
              </select>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>

  <div class="col-sm-9 new-product margin-top remove-padding-left">
    <div class="col-sm-12">
      <p class="btn main-btn" data-toggle="modal" data-target=".supplier-modal"><?php echo _("Add_New_PO_Add_supplier");?></p>
    </div>
    <label id="supplier-name" class="padding-left-15"></label>
    <!-- Need check in JQuery -->
    <input id="supplier-id" type="text" value="" name="supplier" hidden>
  </div>

  <div class="products-div new-product col-sm-9">

    <div class="col-sm-12 remove-padding-left margin-bottom-20">
      <p class="btn main-btn" data-toggle="modal" data-target="#product-modal"><?php echo _("Add_New_PO_Add_product");?></p>
    </div>

    <div id="products-list">
      <!-- AJAX returns products here. -->

    </div>
  </div>

  <div class="col-sm-9 new-product margin-top purchase-roder-note-section">
    <label for="note"><?php echo _("Add_New_PO_Note");?></label>
    <textarea name="note"></textarea>
  </div>

  <div class="col-sm-12">
    <div class="col-sm-12 d-flex justify-content-end">
      <button type="submit" class="btn main-btn save"><?php echo _("Add_New_PO_Save");?></button>
      <button type="button" class="btn btn-secondary  cancel"><?php echo _("Add_New_PO_Cancel");?></button>
    </div>
  </div>

</form>

<!-- Supplier Modal -->
<div class="modal fade supplier-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?php echo _("Add_New_PO_Supplier_Modal_Title");?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <select class="form-control selectpicker" data-live-search="true" name="supplier" id="supplier-list" required>
          <option value="" disabled selected hidden><?php echo _("Add_New_PO_Choose_Supplier");?></option>
          <?php
          foreach ($suppliers as $supplier) {
            echo '<option value="' . $supplier['id'] . '">' . $supplier['name'] . '</option>';
          }
          ?>
        </select>
      </div>

      <div class="modal-footer">
        <button type="button" id="supplier-button" class="btn main-btn"><?php echo _("Add_New_PO_Choose_Supplier_Done");?></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo _("Add_New_PO_Choose_Supplier_Cancel");?></button>
      </div>
    </div>
  </div>
</div>

<!-- Product Modal -->
<div class="modal fade" id="product-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?php echo _("Add_New_PO_Products_Modal_Title");?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <?php
        foreach ($fetchProducts as $fetchProduct) {
          $div = '<div class="form-check purchase-order-product-row">';
          $pic = '<img src="' . $fetchProduct['local_image_path'] . '">';
          $name = '<label>' . $fetchProduct['name'] . '</label>';
          $price = '<label>$' . $fetchProduct['price'] . '</label>';
          $checkbox = '<input class="product-checkbox" type="checkbox" value="' . $fetchProduct['id'] . '">';
          echo $div . "\n" . $pic . "\n" . $name . "\n" . $price . "\n" . $checkbox . "\n" . '</div>';
        }
        ?>
      </div> <!-- End of Modal body -->

      <div class="modal-footer">
        <button type="button" id="product-button" class="btn main-btn"><?php echo _("Add_New_PO_Choose_Products_Done");?></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo _("Add_New_PO_Choose_Products_Cancel");?></button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

<script>
  function increase(element) {
    var text = element.nextSibling.nextSibling;
    text.value = eval("1 + " + text.value);
    return false;
  }

  function decrease(element) {
    var text = element.previousSibling.previousSibling;
    if (text.value != 1) {
      text.value = text.value - 1;
    }
    return false;
  }

  function removeItem(element) {
    var currentProduct = element.parentNode;
    var clearFix = currentProduct.nextElementSibling
    currentProduct.remove();
    clearFix.remove();

    return false;
  }
</script>

<?php
include("includes/template/footer.php");
?>