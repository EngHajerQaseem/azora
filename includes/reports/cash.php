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
    $row = mysqli_fetch_assoc($result);
    $img = !empty($row['local_image_path']) ? 'dashboard/upload/' . $row['local_image_path'] : 'dashboard/layout/images/Company_logo.png';


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
      $username="";

    if (empty($from_date)) {
      $from_date = '2019-01-01';
    }   
    if (empty($to_date)) {
      $to_date = date('Y-m-d');
    }
 if (!empty($user_id)) {
     
     $user_id=explode('|',  $user_id);
     $username=$user_id[1];
     $user_id=$user_id[0];
            $where .=" and user_id=$user_id";
          }
 
} else {
  echo "silence is gold.";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <link href="../../layout/css/report.css" rel="stylesheet">
    <?php  if($_SESSION["language"] == "ar_EG"){
    echo "<style>
    #company .right div{
    margin-right: auto !important;
    margin-left:0 !important;
    }
    </style>";
  }
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
                        <div><?php echo  $row['shopName'];?></b></div>
                        <div><?php echo  $row['address'];?></div>
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
                        <p> تقرير النقدية ".($username!=''?' '.$username:'')."</p>
                        <button class='btn main-btn print-btn' onclick=\" 
                        printS()
                         \">   طباعة التقرير </button>
                    
                        </div>";
                            

                        }else {
                              echo "<div id='bigi'><p>Cash Report ".($username!=''?' '.$username:'')."</p>
                              <button class='btn main-btn print-btn' onclick=\" 
                              printS()
                                  \">Print Report </button>
                            </div>";
                        }

                ?>

            <?php

              if( $_REQUEST['type_of_report']=="NotDetailed"){      
                    $sql ="SELECT SUM(paid) as paid, date_format(created_at, '%Y-%m-%d') created_at,\"sale\" as typeOfTrans ,saleSum.totalPaid,'' AS purchase_status_id from sale 
                                left join (SELECT id,SUM(paid) as totalPaid from sale 
                                WHERE date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date')  $where ) as saleSum on 1=1
                                WHERE date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date')  $where
                                GROUP BY date_format(created_at, '%Y-%m-%d')
                                UNION
                                SELECT SUM(payment), date_format(created_at, '%Y-%m-%d') created_at,\"SellDebt\"as typeOfTrans,totalPaid,'' AS purchase_status_id from debt
                                left join (SELECT id,SUM(payment) totalPaid from debt  WHERE date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date') $where ) as debtSum on 1=1
                                WHERE date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date')  $where
                                GROUP BY date_format(created_at, '%Y-%m-%d')
                                UNION
                                SELECT SUM(paid), date_format(created_at, '%Y-%m-%d') created_at,\"Purchase\"as typeOfTrans,totalPaid,4 AS purchase_status_id from purchase
                                left join (SELECT id,SUM(paid) totalPaid from purchase WHERE (purchase.purchase_status_id=4 or purchase.purchase_status_id=5 or purchase.purchase_status_id=6) AND date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date')  $where) as purchaseSum  on 1=1 
                                WHERE (purchase.purchase_status_id=4 or purchase.purchase_status_id=5 or purchase.purchase_status_id=6) AND date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date')  $where
                                GROUP BY date_format(created_at, '%Y-%m-%d')
                                UNION 
                                SELECT SUM(payment), date_format(created_at, '%Y-%m-%d') created_at,\"PurchaseDebt\"as typeOfTrans,totalPaid,'' AS purchase_status_id from debt_su
                                left join (SELECT id,SUM(payment) totalPaid from debt_su WHERE date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date') $where  ) as debt_suSum  on 1=1
                                WHERE date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date') $where
                                GROUP BY date_format(created_at, '%Y-%m-%d') 
                                union 
                                SELECT SUM(total),date_format(created_at, '%Y-%m-%d') created_at,\"Expense\"as typeOfTrans,totalPaid,'' AS purchase_status_id from expense  
                                left join (SELECT id,SUM(total) totalPaid from expense WHERE date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date')  $where) as expenseSum on 1=1
                                WHERE date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date')  $where
                                GROUP BY date_format(created_at, '%Y-%m-%d') 
                                union
                                SELECT SUM(paid) as paid, date_format(created_at, '%Y-%m-%d') created_at,\"refund\" as typeOfTrans ,saleSum.totalPaid,'' AS purchase_status_id from  refund
                                left join (SELECT id,SUM(paid) as totalPaid from refund 
                                WHERE date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date')  $where ) as saleSum on 1=1
                                WHERE date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date')  $where
                                GROUP BY date_format(created_at, '%Y-%m-%d')
                                order by created_at DESC";
                                             
         
                               }
         
                   else{
                                $sql ="SELECT sale.id,paid, date_format(created_at, '%Y-%m-%d') created_at,\"sale\" as typeOfTrans ,saleSum.totalPaid,user.full_name,customer.name,'' AS purchase_status_id from sale 
                                left join (SELECT id,SUM(paid) as totalPaid from sale 
                                WHERE date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date')  $where ) as saleSum on 1=1
                            left join(select id, full_name from user) as user on sale.user_id=user.id
                            left join(SELECT id,concat( fname,\" \",lname) as name FROM `customer`) as customer on sale.customer_id=customer.id
                                WHERE sale.id!=0 and date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date')  $where
                                UNION
                                SELECT debt.id,payment, date_format(created_at, '%Y-%m-%d') created_at,\"SellDebt\"as typeOfTrans,totalPaid,'____',customer.name,'' AS purchase_status_id from debt
                                left join (SELECT id,SUM(payment) totalPaid from debt  WHERE date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date') $where ) as debtSum on 1=1
                              
                                left join(SELECT id,concat( fname,\" \",lname) as name FROM `customer`) as customer on debt.client_id=customer.id
                                WHERE debt.id!=0 and date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date')  $where
                                UNION
                                SELECT purchase.id,paid, date_format(created_at, '%Y-%m-%d') created_at,\"Purchase\"as typeOfTrans,totalPaid,user.full_name,suppliers.name,purchase_status_id from purchase
                                left join (SELECT id,SUM(paid) totalPaid from purchase WHERE (purchase.purchase_status_id=4 or purchase.purchase_status_id=5 or purchase.purchase_status_id=6) AND date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date')  $where) as purchaseSum  on 1=1
                                left join(select id, full_name from user) as user on purchase.user_id=user.id
                                left join(SELECT id,concat( fname,\" \",lname) as name FROM `suppliers`) as suppliers on purchase.supplier_id=suppliers.id
                                WHERE purchase.id!=0 and (purchase.purchase_status_id=4 or purchase.purchase_status_id=5 or purchase.purchase_status_id=6) AND date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date')  $where
                                UNION 
                                SELECT debt_su.id,payment, date_format(created_at, '%Y-%m-%d') created_at,\"PurchaseDebt\"as typeOfTrans,totalPaid,'____',suppliers.name,'' AS purchase_status_id from debt_su
                                left join (SELECT id,SUM(payment) totalPaid from debt_su WHERE date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date') $where  ) as debt_suSum  on 1=1
                               
                                left join(SELECT id,concat( fname,\" \",lname) as name FROM `suppliers`) as suppliers on debt_su.client_id=suppliers.id
                                WHERE debt_su.id!=0 and date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date') $where 
                                union 
                                SELECT expense.id,total, date_format(created_at, '%Y-%m-%d') created_at,\"Expense\"as typeOfTrans,totalPaid,user.full_name,\"____\",'' AS purchase_status_id from expense  
                                left join (SELECT id,SUM(total) totalPaid from expense WHERE date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date')  $where) as expenseSum on 1=1
                                left join(select id, full_name from user) as user on expense.user_id=user.id
                                WHERE expense.id!=0 and date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date')  $where
                                union 
                                SELECT refund.id,paid, date_format(created_at, '%Y-%m-%d') created_at,\"refund\" as typeOfTrans ,saleSum.totalPaid,user.full_name,customer.name,'' AS purchase_status_id from refund 
                                left join (SELECT id,SUM(paid) as totalPaid from refund 
                                WHERE date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date')  $where ) as saleSum on 1=1
                               left join(select id, full_name from user) as user on refund.user_id=user.id
                                left join(SELECT id,concat( fname,\" \",lname) as name FROM `customer`) as customer on refund.customer_id=customer.id
                                WHERE refund.id!=0 and date_format(created_at, '%Y-%m-%d')  >= ('$from_date') AND date_format(created_at, '%Y-%m-%d') <= ('$to_date')  $where
                                order by created_at DESC";
                         }
                                  
                                        $result = $mysqli->query($sql) or die($mysqli->error);
                                         if( $_REQUEST['type_of_report']=="NotDetailed"){ 
                                             if($_SESSION["language"] == "ar_EG"){
                                        echo  "<table id='items'><tr class='t_header'><th> التاريخ</th><th> القيمة</th><th> النوع</th></tr>";
                                    } else {
                                        echo "<table id='items'><tr class='t_header'><th>Date</th><th>Value</th><th>Type</th></tr>";
                                    }
                                          }
                                         else{
                                    if($_SESSION["language"] == "ar_EG"){
                                        echo  "<table id='items'><tr class='t_header'><th> رقم المرجع</th><th> التاريخ</th>".($username==''?' <th>  اسم المستخدم</th>':'')."<th> القيمة</th><th> النوع</th><th> الاسم</th></tr>";
                                    } else {
                                        echo "<table id='items'><tr class='t_header'><th>Refrence Number</th><th>Date</th>".($username==''?' <th>  User Name</th>':'')."<th>Value</th><th>Type</th><th>Name</th></tr>";
                                    }
                                    }
                                    $saleSum=0;
                                    $debtSum=0;
                                    $purchaseSum=0;
                                    $debt_suSum=0;
                                    $expenseSum=0;
                                    $refund_sum=0;

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
                                    else if($row["typeOfTrans"]=="refund"){ 
                                    $refund_sum=$row["totalPaid"];
                                   }
                                        if($_SESSION["language"] == "ar_EG"){
                                            switch($row["typeOfTrans"]){
                                                case "SellDebt":$row["typeOfTrans"]="تسديد دين";
                                                break;
                                                case "PurchaseDebt":$row["typeOfTrans"]="تسديد شراء";
                                                break;
                                                  case "Expense":$row["typeOfTrans"]="مصروفات";
                                                break;
                                                  case "sale":$row["typeOfTrans"]="بيع";
                                                break;
                                                 case "Purchase": 
                                                    	if($row["purchase_status_id"]==5)
                                                    $row["typeOfTrans"]="ارجاع شراء";
                                                    else if($row["purchase_status_id"]==6)
                                                    $row["typeOfTrans"]="ارجاع شراء جزئي";
                                                    else $row["typeOfTrans"]="شراء";
                                                break;
                                                 case "refund":$row["typeOfTrans"]="استرجاع";
                                                break;
                                            }
                                        }else {
                                                if($row["typeOfTrans"]=="purchase"){
                                                        if($row["purchase_status_id"]==5)
                                                            $row["typeOfTrans"]="purchase refund";
                                                            else if($row["purchase_status_id"]==6)
                                                            $row["typeOfTrans"]="partial purchase refund";
                                                            
                                                }
                                         }
                                         if( $_REQUEST['type_of_report']=="NotDetailed")
                                           echo "<tr class='t_body'><td><div>".$row["created_at"]."</div>"."</td><td>".$row["paid"]."</td><td>".$row["typeOfTrans"]."</td></tr>";
                                    
                                         else
                                    echo "<tr class='t_body'><td><div>".$row["id"]."</div>"."</td><td><div>".$row["created_at"]."</div>"."</td>".($username==''?' <td> '.$row["full_name"].'</td>':'')."<td>".$row["paid"]."</td><td>".$row["typeOfTrans"]."</td> <td>".$row["name"]."</td></tr>";
                               
                            }
                                    echo "</table>";
                                             if($_SESSION["language"] == "ar_EG")
                                            echo "<div class='bottom-total'><div class='ttl'><p> المدخل:</p><p>".number_format($saleSum+$debtSum)."</p></div> <div class='ttl'><p>المخرج: </p><p>".number_format($purchaseSum+$debt_suSum+ $expenseSum+$refund_sum)."</p></div> <div class='ttl'><p> النقدية: </p><p>".number_format(($saleSum+$debtSum)-($purchaseSum+$debt_suSum+ $expenseSum+$refund_sum))."</p></div></div>";
                                             else

                                    echo "<div class='bottom-total'><div class='ttl'><p>Entered:</p><p>".number_format($saleSum+$debtSum)."</p></div> <div class='ttl'><p>Out: </p><p>".number_format($purchaseSum+$debt_suSum+ $expenseSum+$refund_sum)."</p></div> <div class='ttl'><p> Cash: </p><p>".number_format(($saleSum+$debtSum)-($purchaseSum+$debt_suSum+ $expenseSum+$refund_sum))."</p></div></div>";
                                 
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