<?php
//session_start();
include_once("includes/template/language.php");


if(isset($_POST['page'])){

include("connect.php");
include('pagination.php');

$id = $_POST['customerId'];
$start = !empty($_POST['page'])?$_POST['page']:0;
$limit = 10;



//get number of rows
$queryNum = $mysqli->query("SELECT COUNT(id) as customerNum FROM debt  WHERE client_id = " . $id . "");
$resultNum = $queryNum->fetch_assoc();
$rowCount = $resultNum['customerNum'];

//initialize pagination class
$pagConfig = array(
    'currentPage' => $start,
    'totalRows' => $rowCount,
    'perPage' => $limit,
    'link_func' => 'searchFilterDebts'
);
$pagination =  new Pagination($pagConfig);

// Count Rows and number them
$counter = 0;

$salesQuery = $mysqli->query("SELECT date(created_at) AS 'date',  payment AS 'paid' 
FROM debt 
WHERE client_id = " . $id . "
ORDER BY id DESC
LIMIT  $start,$limit
");

if ($salesQuery->num_rows > 0) {



?>



<div class="payment-details full_width">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <input type="hidden" id="customerId" value="<?php echo $id ;?>" />

                            <th style="width:10em" scope="col">
                                <?php echo _("customer_details_date"); ?>
                            </th>

                            <th style="width:10em" scope="col">
                                <?php echo _("customer_details_paid"); ?>
                            </th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
           
                while ($saleRow = $salesQuery->fetch_assoc()) {
              ?>
                        <tr>

                            <td><?php echo $saleRow['date'] ?></td>

                            <td><?php echo $saleRow['paid'] ?></td>

                            </td>

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