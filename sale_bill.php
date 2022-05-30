<?php
include("includes/template/header.php");
include("connect.php");
include("includes/template/functions.php");

$id = $_REQUEST['id'];
$trans=$_REQUEST['trans'];

if($trans ==="Sale"){

$query = "SELECT * from sale_orders where sale_id='" . $id . "'";

$saleQuery = $mysqli->query("SELECT  sale.id AS 'id', date(sale.created_at) AS 'date', sale.total_tax AS 'tax', sale.discount AS 'discount', sale.paid AS 'paid', user.full_name AS 'user', CONCAT(customer.fname, ' ', customer.lname) AS 'customer'
                                FROM ((sale
                                INNER JOIN user ON sale.user_id = user.id)
                                INNER JOIN customer ON sale.customer_id = customer.id)
                                WHERE sale.id = '" . $id . "'");
}
else{
    $query = "SELECT * from refund_orders where refund_orders.id='" . $id . "'"; 
    
    $saleQuery = $mysqli->query("SELECT  refund.sale_id AS 'id', date(refund.created_at) AS 'date', refund.total_tax AS 'tax', refund.discount AS 'discount', refund.paid AS 'paid', user.full_name AS 'user', CONCAT(customer.fname, ' ', customer.lname) AS 'customer'
                                FROM ((refund
                                INNER JOIN user ON refund.user_id = user.id)
                                INNER JOIN customer ON refund.customer_id = customer.id)
                                WHERE refund.id = '" . $id . "'");
}

$result = mysqli_query($mysqli, $query) or die(mysqli_error());
// $row = mysqli_fetch_assoc($result);

// $saleQuery = $mysqli->query("SELECT  sale.id AS 'id', date(sale.created_at) AS 'date', sale.total_tax AS 'tax', sale.discount AS 'discount', sale.paid AS 'paid', user.full_name AS 'user', CONCAT(customer.fname, ' ', customer.lname) AS 'customer'
//                                 FROM ((sale
//                                 INNER JOIN user ON sale.user_id = user.id)
//                                 INNER JOIN customer ON sale.customer_id = customer.id)
//                                 WHERE sale.id = '" . $id . "'");
$saleResult = $saleQuery->fetch_assoc();

function getProuctName($product_id, $mysqli)

{
    $query = $mysqli->query("SELECT name AS 'ProductName' , name_ar as ProductNameAr FROM product WHERE id = '" . $product_id . "'");
    $result = $query->fetch_assoc();
    $name=checkProductsNames($result['ProductName'],$result['ProductNameAr']);
    return $name;
}

function checkServicsNames($product_id, $mysqli)

{
    $query = $mysqli->query("SELECT name AS 'ProductName' , name_ar as ProductNameAr FROM services WHERE id = '" . $product_id . "'");
    $result = $query->fetch_assoc();
    $name=checkProductsNames($result['ProductName'],$result['ProductNameAr']);
    return $name;
}
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="sales.php"><?php echo _("sale_bill_sale"); ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo _("sale_bill_sale_details"); ?></li>
    </ol>
</nav>


<div id="sale_report" class="white-color">
    <div class="row">
        <div class="col-xs-12 col-lg-6 text-align-right">
            <h4><?php echo $_SESSION["shopName"] ?></h4>
        </div>
        <div class="col-xs-12 col-lg-6 right-text ">
            <h4>
                <?php 
        if($trans==="Sale"){
           echo _("sale_bill_invoice"); 
        }
        else{
           
          echo _("refund_bill_invoice"); 
        }?>
            </h4>

        </div>
        <div class="col-6 adress-column text-align-right">
            <p><?php echo $_SESSION["address"] ?></p>
            <p><?php echo $_SESSION["phone"] ?></p>
        </div>
        <hr>
        <div class="col-xs-12 col-lg-6 default-p text-align-right">
            <h6><?php echo _("sale_bill_user_name"); ?></h6>
            <p><?php echo $saleResult['user']; ?></p>
            <h6><?php echo _("sale_bill_invoice_to"); ?></h6>
            <p><?php echo $saleResult['customer']; ?></p>
        </div>

        <div class="col-xs-12 col-lg-6 default-p right-text">
            <div class="bill-second-row-info">
                <p><b><?php echo _("sale_bill_date"); ?> </b><?php echo $saleResult['date']; ?></p>
                <p><b><?php echo _("sale_bill_status"); ?></b> <span id="paidStatus">Paid</span></p>
                <p><b><?php echo _("sale_bill_bill_no"); ?></b> <?php echo '#'.$saleResult['id']; ?></p>
            </div>
        </div>

        <div class="col-12">
            <div class="table-responsive-lg">
                <table class="table table-hover ">
                    <thead class="bill-header">
                        <tr>
                            <th style="width:10em" scope="col">#</th>
                            <th style="width:20em" scope="col"><?php echo _("sale_bill_product"); ?></th>
                            <th></th>
                            <th style="width:10em" scope="col"><?php echo _("sale_bill_quantity"); ?></th>
                            <th style="width:10em" scope="col"><?php echo _("sale_bill_price"); ?></th>
                            <th style="width:10em" scope="col"><?php echo _("sale_bill_total"); ?></th>
                            <th style="width:10em" scope="col"><?php echo _("sale_bill_discount"); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                $bill_subtotal = 0;
                $bill_total = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $Invoice_No = $row['id'];
                    // $service_id= $row['service_id'];
                    

                    if(isset($row["service_id"]) && $row["service_id"]!=null && $row["service_id"]!=0){
                        $product=  checkServicsNames($row["service_id"],$mysqli);
                        }
                        else{
                        $product = getProuctName($row['product_id'], $mysqli);
                        }
                    // $product = getProuctName($row['product_id'], $mysqli);
                    $quantity = $row['quantity'];
                    $price = $row['price'];

                    // Calculating the total sub-total
                    $product_sub_total = $quantity * $price;
                    $GLOBALS['bill_subtotal'] += $product_sub_total;

                    $discount = $row['discount'];

                    // Calculating the total
                    $discount_amount = $discount / 100;
                    $total_after_discount = $product_sub_total - ($product_sub_total * $discount_amount);

                    // Calculating the tax
                    $tax = $row['tax'] / 100;
                    $tax_amount = $total_after_discount * $tax;

                    $total = $total_after_discount + $tax_amount;

                    $GLOBALS['bill_total'] += $total;
                    ?>
                        <tr>
                            <td><?php echo $Invoice_No; ?></td>
                            <td><?php echo $product; ?></td>
                            <td></td>
                            <td><?php echo $quantity; ?></td>
                            <td><?php echo number_format($price); ?></td>
                            <td><?php echo number_format($total); ?></td>
                            <td><?php echo $discount . '%'; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-xs-12 col-lg-6">
            <br><br><br><br><br>
        </div>
        <div class="col-xs-12 col-lg-6 default-p right-text">
            <div class="bill-row-total">
                <p><b><?php echo _("sale_bill_sub_total"); ?>
                    </b><?php echo number_format($GLOBALS['bill_subtotal']); ?></p>
                <p><b><?php echo _("sale_bill_total-discount"); ?> </b><?php echo $saleResult['discount'] . " YR" ?></p>
                <p><b><?php echo _("sale_bill_total-tax"); ?> </b><?php echo $saleResult['tax'] . '%'; ?></p>
                <b class="font-size-1-5"><?php echo 'YR ' . number_format($GLOBALS['bill_total']); ?></b>
                <?php
           
                if($GLOBALS['bill_total'] > $saleResult['paid'] AND $saleResult['paid']!=0){
                    echo '
                        <script>
                            var x = document.getElementById("paidStatus");
                            x.innerHTML = "'._('sale_bill_partially_paid').'";
                            x.style.background = "red";
                            x.style.color = "white";
                        </script>
                        ';
                } else if( $saleResult['paid'] == 0) {
                   
                    echo '
                        <script>
                            var x = document.getElementById("paidStatus");
                            x.innerHTML = "'._('sale_bill_not_paid').'";
                            x.style.background = "red";
                            x.style.color = "white";
                        </script>
                    ';
                } else if( $GLOBALS['bill_total'] == $saleResult['paid']) {
                    echo '
                        <script>
                            var x = document.getElementById("paidStatus");
                            x.innerHTML = "'._('sale_bill_paid').'";
                        </script>
                        ';
                }
                
            ?>
            </div>
        </div>
        <!-- <div class="col-sm-12 d-flex justify-content-end top-margin-sm">
        <button id="sale_pdf" type="submit" class="btn main-btn save"><?php //echo _("sale_bill_print");?></button>
        <button type="button" class="btn btn-secondary  cancel" onclick="location.href='sales.php';"><?php //echo _("sale_bill_cancel");?></button>
    </div> -->
    </div>
</div>

<script>
$('#sale_pdf').click(genScreenshot);

function genScreenshot() {
    html2canvas(document.getElementById('sale_report'), {
        onrendered: function(canvas) {
            var imgData = canvas.toDataURL("image/png", 1.0);
            var pdf = new jsPDF();
            pdf.addImage(imgData, 'png', 0, 0);
            pdf.save('sale_bill.pdf');
        }
    });
}
</script>
<?php
include("includes/template/footer.php");
?>