<?php  


session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../../login.php");
  exit;
}


include_once("../../connect2.php");
  $phone = $_SESSION["phone"];
  $userId=$_SESSION["id"] ;
  include("../template/functions.php");

  $query = "SELECT * from users where id=$userId ";
  $result = mysqli_query($mysqli, $query) or die(mysqli_error());
  $row2 = mysqli_fetch_assoc($result);
  $img = !empty($row2['local_image_path']) ? 'dashboard/upload/' . $row2['local_image_path'] : 'dashboard/layout/images/Company_logo.png';


  $locale = $_SESSION["language"];

    if (defined('LC_MESSAGES')) {
        setlocale(LC_MESSAGES, $locale); // Linux
        bindtextdomain("messages", "./locale");
        bind_textdomain_codeset("messages", 'UTF-8');
    } else {
        putenv("LC_ALL={$locale}"); // windows
        bindtextdomain("messages", ".\locale");
        bind_textdomain_codeset("messages", 'UTF-8');
    }
   
    textdomain("messages");



if(!empty($_GET))
{
  include("../../connect.php");
  $where ="";

    // From and To // 
    $from_date = $_REQUEST['from_stock']; 
    $to_date = $_REQUEST['to_stock'];
    $today = date('Y-m-d');
      $user_id=$_REQUEST['users'];

    if (empty($from_date)) {
      $from_date = '2019-01-01';
    }   
    if (empty($to_date)) {
      $to_date = date('Y-m-d');
    }
 if (!empty($user_id)) {
            $where .=" and purchase.user_id=$user_id";
          }
 
} else {
  echo "silence is gold.";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <link href="../../layout/css/report.css" rel="stylesheet">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://www.google.com/cloudprint/client/cpgadget.js">
    </script>
    <script>
    $(document).ready(function($) {
        var ua = navigator.userAgent.toLowerCase();
        var isAndroid = ua.indexOf("android") > -1; //&& ua.indexOf("mobile");

        $('button.print').click(function(e) {
            e.preventDefault();
            if (isAndroid) {
                // https://developers.google.com/cloud-print/docs/gadget
                var gadget = new cloudprint.Gadget();
                gadget.setPrintDocument("url", $('title').html(), window.location.href, "utf-8");
                gadget.openPrintDialog();
            } else {
                window.print();
            }
            return false;
        });
    });
    </script> -->
    <?php
    if($_SESSION["language"] == "ar_EG")
    echo "<title>تقرير المخزون </title>";
    else
     echo "<title>Stock Report</title>";
    ?>

</head>

<body>
    <?php 
  if($_SESSION["language"] == "ar_EG"){
    echo "<style> body{direction:rtl; }  .right{text-align:left}</style>";
        } else {
                echo "<style>  .right{text-align:right}</style>";   
         }
  ?>
    <div id='invoice'>
        <div id="content">
            <table id='company'>
                <tr>
                    <td>
                        <img
                            src="<?php echo (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . "/".$img ?> " />
                    </td>
                    <td class='right'>
                        <div><?php echo $row2['shopName']?></b></div>
                        <div><?php echo $row2['address']?></div>

                        <?php 
                            if($_SESSION["language"] == "ar_EG"){ ?>
                        <div> من تاريخ : <?php echo $from_date ?></div>
                        <div> إلى: <?php echo $to_date ?></div>
                        <?php } else {?>
                        <div> From: <?php echo $from_date ?></div>
                        <div> To: <?php echo $to_date ?></div>
                        <?php }
                        ?>
                    </td>
                </tr>
            </table>

            <?php 
                    if($_SESSION["language"] == "ar_EG"){
                           echo "<div id='bigi'>
                        <p> تقرير المخزون </p>
                        <button class='btn main-btn print-btn' onclick=\" 
                        printS()
                         \">   طباعة التقرير </button> 
                        </div>";
                            

                        }else {
                              echo "<div id='bigi'><p>Stock Report</p>
                              <button class='btn main-btn print-btn' onclick=\" 
                              printS()
                                  \">Print Report </button>
                            </div>";
                        }

                ?>

            <?php
            $inventory_quantity = 0;
            $stock_value_by_selling_price = 0;
             $stock_value_by_cost_price = 0;
                           $sql ="SELECT product.name AS ProductName,product.name_ar AS ProductNameAr,inventory.quantity,`product`.`price`,purchase_orders.price_of_purchase as purchase_price,date_format(inventory.expiry_date ,'%Y-%m-%d') as expiry_date
                                    from inventory LEFT  JOIN product
                                    on product.id=inventory.product_id
                                     LEFT JOIN purchase_orders ON inventory.created_at=purchase_orders.created_at and  inventory.product_id=purchase_orders.product_id
                                     LEFT JOIN purchase ON  purchase_orders .purchase_id=purchase.id
                                      WHERE inventory.id!=0 and date_format(inventory.created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(inventory.created_at, '%Y-%m-%d') <= ('$to_date')  $where
                                    ORDER BY  inventory.created_at DESC";
                                  

                                        $result = $mysqli->query($sql) or die($mysqli->error);
                                        // $row = $result->fetch_assoc();
                                    if($_SESSION["language"] == "ar_EG"){
                                        echo  "<table id='items'><tr class='t_header'><th style='width:20em'> المنتج</th><th> الكمية</th><th> سعر البيع</th><th>سعر الشراء</th><th> تاريخ الإنتهاء</th></tr>";
                                    } else {
                                        echo "<table id='items'><tr class='t_header'><th style='width:20em'>Product</th><th>Quantity</th><th>Sale price</th><th>Purchase price</th><th style='width:8em'> Expiry date</th></tr>";
                                    }
                                    while( $row = $result->fetch_assoc()){
                                      $inventory_quantity+=$row["quantity"];
                                      $stock_value_by_selling_price=$stock_value_by_selling_price+$row["quantity"]*$row["price"];
                                      $stock_value_by_cost_price = $stock_value_by_cost_price+$row["quantity"]*$row["purchase_price"];

                                      $product_name=checkProductsNames($row['ProductName'],$row['ProductNameAr']);
                                    echo "<tr class='t_body'><td><div>".$product_name."</div>"."</td><td>".$row["quantity"]."</td><td>".$row["price"]."</td><td>".$row["purchase_price"]."</td><td>".$row["expiry_date"]."</td></tr>";
                                    }
                                    echo "</table>";
                                    
                                            $profit_estimate =number_format(($stock_value_by_selling_price - $stock_value_by_cost_price)) ;
                                             $stock_value_by_cost_price = number_format($stock_value_by_cost_price);
                                             $stock_value_by_selling_price = number_format($stock_value_by_selling_price);
                                             if($_SESSION["language"] == "ar_EG")
                                            echo "<div class='bottom-total'><div class='ttl'><p> الكمية:</p><p>".number_format($inventory_quantity)."</p></div> <div class='ttl'><p>قيمة الأسهم حسب سعر التكلفة: </p><p> $stock_value_by_cost_price </p></div> <div class='ttl'><p>قيمة الأسهم حسب سعر البيع: </p><p>$stock_value_by_selling_price</p></div> <div class='ttl'><p> تقدير الربح: </p><p>$profit_estimate</p></div>";
                                             else

                                    echo "<div class='bottom-total'><div class='ttl'><p>inventory quantity:</p><p>".number_format($inventory_quantity)."</p></div> <div class='ttl'><p>stock value by cost price: </p><p>$stock_value_by_cost_price</p></div><div class='ttl'><p>stock value by sale price: </p><p>$stock_value_by_selling_price</p></div> <div class='ttl'><p> profit estimate: </p><p>$profit_estimate</p></div></div>";
                                    
                ?>

        </div>


    </div>


    <script>
    function printS() {
        window.PPClose = false; // Clear Close Flag
        window.onbeforeunload = function() { // Before Window Close Event
            if (window.PPClose === false) { // Close not OK?
                return 'Leaving this page will block the parent window!\nPlease select "Stay on this Page option" and use the\nCancel button instead to close the Print Preview Window.\n';
            }
        }
        var printButton = document.querySelector(".print-btn");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        window.print();
        printButton.style.visibility = 'visible'; // Print preview
        window.PPClose = true;
    }
    </script>
</body>

</html>