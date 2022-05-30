<?php
//session_start();
include_once("includes/template/language.php");


if(isset($_POST['page'])){

include("connect.php");
include('pagination.php');

$id = $_POST['supplierId'];
$start = !empty($_POST['page'])?$_POST['page']:0;
$limit = 10;



//get number of rows
$queryNum = $mysqli->query("SELECT COUNT(id) as supplierNum FROM debt_su  WHERE client_id = " . $id . "");
$resultNum = $queryNum->fetch_assoc();
$rowCount = $resultNum['supplierNum'];

//initialize pagination class
$pagConfig = array(
    'currentPage' => $start,
    'totalRows' => $rowCount,
    'perPage' => $limit,
    'link_func' => 'searchFilterDebtSu'
);
$pagination =  new Pagination($pagConfig);

// Count Rows and number them
$counter = 0;

$puechaseQuery = $mysqli->query("SELECT date(created_at) AS 'date',  payment AS 'paid' 
FROM debt_su 
WHERE client_id = " . $id . "
ORDER BY id DESC
LIMIT $start,$limit
");

if ($puechaseQuery->num_rows > 0) {



?>



<div class="customer_sales full_width">
    <div class="row">
        <div class="col-md-12">

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
        </div>
    </div>
</div>
</div>
<?php echo $pagination->createLinks(); ?>

<?php } 
}
 ?>