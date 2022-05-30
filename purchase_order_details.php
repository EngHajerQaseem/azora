<?php
include("includes/template/header.php");
include("includes/template/functions.php");
include("connect.php");

$id = $_REQUEST['id'];

$query = "SELECT * from purchase_orders where purchase_id ='" . $id . "'";
$result = mysqli_query($mysqli, $query) or die(mysqli_error());

$purchaseQuery = $mysqli->query("SELECT  purchase.id AS 'id', purchase.sub_total AS 'sub_total', date(purchase.created_at) AS 'date', purchase.total AS 'total', purchase.total_tax AS 'tax', purchase.total_discount AS 'discount', purchase.paid AS 'paid', purchase.purchase_status_id AS 'status', user.full_name AS 'user', CONCAT(suppliers.fname, ' ', suppliers.lname) AS 'supplier'
                                FROM ((purchase
                                INNER JOIN user ON purchase.user_id = user.id)
                                INNER JOIN suppliers ON purchase.supplier_id = suppliers.id)
                                WHERE purchase.id = '" . $id . "'");
$purchaseResult = $purchaseQuery->fetch_assoc();

function getProuctName($product_id, $mysqli)
{
    $query = $mysqli->query("SELECT name AS 'ProductName' , name_ar as ProductNameAr FROM product WHERE id = '" . $product_id . "'");
    $result = $query->fetch_assoc();
     $name=checkProductsNames($result['ProductName'],$result['ProductNameAr']);
    return $name;
}

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="purchase_order.php"><?php echo _("PO_Details_header");?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo _("PO_Details");?></li>
    </ol>
</nav>

<div class="white-color ">
    <!-- <h4 class="col-6"><?php echo $_SESSION["shopName"]; ?></h4>
    <h4 class="col-6 right-text"><?php echo _("PO_Details_invoice");?></h4>
    <div class="col-6 adress-column">
        <p><?php echo $_SESSION["address"] ?></p>
        <p><?php echo $_SESSION["phone"] ?></p>
    </div>

    <hr>

    <div class="col-6 default-p">
        <b><?php echo _("PO_Details_To");?></b>
        <p><?php echo $purchaseResult['supplier']; ?></p>
        <b><?php echo _("PO_Details_By");?></b>
        <p><?php echo $purchaseResult['user']; ?></p>
    </div>

    <div class="col-6 default-p right-text">
        <div class="bill-second-row-info">
            <p><b><?php echo _("PO_Details_Date");?>: </b><?php echo $purchaseResult['date']; ?></p>
            <p><b><?php echo _("PO_Details_Number");?>:</b> <?php echo '#' . $purchaseResult['id']; ?> </p>
        </div>
    </div> -->

    <div class="row">
        <div class="col-xs-12 col-lg-6 text-align-right">
            <h4><?php echo $_SESSION["shopName"] ?></h4>
        </div>
        <div class="col-xs-12 col-lg-6 right-text ">
            <h4><?php echo _("sale_bill_invoice"); ?></h4>
        </div>
        <div class="col-6 adress-column text-align-right">
            <p><?php echo $_SESSION["address"] ?></p>
            <p><?php echo $_SESSION["phone"] ?></p>
        </div>
        <hr>
        <div class="col-xs-12 col-lg-6 default-p text-align-right">
            <h6><?php echo _("PO_Details_To");?>:</h6>
            <p><?php echo $purchaseResult['supplier']; ?></p>
            <h6><?php echo _("PO_Details_By");?>:</h6>
            <p><?php echo $purchaseResult['user']; ?></p>
        </div>

        <div class="col-xs-12 col-lg-6 default-p right-text">
            <div class="bill-second-row-info">
                <p><b><?php echo _("PO_Details_Date");?> </b><?php echo $purchaseResult['date']; ?></p>
                <p><b><?php echo _("sale_bill_status"); ?></b> <span id="paidStatus">Paid</span></p>
                <p><b><?php echo _("PO_Details_Number");?></b> <?php echo '#'.$purchaseResult['id']; ?></p>
            </div>
        </div>


        <div class="col-12">
            <div class="table-responsive-lg">
                <table class="table table-hover ">
                    <thead class="bill-header">
                        <tr>
                            <th style="width:10em" scope="col">#</th>
                            <th style="width:15em" scope="col"><?php echo _("PO_Details_Product");?></th>
                            <th></th>
                            <th style="width:10em" scope="col"><?php echo _("PO_Details_Quantity");?></th>
                            <?php if ($purchaseResult['status'] == 4) {
                        echo '
                            <th style="width:10em" scope="col">'; echo _("PO_Details_Price"); echo'</th>
                            <th style="width:10em" scope="col">'; echo _("PO_Details_Discount"); echo'</th>
                            <th style="width:10em" scope="col">'; echo _("PO_Details_Tax"); echo'</th>
                            <th style="width:10em" scope="col">'; echo _("PO_Details_Total"); echo'</th> ';
                    }
                    ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                $bill_subtotal = 0;
                $bill_total = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $Invoice_No = $row['id'];
                    $product = getProuctName($row['product_id'], $mysqli);
                    if ($purchaseResult['status'] == 4) {
                        $quantity = $row['received_quantity'];
                    } else {
                        $quantity = $row['requested_quantity'];
                    }
                    $price = $row['price_of_purchase'];

                    // Calculating the total sub-total
                    $product_sub_total = $quantity * $price;
                    

                    $discount = $row['given_discount'];

                    // Calculating the total
                    $discount_amount = $discount / 100;
                    $total_after_discount = $product_sub_total - ($product_sub_total * $discount_amount);

                    // Calculating the tax
                    $tax = $row['tax_on_product'] / 100;
                    $tax_amount = $total_after_discount * $tax;

                    $total = $total_after_discount + $tax_amount;

                    ?>
                        <tr>
                            <td><?php echo $Invoice_No; ?></td>
                            <td><?php echo $product; ?></td>
                            <td></td>
                            <td><?php echo $quantity; ?></td>
                            <?php
                            if ($purchaseResult['status'] == 4) {
                                echo '<td>' . number_format($row['price_of_purchase']) . '</td>';
                                echo '<td>' . number_format($row['given_discount']) . '</td>';
                                echo '<td>' . number_format($row['tax_on_product']) . '</td>';
                                echo '<td>' . number_format($total) . '</td>';
                            }
                            ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-6">
            <br><br><br><br><br>
        </div>

        <?php if ($purchaseResult['status'] == 4) {
        echo '
    <div class="col-6 default-p right-text">
        <div class="bill-row-total">
            <p><b>';echo _("PO_Details_subtotal"); echo': </b>' . number_format($purchaseResult['sub_total']) . ' </p>
            <p><b>';echo _("PO_Details_Total_Discount"); echo': </b>' . $purchaseResult['discount'] . " YR" . '</p>
            <p><b>';echo _("PO_Details_Total_Tax"); echo': </b>' . $purchaseResult['tax'] . '%' . '</p>
            <b class="font-size-1-5">' . 'YR ' . number_format($purchaseResult['total']) . '</b>
        </div>
    </div> ';
    }
    ?>


        <?php
           
           if($purchaseResult['total'] > $purchaseResult['paid'] AND $purchaseResult['paid']!=0){
               echo '
                   <script>
                       var x = document.getElementById("paidStatus");
                       x.innerHTML = "'._('sale_bill_partially_paid').'";
                       x.style.background = "red";
                       x.style.color = "white";
                   </script>
                   ';
           } else if( $purchaseResult['paid'] == 0) {
              
               echo '
                   <script>
                       var x = document.getElementById("paidStatus");
                       x.innerHTML = "'._('sale_bill_not_paid').'";
                       x.style.background = "red";
                       x.style.color = "white";
                   </script>
               ';
           } else if( $purchaseResult['total'] == $purchaseResult['paid']) {
               echo '
                   <script>
                       var x = document.getElementById("paidStatus");
                       x.innerHTML = "'._('sale_bill_paid').'";
                   </script>
                   ';
           }
           
       ?>

        <!-- <div class="col-sm-12 d-flex justify-content-end top-margin-sm">
        <button type="submit" class="btn main-btn save"><?php echo _("PO_Details_Submit");?></button>
        <button type="button" class="btn btn-secondary  cancel" onclick="location.href='purchase_order.php';"><?php echo _("PO_Details_Cancel");?></button>
    </div> -->

    </div>
    <?php
include("includes/template/footer.php");
?>