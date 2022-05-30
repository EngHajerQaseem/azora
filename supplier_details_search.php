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
$queryNum = $mysqli->query("SELECT COUNT(id) as supplierNum FROM purchase  WHERE supplier_id = " . $id . "
ORDER BY purchase.id ASC");
$resultNum = $queryNum->fetch_assoc();
$rowCount = $resultNum['supplierNum'];

//initialize pagination class
$pagConfig = array(
    'currentPage' => $start,
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
                            <input type="hidden" id="supplierId" value="<?php echo $id ;?>" />
                            <th style="width:10em" scope="col"><?php echo _("customer_details_invoice"); ?></th>
                            <th style="width:15em" scope="col"><?php echo _("customer_details_date"); ?></th>
                            <th style="width:10em" scope="col"><?php echo _("customer_details_total"); ?></th>
                            <th style="width:10em" scope="col"><?php echo _("customer_details_paid"); ?></th>
                            <th style="width:10em" scope="col"><?php echo _("customer_details_status"); ?></th>
                            <th style="width:15em" scope="col"></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
           
                while ($saleRow = $puechaseQuery->fetch_assoc()) {
              ?>
                                            <tr  style="cursor: pointer;" onclick="window.location='purchase_order_details.php?id=<?php echo $saleRow["Invoice.No"] ?>'">
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
        </div>
    </div>
</div>
</div>
<?php echo $pagination->createLinks(); ?>

<?php } 
}
 ?>