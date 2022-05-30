<?php
include("includes/template/header.php");
include("includes/template/functions.php");
include("connect.php");

//$type=$_SESSION["type_of_shop"];
//echo $type;
?>

<div class="row">

    <div class="col-xl-4
      col-md-12 col-12">
        <div class="dashboard-block text-align-center firstCardDashboard">
            <?php
                                    $saleSum=0;
                                    $debtSum=0;
                                    $purchaseSum=0;
                                    $debt_suSum=0;
                                    $expenseSum=0;
                                    $refundSum=0;
                                     $sql ="
                                     SELECT id,SUM(paid) as totalPaid,'refund' as typeOfTrans from refund
                                     union SELECT id,SUM(paid) as totalPaid,'sale' as typeOfTrans from sale
                                    UNION SELECT id,SUM(payment) totalPaid,'SellDebt'  from debt
                                    UNION SELECT id,SUM(paid) totalPaid,'Purchase'as typeOfTrans from purchase
                                    UNION SELECT id,SUM(payment),'PurchaseDebt'as typeOfTrans from debt_su
                                    union SELECT ID,SUM(total),'expense'as typeOfTrans  from expense
                                     ";
                                          $result = $mysqli->query($sql) or die($mysqli->error);
                                    while( $row = $result->fetch_assoc()){
                                  if($row["typeOfTrans"]=="sale")
                                    $saleSum=$row["totalPaid"];
                                   else if($row["typeOfTrans"]=="SellDebt")
                                    $debtSum=$row["totalPaid"];
                                    else if($row["typeOfTrans"]=="Purchase")
                                    $purchaseSum=$row["totalPaid"];
                                    else if($row["typeOfTrans"]=="PurchaseDebt")
                                    $debt_suSum=$row["totalPaid"];
                                    else if($row["typeOfTrans"]=="Expense")
                                    $expenseSum=$row["totalPaid"];
                                    else if($row["typeOfTrans"]=="refund")
                                    $refundSum=$row["totalPaid"];
                                    }
               ?>

            <div class="cash">


                <div class="cashAmount">
                    <img width="100" src="./layout/images/dollar.svg" alt="">
                </div>

                <div class="cashName">

                    <h4>
                        <?php
            echo number_format(($saleSum+$debtSum)-($purchaseSum+$debt_suSum+ $expenseSum+$refundSum))
            ?>
                    </h4>
                    <h4 class=""><?php echo _("Cash"); ?></h4>

                </div>


            </div>
        </div>


    </div>
    <div class="responsiveSecondDashboardCard col-xl-8 col-md-12 col-12">
        <div class="dashboard-block text-align-center firstCardDashboard">




            <div class="totalSales">
                <div class="allSingleSales">

                    <div class="singleSales">
                        <div class="singleSalesIcon">
                            <img width="80" src="./layout/images/money.svg" alt="">
                        </div>
                        <div class="singleSalesDetails">
                            <h4>
                                <?php
        $dailySales = $mysqli->query("SELECT SUM(sale.total) AS 'daily',(SELECT SUM(refund.total) 
          FROM refund
          WHERE cast(refund.created_at as date) = CURDATE() AND archive = 0) as 'dailyRefund'
          FROM sale
          WHERE cast(sale.created_at as date) = CURDATE() AND archive = 0");
        $value = $dailySales->fetch_assoc();
        echo $value['daily'] - $value['dailyRefund'];
        ?>
                            </h4>
                            <h4 class="margin-top"><?php echo _("daily_sales"); ?></h4>
                        </div>


                    </div>
                    <div class="singleSales">
                        <div class="singleSalesIcon">
                            <img width="80" src="./layout/images/investment.svg" alt="">
                        </div>
                        <div class="singleSalesDetails">
                            <h4>
                                <?php
        $monthlySales = $mysqli->query("SELECT SUM(sale.total) AS 'monthly',(SELECT SUM(refund.total) 
          FROM refund
          WHERE MONTH(refund.created_at) = MONTH(NOW()) AND archive = 0) AS 'monthlyRefund'
          FROM sale
          WHERE MONTH(sale.created_at) = MONTH(NOW()) AND archive = 0") ;
        $value = $monthlySales->fetch_assoc();
        echo $value['monthly']-$value['monthlyRefund'];
        ?>
                            </h4>
                            <h4><?php echo _("monthly_sales"); ?></h4>
                        </div>


                    </div>




                    <div class="singleSales">
                        <div class="singleSalesIcon">
                            <img width="80" src="./layout/images/financial-profit.svg" alt="">
                        </div>
                        <div class="singleSalesDetails">
                            <h4>
                                <?php
        $yearlySales = $mysqli->query("SELECT SUM(sale.total) AS 'yearly',(SELECT SUM(refund.total) 
          FROM refund
          WHERE YEAR(refund.created_at) = YEAR(CURDATE()) AND archive = 0)AS 'yearlyRefund'
          FROM sale
          WHERE YEAR(sale.created_at) = YEAR(CURDATE()) AND archive = 0");
        $value = $yearlySales->fetch_assoc();
        echo $value['yearly']-$value['yearlyRefund'];
        ?>
                            </h4>
                            <h4><?php echo _("yearly_sales"); ?></h4>
                        </div>


                    </div>
                </div>





            </div>



        </div>

    </div>
    <div class="col-xl-4 col-md-6 col-12">
        <div class="dashboard-block">
            <h5><?php echo _("sales_vs_purchase"); ?></h5>
            <div class="dougnut-controller">
                <button name="previous" onclick="drawChart(this)">
                    < </button>
                        <p id="salesVSPurchaseHeader"><?php echo _("daily"); ?></p>
                        <button name="next" onclick="drawChart(this)">></button>
            </div>
            <div class="chart-wrapper">
                <canvas id="doughnut-chart" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 col-12">
        <div class="dashboard-block">
            <h5><?php echo _("stock_value"); ?></h5>
            <div class="chart-wrapper">
                <canvas id="bar-chart-grouped" width="100%" height="100%"></canvas>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 col-12">
        <div class="dashboard-block dashboard-block-lists debtCard">
            <?php 
            // $tmp = 0;
            $supplierDebt = $mysqli->query("SELECT SUM(total - paid) as supplierDebt, (SELECT SUM(balance) from suppliers) as supplierBalance, (SELECT SUM(payment) from debt_su) as payment from purchase");
            // echo $supplierDebt;/
            if($supplierDebt->num_rows > 0){
                if ($row = $supplierDebt->fetch_assoc()) {
                    // foreach($row as $element){
                        // echo $element;
                        // $sumCustomerDebt = $element;
                    // }
                    // $sumSupplierDebt = $row;

                    $sumSupplierDebt = $row['supplierDebt'] + $row['supplierBalance'] - $row['payment'];
                    $oldValue = $row['supplierDebt'] + $row['supplierBalance'];
                    $newValue = $row['payment'];

                    
                    $diff = ($newValue / ($oldValue != 0 ? $oldValue : 1) ) * 100;
                    // echo round(100 - $diff, 2)."%";
                    // if($diff < $tmp){
                    //     // echo "arrow down";
                    // }else{
                    //     // echo "arrow up";
                    // }
                }
            }

            // $tmp = $diff;
            // print_r($supplierDebt);

            ?>

            <?php 
            // $tmp = 0;
            $customerDebt = $mysqli->query("SELECT SUM(total - paid) as customerDebt, (SELECT SUM(balance) from customer) as customerBalance, (SELECT SUM(payment) from debt) as payment from sale");
            if($customerDebt->num_rows > 0){
                if ($row = $customerDebt->fetch_assoc()) {
                    // foreach($row as $element){
                        // echo $element;
                        // $sumCustomerDebt = $element;
                    // }
                    // $sumSupplierDebt = $row;

                    $sumCustomerDebt = $row['customerDebt'] + $row['customerBalance'] - $row['payment'];
                    $oldValue = $row['customerDebt'] + $row['customerBalance'];
                    $newValue = $row['payment'];
                    $diff2 = ($newValue / ($oldValue != 0 ? $oldValue : 1) ) * 100;
                    // echo round(100 - $diff, 2)."%";
                    // if($diff < $tmp){
                    //     // echo "arrow down";
                    // }else{
                    //     // echo "arrow up";
                    // }
                }
            }

            // $tmp = $diff;
            // print_r($supplierDebt);

            ?>
            <div class="supplierDebt">
                <div class="supplierTitle">
                    <h2>Supplier Debt</h2>
                </div>
                <h3><?php echo  number_format($sumSupplierDebt); ?></h3>
                <div class="percentage">
                    <h4><?php echo number_format($diff - 100, 2) ?>%</h4>
                </div>



            </div>
            <div class="customerDebt">
                <div class="customerTitle">
                    <h2>Customer Debt</h2>
                </div>
                <h3><?php echo number_format($sumCustomerDebt); ?></h3>
                <div class="percentage">
                    <h4><?php echo number_format($diff2 - 100, 2) ?>%</h4>
                </div>

            </div>

        </div>
    </div>

    <div class="col-xl-4 col-md-6 col-12">
        <div class="dashboard-block dashboard-block-lists">
            <p class="blue-text"><?php echo _("recent_bills"); ?></p>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th><?php echo _("dashboard_bills_no"); ?></th>
                        <th><?php echo _("dashboard_total"); ?></th>
                        <th><?php echo _("dashboard_type"); ?></th>
                    </tr>
                </thead>
                <tbody>

                    <?php
          $recentBillsResult = $mysqli->query("SELECT  id, type, total FROM expense Where archive=0 ORDER BY ID DESC LIMIT 5");

          if ($recentBillsResult->num_rows > 0) {
            while ($row = $recentBillsResult->fetch_assoc()) {
              $id = $row['id'];
              $total = $row['total'];
              $type = $row['type'];
          ?>
                    <tr>
                        <td><?php echo $id ?></td>
                        <td><?php echo $total ?></td>
                        <td><?php echo $type ?></td>
                    </tr>
                    <?php
            }
          }
          ?>

                </tbody>
            </table>
        </div>
    </div>


    <div class="col-xl-4 col-md-6 col-12">
        <div class="dashboard-block dashboard-block-lists">
            <p class="blue-text"><?php echo _("dashboard_recent_transaction"); ?></p>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th><?php echo _("dashboard_invoice_no"); ?></th>
                        <th><?php echo _("dashboard_total"); ?></th>
                        <th><?php echo _("dashboard_type"); ?></th>
                    </tr>
                </thead>
                <tbody>

                    <?php
          $recentTransactions = $mysqli->query("SELECT *
          FROM (SELECT 'Purchase' AS 'type', purchase.id AS 'id', purchase.total AS 'total', purchase.created_at AS 'date'
                  FROM purchase
                  WHERE purchase.purchase_status_id = 4 and purchase.archive=0
              UNION
                  SELECT 'Sale' as 'type', sale.id AS 'id', sale.total AS 'total', sale.created_at AS 'date'
                  FROM sale where archive=0) AS RecentStuff
          ORDER BY date DESC
          LIMIT 5");
          if ($recentTransactions->num_rows > 0) {
            while ($row = $recentTransactions->fetch_assoc()) {
              $id = $row['id'];
              $total = $row['total'];
              $type = $row['type'];
          ?>
                    <tr>
                        <td><?php echo $id ?></td>
                        <td><?php echo $total ?></td>
                        <td><?php echo $type == 'Sale' ? _("dashboard_sales") : _("dashboard_purchase")?></td>
                    </tr>
                    <?php
            }
          }
          ?>

                </tbody>
            </table>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 col-12">
        <div class="dashboard-block dashboard-block-lists">
            <p class="blue-text"><?php echo _("dashboard_top_products_of_today"); ?></p>
            <div class=" table-responsive-lg">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:15em"><?php echo _("dashboard_product"); ?></th>
                            <th style="width:5em"><?php echo _("dashboard_total"); ?></th>
                            <th style="width:10em"><?php echo _("dashboard_availability"); ?></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
          $recentBillsResult = $mysqli->query("SELECT sale_orders.sale_id AS 'id', sale_orders.product_id AS 'ProductID', SUM(sale_orders.quantity) AS 'ProductQuantity', product.name AS 'ProductName',product.name_ar AS 'ProductNameAr', product.server_image_path AS 'ProductImage', sale_orders.created_at AS 'Date',product.category_id AS category,
          inventory.quantity AS 'InventoryQuantity'

                                                  -- (SELECT inventory.quantity FROM inventory
                                                  -- INNER JOIN sale_orders ON sale_orders.id = inventory.product_id 
                                                  --  WHERE inventory.product_id = sale_orders.product_id) AS 'InventoryQuantity'


                                                   FROM sale_orders 
                                                   INNER JOIN inventory ON inventory.product_id  =  sale_orders.product_id 
                                                  INNER JOIN product ON product.id = sale_orders.product_id 
                                                  WHERE DATE(cast(sale_orders.created_at as date)) = CURDATE() AND product.archive=0
                                                  AND inventory.product_id = sale_orders.product_id
                                                  GROUP BY sale_orders.product_id 
                                                  ORDER BY sale_orders.quantity 
                                                  DESC LIMIT 3
                                                   ");
           
          if ($recentBillsResult->num_rows > 0) {
            while ($row = $recentBillsResult->fetch_assoc()) {
              $name=checkProductsNames($row['ProductName'],$row['ProductNameAr']);
              $ProductImage=checkProductsImages($row['ProductImage'],$row['category']);
              
              //$ProductName = $row['ProductName'];
              
             // $ProductImage = $row['ProductImage'];
              $ProductQuantity = $row['ProductQuantity'];
              $InventoryQuantity = $row['InventoryQuantity'];

            
              
          ?>
                        <tr>
                            <td>
                                <img src="<?php echo $ProductImage ; ?>" />
                                <!-- <img src="<?php //echo "../Dashboard/syncing/picture/images/".$ProductImage ?>" /> -->
                                <p><?php echo substr($name,0,16).'...' ?></p>
                            </td>
                            <td><?php echo $ProductQuantity ?></td>
                            <td>
                                <?php
                  if ($InventoryQuantity <= 0) {
                    echo '<div class="product-status-unavailabile">'. $InventoryQuantity . ' ' . _("dashboard_out_of_stock") . '</div>';
                  } else {
                     echo '<div class="product-status-availabile">' . $InventoryQuantity . ' ' . _("dashboard_in_stock") . '</div>';
                  }
                  ?>

                            </td>
                        </tr>
                        <?php
            }
          }
          ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>
drawChart();
new Chart(document.getElementById("bar-chart-grouped"), {
    type: 'bar',
    data: {

        <?php
      $stockValue = $mysqli->query("SELECT SUM(inventory.quantity) AS 'Quantity',inventory.quantity AS 'qty', product.name AS 'ProductName' ,product.name_ar As 'ProductNameAr'
                                      FROM inventory
                                      INNER JOIN product ON product.id = inventory.product_id
                                      WHERE inventory.archive=0 and inventory.quantity>0 
                                      GROUP BY inventory.product_id,inventory.quantity
                                      ORDER BY inventory.quantity ASC
                                      LIMIT 6");
        
      
      if ($stockValue->num_rows > 0) {
        $Quantity = array();
        $ProductName = array();

        $colors = array("#55D8FE", "#A3A0FB", "#FFDA83", "#FF8373", "#6FC1A5", "#4F98CA");

        while ($row = $stockValue->fetch_assoc()) {
          array_push($Quantity, $row['Quantity']);
          if($_SESSION["language"] == "ar_EG"){
            if(is_null($row['ProductNameAr'])){

              array_push($ProductName, $row['ProductName'] );
            }
            else{
              array_push($ProductName, $row['ProductNameAr'] );

            }
            
         
          } elseif ($_SESSION["language"] == "en_US"){
            
            if(is_null($row['ProductName'])){

              array_push($ProductName, $row['ProductNameAr'] );
            }
            elseif($row['ProductName']==="null"){

              array_push($ProductName, $row['ProductNameAr'] );
            }
            else{
              array_push($ProductName, $row['ProductName'] );

            }
           
          
          }
          
        }
      ?>
        labels: [<?php
        //preg_replace( "/\r|\n/","",$ProductName[$i])
                  for ($i = 0; $i < count($Quantity); $i++) {
                    echo '"'.preg_replace( "/\r|\n/","",$ProductName[$i]).'"';
                    if (count($Quantity) != $i + 1) {
                      echo ',';
                    }
                  }
                  ?>],
        datasets: [
            <?php
          $colorsArray = '["';
          $valuesArray = '[';
          for ($i = 0; $i < count($ProductName); $i++) {
            if ($i == 0) {
              $valuesArray .=  $Quantity[$i];
              $colorsArray .= $colors[$i];
            } else {
              $valuesArray .= ','  . $Quantity[$i];
              $colorsArray .= '","' . $colors[$i];
            }
          }
          $colorsArray = $colorsArray . '"]';
          $valuesArray =  $valuesArray . ']';
          echo '{ 
              label: "Quantity",
              barPercentage: 0.4,
              backgroundColor: ' . $colorsArray . ',
              data:' . $valuesArray . ' 
            }';
          ?>
            <?php
      }
        ?>
        ],
    },
    options: {
        scales: {
            xAxes: [{
                ticks: {
                    padding: 2,
                    callback: function(tick) {
                        var characterLimit = 16;
                        if (tick.length >= characterLimit) {
                            return tick.slice(0, tick.length).substring(0, characterLimit - 1)
                                .trim() + '...';;
                        }
                        return tick;
                    }
                }

            }]
        },
        legend: {
            display: false
        },
        responsive: true,
        maintainAspectRatio: false
    }
});
let i = 0;

function drawChart(button) {
    let options = ["<?php echo _("daily"); ?>", "<?php echo _("monthly"); ?>", "<?php echo _("yearly"); ?>"];
    <?php
    $salesVSPurchase = $mysqli->query("(SELECT SUM(sale.total) 
    FROM sale
    WHERE cast(sale.created_at as date) = CURDATE() AND archive=0) 
    UNION ALL
    (SELECT SUM(purchase.total)
    FROM purchase
    WHERE cast(purchase.created_at as date) = CURDATE()  AND archive=0)
    UNION ALL
    (SELECT SUM(sale.total)
    FROM sale
    WHERE MONTH(sale.created_at) = MONTH(NOW()))
    UNION ALL
    (SELECT SUM(purchase.total)
    FROM purchase
    WHERE MONTH(purchase.created_at) = MONTH(NOW())  AND archive=0)
    UNION ALL
    (SELECT SUM(sale.total)
    FROM sale
    WHERE YEAR(sale.created_at) = YEAR(CURDATE())  AND archive=0)
    UNION ALL
    (SELECT SUM(purchase.total)
    FROM purchase
    WHERE YEAR(purchase.created_at) = YEAR(CURDATE())  AND archive=0)");
    $sales = array();
    while ($row = $salesVSPurchase->fetch_assoc()) {
      $value = 0;
      if ($row['SUM(sale.total)'] != 0) {
        $value = $row['SUM(sale.total)'];
      }else{
        
      }
      array_push($sales, $value);
    }

    echo 'let salesDaily = ' . $sales[0] . ';';
    echo 'let purchaseDaily = ' . $sales[1] . ';';
    echo 'let salesMonthly = ' . $sales[2] . ';';
    echo 'let purchaseMonthly = ' . $sales[3] . ';';
    echo 'let salesYearly = ' . $sales[4] . ';';
    echo 'let purchaseYearly = ' . $sales[5] . ';';
    ?>


    if ($(button).attr('name') == "next") {
        console.log(jQuery.inArray($('#salesVSPurchaseHeader').text(), options))
        if (jQuery.inArray($('#salesVSPurchaseHeader').text(), options) === options.length - 1) {
            $("#salesVSPurchaseHeader").text(options[0]);
            i = 0;
        } else {
            i++;
            $("#salesVSPurchaseHeader").text(options[i]);



        }

        // $("#salesVSPurchaseHeader").text(options[jQuery.inArray($('#salesVSPurchaseHeader').text(), options) +1]);
        // console.log(i);



    }
    // else{
    //   $("#salesVSPurchaseHeader").text(options[jQuery.inArray($('#salesVSPurchaseHeader').text(), options) - 1]);

    // }

    let sales = 0;
    let purchase = 0;


    if (jQuery.inArray($('#salesVSPurchaseHeader').text(), options) == 0) {
        sales = salesDaily;
        purchase = purchaseDaily;
    } else if (jQuery.inArray($('#salesVSPurchaseHeader').text(), options) == 1) {

        sales = salesMonthly;
        purchase = purchaseMonthly;
    } else {

        sales = salesYearly;
        purchase = purchaseYearly;
    }

    // if (myChart) myChart.destroy();
    new Chart(document.getElementById("doughnut-chart"), {
        type: 'doughnut',
        data: {
            labels: ["<?php echo _('dashboard_sales'); ?>", "<?php echo _('dashboard_purchase'); ?>"],
            datasets: [{
                label: "<?php echo _('dashboard_sales') . ', ' . _('dashboard_purchase'); ?>",
                backgroundColor: ["#3e95cd", "#8e5ea2"],
                data: [sales, purchase]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });




}
</script>

<?php

include("includes/template/footer.php");
?>