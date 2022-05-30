<?php

  session_start();

  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
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
    $from_date = $_REQUEST['from_debt']; 
    $to_date = $_REQUEST['to_debt'];
    $today = date('Y-m-d');

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
    $customer = $_REQUEST["customer"];
    $where ="where date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date')";

    $whereS ="where date_format(sale.created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(sale.created_at, '%Y-%m-%d') <= ('$to_date')";

    $whereR ="where date_format(refund.created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(refund.created_at, '%Y-%m-%d') <= ('$to_date')";


    // Style for rows  for HTML//
    ?>
<style>
.red1 {
    color: #03a9f4;

    /* color: #f0ad4e; */
}

.red2 {
    color: #3f51b5;
    /* color: #c73307; */
}

.red3 {
    color: #ff0000;
}

.t-paddig {
    padding: 1.8rem;
    height: 100%
}
</style>
<?php 
  $sql= "SELECT 'Opening Balance' as saleId,balance AS saleTotal,null AS salePaid ,null  AS saleCreated,'--' as Type_of_Transaction,1 as ordering  
    FROM customer where id = $customer  
             union   SELECT *
             FROM(
            SELECT id AS saleId, total AS saleTotal, 
            paid AS salePaid,date_format(created_at, '%Y-%m-%d') AS saleCreated,'Sale' as Type_of_Transaction ,2 as ordering FROM sale  
          $where  AND customer_id = $customer 
          Union
       SELECT sale_id AS saleId, total AS saleTotal,  
        paid AS salePaid,date_format(created_at, '%Y-%m-%d') AS saleCreated,'Refund' as Type_of_Transaction,3 as ordering  FROM refund 
        $where  AND customer_id = $customer 
        order by saleId DESC,ordering ASC
        ) as test
          Union          
            (SELECT '-' as saleId,0 as saleTotal,payment,date_format(created_at, '%Y-%m-%d'),'--' as Type_of_Transaction,4 as ordering 
             FROM debt $where AND client_id = $customer)               
    ";
  
    $result = $mysqli->query($sql) or die($mysqli->error);
     $total_unpaid=0;
     $total_paid=0;
  $red1 = date('Y-m-d', strtotime($today. '-30 days'));
      $red2 = date('Y-m-d', strtotime($today. '-60 days'));
    
    while($row = $result->fetch_assoc()) {     
      $sale_id = $row['saleId'];
      $sale_date = $row['saleCreated'];
      $sale_total = $row['saleTotal'];
      $sale_paid = $row['salePaid'];
      $type=$row['Type_of_Transaction'];
      // $status = $row['debtStatus'];         
      //$total_paid = $row['allPaid']; 
      $debt = $sale_total - $sale_paid;                 
      $total_unpaid=($type=='Refund'?$total_unpaid-$debt:$total_unpaid+$debt) ;

      if ($debt == 0 ){
        if($_SESSION["language"] == "ar_EG"){
          $status = "مسدد";
          }
          else{
            $status = "paid";
          }
      } else {
        if($_SESSION["language"] != "ar_EG"){
          $status = "Loan";
        }
        else{
          $status = "غير مسدد";
  
        }
      }
      if($sale_id=='-'){
        $total_paid = $row['salePaid'] ;
        if($_SESSION["language"] == "ar_EG"){
          $status = "تسديد دين";
        }
        else{
        $status = "Paid Debt";
        }
        $debt="--";
  
      }
     
      if($sale_id=='Opening Balance'){
        if($_SESSION["language"] == "ar_EG"){
          $sale_id="الرصيد الافتتاحي";
        }
        $status = "-";
        $debt="--";
        $sale_date="--";
        $sale_paid="--";
        
      }
      // Coloring rows //
      

      if(is_numeric($sale_id)){
       // echo"yes";
      if ($sale_date === $today){
        $colorClass = "white !important";
      }
     
      else if  (($sale_date < $today) && ($sale_date >= $red1)){
        $colorClass = "red1";
      }
      else if  (( $red1 > $sale_date ) && ($sale_date > $red2)){
        $colorClass = "red2";
      }
      else  ($sale_date < $red2){
        $colorClass = "red3"
      };

      // Color rows if they are paid //
      if ($sale_paid == $sale_total){
        $colorClass = "white !important";
      }
    }
    else{
     // echo"no";
      $colorClass = "white";
    }

      // 2E - ITEMS //
      $items = [
        ['<div class="t-paddig ' .$colorClass. '" >'.$sale_id.'</div>', 
        '<div class="t-paddig ' .$colorClass. '">'.$sale_date.'</div>',
        '<div class="t-paddig ' .$colorClass. '">'.$sale_total.'</div>',
        '<div class="t-paddig ' .$colorClass. '">'.$sale_paid.'</div>',
        '<div class="t-paddig ' .$colorClass. '">'.$debt.'</div>',
        '<div class="t-paddig ' .$colorClass. '">'.$status.'</div>',
        '<div class="t-paddig ' .$colorClass. '">'.$type.'</div>'
       ],
      ];
      foreach ($items as $i) { $invoice->add("items", $i); }   

    } 
    // Closing While. //
   

    // Query for calling customer details, instead of blank page //
    $sql_customer = "SELECT fname AS CustomerFname, lname AS CustomerLname,phone AS customerPhone, email AS customerEmail, address AS customerAddress 
    FROM customer WHERE customer.id = $customer";
    $result_customer = $mysqli->query($sql_customer) or die($mysqli->error);
    if ($row_customer = $result_customer->fetch_assoc()) {

      // Customer Details //
      $fname = $row_customer['CustomerFname'];
      $lname = $row_customer['CustomerLname'];
      $customerName = $fname . ' '. $lname;
      $phone = $row_customer['customerPhone'];
      $email = $row_customer['customerEmail'];
      $location = $row_customer['customerAddress'];
     
      
      //  Custmoer Name //
      $invoice->set("billto", [
        $customerName
      ]);

      // 2D - Customer Detials //
      $invoice->set("shipto", [
        $phone,
        $email, 
        $location
      ]);
      

      if($_SESSION["language"] == "ar_EG"){
        $invoice->set("invoice", [
          ["مسدد", number_format($total_paid),],
          ["- - - - - - - - - -", ""],
          ["غير مسدد", number_format($total_unpaid)],
        ]);
      } else {
        $invoice->set("invoice", [
          ["Paid", $total_paid,],
          ["- - - - - - - - - -", ""],
          ["Unpaid", $total_unpaid],
        ]);
      }
     

    }

    // $invoice->set("notes", [	
    //   ""
    // ]);

    

    /* [STEP 3 - OUTPUT] */
    // 3A - CHOOSE TEMPLATE, DEFAULTS TO SIMPLE IF NOT SPECIFIED
    $invoice->template("customer");

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

  } else {
    echo "silence is gold.";
  }
?>