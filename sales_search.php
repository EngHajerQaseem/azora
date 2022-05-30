<?php

include_once("includes/template/language.php");

if (isset($_POST['page'])) {
    //Include pagination class file
    include('pagination.php');

    //Include database configuration file
    include('connect.php');

    $start = !empty($_POST['page']) ? $_POST['page'] : 0;
    $limit = 10;

    //set conditions for search
    $whereSQL = $orderSQL = '';
    $keywords = $_POST['keywords'];
    $sortBy = $_POST['sortBy'];
    if (!empty($keywords)) {
        $whereSQL = "WHERE CONCAT(customer.fname, ' ', customer.lname) LIKE '%" . $keywords . "%' AND customer.archive=0" ;
    }
    if (!empty($sortBy)) {
        $orderSQL = " ORDER BY id " . $sortBy;
    } else {
        $orderSQL = " ORDER BY id DESC ";
    }

    //get number of rows
    // $queryNum = $mysqli->query("SELECT COUNT(purchase.id) as purchaseNum, CONCAT(suppliers.fname, ' ', suppliers.lname) AS 'supplier'
    //                             FROM purchase
    //                             INNER JOIN suppliers ON purchase.supplier_id = suppliers.id 
    //                             ".$whereSQL.$orderSQL);

    // Work fine but not search
    $queryNum = $mysqli->query("SELECT COUNT(sale.id) as saleNum,COUNT(refund.id) as refundNum, CONCAT(customer.fname, ' ', customer.lname) AS 'customer'
                                FROM sale
                                LEFT JOIN customer ON sale.customer_id = customer.id
                                LEFT JOIN refund ON sale.id = refund.sale_id
                                " . $whereSQL);

    // $queryNum = $mysqli->query("SELECT * FROM (SELECT COUNT(purchase.id) as purchaseNum, CONCAT(suppliers.fname, ' ', suppliers.lname) AS 'supplier'
    //                             FROM purchase
    //                             INNER JOIN suppliers ON purchase.supplier_id = suppliers.id 
    //                             ) AS data ".$whereSQL);

    $resultNum = $queryNum->fetch_assoc();
    $rowCount = $resultNum['saleNum']+$resultNum['refundNum'];
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

    //get rows
    // $query = $mysqli->query("SELECT purchase.id AS 'PO.NO', purchase.created_at AS 'date', transaction.total_cost_price AS 'total',  purchase_status.status AS 'PO_status', CONCAT(suppliers.fname, ' ', suppliers.lname) AS 'supplier', user.full_name AS 'user'
    //                         FROM ((((purchase 
    //                         INNER JOIN transaction ON purchase.transaction_id = transaction.id)
    //                         INNER JOIN purchase_status ON purchase.purchase_status_id = purchase_status.id)
    //                         INNER JOIN suppliers ON purchase.supplier_id = suppliers.id)
    //                         INNER JOIN user ON transaction.user_id = user.id)
    //                         $whereSQL
    //                         $orderSQL
    //                         LIMIT $start,$limit");

    // Work fine but not search
    // $query = $mysqli->query("SELECT sale.id AS 'Invoice.No', date(sale.created_at) AS 'date', sale.sub_total AS 'total', sale.paid AS 'paid', CONCAT(customer.fname, ' ', customer.lname) AS 'customer', user.full_name AS 'user'  
    //                         FROM ((sale 
    //                         LEFT JOIN customer ON sale.customer_id = customer.id)
    //                         LEFT JOIN user ON sale.user_id = user.id)
    //                         $whereSQL
    //                         ORDER BY sale.id DESC
    //                         LIMIT $start,$limit");



                $query =$mysqli->query("(SELECT sale.id AS 'Invoice_No', date(sale.created_at) AS 'date', sale.sub_total AS 'total', sale.paid AS 'paid', CONCAT(customer.fname, ' ', customer.lname) AS 'customer', user.full_name AS 'user','Sale' as Type_of_Transaction ,1 as ordering
                FROM ((sale 
                LEFT JOIN customer ON sale.customer_id = customer.id)
                LEFT JOIN user ON sale.user_id = user.id) $whereSQL
                )

                UNION 
                (SELECT refund.id AS 'Invoice_No', date(refund.created_at) AS 'date', refund.sub_total AS 'total', refund.paid AS 'paid', CONCAT(customer.fname, ' ', customer.lname) AS 'customer', user.full_name AS 'user','Refund' as Type_of_Transaction,2 as ordering
                FROM ((refund 
                LEFT JOIN customer ON refund.customer_id = customer.id)
                LEFT JOIN user ON refund.user_id = user.id) $whereSQL 
                )
                
                ORDER BY Invoice_No DESC,ordering ASC
                limit  $start, $limit
                ");

    // $query = $mysqli->query("SELECT * FROM (SELECT purchase.id AS 'PO.NO', purchase.created_at AS 'date', transaction.total_cost_price AS 'total',  purchase_status.status AS 'PO_status', CONCAT(suppliers.fname, ' ', suppliers.lname) AS 'supplier', user.full_name AS 'user'
    //                         FROM ((((purchase 
    //                         INNER JOIN transaction ON purchase.transaction_id = transaction.id)
    //                         INNER JOIN purchase_status ON purchase.purchase_status_id = purchase_status.id)
    //                         INNER JOIN suppliers ON purchase.supplier_id = suppliers.id)
    //                         INNER JOIN user ON transaction.user_id = user.id)
    //                         ) AS data
    //                         $whereSQL
    //                         LIMIT $start,$limit");

    if ($query->num_rows > 0) { ?>
<div class="users_list">
    <div class=" table-responsive-lg">
        <table class=" table table-hover ">
            <thead>
                <tr>
                    <th style="width:4em" scope="col">#</th>
                    <th style="width:7em" scope="col"><?php echo _("sales_date"); ?></th>
                    <th style="width:5em" scope="col"><?php echo _("sales_total"); ?></th>
                    <th class="hidden-xs" style="width:10em" scope="col"><?php echo _("sales_paid"); ?></th>
                    <th class="hidden-xs" style="width:15em" scope="col"><?php echo _("sales_customer"); ?></th>
                    <th class="hidden-xs" style="width:15em" scope="col"><?php echo _("sales_user"); ?></th>
                    <th class="hidden-xs" style="width:15em" scope="col"><?php echo _("sales_Type_Of_Transaction"); ?>
                    </th>
                    <th class="hidden-xs" style="width:10em" scope="col"></th>
                </tr>
            </thead>
            <?php
                
                        while ($row = $query->fetch_assoc()) {
                            $counter++;
                            $Invoice_No = $row['Invoice_No'];
                            $date = $row['date'];
                            $total = $row['total'];
                            $paid = $row['paid'];
                            $customer = $row['customer'];
                            $user = $row['user'];
                            $transaction=$row['Type_of_Transaction'];
                            ?>
            <!-- content -->
            <tbody>
                <tr style="cursor: pointer;"
                    onclick="window.location='sale_bill.php?id=<?php echo $row['Invoice_No'].'&trans='.$transaction;?>'">
                    <td><?php echo $Invoice_No; ?></td>
                    <td><?php echo $date; ?></td>
                    <td><?php echo $total; ?></td>
                    <td class="hidden-xs"><?php echo $paid; ?></td>
                    <td class="hidden-xs"><?php echo $customer; ?></td>
                    <td class="hidden-xs"><?php echo $user; ?></td>
                    <td class="hidden-xs">
                        <?php echo $transaction==="Sale" ?  _("sale_transaction") :  _("refund_transaction") ; ?></td>
                    <td class="hidden-xs  align-content-end">
                        <div class="dropdown">
                            <button class="create-new-btn main-btn btn" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                onclick="window.location='sale_bill.php?id=<?php echo $row['Invoice_No'];?>'">
                                <?php echo _("transaction_view_details")?>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>

            <?php } ?>
        </table>
    </div>
</div>
<?php echo $pagination->createLinks(); ?>
<?php }
} ?>

<script>
$(document).ready(function() {
    // $('.delete_sale').click(function(e) {
    //     e.preventDefault();
    //     var saleid = $(this).attr('data-sale-id');
    //     var parent = $(this).parent(".dropdown-menu").parent(".dropdown").parent("td").parent("tr");
    //     bootbox.dialog({
    //         message: "<div class='delete_user_popup'><div class='icon-trash'><i class='fas fa-trash'></i></div><div class='delete-text'><?php echo _("sales_delete_alert_message"); ?></div></div>",
    //         title: "<i class='glyphicon glyphicon-trash'></i>",
    //         buttons: {
    //             success: {
    //                 label: "<?php echo _("sales_cancel"); ?>",
    //                 className: "btn-normal",
    //                 callback: function() {
    //                     $('.bootbox').modal('hide');
    //                 }
    //             },
    //             danger: {
    //                 label: "<?php echo _("sales_delete"); ?>!",
    //                 className: "btn-danger",
    //                 callback: function() {
    //                     $.ajax({
    //                             type: 'POST',
    //                             url: 'sales_rmv.php',
    //                             data: 'saleid=' + saleid
    //                         })
    //                         .done(function(response) {
    //                             bootbox.alert(response);
    //                             parent.fadeOut('slow');
    //                         })
    //                         .fail(function() {
    //                             bootbox.alert('Error....');
    //                         })
    //                 }
    //             }
    //         }
    //     });
    // });
});
</script>