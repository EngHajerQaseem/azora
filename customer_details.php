<?php
//session_start();
include("includes/template/header.php");
include("includes/template/functions.php");
include("connect.php");
include('pagination.php');

$id = $_GET['id'];

$query = "SELECT * from customer where id='" . $id . "' ";
$result = mysqli_query($mysqli, $query) or die(mysqli_error());
$row = mysqli_fetch_assoc($result);


// $userPicture = !empty($row['local_image_path']) ? $row['local_image_path'] : 'no-image.png';
// $userPictureURL = 'upload/' . $userPicture;
//$userPicture = !empty($row['server_image_path'])?'upload/'.$row['server_image_path']:'layout/images/user.png';
$userPictureURL = checkImages($row['server_image_path']);;

$fname = $row['fname'];
$lname = $row['lname'];
$fullName = $fname . "&nbsp;" . $lname;

// if (isset($_GET['id']) && $_GET['id'] == 1) {
//   $sql = "SELECT * from customer where id='" . $id . "'";
//   mysqli_query($mysqli, $sql) or die(mysqli_error());
// }
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="customers.php"><?php echo _("customer_details_customers"); ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo _("customer_details_customers_details"); ?>
        </li>
    </ol>
</nav>
<div class="profile-wrapper">

    <div class="">
        <div class="details-content full_width">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="main-details">
                        <h2><?php echo _("customer_details_basic_information"); ?></h2>
                        <div class="row">
                            <div class="col-lg-4 col-md-12 d-flex justify-content-center">
                                <div class="proImg profile_image">
                                    <img src="<?php echo $userPictureURL; ?>" />
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <div class="user-details">
                                    <ul>
                                        <li><span><i class="fas fa-user"></i>
                                                <?php //echo _("customer_details_full_name"); ?></span><?php echo $fullName; ?>
                                        </li>
                                        <li><span><i class="fas fa-phone-alt"></i>
                                                <?php //echo _("customer_details_phone_number"); ?>
                                            </span><?php echo $row['phone']; ?></li>
                                        <?php if(!empty($row['email'])) {?>
                                        <li><span><i class="fas fa-envelope"></i>

                                            </span><?php echo $row['email']; ?></li>
                                        <?php } ?>

                                        <?php if(!empty($row['address'])) {?>
                                        <li><span><i class="fas fa-building"></i>
                                                <?php //echo _("customer_details_address"); ?>
                                            </span><?php echo $row['address']; ?></li>
                                        <?php } ?>


                                        <li><span><i class="fas fa-dollar-sign"></i>

                                            </span><?php echo $row['balance']; ?></li>

                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="debt">
                        <h2><?php echo _("supplier_details_Debt_information");?></h2>
                        <?php 
                 // SQL query  get the debt//
                      $debtSql="SELECT  SUM(payment) AS debt              
                      FROM debt     
                      where  client_id = $id ";
                      $debtResult = $mysqli->query($debtSql) or die($mysqli->error);
                      $debt_customer = $debtResult->fetch_assoc();


                   // SQL query //
                      $sql= "SELECT  SUM(sale.paid) AS allPaid , SUM(sale.total) as allTotal,SUM(refund.total) as refundTotal , SUM(refund.paid) as refundPaid,customer.balance as balance
                     
                      FROM sale
                      INNER JOIN customer ON customer.id = sale.customer_id
                      LEFT JOIN refund ON refund.sale_id = sale.id       
                      WHERE
                       sale.customer_id = $id 
                  ";

                  $result = $mysqli->query($sql) or die($mysqli->error);
                 

                  while($row = $result->fetch_assoc()) {

                 
                
                  // $sale_total = $row['allTotal'];       
                  // $total_paid = $row['allPaid'];     
                  // $total_unpaid = $row['allTotal'] - $row['allPaid'];


                    //    $total_paid = $row['allPaid'] +$debt_customer['debt'];     
                    //    $total_unpaid = $row['allTotal']-$total_paid ;


                          $totalRefund=$row['refundTotal']-$row['refundPaid'];
                          
                          $total_debt =$row['balance']+$row['allTotal']- $row['allPaid']-$totalRefund;

                         

                          $total_paid = $debt_customer['debt'];   

                         $total_unpaid =$total_debt-$total_paid;
                         
                        //  -$row['refundTotal']+ $row['allTotal']- $row['allPaid']-$total_paid ;
                        

                  }

                 

                     
                     
               
                  
               
                ?>

                        <div class="customer-payment">
                            <p class=""><span><i class="fa fa-money-bill-wave"></i>
                                    <?php echo _("customer_details_total_debt"); ?></span><?php echo number_format($total_debt) ; ?>
                            </p>
                            <p><span><i class="fa fa-money-bill-wave"></i>
                                    <?php echo _("customer_details_total_paid"); ?></span><?php echo  number_format($total_paid) ; ?>
                            </p>
                            <p class="paid"><span><i class="fa fa-money-bill-wave"></i>
                                    <?php echo _("customer_details_not_paid"); ?></span><?php echo number_format($total_unpaid) ; ?>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#sales" role="tab" aria-controls="home"
                    aria-selected="true"><?php echo _("customer_details_sales_history"); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#debts" role="tab" aria-controls="profile"
                    aria-selected="false"><?php echo _("customer_details_paid_debts"); ?></a>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="sales" role="tabpanel" aria-labelledby="home-tab">

                <div class="supplier_sales full_width">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="customer-wrapper">
                                <div class="loading-overlay">
                                    <div class="overlay-content"><?php echo _("customers_loading"); ?></div>
                                </div>
                                <div id="customers_content">
                                    <?php 
           // pagination 
           $limit =10;

           //get number of rows
           $queryNum = $mysqli->query("SELECT COUNT(sale.id) as customerNum , COUNT(refund.id) as refundNum FROM sale LEFT JOIN refund ON sale.id = refund.sale_id  WHERE sale.customer_id = " . $id . "
           ORDER BY sale.id DESC");
           $resultNum = $queryNum->fetch_assoc();
           $rowCount = $resultNum['customerNum']+$resultNum['refundNum'];
           
           //initialize pagination class
           $pagConfig = array(
               'totalRows' => $rowCount,
               'perPage' => $limit,
               'link_func' => 'searchFilter'
           );
           $pagination =  new Pagination($pagConfig);

           // Count Rows and number them
          $counter = 0;
             $salesQuery = $mysqli->query("(SELECT sale.id AS 'Invoice_No', date(sale.created_at) AS 'date', sale.total AS 'total', sale.paid AS 'paid' ,'Sale' as Type_of_Transaction
                                       FROM sale 
                                       WHERE sale.customer_id = " . $id . ")
                                       union
                                       (
                                        SELECT refund.sale_id AS 'Invoice_No', date(refund.created_at) AS 'date', refund.total AS 'total', refund.paid AS 'paid'
                                        ,'Refund' as Type_of_Transaction 
                                        FROM refund 
                                        WHERE refund.customer_id = " . $id . " 
                                       )
                                       ORDER BY Invoice_No DESC
                                       LIMIT $limit
                                       ");
                                      
                                    

             if ($salesQuery->num_rows > 0) { ?>
                                    <div class="table-responsive">
                                        <table class="table table-hover ">
                                            <thead>
                                                <tr>
                                                    <input type="hidden" id="customerId" value="<?php echo $id ;?>" />
                                                    <th style="width:10em" scope="col">
                                                        <?php echo _("customer_details_invoice"); ?></th>
                                                    <th style="width:10em" scope="col">
                                                        <?php echo _("customer_details_date"); ?>
                                                    </th>
                                                    <th style="width:10em" scope="col">
                                                        <?php echo _("customer_details_total"); ?></th>
                                                    <th style="width:10em" scope="col">
                                                        <?php echo _("customer_details_paid"); ?>
                                                    </th>

                                                    <th style="width:10em" scope="col">
                                                        <?php echo _("customer_details_status"); ?></th>
                                                    <th style="width:10em" scope="col">
                                                        <?php echo _("customer_details_Type_Of_Transaction"); ?>
                                                    </th>
                                                    <th style="width:10em" scope="col"></th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
             
                while ($saleRow = $salesQuery->fetch_assoc()) {
              ?>
                                                <tr style="cursor: pointer;"
                                                    onclick="window.location='sale_bill.php?id=<?php echo $saleRow['Invoice_No'].'&trans='.$saleRow['Type_of_Transaction'];?>'">
                                                    <td><?php echo $saleRow['Invoice_No'] ?></td>
                                                    <td><?php echo $saleRow['date'] ?></td>
                                                    <td><?php echo $saleRow['total'] ?></td>
                                                    <td><?php echo $saleRow['paid'] ?></td>
                                                    <td><?php echo $saleRow['total'] <= $saleRow['paid'] ? _("customer_details_paid") : _("customer_details_loan")  ?>
                                                    </td>
                                                    <td><?php echo $saleRow['Type_of_Transaction']==="Sale"?  _("customer_details_sale_transaction") :  _("customer_details_refund_transaction") ;?>
                                                    </td>
                                                    <td><a class="create-new-btn btn main-btn"
                                                            href="sale_bill.php?id=<?php echo $saleRow['Invoice_No'].'&trans='.$saleRow['Type_of_Transaction'];?>"><?php echo _("customer_details_view_invoice"); ?></a>
                                                    </td>
                                                </tr>
                                                <?php 
              }
               ?>

                                            </tbody>
                                        </table>

                                        <?php echo $pagination->createLinks(); ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>





                </div>
            </div>
            <div class="tab-pane fade" id="debts" role="tabpanel" aria-labelledby="profile-tab">

                <div class="payment-details full_width">

                    <div class="row">
                        <div class="col-md-12">

                            <div class="customer-wrapper">
                                <div class="loading-overlay">
                                    <div class="overlay-content"><?php echo _("customers_loading"); ?></div>
                                </div>
                                <div id="customers_debts">
                                    <?php 
   // pagination 
   $limit = 10;

   //get number of rows
   $queryNum = $mysqli->query("SELECT COUNT(id) as customerNum FROM debt  WHERE client_id = " . $id . "
   ");
   $resultNum = $queryNum->fetch_assoc();
   $rowCount = $resultNum['customerNum'];

   //initialize pagination class
   $pagConfig = array(
       'totalRows' => $rowCount,
       'perPage' => $limit,
       'link_func' => 'searchFilterDebts'
   );
   $pagination =  new Pagination($pagConfig);

   // Count Rows and number them
  $counter = 0;
    //  $salesQuery = $mysqli->query("SELECT sale.id AS 'Invoice.No', date(sale.created_at) AS 'date', sale.total AS 'total', sale.paid AS 'paid' 
    //                            FROM sale 
    //                            WHERE sale.customer_id = " . $id . "
    //                            ORDER BY sale.id ASC
    //                            LIMIT $limit
    //                            ");

                               $salesQuery = $mysqli->query("SELECT date(created_at) AS 'date',  payment AS 'paid' 
                               FROM debt 
                               WHERE client_id = " . $id . "
                               ORDER BY id ASC
                               LIMIT $limit
                               ");

     if ($salesQuery->num_rows > 0) { ?>
                                    <div class="table-responsive">
                                        <table class="table table-hover ">
                                            <thead>
                                                <tr>
                                                    <input type="hidden" id="customerId" value="<?php echo $id ;?>" />
                                                    <!-- <th style="width:10em" scope="col">
                                        <?php echo _("customer_details_invoice"); ?></th> -->
                                                    <th style="width:10em" scope="col">
                                                        <?php echo _("customer_details_date"); ?>
                                                    </th>
                                                    <!-- <th style="width:10em" scope="col">
                                        <?php echo _("customer_details_total"); ?></th> -->
                                                    <th style="width:10em" scope="col">
                                                        <?php echo _("customer_details_paid"); ?>
                                                    </th>
                                                    <!-- <th style="width:10em" scope="col">
                                        <?php echo _("customer_details_status"); ?></th>
                                    <th style="width:10em" scope="col"></th> -->

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
     
        while ($saleRow = $salesQuery->fetch_assoc()) {
      ?>
                                                <tr>
                                                    <!-- <td><?php echo $saleRow['Invoice.No'] ?></td> -->
                                                    <td><?php echo $saleRow['date'] ?></td>
                                                    <!-- <td><?php echo $saleRow['total'] ?></td> -->
                                                    <td><?php echo $saleRow['paid'] ?></td>
                                                    <!-- <td><?php echo $saleRow['total'] <= $saleRow['paid'] ? _("customer_details_paid") : _("customer_details_loan")  ?>
                                    </td>
                                    <td><a class="create-new-btn btn main-btn"
                                            href="sale_bill.php?id=<?php echo $saleRow["Invoice.No"] ?>"><?php echo _("customer_details_view_invoice"); ?></a>
                                    </td> -->
                                                </tr>
                                                <?php 
      }
       ?>

                                            </tbody>
                                        </table>

                                        <?php echo $pagination->createLinks(); ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>





        </div>

    </div>

    <script>
    function searchFilter(page_num) {
        page_num = page_num ? page_num : 0;
        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        var customerId = $('#customerId').val();

        $.ajax({
            type: 'POST',
            url: 'customer_details_search.php',
            data: 'page=' + page_num + '&keywords=' + keywords + '&sortBy=' + sortBy + '&customerId=' +
                customerId,
            beforeSend: function() {
                $('.loading-overlay').show();
            },
            success: function(html) {
                $('#customers_content').html(html);
                $('.loading-overlay').fadeOut("slow");
            }
        });
    }

    function searchFilterDebts(page_num) {
        page_num = page_num ? page_num : 0;
        var keywords = $('#keywords').val();
        var sortBy = $('#sortBy').val();
        var customerId = $('#customerId').val();

        $.ajax({
            type: 'POST',
            url: 'customer_details_debts_search.php',
            data: 'page=' + page_num + '&keywords=' + keywords + '&sortBy=' + sortBy + '&customerId=' +
                customerId,
            beforeSend: function() {
                $('.loading-overlay').show();
            },
            success: function(html) {
                $('#customers_debts').html(html);
                $('.loading-overlay').fadeOut("slow");
            }
        });
    }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <?php include("includes/template/footer.php"); ?>