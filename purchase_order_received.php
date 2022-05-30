<?php
include("includes/template/header.php");
include("connect.php");

$purchaseID = $_REQUEST['id'];

$purchaseResult = $mysqli->query("SELECT purchase.*, user.full_name AS 'user', CONCAT(suppliers.fname, ' ', suppliers.lname) AS 'supplier', warehouse.name AS 'warehouse' 
                                  FROM (((purchase 
                                  INNER JOIN suppliers ON purchase.supplier_id = suppliers.id)
                                  INNER JOIN user ON purchase.user_id = user.id)
                                  INNER JOIN warehouse ON purchase.warehouse_id = warehouse.id)
                                  WHERE purchase.id = '" . $purchaseID . "'");

$purchases = $purchaseResult->fetch_assoc();

$warehouseID = $purchases['warehouse_id'];

$productsResult = $mysqli->query("SELECT purchase_orders.id AS 'id', product.name AS 'product_name', purchase_orders.requested_quantity AS 'ordered_quantity'
                                  FROM purchase_orders
                                  INNER JOIN product ON purchase_orders.product_id = product.id
                                  WHERE purchase_id = '" . $purchaseID . "'");

$products = $productsResult->fetch_all(MYSQLI_ASSOC);
?>

<div class="white-color">

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $billDate = $_REQUEST['deliveryDate'];
        $discountTotal = $_REQUEST['discountTotal'];
        $taxTotal = $_REQUEST['taxTotal'];
        $billTotal = $_REQUEST['billTotal'];
        $BillSubTotal = $_REQUEST['BillSubTotal'];
        $paidTotal = $_REQUEST['paidTotal'];
        $user_id = 2; //TODO: get user id here.
        $purchaseStatusID = 4;
        

        $productsPricesTemp = $_REQUEST['prices'];
        $productsReceivedOrderTemp = $_REQUEST['receivedOrder'];
        $productsTaxTemp = $_REQUEST['tax'];
        $productsDiscountTemp = $_REQUEST['discount'];
        $productsExpiryDateTemp = $_REQUEST['expiryDate'];

        $productsID = array_keys($productsPricesTemp);
        $productsPrice = array_values($productsPricesTemp);
        $productsReceived = array_values($productsReceivedOrderTemp);
        $productsTaxes = array_values($productsTaxTemp);
        $productsDiscount = array_values($productsDiscountTemp);
        $productsExpiryDate = array_values($productsExpiryDateTemp);
         

        $sql = "UPDATE purchase SET user_id = ?, purchase_status_id = ?, total_tax = ?, total_discount = ?, total = ?, sub_total= ?, paid = ?, delivery_date = ? WHERE id = ?";

        $stmt = mysqli_prepare($mysqli, $sql);

        mysqli_stmt_bind_param($stmt, "iiiiiiisi", $user_id, $purchaseStatusID, $taxTotal, $discountTotal, $billTotal, $BillSubTotal, $paidTotal, $billDate, $purchaseID);

        if (mysqli_stmt_execute($stmt)) {

            $purchaseSQL = "UPDATE purchase_orders SET received_quantity = ?, price_of_purchase  = ?, given_discount  = ?, tax_on_product = ?, expiry_date = ? WHERE id = ?";

            $purchaseSTMT = mysqli_prepare($mysqli, $purchaseSQL);

            $productsCount = count($productsID);

            $errorCounter = 0;

            $inventorySQL = "INSERT INTO inventory (warehouse_id, product_id, quantity , expiry_date) VALUES (?, ?, ?, ?)";

            $inventoryStmt = mysqli_prepare($mysqli, $inventorySQL);

            for($i = 0; $i < $productsCount; $i++ ){

                $procutQuantity = $productsReceived[$i];
                $productPrice = $productsPrice[$i];
                $procutDiscount = $productsDiscount[$i];
                $productTax = $productsTaxes[$i];
                $productExpiry = $productsExpiryDate[$i];
                $productID = intval(str_replace("'", "", $productsID[$i]));

                mysqli_stmt_bind_param($purchaseSTMT, "iiiisi", $procutQuantity, $productPrice, $procutDiscount, $productTax , $productExpiry, $productID);

                if(mysqli_stmt_execute($purchaseSTMT)){
                    
                } else {
                    //echo $mysqli->error;
                    $errorCounter++;
                }

                mysqli_stmt_bind_param($inventoryStmt, "iiis", $warehouseID, $productID, $procutQuantity, $productExpiry);

                if(!mysqli_stmt_execute($inventoryStmt)){
                    echo $mysqli->error;
                    $errorCounter++;
                }
            }

            if($errorCounter == 0){
                echo '<div class="done-msg"> Successfully Updated </div>';
            } else {
                echo '<div class="fail-msg"> Sorry Something went wrong </div>';
            }

            mysqli_stmt_close($purchaseSTMT);

            mysqli_stmt_close($inventoryStmt);

        } else {
            echo '<div class="fail-msg"> Sorry Something went wrong first</div>'.$mysqli->error;
        }

        mysqli_stmt_close($stmt);

        mysqli_close($mysqli);
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" method="post">

        <div class="col-6">
            <h4>Shop Name</h4>
            <input name="id" value=<?php echo $purchases['id']; ?> hidden>
            <p class="remove-p-margin-bottom">Yemen-Sana'</p>
            <p class="remove-p-margin-bottom">P:(+967)456-7890</p>
        </div>
        <div class="col-12 right-text">
            <div class="bill-second-row-info">
                <b><?php echo _("PO_Received_Order_To");?></b>
                <p><?php echo $purchases['supplier']; ?></p>
                <b><?php echo _("PO_Received_Order_By");?></b>
                <p><?php echo $purchases['user']; ?></p>
                <b><?php echo _("PO_Received_Number");?></b>
                <p><?php echo $purchases['id']; ?></p>
            </div>
        </div>

        <div class="col-6 good-received-labels">
            <label><?php echo _("PO_Received_Title");?></label>
            <input type="text" class="width-full" placeholder="First Purchase Order" readonly value=<?php echo $purchases['title']; ?>>
            <div class="row">

                <div class="col-12 col-sm-12">
                    <label><?php echo _("PO_Received_warehouse");?></label>
                    <input type="text" class="width-full" placeholder="First Purchase Order" value=<?php echo $purchases['warehouse']; ?> readonly>
                </div>

            </div>

            <div class="row">

                <div class="col-12 col-sm-6">
                    <label><?php echo _("PO_Received_Created_Date");?></label>
                    <input type="text" value=<?php echo $purchases['created_at']; ?> readonly>
                </div>

                <div class="col-12 col-sm-6">
                    <label><?php echo _("PO_Received_Delivery_Date");?></label>
                    <input type="date" name="deliveryDate" value="" required>
                </div>
            </div>

        </div>

</div>

<div class="products-div">

    <?php foreach ($products as $product) { ?>

        <div class="products-div-product-row">
            <h6><?php echo $product['product_name']; ?></h6>
            <div class="row padding-left-15">
                <div class="good-received-product-properties">
                    <label><?php echo _("PO_Received_Price");?></label>
                    <input class="product-div-item" type="text" value="0" name="<?php echo "prices['" . $product['id'] . "']"; ?>" id="priceInputValue">
                </div>

                <div class="good-received-product-properties">
                    <label><?php echo _("PO_Received_ordered_Qty");?></label>
                    <input class="product-div-item" type="text" value=<?php echo $product['ordered_quantity']; ?> readonly>
                </div>

                <div class="good-received-product-properties">
                    <label><?php echo _("PO_Received_Received_Qty");?></label>
                    <input class="product-div-item" type="text" name="<?php echo "receivedOrder['" . $product['id'] . "']"; ?>" value="" required>
                </div>

                <div class="good-received-product-properties">
                    <label><?php echo _("PO_Received_Tax");?></label>
                    <input class="product-div-item" type="number" name="<?php echo "tax['" . $product['id'] . "']"; ?>" value="0">
                </div>

                <div class="good-received-product-properties">
                    <label><?php echo _("PO_Received_Discount");?></label>
                    <input class="product-div-item" type="number" name="<?php echo "discount['" . $product['id'] . "']"; ?>" value="0">
                </div>

                <div class="good-received-product-properties">
                    <label><?php echo _("PO_Received_Total");?></label>
                    <input class="product-div-item roduct-div-item-total" type="text" value="0" readonly>
                </div>

                <div class="good-received-product-properties">
                    <label for="from"><?php echo _("PO_Received_Expiry_Date");?></label>
                    <input type="date" name="<?php echo "expiryDate['" . $product['id'] . "']"; ?>" id="expiryDate" required>
                </div>

            </div>
        </div>

    <?php } ?>

</div>

<div class=" margin-top white-color">

    <div class="col-6 padding-left-0">
        <select class="form-control selectpicker" name="supplier" id="supplier-list" required>
            <option value="" selected><?php echo _("PO_Received_Cash");?></option>
            <option data-tokens="first product"><?php echo _("PO_Received_Account");?></option>
        </select>
    </div>

    <div class="col-12 payment-method">
        <div class="row payment-method-amounts">
            <div>
                <label><?php echo _("PO_Received_subtotal");?></label>
                <input id="subTotal" name="BillSubTotal" type="text" value="0" readonly>
            </div>
            <div>
                <label><?php echo _("PO_Received_Total_Discount");?></label>
                <input class="product-div-item-bill" type="number" name="discountTotal" value="0">
            </div>
            <div>
                <label><?php echo _("PO_Received_Total_Tax");?></label>
                <input class="product-div-item-bill" type="number" name="taxTotal" value="0">
            </div>
            <div>
                <label><?php echo _("PO_Received_Whole_Total");?></label>
                <input id="billTotal" name="billTotal" type="text" value="0" readonly>
            </div>
            <div>
                <label><?php echo _("PO_Received_Paid");?></label>
                <input type="text" name="paidTotal" value="0">
            </div>
        </div>
    </div>
</div>

<div class="margin-top white-color">
    <b class="col-12"><?php echo _("PO_Received_Note");?></b>
    <p><?php echo $purchases['note']; ?></p>
    <div class="col-sm-12 d-flex justify-content-end top-margin-sm">
        <button type="submit" class="btn main-btn save"><?php echo _("PO_Received_Done");?></button>
        <button type="button" class="btn btn-secondary  cancel"><?php echo _("PO_Received_Cancel");?></button>
    </div>
</div>
</form>

<script>
    $(".product-div-item").keyup(function() {

        let inputElements = $(this).parent().parent().children().find("input");
        let price = $(inputElements[0]).val();
        let quantityRequested = $(inputElements[1]).val();
        let quantity = $(inputElements[2]).val();
        let tax = $(inputElements[3]).val();
        let discount = $(inputElements[4]).val();

        discount = discount / 100;
        price = price - (price * discount);
        tax = tax / 100;
        price = (price * tax) + price;
        price = price * quantity;
        $(inputElements[5]).val(price);

        let finalPrice = 0;
        let total = $('.roduct-div-item-total');
        for (let i = 0; i < total.length; i++) {
            finalPrice += parseFloat($(total[i]).val());
        }

        $('#subTotal').val(finalPrice);

        setBillTotal(finalPrice);

    });

    $(".product-div-item-bill").keyup(function() {
        setBillTotal(parseFloat($('#subTotal').val()));
    });

    function setBillTotal(total) {

        let totalBill = $('.product-div-item-bill');

        let totalTax = $(totalBill[1]).val();
        let totalDiscount = $(totalBill[0]).val();

        totalDiscount = totalDiscount / 100;
        let totalPrice = total;
        total = totalPrice - (totalPrice * totalDiscount);
        totalTax = totalTax / 100;
        total = (total * totalTax) + total;

        $('#billTotal').val(total);
    }
</script>

<?php
include("includes/template/footer.php");
?>