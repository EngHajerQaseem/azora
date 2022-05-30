<?php
  session_start();

  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../login.php");
    exit;
  }
  
  if(!empty($_GET))
  {
    include("../../connect.php");
    include("../template/functions.php");

    /* [ CREATE NEW INVOICR OBJECT] */
    require("../../invoicr.php");
    $invoice = new Invoicr();

    // From and To // 
    $from_date = $_REQUEST['from_sub']; 
    $to_date = $_REQUEST['to_sub'];

    if (empty($from_date)) {
      $from_date = '2019-01-01';
    }   
    if (empty($to_date)) {
      $to_date = date('Y-m-d');
    }
       
    // Get Id of product //
    $subcategory = $_REQUEST["subcategory"];

    // Where clause to make query more clean. //
    $where = "WHERE date_format(created_at, '%Y-%m-%d') >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date')";

    $sql= "SELECT *,(subcategory.name) AS subcategoryName FROM
    (SELECT id, subcategory_id FROM product ) AS product
      LEFT JOIN
    (SELECT COALESCE((SELECT SUM(quantity * price) FROM sale_orders $where),0) AS sub_total_sales, (product_id) AS saleProductId,(discount) AS saleDiscount,(tax) AS saleTax, created_at 
      FROM sale_orders $where) AS sale_orders ON product.id = saleProductId
      LEFT JOIN
    (SELECT id,name FROM subcategory WHERE id = $subcategory) AS subcategory ON product.subcategory_id = subcategory.id
      LEFT JOIN
    (SELECT COALESCE((SELECT SUM(received_quantity * price_of_purchase) FROM purchase_orders $where),0) AS sub_total_purchases,(product_id) AS purchaseProductId,(given_discount) AS purchaseDiscount, created_at, (tax_on_product) AS purchaseTax  FROM purchase_orders $where) AS purchase_orders ON product.id = purchaseProductId WHERE subcategory.id = $subcategory    
    ";

    $result = $mysqli->query($sql) or die($mysqli->error);
    $row = $result->fetch_assoc();

    // Query for subcategory name, if there isn't any result from above.
    $sql_subcat = "SELECT subcategory.name AS 'subCategoryName',subcategory.name_ar AS 'subCategoryNameAr' FROM subcategory WHERE id = $subcategory";
    $result_subcat = $mysqli->query($sql_subcat) or die($mysqli->error);
    $row_subcat = $result_subcat->fetch_assoc();

    ////// Total Sales ////
    $sub_total_sales = $row['sub_total_sales'];
    $discount= ($row['saleDiscount'] / 100) * $sub_total_sales;
    $tax = ($row['saleTax'] / 100) * $sub_total_sales;   
    $total_sales = ($sub_total_sales - $discount) + $tax;

    /////// Total Purchase ////
    $sub_total_purchases = $row['sub_total_purchases'];
    $discount= ($row['purchaseDiscount'] / 100) * $sub_total_purchases;
    $tax = ($row['purchaseTax'] / 100) * $sub_total_purchases;
    $total_purchases = ($sub_total_purchases - $discount) + $tax;


    // Profit
    $profit = number_format($total_sales - $total_purchases);
    $name_sub =checkProductsNames($row_subcat['subCategoryName'],$row_subcat['subCategoryNameAr']);
    
   // Company Name //    
   if($_SESSION["language"] == "ar_EG"){
    $invoice->set("company", [
      (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . "/azora/layout/images/Company_logo.png", 
      "Azora", 
      "Haddah Str, Sanaa - Yemen",
      "https://azora.tech",
      "من تاريخ : $from_date",
      "إلى : $to_date",
    ]);
  } else {
    $invoice->set("company", [
      (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . "/azora/layout/images/Company_logo.png", 
      "Azora", 
      "Haddah Str, Sanaa - Yemen",
      "https://azora.tech",
      "From : $from_date",
      "To : $to_date",
    ]);

  }

    // 2E - ITEMS 
      $items = [
        [$name_sub,number_format($total_sales), $profit],
      ];
      foreach ($items as $i) { $invoice->add("items", $i); }                 

      // $invoice->set("notes", [	
      //   "Get a 10% off with the next purchase with discount code DOGE1234!"
      // ]);


      /* [STEP 3 - OUTPUT] */
      // 3A - CHOOSE TEMPLATE, DEFAULTS TO SIMPLE IF NOT SPECIFIED
      $invoice->template("category");

      /*****************************************************************************/
      // 3B - OUTPUT IN HTML
      // DEFAULT DISPLAY IN BROWSER | 1 DISPLAY IN BROWSER | 2 FORCE DOWNLOAD | 3 SAVE ON SERVER
      // $invoice->outputHTML();
      // $invoice->outputHTML(1);
      // $invoice->outputHTML(2, "invoice.html");
      /*****************************************************************************/
      // 3C - PDF OUTPUT
      // DEFAULT DISPLAY IN BROWSER | 1 DISPLAY IN BROWSER | 2 FORCE DOWNLOAD | 3 SAVE ON SERVER
      $invoice->outputPDF();
      // $invoice->outputPDF(1);
      // $invoice->outputPDF(2, "invoice.pdf");
      /*****************************************************************************/

  } else {
    echo "silence is gold.";
  }
?>