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
    $whereSQL = "WHERE CONCAT(suppliers.fname, ' ', suppliers.lname) LIKE '%" . $keywords . "%'";
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
  $queryNum = $mysqli->query("SELECT COUNT(purchase.id) as purchaseNum, CONCAT(suppliers.fname, ' ', suppliers.lname) AS 'supplier'
                                FROM purchase
                                INNER JOIN suppliers ON purchase.supplier_id = suppliers.id 
                                " . $whereSQL);

  // $queryNum = $mysqli->query("SELECT * FROM (SELECT COUNT(purchase.id) as purchaseNum, CONCAT(suppliers.fname, ' ', suppliers.lname) AS 'supplier'
  //                             FROM purchase
  //                             INNER JOIN suppliers ON purchase.supplier_id = suppliers.id 
  //                             ) AS data ".$whereSQL);

  $resultNum = $queryNum->fetch_assoc();
  $rowCount = $resultNum['purchaseNum'];

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
  $query = $mysqli->query("SELECT purchase.id AS 'PO.NO', date(purchase.created_at) AS 'date', purchase.total AS 'total',purchase.paid AS 'paid',  purchase_status.status AS 'PO_status', CONCAT(suppliers.fname, ' ', suppliers.lname) AS 'supplier', user.full_name AS 'user'
                            FROM (((purchase 
                            INNER JOIN purchase_status ON purchase.purchase_status_id = purchase_status.id)
                            INNER JOIN suppliers ON purchase.supplier_id = suppliers.id)
                            INNER JOIN user ON purchase.user_id = user.id)
                            $whereSQL
                            ORDER BY purchase.id DESC
                            LIMIT $start,$limit");

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
        <table class="table table-hover ">
            <thead>
                <tr>
                    <th style="width:5em" scope="col">#</th>
                    <th style="width:9em" scope="col"><?php echo _("PO_Search_Date");?></th>
                    <th style="width:5em" scope="col"><?php echo _("PO_Search_Total");?></th>
                    <th class="hidden-xs" style="width:8em" scope="col"><?php echo _("Purchase_order_Paid");?></th>
                    <th class="hidden-xs" style="width:10em" scope="col"><?php echo _("PO_Search_Status");?></th>
                    <th class="hidden-xs" style="width:10em" scope="col"><?php echo _("PO_Search_Supplier");?></th>
                    <th class="hidden-xs" style="width:10em" scope="col"><?php echo _("PO_Search_User");?></th>
                    <th class="hidden-xs" style="width:10em" scope="col"></th>
                </tr>
            </thead>
            <?php
        $no=$start;
            while ($row = $query->fetch_assoc()) {
              $counter++;
              $PO_NO = $row['PO.NO'];
              $date = $row['date'];
              $total = $row['total'];
              $paid = $row['paid'];
              $PO_status = $row['PO_status'];
              $supplier = $row['supplier'];
              $user = $row['user'];
              ?>
            <!-- content -->
            <tbody>
                <tr style="cursor: pointer;"
                    onclick="window.location='purchase_order_details.php?id=<?php echo $row["PO.NO"]?>'">
                    <td><?php echo $PO_NO; ?></td>
                    <td><?php echo $date; ?></td>
                    <td><?php echo $total; ?></td>
                    <td class="hidden-xs"><?php echo $paid; ?></td>
                    <td class="hidden-xs"><?php echo $PO_status; ?></td>
                    <td class="hidden-xs"><?php echo $supplier; ?></td>
                    <td class="hidden-xs"><?php echo $user; ?></td>
                    <td class="hidden-xs align-content-end">
                        <button class="create-new-btn main-btn btn" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            onclick="window.location='purchase_order_details.php?id=<?php echo $row["PO.NO"]?>'">
                            <?php echo _("transaction_view_details")?>
                        </button>
                    </td>
                </tr>
            </tbody>

            <?php } ?>
        </table>
    </div>
</div>
<?php echo $pagination->createLinks(); ?>

<script>
$(document).ready(function() {
    $('.received-operation').click(function(e) {
        e.preventDefault();
        var purchaseid = $(this).attr('data-received-id');
        var type = $(this).attr('data-operation-type');
        bootbox.dialog({
            message: "<div class='delete_user_popup'><div class='icon-trash'><i class='fas fa-trash'></i></div><div class='delete-text'>Are you sure you want to mark this as " +
                type + "?</div></div>",
            title: "<i class='glyphicon glyphicon-trash'></i>",
            buttons: {
                success: {
                    label: "Cancel",
                    className: "btn-normal",
                    callback: function() {
                        $('.bootbox').modal('hide');
                    }
                },
                danger: {
                    label: "Proceed",
                    className: "btn-info",
                    callback: function() {
                        $.ajax({
                                type: 'POST',
                                url: 'purchase_order_operation.php',
                                data: 'purchaseid=' + purchaseid + '&operationType=' +
                                    type
                            })
                            .done(function(response) {
                                bootbox.alert(response);
                                setTimeout(
                                    function() {
                                        location.reload();
                                    }, 0001);
                            })
                            .fail(function() {
                                bootbox.alert('Error....');
                            })
                    }
                }
            }
        });
    });
});
</script>



<?php }
} ?>