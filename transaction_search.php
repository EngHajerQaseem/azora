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
        $whereSQL = "WHERE full_name LIKE '%" . $keywords . "%' AND archive = 0";
    }
    if (!empty($sortBy)) {
        $orderSQL = " ORDER BY id " . $sortBy;
    } else {
        $orderSQL = " ORDER BY id DESC ";
    }

    //get number of rows
    $queryNum = $mysqli->query("SELECT COUNT(*) as transactionNum FROM (
        SELECT sale.id, user.full_name
            FROM sale 
            INNER JOIN user ON sale.user_id = user.id
            WHERE full_name LIKE '%" . $keywords . "%' AND sale.archive = 0
            UNION
        SELECT refund.id, user.full_name
            FROM refund 
            INNER JOIN user ON refund.user_id = user.id
            WHERE full_name LIKE '%" . $keywords . "%' AND refund.archive = 0
            UNION
        SELECT purchase.id, user.full_name
            FROM purchase
            INNER JOIN user ON purchase.user_id = user.id
            WHERE (purchase.purchase_status_id = 4 OR purchase.purchase_status_id = 5 OR purchase.purchase_status_id = 6) AND full_name LIKE '%" . $keywords . "%' AND purchase.archive = 0
            UNION
        SELECT expense.id, user.full_name
            FROM expense
            INNER JOIN user ON expense.user_id = user.id
            WHERE full_name LIKE '%" . $keywords . "%' AND expense.archive = 0) AS Transactions ");


    $resultNum = $queryNum->fetch_assoc();
    $rowCount = $resultNum['transactionNum'];

    //initialize pagination class
    $pagConfig = array(
        'currentPage' => $start,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'searchFilter'
    );
    $pagination =  new Pagination($pagConfig);

    // Count Rows and number them

    //get rows
    $query =$mysqli->query("SELECT sale.id, date(sale.created_at) As 'date', user.full_name, sale.sub_total AS 'total', 'Sale' AS 'type'
        FROM sale 
        INNER JOIN user ON sale.user_id = user.id
        WHERE full_name LIKE '%" . $keywords . "%' AND sale.archive = 0
        
        UNION 
        SELECT refund.id, date(refund.created_at) AS 'date', user.full_name, refund.sub_total AS 'total', 'Refund' as 'type'
        FROM refund 
                                        
        INNER JOIN user ON refund.user_id = user.id 
        WHERE full_name LIKE '%" . $keywords . "%' AND refund.archive = 0
        UNION
    SELECT purchase.id, date(purchase.created_at) AS 'date', user.full_name, purchase.total AS 'total',  'Purchase' AS 'type' 
        FROM purchase
        INNER JOIN user ON purchase.user_id = user.id
        WHERE (purchase.purchase_status_id = 4 OR purchase.purchase_status_id = 5 OR purchase.purchase_status_id = 6) AND full_name LIKE '%" . $keywords . "%' AND purchase.archive = 0
        UNION
    SELECT expense.id, date(expense.created_at) AS 'date', user.full_name, expense.total AS 'total',  'Expense' AS 'type' 
        FROM expense
        INNER JOIN user ON expense.user_id = user.id
        WHERE full_name LIKE '%" . $keywords . "%' AND expense.archive = 0 
       
        ORDER BY id DESC
        LIMIT $start,$limit");

             // $sqlquery = mysqli_query($mysqli,$query);                       
            if ($query->num_rows > 0) { ?>
<div class="users_list ">
    <div class="table-responsive">
        <table class="table table-hover ">
            <thead>
                <tr>
                    <th style="width:10em" scope="col"><?php echo _("transaction_date"); ?></th>
                    <th class="hidden-xs" style="width:15em" scope="col"><?php echo _("transaction_user"); ?></th>
                    <th style="width:7em" scope="col"><?php echo _("transaction_total"); ?></th>
                    <th style="width:6em" scope="col"><?php echo _("transaction_type"); ?></th>
                    <th class="hidden-xs" style="width:10em"></th>
                </tr>
            </thead>
            <?php
                $no=$start;
                        while ($row = $query->fetch_assoc()) {
                            $transaction_no = $row['id'];
                            $date = $row['date'];
                            $user = $row['full_name'];
                            $total = number_format($row['total']);
                            $type = $row['type'];

                            switch($type){
                                case "Purchase":
                                $trans_type = _("dashboard_purchase");
                                break;

                                case "Refund":
                                $trans_type = "Refund";
                                break;

                                case "Sale":
                                $trans_type = _("dashboard_sales");
                                break;

                                case "Expense":
                                $trans_type = _("expense_Add_header");
                                break;
                                 

                          }
                            ?>
            <!-- content -->
            <tbody>
                <?php
                                            if($type == 'Sale'){
                                                echo '<tr style="cursor:pointer"  onclick="window.location.href=\'sale_bill.php?id='.$row['id'].'&trans='.$type.'\';"></>';
                                            }else if($type == 'Refund'){
                                                   echo '<tr style="cursor:pointer"  onclick="window.location.href=\'sale_bill.php?id='.$row['id'].'&trans='.$type.'\';"></>';
                                            }
                                             else if ($type == 'Purchase'){
                                                echo '<tr style="cursor:pointer"  onclick="window.location.href=\'purchase_order_details.php?id='.$row['id'].'\';"></>';
                                            } 
                                               
                                        ?>
                <td><?php echo $date; ?></td>
                <td class="hidden-xs"><?php echo $user; ?></td>
                <td><?php echo $total; ?></td>
                <td><?php echo $trans_type; ?></td>
                <td class="hidden-xs">
                    <!-- <button class="create-new-btn">View Details</button> -->

                    <?php
                                             if($type == 'Sale'){
                                                echo '<button class="create-new-btn main-btn btn" onclick="window.location.href=\'sale_bill.php?id='.$row['id'].'&trans='.$type.'\';">'._("transaction_view_details").'</button>';
                                            }else if($type == 'Refund'){
                                                    echo '<button class="create-new-btn main-btn btn" onclick="window.location.href=\'sale_bill.php?id='.$row['id'].'&trans='.$type.'\';">'._("transaction_view_details").'</button>';
                                            } else if ($type == 'Purchase'){
                                                echo '<button class="create-new-btn main-btn btn" onclick="window.location.href=\'purchase_order_details.php?id='.$row['id'].'\';">'._("transaction_view_details").'</button>';
                                            }
                                        ?>
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