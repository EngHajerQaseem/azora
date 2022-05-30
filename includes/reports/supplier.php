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
    $from_date = $_REQUEST['from_sup']; 
    $to_date = $_REQUEST['to_sup'];
    $today = date('Y-m-d');

    if (empty($from_date)) {
      $from_date = '2019-01-01';
    }   
    if (empty($to_date)) {
      $to_date = date('Y-m-d');
    }
    ?>
<!-- Style for rows  for HTML// -->

<style>
.red1 {
    color: #f0ad4e;
}

.red2 {
    color: #c73307;
}

.red3 {
    color: #ff0000;
}

.t-paddig {
    padding: 1rem;

}
</style>

<?php
    
    $where = "AND purchase.delivery_date >= ('$from_date') AND purchase.delivery_date <= ('$to_date') AND (purchase.purchase_status_id=4 or purchase.purchase_status_id=5 or purchase.purchase_status_id=6)";

    $whereS = "AND created_at >= ('$from_date') AND created_at <= ('$to_date')";

    
    

    
    // Get Id of supplier //
    $supplier = $_REQUEST["supplier"];
    // $sql = "SELECT *,CONCAT(suppliers.fname, ' ',suppliers.lname) AS 'name' ,suppliers.phone as 'phone', purchase.delivery_date AS purchaseDate, purchase.total AS purchaseTotal, purchase.paid AS purchasePaid
    // FROM suppliers
    // INNER JOIN purchase ON suppliers.id = purchase.supplier_id
    // WHERE suppliers.id = $supplier $where
    // ";    

    






    $sql= "
    (SELECT 'Opening Balance' as purchaseId,balance AS purchaseTotal,0 AS purchasePaid,replace(null,null,'-') AS delivery_date   
    FROM suppliers  where id = $supplier )
     union
   SELECT id AS purchaseId, total AS purchaseTotal, 
             paid AS purchasePaid,date_format(delivery_date, '%Y-%m-%d') AS delivery_date FROM purchase  where id!=0 and supplier_id=$supplier $where
          Union          
          (SELECT '-',null as purchaseTotal,payment,date_format(created_at, '%Y-%m-%d')
           FROM debt_su  
           where id!=0 and client_id=$supplier $whereS) 
          ";

     

    $result = $mysqli->query($sql) or die($mysqli->error);

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

 $total_paid=0;
 $total_unpaid=0;
    while ($row = $result->fetch_assoc()) {
      // $purchase_date = $row['purchaseDate'];
      // $purchase_total = $row['purchaseTotal'];
      // $purchase_debit = $purchase_total - $row['purchasePaid'];
      // $purchase_paid = $row['purchasePaid'];
      // ////// sum debit
      // $total_debit += $purchase_debit;
      //$total_paid += $purchase_paid;
      // $total_paid  = $debt_supplier['debt'];
      // $total_unpaid=$total_debit-$debt_supplier['debt'];



     
          $purchase_id = $row['purchaseId'];
          $purchase_date = $row['delivery_date'];
          $purchase_total = $row['purchaseTotal'];
          $purchase_paid = $row['purchasePaid'];
          $purchase_debet = $purchase_total - $purchase_paid;
          $total_unpaid+=$purchase_debet;
          // $total_debt=$row['totalDebt'] ;

          if ($purchase_debet == 0 ){
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
      if($purchase_id=='-'){
        $total_paid +=$purchase_paid; 
        if($_SESSION["language"] == "ar_EG"){
          $status = "تسديد دين";
        }
        else{
        $status = "Paid Debt";
        }
        $purchase_debet="--";
        $purchase_total="--";


      }
      if($purchase_id=='Opening Balance'){
        if($_SESSION["language"] == "ar_EG"){
          $purchase_id="الرصيد الافتتاحي";
        }
        $status = "-";
        $purchase_debet="--";
        $purchase_date="--";
        
      }   
        
      $red1 = date('Y-m-d', strtotime($today. '-30 days'));
      $red2 = date('Y-m-d', strtotime($today. '-60 days'));
      if(is_numeric($purchase_id)){
      if ($purchase_date === $today){
        $colorClass = "white !important";
      }
      else if  (($purchase_date < $today) && ($purchase_date >= $red1)){
        $colorClass = "red1";
      }
      else if  (( $red1 > $purchase_date ) && ($purchase_date > $red2)){
        $colorClass = "red2";
      }
      else  ($purchase_date < $red2){
        $colorClass = "red3"
      };

      // //Color rows if they are paid //
      if ($purchase_paid == $purchase_total){
        $colorClass = "white !important";
      }
    }
    else{
      // echo"no";
       $colorClass = "white";
     }
      $items = [
        ['<div class="t-paddig ' .$colorClass. '" >'.$purchase_id.'</div>',
        '<div class="t-paddig ' .$colorClass. '" >'.$purchase_date.'</div>', 
        '<div class="t-paddig ' .$colorClass. '">'.$purchase_total.'</div>',
        '<div class="t-paddig ' .$colorClass. '">'.$purchase_paid.'</div>',
        '<div class="t-paddig ' .$colorClass. '">'.$purchase_debet.'</div>',
        '<div class="t-paddig ' .$colorClass. '">'.$status.'</div>',
       ],
       
      ];
      foreach ($items as $i) { $invoice->add("items", $i); }     

    }
    
    //TOTALS
    if($_SESSION["language"] == "ar_EG"){
      $invoice->set("totals", [
        // ["الإجمالي", $total_debit],
        ["المسدد", $total_paid,],
        ["- - - - - - - - - -", ""],
        ["غير مسدد", $total_unpaid],
      ]);
    } else {
      $invoice->set("totals", [
        // ["TOTAL", $total_debit],
        ["Paid", $total_paid,],
        ["- - - - - - - - - -", ""],
        ["Unpaid", $total_unpaid],
      ]);
    }


    
    // Query for calling customer details, instead of blank page //
    $sql_customer = "SELECT fname AS supplierFname, lname AS supplierLname,phone AS supplierPhone, email AS supplierEmail, address AS supplierAddress 
    FROM suppliers WHERE id = $supplier";
    $result_supplier = $mysqli->query($sql_customer) or die($mysqli->error);
    if ($row_supplier = $result_supplier->fetch_assoc()) {

      // Customer Details //
      $fname = $row_supplier['supplierFname'];
      $lname = $row_supplier['supplierLname'];
      $supplier_name = $fname . ' '. $lname;
      $supplier_phone = $row_supplier['supplierPhone'];
      $email = $row_supplier['supplierEmail'];
      $location = $row_supplier['supplierAddress'];
      // if (!isset($total_paid)){
      //   $total_paid = 0;
      // }
      // if (!isset($total_unpaid)){
      //   $total_unpaid = 0;
      // }
    }
      
     
    // Supplier info 
    $invoice->set("billto", [
              [
              $supplier_name,
              $supplier_phone
              ]
            ]);


    // $invoice->set("notes", [	
    //   "Get a 10% off with the next purchase with discount code DOGE1234!"
    // ]);


    /* [STEP 3 - OUTPUT] */
    // 3A - CHOOSE TEMPLATE, DEFAULTS TO SIMPLE IF NOT SPECIFIED
    $invoice->template("supplier");

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