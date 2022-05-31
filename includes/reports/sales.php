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
     $user_id=$_REQUEST['users'];

    $username=$_REQUEST['users']; 
     
     if(empty($username)){
      $where="";
     }
     else{
      $where="AND purchase.user_id=".$username;
     }

    // From and To // 
    $from_date = $_REQUEST['from_sales']; 
    $to_date = $_REQUEST['to_sales'];
    $where ="";

    if (empty($from_date)) {
      $from_date = '2019-01-01';
    }   
    if (empty($to_date)) {
      $to_date = date('Y-m-d');
    }
    if (empty($from_date) && empty($to_date) ) {
      $where = "";
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
    
    
    $where = "where created_at>= ('$from_date') AND created_at<= ('$to_date')"; 
    if (!empty($user_id)) {
            $where .=" and user_id=$user_id";
          }
          if(empty($_REQUEST['typeOf'])){
    $sql= "SELECT *,1 as appear   FROM
    (SELECT id as saleId,created_at AS saleDate,customer_id,user_id,'' FROM sale $where) AS sale
      INNER JOIN
    (SELECT id, price pro_price,quantity qty, product_id,sale_id,service_id FROM sale_orders  where  !(service_id=0 and product_id=0  )  ) AS sale_orders ON sale.saleId= sale_orders.sale_id
      LEFT JOIN
    (SELECT id,fname AS fname, lname AS lname FROM customer) AS customer ON sale.customer_id = customer.id
      left JOIN
    (SELECT id,product.name as ProductName,product.name_ar as ProductNameAr FROM product) AS product ON product.id = sale_orders.product_id 
    left JOIN (SELECT id,services.name as ServiceName,services.name_ar as serviceNameAr FROM services) AS services ON services.id = sale_orders.service_id   
       left join (select id,user.full_name from user )as user on sale.user_id=user.id
       where saleId!=0
       union
       SELECT *,2 as appear FROM
    (SELECT sale_id as saleId ,created_at AS saleDate,customer_id,user_id,id FROM refund $where) AS refund
      INNER JOIN
    (SELECT id, price pro_price,quantity qty, product_id,refund_id,-3 as service_id FROM refund_orders ) AS refund_orders ON refund.id = refund_orders.refund_id
      LEFT JOIN
    (SELECT id,fname AS fname, lname AS lname FROM customer) AS customer ON refund.customer_id = customer.id
      left JOIN
    (SELECT id,product.name as ProductName,product.name_ar as ProductNameAr,'' as ServiceName,'' as serviceNameAr,'' as serviceId FROM product) AS product ON product.id = refund_orders.product_id 
  
       left join (select id,user.full_name from user )as user on refund.user_id=user.id
       where saleId!=0
      ORDER BY saleId desc,appear Asc

    ";
    }
    else{
      if($_REQUEST['typeOf']=="Service"){
         $sql= "SELECT * FROM
    (SELECT id as saleId ,created_at AS saleDate,customer_id,user_id FROM sale $where) AS sale
      INNER JOIN
    (SELECT id, price pro_price,quantity qty, product_id,sale_id,service_id FROM sale_orders ) AS sale_orders ON sale.saleId = sale_orders.sale_id
      LEFT JOIN
    (SELECT id,fname AS fname, lname AS lname FROM customer) AS customer ON sale.customer_id = customer.id
    left JOIN (SELECT id,services.name as ServiceName,services.name_ar as serviceNameAr FROM services) AS services ON services.id = sale_orders.service_id   
       left join (select id,user.full_name from user )as user on sale.user_id=user.id
       where saleId!=0 and sale_orders.service_id is not null and sale_orders.service_id!=0
      ORDER BY saleId desc  
    ";
      }
      else{
           $sql= "SELECT *,1 as appear  FROM
     (SELECT id as saleId,created_at AS saleDate,customer_id,user_id,'' FROM sale $where) AS sale
      INNER JOIN
    (SELECT id, price pro_price,quantity qty, product_id,sale_id,service_id FROM sale_orders ) AS sale_orders ON sale.saleId= sale_orders.sale_id
      LEFT JOIN
    (SELECT id,fname AS fname, lname AS lname FROM customer) AS customer ON sale.customer_id = customer.id
      left JOIN
    (SELECT id,product.name as ProductName,product.name_ar as ProductNameAr FROM product) AS product ON product.id = sale_orders.product_id 
       left join (select id,user.full_name from user )as user on sale.user_id=user.id
       where  saleId!=0 and sale_orders.product_id is not null and sale_orders.product_id!=0
      union
      SELECT * ,2 as appear
      FROM 
      (SELECT sale_id as saleId ,created_at AS saleDate,customer_id,user_id,id FROM refund $where) AS refund
      INNER JOIN
    (SELECT id, price pro_price,quantity qty, product_id,refund_id,-3 as service_id FROM refund_orders ) AS refund_orders ON refund.id = refund_orders.refund_id
      LEFT JOIN
    (SELECT id,fname AS fname, lname AS lname FROM customer) AS customer ON refund.customer_id = customer.id
      left JOIN
    (SELECT id,product.name as ProductName,product.name_ar as ProductNameAr FROM product) AS product ON product.id = refund_orders.product_id 
       left join (select id,user.full_name from user )as user on refund.user_id=user.id
     where  saleId!=0 
      ORDER BY saleId desc,appear ASC
    ";
      }
    }
    $result = $mysqli->query($sql) or die($mysqli->error);
  
    

    while ($row = $result->fetch_assoc()) {

      // Table variables
      $refrence_no = $row['saleId'];
      $customer = $row['fname'].' '.$row['lname'];
      $opTYpe="";
      if($row["service_id"]==-3){
        $product_name =  checkProductsNames($row['ProductName'],$row['ProductNameAr']);
        $opTYpe="PR";
      }
      else if($row["service_id"]!=null and $row["service_id"]!=0){
      $product_name =  checkProductsNames($row['ServiceName'],$row['serviceNameAr']);
       $opTYpe="S"; 
      }
      else{
       $product_name =  checkProductsNames($row['ProductName'],$row['ProductNameAr']);
    
      $opTYpe="P";
       }
      //$warehouse = $row['warehouseName'];
      $date = $row['saleDate'];
      // $total_tax = $row['saleTotalTax'];
      // $total_discount = $row['saleTotalDiscount'];
      $product_total = $row['qty'] * $row['pro_price'];
      // $sub_total = $row['sumSubTotal'];
      // $sub_total_decimal = number_format((float)$sub_total, 2, '.', '');
      // $total = $row['saleTotal'];
      $user_name=$row['full_name'];
      // $total_decimal = number_format((float)$total, 2, '.', '');


      // Table Items
      $items = [
        [$refrence_no, $customer, $product_name,$row['pro_price'],$row['qty'], $product_total,$date,$user_name,$opTYpe],
      ];
      foreach ($items as $i) { $invoice->add("items", $i); } 
    }
    
    //TOTALS
    if(empty($_REQUEST['typeOf'])){
      $sql=" SELECT SUM(sub_total) as sum_sub_total ,SUM(discount) as sum_total_discount,SUM(total_tax) as sum_total_tax ,SUM(total) as SumTotal ,'sale' as type_of_trans
      FROM `sale`  join(select sale_id ,service_id from  sale_orders where  !(service_id=0 and product_id=0 ) ) as sale_orders on  sale_orders.sale_id=sale.id $where  and sale.id!=0
      union
      SELECT SUM(sub_total) as sum_sub_total ,SUM(discount) as sum_total_discount,SUM(total_tax) as sum_total_tax,SUM(total) as SumTotal ,'refund' as type_of_trans
      FROM `refund` $where and refund.id!=0
       ";
     }
     else {
         if($_REQUEST['typeOf']=="Service"){
           $sql=" SELECT SUM(sub_total) as sum_sub_total ,SUM(discount) as sum_total_discount,SUM(total_tax) as sum_total_tax ,SUM(total) as SumTotal ,'sale' as type_of_trans
                 FROM `sale`  join(select sale_id ,service_id from  sale_orders) as sale_orders on  sale_orders.sale_id=sale.id
                     $where and sale.id!=0 and sale_orders.service_id is not null and sale_orders.service_id!=0
                    ";
         }
         else{
           $sql=" SELECT SUM(sub_total) as sum_sub_total ,SUM(discount) as sum_total_discount,SUM(total_tax) as sum_total_tax ,SUM(total) as SumTotal ,'sale' as type_of_trans
      FROM `sale`  join(select sale_id ,product_id from  sale_orders) as sale_orders on  sale_orders.sale_id=sale.id $where and  sale.id!=0 and sale_orders.product_id is not null and sale_orders.product_id!=0
      union
      SELECT SUM(sub_total) as sum_sub_total ,SUM(discount) as sum_total_discount,SUM(total_tax) as sum_total_tax,SUM(total) as SumTotal ,'refund' as type_of_trans
      FROM `refund` $where and refund.id!=0;
       ";
         }
     }
 $result = $mysqli->query($sql) or die($mysqli->error);
 $sub_total_decimal=0;
 $total_discount=0;
 $total_tax=0;
 $total_decimal=0;
    while($row =$result->fetch_assoc()){
      if($row["type_of_trans"]=="sale"){
        $sub_total_decimal=$sub_total_decimal+$row["sum_sub_total"];
        $total_tax=$total_tax+$row["sum_total_tax"];
        $total_discount=$total_discount+$row["sum_total_discount"];
        $total_decimal=$total_decimal+$row["SumTotal"];

      }
      else{
         $sub_total_decimal=$sub_total_decimal-$row["sum_sub_total"];
        $total_tax=$total_tax-$row["sum_total_tax"];
        $total_discount=$total_discount-$row["sum_total_discount"];
        $total_decimal=$total_decimal-$row["SumTotal"];
      }
   
    }
     if($_SESSION["language"] == "ar_EG"){
      $invoice->set("totals", [
        ["الصافي", number_format($sub_total_decimal)],
        ["الخصم", number_format($total_discount)],
        ["الضريبة", number_format($total_tax)],
        ["الإجمالي", number_format($total_decimal)]
      ]);
    } else {
      $invoice->set("totals", [
        ["SUB-TOTAL", number_format($sub_total_decimal)],
        ["DISCOUNT", number_format($total_discount)],
        ["Tax", number_format($total_tax)],
        ["GRAND TOTAL", number_format($total_decimal)]
      ]);
    }

    // $invoice->set("notes", [	
    //   "Get a 10% off with the next purchase with discount code DOGE1234!"
    // ]);
       
    // 3A - CHOOSE TEMPLATE.
    $invoice->template("sales");

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