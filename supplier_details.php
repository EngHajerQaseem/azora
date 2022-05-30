<?php
//session_start();
include("includes/template/header.php");

include("connect.php");
include("includes/template/functions.php");
include('pagination.php');

$id=$_GET['id'];

$query = "SELECT * from suppliers where id='".$id."' "; 
$result = mysqli_query($mysqli, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);

$userPictureURL=checkImages($row['server_image_path']);


$balance=$row['balance'];

$fname = $row['fname'];
$lname = $row['lname'];
$fullName = $fname. "&nbsp;". $lname; 

// if(isset($_GET['id']) && $_GET['id']==1){
//   $sql="SELECT * from suppliers where id='".$id."'";
//   mysqli_query($mysqli, $sql) or die(mysqli_error());
// }

?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="suppliers.php"><?php echo _("supplier_details_suppliers"); ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo _("supplier_details_suppliers_details"); ?>
        </li>
    </ol>
</nav>

<div class="profile-wrapper">


    <div class="details-content full_width">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="main-details">
                    <h2><?php echo _("supplier_details_basic_information");?></h2>
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="proImg profile_image">
                                <img src="<?php echo $userPictureURL;?>" />
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="user-details">
                                <ul>
                                    <li><span><i class="fas fa-user"></i>
                                            <?php //echo _("supplier_details_full_name");?></span><?php echo $fullName;?>
                                    </li>
                                    <li><span><i
                                                class="fas fa-phone-alt"></i><?php //echo _("supplier_details_phone_number");?>
                                        </span><?php echo $row['phone'];?></li>
                                    <?php if(!empty($row['address'])) {?>
                                    <li><span><i
                                                class="fa fa-map-marker-alt"></i><?php // echo _("supplier_details_address");?></span><?php echo $row['address'];?>
                                    </li>
                                    <?php } ?>
                                    <?php if(!empty($row['company_name'])) {?>
                                    <li><span><i
                                                class="fas fa-building"></i><?php //echo _("supplier_details_company");?>
                                        </span><?php echo $row['company_name'];?></li>
                                    <?php } ?>
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
                 FROM debt_su     
                 where  client_id = $id ";
                 $debtResult = $mysqli->query($debtSql) or die($mysqli->error);
                 $debt_customer = $debtResult->fetch_assoc();


                   // SQL query //
                      $sql= "SELECT  SUM(paid) AS allPaid , SUM(total) as allTotal
                     
                      FROM purchase
                      INNER JOIN suppliers ON suppliers.id = purchase.supplier_id       
                      WHERE
                      purchase.supplier_id = $id 
                  ";

                  $result = $mysqli->query($sql) or die($mysqli->error);
                 

                  while($row = $result->fetch_assoc()) {

                 
                
                    // $total_paid = $row['allPaid'] +$debt_customer['debt'];     
                    // $total_unpaid = $row['allTotal']-$total_paid ;

                    $total_debt = $row['allTotal']- $row['allPaid']+$balance;
                    $total_paid = $debt_customer['debt'];     
                    $total_unpaid =  $total_debt-$total_paid ;
                   

                  
                }
                ?>

                    <div class="customer-payment">
                        <p><span><i class="fa fa-money-bill-wave"></i>
                                <?php echo _("customer_details_total_debt"); ?></span><?php echo  number_format( $total_debt) ; ?>
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
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#purchase" role="tab" aria-controls="home"
                aria-selected="true"><?php echo _("supplier_details_purchase_history"); ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#debts" role="tab" aria-controls="profile"
                aria-selected="false"><?php echo _("customer_details_paid_debts"); ?></a>
        </li>

    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="purchase" role="tabpanel" aria-labelledby="home-tab">
            <div class="supplier_sales full_width">
                <div class="row">
                    <div class="col-md-12">

                        <div class="customer-wrapper">
                            <div class="loading-overlay">
                                <div class="overlay-content"><?php echo _("customers_loading"); ?></div>
                            </div>
                            <div id="suppliers_content">
                                <?php
             $limit = 10;

             //get number of rows
             $queryNum = $mysqli->query("SELECT COUNT(id) as supplierNum FROM purchase  WHERE supplier_id = " . $id . "
             ORDER BY purchase.id DESC");
             $resultNum = $queryNum->fetch_assoc();
             $rowCount = $resultNum['supplierNum'];
  
             //initialize pagination class
             $pagConfig = array(
                 'totalRows' => $rowCount,
                 'perPage' => $limit,
                 'link_func' => 'searchFilter'
             );
             $pagination =  new Pagination($pagConfig);
  
             // Count Rows and number them
            $counter = 0;
              $puechaseQuery = $mysqli->query("SELECT purchase.id AS 'Invoice.No', date(purchase.created_at) AS 'date', purchase.total AS 'total' ,paid
                                        FROM purchase 
                                        WHERE purchase.supplier_id = " . $id . "
                                        ORDER BY purchase.id DESC
                                        LIMIT $limit
                                        ");

              if ($puechaseQuery->num_rows > 0) {
                ?>
                                <div class="table-responsive">
                                    <table class="table table-hover ">
                                        <thead>
                                            <tr>
                                                <th style="width:10em" scope="col">
                                                    <?php echo _("customer_details_invoice"); ?>
                                                </th>
                                                <th style="width:15em" scope="col">
                                                    <?php echo _("customer_details_date"); ?>
                                                </th>
                                                <th style="width:10em" scope="col">
                                                    <?php echo _("customer_details_total"); ?>
                                                </th>
                                                <th style="width:10em" scope="col">
                                                    <?php echo _("customer_details_paid"); ?>
                                                </th>
                                                <th style="width:10em" scope="col">
                                                    <?php echo _("customer_details_status"); ?>
                                                </th>

                                                <th style="width:15em"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                while ($saleRow = $puechaseQuery->fetch_assoc()) {
                  ?>
                                            <input type="hidden" id="supplierId" value="<?php echo $id ;?>" />
                                            <tr style="cursor: pointer;"
                                                onclick="window.location='purchase_order_details.php?id=<?php echo $saleRow["Invoice.No"] ?>'">
                                                <td class=""><?php echo $saleRow['Invoice.No'] ?></td>
                                                <td class=""><?php echo $saleRow['date'] ?></td>
                                                <td><?php echo $saleRow['total'] ?></td>
                                                <td><?php echo $saleRow['paid'] ?></td>
                                                <td><?php echo $saleRow['total'] <= $saleRow['paid'] ? _("customer_details_paid") : _("customer_details_loan")  ?>
                                                </td>
                                                <td><a class="create-new-btn btn main-btn"
                                                        href="purchase_order_details.php?id=<?php echo $saleRow["Invoice.No"] ?>"><?php echo _("customer_details_view_invoice"); ?></a>
                                                </td>
                                            </tr>
                                            <?php 
              }
               ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php echo $pagination->createLinks(); ?>
                                <?php } ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>





        <div class="tab-pane fade " id="debts" role="tabpanel" aria-labelledby="home-tab">
            <div class="payment-details full_width">
                <div class="row">
                    <div class="col-md-12">

                        <div class="customer-wrapper">
                            <div class="loading-overlay">
                                <div class="overlay-content"><?php echo _("customers_loading"); ?></div>
                            </div>
                            <div id="suppliers_debts">
                                <?php
             $limit = 10;

             //get number of rows
             $queryNum = $mysqli->query("SELECT COUNT(id) as supplierNum FROM debt_su  WHERE client_id = " . $id . "");
             $resultNum = $queryNum->fetch_assoc();
             $rowCount = $resultNum['supplierNum'];
  
             //initialize pagination class
             $pagConfig = array(
                 'totalRows' => $rowCount,
                 'perPage' => $limit,
                 'link_func' => 'searchFilterDebtSu'
             );
             $pagination =  new Pagination($pagConfig);
  
             // Count Rows and number them
            $counter = 0;
              $puechaseQuery= $mysqli->query("SELECT date(created_at) AS 'date',  payment AS 'paid' 
              FROM debt_su 
              WHERE client_id = " . $id . "
              ORDER BY id DESC
              LIMIT $limit
                                        ");

              if ($puechaseQuery->num_rows > 0) {
                ?>
                                <div class="table-responsive">
                                    <table class="table table-hover ">
                                        <thead>
                                            <tr>

                                                <th style="width:15em" scope="col">
                                                    <?php echo _("customer_details_date"); ?>
                                                </th>

                                                <th style="width:10em" scope="col">
                                                    <?php echo _("customer_details_paid"); ?>
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                while ($saleRow = $puechaseQuery->fetch_assoc()) {
                  ?>
                                            <input type="hidden" id="supplierId" value="<?php echo $id ;?>" />
                                            <tr>

                                                <td class=""><?php echo $saleRow['date'] ?></td>

                                                <td><?php echo $saleRow['paid'] ?></td>

                                            </tr>
                                            <?php 
              }
               ?>
                                        </tbody>
                                    </table>
                                </div>
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



<script>
function searchFilter(page_num) {
    page_num = page_num ? page_num : 0;
    var keywords = $('#keywords').val();
    var sortBy = $('#sortBy').val();
    var supplierId = $('#supplierId').val();

    $.ajax({
        type: 'POST',
        url: 'supplier_details_search.php',
        data: 'page=' + page_num + '&keywords=' + keywords + '&sortBy=' + sortBy + '&supplierId=' +
            supplierId,
        beforeSend: function() {
            $('.loading-overlay').show();
        },
        success: function(html) {
            $('#suppliers_content').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
    });
}

function searchFilterDebtSu(page_num) {
    page_num = page_num ? page_num : 0;
    var keywords = $('#keywords').val();
    var sortBy = $('#sortBy').val();
    var supplierId = $('#supplierId').val();

    $.ajax({
        type: 'POST',
        url: 'supplier_details_search_debts.php',
        data: 'page=' + page_num + '&keywords=' + keywords + '&sortBy=' + sortBy + '&supplierId=' +
            supplierId,
        beforeSend: function() {
            $('.loading-overlay').show();
        },
        success: function(html) {
            $('#suppliers_debts').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
    });
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
    integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
</script>
<?php include("includes/template/footer.php"); ?>