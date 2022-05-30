<?php

  session_start();
  

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
    include("../template/functions.php");
   

    /* [ CREATE NEW INVOICR OBJECT] */
    require("../../invoicr.php");
    $invoice = new Invoicr();

     $username=$_REQUEST['users']; 
     $sub_total=0;
     if(empty($username)){
      $where="";
     }
     else{
      $where="AND purchase.user_id=".$username;
     }

    //  echo $username;

    // From and To // 
    $from_date = $_REQUEST['from_purchase']; 
    $to_date = $_REQUEST['to_purchase'];

    if (empty($from_date)) {
      $from_date = '2019-01-01';
    }   
    if (empty($to_date)) {
      $to_date = date('Y-m-d');
    }
   
    
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
    
    // Get Id of product //
    // $products = $_REQUEST["products"];

    $sql = "SELECT *,purchase.id AS purchaseId,suppliers.fname AS supFname,suppliers.lname AS supLname, product.name as ProductName,product.name_ar as ProductNameAr, purchase_orders.received_quantity AS purchaseQuantity,purchase_orders.price_of_purchase AS purchasePrice, purchase_orders.tax_on_product AS purchaseTax, date_format(purchase.created_at, '%Y-%m-%d') AS purchaseDate, purchase.total_tax AS purchaseTotalTax, purchase.total_discount AS purchaseTotalDiscount, purchase.sub_total AS purchaseSubTotal, purchase.total AS purchaseTotal,user.full_name as username
    FROM ((((purchase 
    INNER JOIN purchase_orders ON purchase.id = purchase_orders.purchase_id )
    INNER JOIN suppliers ON purchase.supplier_id = suppliers.id )
    INNER JOIN product ON purchase_orders.product_id = product.id) 
    INNER JOIN user ON purchase.user_id = user.id) 
    where (purchase.purchase_status_id=4 or purchase.purchase_status_id=5 or purchase.purchase_status_id=6) $where ";  
  

    //if there is condation ( before and to dates) //
    if (!empty($from_date) && !empty($to_date)) {
      $sql .="AND date_format(purchase.created_at, '%Y-%m-%d') >= ('$from_date') AND date_format(purchase.created_at, '%Y-%m-%d') <= ('$to_date') ORDER BY purchase.created_at ASC";
      $from = "From : $from_date";
      $to = "To : $to_date";
    } else if (!empty($from_date)) {     
      $sql .=" AND date_format(purchase.created_at, '%Y-%m-%d') >= ('$from_date')  ORDER BY purchase.created_at ASC ";
      $from = "From : $from_date";
      $to = "";
    } else if (!empty($to_date)) {
      $sql .=" AND date_format(purchase.created_at, '%Y-%m-%d') <= ('$to_date')  ORDER BY purchase.created_at ASC";
      $to = "To : $to_date";
      $from = "" ;     
    } else {
      $sql .=" ORDER BY purchase.created_at ASC";
      $to = "";
      $from = "" ;
    }

    $result = $mysqli->query($sql) or die($mysqli->error);
  
 

    while ($row = $result->fetch_assoc()) {

      // Table variables
      $refrence_no = $row['purchaseId'];
      $supplier_name = $row['supFname'].' '.$row['supLname'];
      $product_name = checkProductsNames($row['ProductName'],$row['ProductNameAr']);
      $quantity = $row['purchaseQuantity'];
      $price = $row['purchasePrice'];
      $date = $row['purchaseDate'];
      $total_tax = $row['purchaseTotalTax'];
      $total_discount = $row['purchaseTotalDiscount'];
      //$sub_total = $row['purchaseSubTotal'];
      $sub_total =$sub_total+ $row['purchasePrice'] * $row['purchaseQuantity'];
      $total = $sub_total+ $total_tax - $total_discount;
      $user=$row['username'];
      $total_price=$quantity*$price;


      // Table Items
      $items = [
        [$refrence_no, $supplier_name, $product_name, $quantity,$price,$total_price,$date,$user],
      ];
      foreach ($items as $i) { $invoice->add("items", $i); } 
    //TOTALS
    if($_SESSION["language"] == "ar_EG"){
    $invoice->set("totals", [
      // ["الصافي", "$sub_total"],
      // ["الخصم", "$total_discount"],
      // ["الضريبة", "$total_tax"],
      ["الإجمالي", "$sub_total"]
    ]);
    } else {
      $invoice->set("totals", [
        // ["SUB-TOTAL", "$sub_total"],
        // ["DISCOUNT", "$total_discount"],
        // ["Tax", "$total_tax"],
        ["GRAND TOTAL", "$sub_total"]
      ]);
    }
 
    }

    // $invoice->set("notes", [	
    //   "Get a 10% off with the next purchase with discount code DOGE1234!"
    // ]);
       
    // 3A - CHOOSE TEMPLATE.
    $invoice->template("purchase");

    /*****************************************************************************/
    // 3B - OUTPUT IN HTML
    // DEFAULT DISPLAY IN BROWSER | 1 DISPLAY IN BROWSER | 2 FORCE DOWNLOAD | 3 SAVE ON SERVER
     $invoice->outputHTML();
    // $invoice->outputHTML(1);
    // $invoice->outputHTML(2, "invoice.html");
    /*****************************************************************************/
    // 3C - PDF OUTPUT
    // DEFAULT DISPLAY IN BROWSER | 1 DISPLAY IN BROWSER | 2 FORCE DOWNLOAD | 3 SAVE ON SERVER
    //$invoice->outputPDF();
    // $invoice->outputPDF(1);
    // $invoice->outputPDF(2, "invoice.pdf");
    /*****************************************************************************/
  } else {
    echo "silence is gold.";
  }
?>