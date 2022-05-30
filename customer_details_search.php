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
$queryNum = $mysqli->query("SELECT COUNT(sale.id) as customerNum , COUNT(refund.id) as refundNum FROM sale LEFT JOIN refund ON sale.id = refund.sale_id  WHERE sale.customer_id = " . $id . "
           ORDER BY sale.id DESC");
           $resultNum = $queryNum->fetch_assoc();
           $rowCount = $resultNum['customerNum']+$resultNum['refundNum'];

           echo $rowCount;

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
LIMIT $start,$limit
");

if ($salesQuery->num_rows > 0) {



?>



<div class="customer_sales full_width">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <input type="hidden" id="customerId" value="<?php echo $id ;?>" />
                            <th style="width:10em" scope="col"><?php echo _("customer_details_invoice"); ?></th>
                            <th style="width:10em" scope="col"><?php echo _("customer_details_date"); ?></th>
                            <th style="width:10em" scope="col"><?php echo _("customer_details_total"); ?></th>
                            <th style="width:10em" scope="col"><?php echo _("customer_details_paid"); ?></th>
                            <th style="width:10em" scope="col"><?php echo _("customer_details_status"); ?></th>
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
                            onclick="window.location='sale_bill.php?id=<?php echo $saleRow["Invoice_No"] ?>'">
                            <td><?php echo $saleRow['Invoice_No'] ?></td>
                            <td><?php echo $saleRow['date'] ?></td>
                            <td><?php echo $saleRow['total'] ?></td>
                            <td><?php echo $saleRow['paid'] ?></td>
                            <td><?php echo $saleRow['total'] <= $saleRow['paid'] ? _("customer_details_paid") : _("customer_details_loan")  ?>
                            </td>
                            <td><?php echo $saleRow['Type_of_Transaction']==="Sale" ? _("customer_details_sale_transaction") :  _("customer_details_refund_transaction") ?>
                            </td>
                            <td><a class="create-new-btn btn main-btn"
                                    href="sale_bill.php?id=<?php echo $saleRow["Invoice_No"] ?>"><?php echo _("customer_details_view_invoice"); ?></a>
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