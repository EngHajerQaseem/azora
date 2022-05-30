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

    /* [ CREATE NEW INVOICR OBJECT] */
    require("../../invoicr.php");
    $invoice = new Invoicr();

    // From and To // 
    $from_date = $_REQUEST['from_profit']; 
    $to_date = $_REQUEST['to_profit'];

    if (empty($from_date)) {
      $from_date = '2019-01-01';
    }   
    if (empty($to_date)) {
      $to_date = date('Y-m-d');
    }

    $sale_query = "SELECT COALESCE(SUM(total),0) AS saleTotal FROM sale ";
    $refund_query = "SELECT COALESCE(SUM(total),0) AS refundTotal FROM refund ";
    $purchase_query = "SELECT  COALESCE(SUM(purchase.total),0) AS purchaseTotal FROM purchase where (purchase.purchase_status_id=4 or purchase.purchase_status_id=5 or purchase.purchase_status_id=6) AND";
    $expense_query = "SELECT COALESCE(SUM(expense.total),0) AS expenseTotal FROM expense ";  
    

    //if there is condation ( before and to dates) //
    if (!empty($from_date) && !empty($to_date)) {
      $sale_query .="WHERE date(created_at) >= ('$from_date') AND date(created_at) <= ('$to_date')";
      $refund_query .="WHERE date(created_at) >= ('$from_date') AND date(created_at) <= ('$to_date')";
      $purchase_query .=" date(created_at) >= ('$from_date') AND date(created_at) <= ('$to_date')";
      $expense_query .="WHERE date(created_at) >= ('$from_date') AND date(created_at) <= ('$to_date')";
      $from = "From : $from_date";
      $to = "To : $to_date";
    } 
    else if (!empty($from_date)) {     
      $sale_query .="WHERE date(created_at) >= ('$from_date')";
      $refund_query .="WHERE date(created_at) >= ('$from_date')";
      $purchase_query .=" date(created_at) >= ('$from_date')";
      $expense_query .="WHERE date(created_at) >= ('$from_date')";
      $from = "From : $from_date";
      $to = "";
    } else if (!empty($to_date)) {
      $sale_query .="WHERE date(created_at) <= ('$to_date')";
       $refund_query .="WHERE date(created_at) <= ('$to_date')";
      $purchase_query .=" date(created_at) <= ('$to_date')";
      $expense_query .="WHERE date(created_at) <= ('$to_date')";
      $to = "To : $to_date";
      $from = "" ;     
    } else {
      $to = "";
      $from = "" ;
    }

    $sale_result = $mysqli->query($sale_query) or die($mysqli->error);
    $refund_result = $mysqli->query($refund_query) or die($mysqli->error);
    $purchase_result = $mysqli->query($purchase_query) or die($mysqli->error);
    $expense_result = $mysqli->query($expense_query) or die($mysqli->error);
  
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


    $sale_row = $sale_result->fetch_assoc(); 
    $refund_row = $refund_result->fetch_assoc(); 
    $purchase_row = $purchase_result->fetch_assoc();
    $expense_row = $expense_result->fetch_assoc();

    // // Table variables
  //  echo $sale_query;
  // echo $sale_row['saleTotal'];
  // echo $sale_query;
    $total_sales = $sale_row['saleTotal'];
     $total_refunds = $refund_row['refundTotal'];
    // echo $total_sales;
    $cost_of_sales = $purchase_row['purchaseTotal'];
    $cross_profit = $total_sales - $cost_of_sales;
    $total_expense = $expense_row['expenseTotal'];
    $Net_profit_before_tax = $cross_profit - $total_expense;    
    // if ($Net_profit_before_tax <= 0 ){
    //   $total_tax = 0;
    // } else {
    //   $total_tax = (0.05 * $Net_profit_before_tax);
    // }
    // $Net_profit =  $Net_profit_before_tax - $total_tax;


    // Table Items
    $items = [
      [number_format($total_sales-$total_refunds), number_format($cost_of_sales), number_format($cross_profit-$total_refunds),number_format($total_expense),number_format($Net_profit_before_tax-$total_refunds)],
    ];
    foreach ($items as $i) { $invoice->add("items", $i);
     } 

    // $invoice->set("notes", [	
    //   "Get a 10% off with the next purchase with discount code DOGE1234!"
    // ]);
       
    // 3A - CHOOSE TEMPLATE.
    $invoice->template("profit");

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
    /*****************************************************************************/
  } else {
    echo "silence is gold.";
  }
?>