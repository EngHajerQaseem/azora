<?php
if (isset($_POST['products'])) {

  $selectedProducts = $_POST['products'];
  $selectedProducts = str_split($selectedProducts);
  array_shift($selectedProducts);

  //Include database configuration file
  include('connect.php');

  $productsResult = $mysqli->query("SELECT id, name, price, local_image_path  FROM product");

  $products = $productsResult->fetch_all(MYSQLI_ASSOC);

  foreach ($selectedProducts as $productID) {
    foreach ($products as $product) {
      if ($productID == $product['id']) {
        echo '<div class="position-relative">
                  <span class="float-left">' . $product['name'] . '</span>
                  <div class="purchase-order-product">
                    <div>
                      <label>Quantity</label>
                      <div>
                        <button type="button" onclick="increase(this)">+</button>
                        <input tybe="text" value="1" name="products[\''.$product['id'].'\']">
                        <button type="button" onclick="decrease(this)">-</button>
                      </div>
                    </div>
                  </div>
                  <i class="fa fa-trash cursor-pointer" onclick="removeItem(this)" ></i>
                </div>
                <div class="clear-fix"></div>';
      }
    }
  }
}
?>