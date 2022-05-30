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

    // From and To // 
    $from_date = $_REQUEST['from_cate']; 
    $to_date = $_REQUEST['to_cate'];
     $user_id=$_REQUEST['users'];
     $subCata=$_REQUEST['subcategory'];
       $whereP ="";
            $whereS="";
            $whereR="";

    if (empty($from_date)) {
      $from_date = '2019-01-01';
    }   
    if (empty($to_date)) {
      $to_date = date('Y-m-d');
    }
 if (!empty($user_id)) {
            $whereP .=" and purchase.user_id=$user_id";
            $whereS.=" and sale.user_id=$user_id";
            $whereR.=" and refund.user_id=$user_id";
          }

          if (!empty($subCata)) {
            $whereP .=" and product.subcategory_id=$subCata";
            $whereS.=" and product.subcategory_id=$subCata";
            $whereR.=" and product.subcategory_id=$subCata";
          
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



    // Get Id of Category //
    $category = explode('|',  $_REQUEST["category"]);
    $categoryID =$category[0];

    $whereP .=" and date_format(purchase_orders.created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(purchase_orders.created_at, '%Y-%m-%d') <= ('$to_date')";
    $whereS.= " and date_format(sale_orders.created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(sale_orders.created_at, '%Y-%m-%d') <= ('$to_date')";
    $whereR.= " and date_format(refund_orders.created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(refund_orders.created_at, '%Y-%m-%d') <= ('$to_date')";
    
     $sql= "SELECT DISTINCT inventory.product_id,product.name,product.name_ar ,sale_quantity,sale_price,purcase_quantity,purchase_price,sale_refund_quntity,sale_refund_price
    from inventory
    join product on product.id=inventory.product_id
     left JOIN
    (
    SELECT SUM(sale_orders.quantity) sale_quantity,SUM(sale_orders.price*sale_orders.quantity) sale_price,sale_orders.product_id
        from sale_orders
        left join refund_orders on sale_orders.id=refund_orders.sale_orders_id
         left JOIN sale ON sale_orders.sale_id=sale.id  
         left join product on product.id=sale_orders.product_id
          where 1 $whereS
        group by sale_orders.product_id
    ) as sale on product.id=sale.product_id
    left join
      (
    SELECT SUM(refund_orders.quantity) sale_refund_quntity,SUM(refund_orders.price*refund_orders.quantity) sale_refund_price,refund_orders.product_id
        from refund_orders
         left JOIN refund ON refund_orders.refund_id=refund.id  
         left join product on product.id=refund_orders.product_id
          where 1 $whereR
        group by refund_orders.product_id
    ) as refund on product.id=refund.product_id
    
  left  join(
    select purchase_orders.product_id,SUM(purchase_orders.received_quantity) purcase_quantity,SUM(purchase_orders.price_of_purchase*purchase_orders.received_quantity) purchase_price
        from purchase_orders  left JOIN purchase ON purchase_orders.purchase_id=purchase.id
        left join product on product.id=purchase_orders.product_id
        where (purchase.purchase_status_id=4 or purchase.purchase_status_id=5 or purchase.purchase_status_id=6) $whereP
          group by purchase_orders.product_id
    ) as purchases on product.id=purchases.product_id
    WHERE product.category_id= $categoryID";


    $result = $mysqli->query($sql) or die($mysqli->error);
    // $row = $result->fetch_assoc();

    // Profit
    while($row = $result->fetch_assoc()){
    $product_name=checkProductsNames($row['name'],$row['name_ar']);
   
    $items = [
      [$product_name,(!empty($row["purcase_quantity"])?$row["purcase_quantity"]:0),(!empty($row["purchase_price"])?$row["purchase_price"]:0),($row["sale_quantity"]-$row["sale_refund_quntity"]),($row["sale_price"]-$row["sale_refund_price"])],
    ];
    foreach ($items as $i) { $invoice->add("items", $i); }   
    }             

     $sql= "
          (
      SELECT SUM(sale_orders.quantity*sale_orders.price) total_sales,'sale' as type_of_trans
      from sale_orders
      left JOIN sale ON  sale_orders.sale_id=sale.id
      left JOIN user on sale.user_id=user.id
      left join product on product.id=sale_orders.product_id
          WHERE  product.category_id= $categoryID $whereS
          )
      UNION
      (SELECT sum(purchase_orders.received_quantity*purchase_orders.price_of_purchase) total_purchase,'purchase' as type_of_trans
      FROM `purchase_orders` 
      left JOIN purchase ON  purchase_orders.purchase_id=purchase.id
      left JOIN user on purchase.user_id=user.id
      left join product on product.id=purchase_orders.product_id
      WHERE (purchase.purchase_status_id=4 or purchase.purchase_status_id=5 or purchase.purchase_status_id=6) AND product.category_id = $categoryID $whereP)
      union
            (
      SELECT SUM(refund_orders.quantity*refund_orders.price) total_sales_refund,'refund' as type_of_trans
      from refund_orders 
      left JOIN refund ON  refund_orders.refund_id=refund.id
      left JOIN user on refund.user_id=user.id
      left join product on product.id=refund_orders.product_id
          WHERE  product.category_id= $categoryID $whereR
          ) 
          ";  
           
           $result = $mysqli->query($sql) or die($mysqli->error);
    // $row = $result->fetch_assoc();
    // Profit
    while($row = $result->fetch_assoc()){
 
      // 2E - ITEMS 
    $totals = [
      [$row["type_of_trans"],($row["total_sales"])],
    ];
    foreach ($totals as $i) { $invoice->add("totals", $i); }   
    } 

      // $invoice->set("notes", [	
      //   "Get a 10% off with the next purchase with discount code DOGE1234!"
      // ]);


      // 3A - CHOOSE TEMPLATE, DEFAULTS TO SIMPLE IF NOT SPECIFIED
      $invoice->template("category");

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