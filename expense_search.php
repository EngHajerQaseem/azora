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
    $whereSQL = 'where expense.archive = 0 ';
     $orderSQL = '';
    $keywords = $_POST['keywords'];
    $sortBy = $_POST['sortBy'];
    if (!empty($keywords)) {
        $whereSQL .=" AND type LIKE '%" . $keywords . "%' ";
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
    $queryNum = $mysqli->query("SELECT COUNT(id) as expenseNum FROM expense " . $whereSQL);

    // $queryNum = $mysqli->query("SELECT * FROM (SELECT COUNT(purchase.id) as purchaseNum, CONCAT(suppliers.fname, ' ', suppliers.lname) AS 'supplier'
    //                             FROM purchase
    //                             INNER JOIN suppliers ON purchase.supplier_id = suppliers.id 
    //                             ) AS data ".$whereSQL);

    $resultNum = $queryNum->fetch_assoc();
    $rowCount = $resultNum['expenseNum'];

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
    $query = $mysqli->query("SELECT expense.id AS 'id' ,date(expense.created_at) AS 'date', expense.type AS 'type', expense.description AS 'description', user.full_name AS 'user', expense.total AS 'total'
                            FROM (expense 
                            INNER JOIN user ON expense.user_id = user.id)
                            $whereSQL
                            ORDER BY expense.id DESC
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
                    <th style="width:10em" scope="col"><?php echo _("expense_Search_Date");?></th>
                    <th style="width:15em" scope="col"><?php echo _("expense_Search_Type");?></th>
                    <th style="width:15em" scope="col"><?php echo _("expense_Search_Description");?></th>
                    <th style="width:15em" scope="col"><?php echo _("expense_Search_User");?></th>
                    <th style="width:10em" scope="col"><?php echo _("expense_Search_Total");?></th>
                    <!-- <th scope="col"></th> -->
                </tr>
            </thead>
            <?php
                $no=$start;
                        while ($row = $query->fetch_assoc()) {
                            $counter++;
                            $num=$row['id'];
                            $date = $row['date'];
                            $type = $row['type'];
                            $description = $row['description'];
                            $user = $row['user'];
                            $total = $row['total'];
                            ?>
            <!-- content -->
            <tbody>
                <tr>
                    <td><?php echo $num;?></td>
                    <td><?php echo $date; ?></td>
                    <td><?php echo $type; ?></td>
                    <td><?php echo $description; ?></td>
                    <td><?php echo $user; ?></td>
                    <td><?php echo $total; ?></td>
                    <!-- <td class="align-content-end">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php //echo _("expense_Search_Action");?>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                       
                                        <a class="dropdown-item" href="#"><i class="fa fa-edit"></i> <?php //echo _("expense_Search_Edit");?> </a>
                                        <a class="dropdown-item delete_exp" data-exp-id="<?php //echo $row["id"]; ?>" href="javascript:void(0)"><i class="fa fa-trash"></i> <?php echo _("expense_Search_Delete");?>  </a>
                                    </div>
                                </div>
                            </td> -->
                </tr>
            </tbody>

            <?php } ?>
        </table>
    </div>
    <?php echo $pagination->createLinks(); ?>
    <?php }
} ?>

    <script>
    $(document).ready(function() {
        // $('.delete_exp').click(function(e) {
        //     e.preventDefault();
        //     var expid = $(this).attr('data-exp-id');
        //     var parent = $(this).parent(".dropdown-menu").parent(".dropdown").parent("td").parent("tr");
        //     bootbox.dialog({
        //         message: "<div class='delete_user_popup'><div class='icon-trash'><i class='fas fa-trash'></i></div><div class='delete-text'><?php echo _("expense_search_delete_alert_message"); ?></div></div>",
        //         title: "<i class='glyphicon glyphicon-trash'></i>",
        //         buttons: {
        //             success: {
        //                 label: "<?php echo _("expense_search_alert_cancel"); ?>",
        //                 className: "btn-normal",
        //                 callback: function() {
        //                     $('.bootbox').modal('hide');
        //                 }
        //             },
        //             danger: {
        //                 label: "<?php echo _("expense_search_alert_delete"); ?>!",
        //                 className: "btn-danger",
        //                 callback: function() {
        //                     $.ajax({
        //                             type: 'POST',
        //                             url: 'expense_rmv.php',
        //                             data: 'expid=' + expid
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