<?php

  session_start();
  include("../template/functions.php");

  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../login.php");
    exit;
  }
  include("../../connect2.php");
  $userId = $_SESSION["id"];
   // get Shop info 
   $query = "SELECT * from users where id=$userId ";
   $result = mysqli_query($mysqli, $query) or die(mysqli_error());
   $row2 = mysqli_fetch_assoc($result);
   $img = !empty($row2['local_image_path']) ? 'dashboard/upload/' . $row2['local_image_path'] : 'dashboard/layout/images/Company_logo.png';

  if(!empty($_GET))
  {
    include("../../connect.php");

    /* [ CREATE NEW INVOICR OBJECT] */
    require("../../invoicr.php");
    $invoice = new Invoicr();

    // From and To //
    $from_date = $_REQUEST['from']; 
    $to_date = $_REQUEST['to'];
    $user_id=$_REQUEST['users'];

    if (empty($from_date)) {
      $from_date = '2019-01-01';
    }   
    if (empty($to_date)) {
      $to_date = date('Y-m-d');
    }
       
    // Get Id of product //
    $test = explode('|',  $_REQUEST["products"]);
    $products =$test[0];

    $Sproducts ="";
    $Pproducts ="";
    $Rproducts ="";
    $Tproduct ="";
    $STproduct ="";
    $service ="";

   

    $whereP =" and date_format(purchase_orders.created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(purchase_orders.created_at, '%Y-%m-%d') <= ('$to_date')";
    $whereS= "  date_format(sale_orders.created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(sale_orders.created_at, '%Y-%m-%d') <= ('$to_date')";
    $whereR= "  date_format(refund_orders.created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(refund_orders.created_at, '%Y-%m-%d') <= ('$to_date')";


    if (!empty($products)) {
      $Sproducts ="  sale_orders.product_id= $products";
      $Pproducts ="and purchase_orders.product_id= $products";
      $Rproducts ="   refund_orders.product_id= $products";
      $Tproduct="product_id= $products";
      $STproduct="and product_id= $products";

      $service="sale_orders.service_id= $products";
     

      $whereS= "and  date_format(sale_orders.created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(sale_orders.created_at, '%Y-%m-%d') <= ('$to_date')";
    $whereR= "and  date_format(refund_orders.created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(refund_orders.created_at, '%Y-%m-%d') <= ('$to_date')";

    }
   
      if (!empty($user_id)) {
            $whereP .=" and purchase.user_id=$user_id";
            $whereS.=" and sale.user_id=$user_id";
          }
            
if($_REQUEST["typeOf"]=="service"){
     $sql= "
          (
      SELECT sale_orders.created_at,sale_orders.quantity,sale_orders.price,user.full_name,'sale' as type_of_trans
      FROM `sale_orders` 
      left JOIN sale ON  sale_orders.sale_id=sale.id
      left JOIN user on sale.user_id=user.id
          WHERE  $service $whereS
          )    
          ";
}
else{

          $sql= "
          (
      SELECT sale_orders.created_at,sale_orders.quantity,sale_orders.price,user.full_name,'sale' as type_of_trans,'' as purchase_status_id
      FROM `sale_orders` 
      left JOIN sale ON  sale_orders.sale_id=sale.id
      left JOIN user on sale.user_id=user.id
        where $Sproducts $whereS
          )
      UNION
      (SELECT purchase_orders.created_at,purchase_orders.received_quantity,purchase_orders.price_of_purchase,user.full_name,'purchase' as type_of_trans,purchase_status_id
      FROM `purchase_orders` 
      left JOIN purchase ON  purchase_orders.purchase_id=purchase.id
      left JOIN user on purchase.user_id=user.id
      WHERE (purchase.purchase_status_id=4 or purchase.purchase_status_id=5 or purchase.purchase_status_id=6)  $Pproducts  $whereP)
      UNION
      SELECT refund_orders.created_at,refund_orders.quantity,refund_orders.price,user.full_name,'refund' as type_of_trans,'' as purchase_status_id
      FROM `refund_orders` 
      left JOIN refund ON  refund_orders.refund_id=refund.id 
      left JOIN user on refund.user_id=user.id
         where $Rproducts $whereR
          ORDER by created_at  
          ";
    } 
     // echo $sql;
    $result = $mysqli->query($sql) or die($mysqli->error);
    // $row = $result->fetch_assoc();

    // Profit
    while($row = $result->fetch_assoc()){
    $created_at = $row['created_at'];
    $quantity = $row['quantity'];
    $price = $row['price'] ;
    $full_name = $row['full_name'] ;
    $type_of_trans=$row['type_of_trans'] ;
    
      // 2E - ITEMS 
    $items = [
      [$created_at,$quantity,$price,$full_name,$type_of_trans,$row['purchase_status_id']],
    ];
    foreach ($items as $i) { $invoice->add("items", $i); }   
    }
    if($_REQUEST["typeOf"]=="service"){
      $sql= "SELECT
           0 AS total_purchases,
            COALESCE(SUM(quantity * price ),0) AS total_sales,0 total_refunds
          FROM
           sale_orders
            WHERE
           $service $whereS
    ";

    }
    else{
$sql= "SELECT
           (SELECT COALESCE(SUM(received_quantity * price_of_purchase),0)  FROM purchase_orders join purchase on purchase.id=purchase_orders.purchase_id where (purchase.purchase_status_id=4 or purchase.purchase_status_id=5 or purchase.purchase_status_id=6)  $STproduct $whereP) AS total_purchases,
            (select COALESCE(SUM(quantity * price ),0) From sale_orders where $Tproduct $whereS) AS total_sales ,
             (select COALESCE(SUM(quantity * price ),0) From refund_orders where $Tproduct $whereR) AS total_refunds
    ";
    }
    //echo $sql;
    //  LEFT JOIN
    //         (SELECT SUM(quantity * price ) AS sumRefund, quantity, price, date_format(sale_orders.created_at, '%Y-%m-%d') AS salesCreated, product_id FROM sale_orders 
    //          LEFT JOIN sale on sale.id=sale_orders.sale_id
    //      where 1  $whereS GROUP BY product_id) AS sale_orders
    //       ON product.id = sale_orders.product_id
    $result = $mysqli->query($sql) or die($mysqli->error);
    $row = $result->fetch_assoc();
    // Profit
    $total_purchases = $row['total_purchases'];
    $total_refunds = $row['total_refunds'];
     $total_sales = $row['total_sales']-$total_refunds; 
    $profit = ($total_sales - $total_purchases);
$item = [
      [number_format($total_purchases),number_format($total_sales),number_format($profit)],
    ];
    foreach ($item as $i) { $invoice->add("item", $i); }
    // Company Name //    
    if($_SESSION["language"] == "ar_EG"){
      $invoice->set("company", [
        (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . "/".$img, 
        $row2['shopName'], 
        $row2['address'],
        "من تاريخ : $from_date",
        "إلى : $to_date",
      ]);
    } else {
      $invoice->set("company", [
        (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . "/".$img, 
        $row2['shopName'], 
        $row2['address'],
        "From : $from_date",
        "To : $to_date",
      ]);

    }
                

    // $invoice->set("notes", [	
    //   "Get a 10% off with the next purchase with discount code DOGE1234!"
    // ]);


    /* [STEP 3 - OUTPUT] */
    // 3A - CHOOSE TEMPLATE, DEFAULTS TO SIMPLE IF NOT SPECIFIED
    $invoice->template("product");

    /*****************************************************************************/
    // 3B - OUTPUT IN HTML
    // DEFAULT DISPLAY IN BROWSER | 1 DISPLAY IN BROWSER | 2 FORCE DOWNLOAD | 3 SAVE ON SERVER
    $invoice->outputHTML();
    // $invoice->outputHTML(1);
    // $invoice->outputHTML(2, "invoice.html");
    /*****************************************************************************/
    // 3C - PDF OUTPUT
    // DEFAULT DISPLAY IN BROWSER | 1 DISPLAY IN BROWSER | 2 FORCE DOWNLOAD | 3 SAVE ON SERVER
    // $invoice->outputPDF();
    // $invoice->outputPDF(1);
    // $invoice->outputPDF(2, "invoice.pdf");

  } else {
    echo "silence is gold.";
  }
?>