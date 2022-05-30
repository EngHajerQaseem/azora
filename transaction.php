<?php
include("includes/template/header.php");
include("connect.php");
//Include pagination class file
include('pagination.php');
?>
<div class="products-page">

    <div class="product-header">
        <div class="row">
            <div class="col-lg-4 col-12">
                <!--<div class="dropdown">
                     <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        All Expense
                    </button> 
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Recent </a>
                        <a class="dropdown-item" href="#">Categroy Name</a>
                        <a class="dropdown-item" href="#">Categroy Name</a>
                    </div>
                </div>-->
                <h3 class="page-title"><?php echo _("Page_Title_Transaction");?></h3>
            </div>

            <div class="col-lg-4 col-12">
                <div class="input-group md-form form-sm form-1 pl-0">
                    <input class="form-control my-0 py-1" type="text" id="keywords"
                        placeholder="<?php echo _("transaction_search_by_user_name"); ?>" onkeyup="searchFilter()" />
                    <!-- <input class="form-control my-0 py-1" type="text" placeholder="Search Transactions" aria-label="Search"> -->
                    <div class="input-group-append">
                        <span class="input-group-text search-icon" id="basic-text1"><i class="fa fa-search text-white"
                                aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-12  d-flex justify-content-end">
            </div>

        </div>
    </div>

    <div class="user-wrapper">
        <div class="loading-overlay">
            <div class="overlay-content"><?php echo _("transaction_loading"); ?></div>
        </div>
        <div id="transaction_content">
            <?php

            $limit = 10;

            //get number of rows
            $queryNum = $mysqli->query("SELECT COUNT(id) as transactionNum FROM (SELECT sale.id AS 'id' FROM sale
            INNER JOIN user ON sale.user_id = user.id
            WHERE sale.archive = 0
             UNION 
             SELECT refund.id AS 'id' FROM refund
            INNER JOIN user ON refund.user_id = user.id
            WHERE refund.archive = 0
             UNION 
             SELECT purchase.id AS 'id' FROM purchase 
            INNER JOIN user ON purchase.user_id = user.id
             WHERE (purchase.purchase_status_id = 4 OR purchase.purchase_status_id = 5 OR purchase.purchase_status_id = 6) AND  purchase.archive = 0
              UNION 
              SELECT expense.id AS 'id' FROM expense
            INNER JOIN user ON expense.user_id = user.id
              WHERE expense.archive = 0) AS tranactions");
              
            $resultNum = $queryNum->fetch_assoc();
            $rowCount = $resultNum['transactionNum'];
            //initialize pagination class
            $pagConfig = array(
                'totalRows' => $rowCount,
                'perPage' => $limit,
                'link_func' => 'searchFilter'
            );
            $pagination =  new Pagination($pagConfig);

            // Count Rows and number them

            //get rows
            $query = $mysqli->query(" SELECT sale.id, date(sale.created_at) AS 'date', user.full_name, sale.sub_total AS 'total',NULL AS 'status', 'Sale' AS 'type'
                                        FROM sale 
                                        INNER JOIN user ON sale.user_id = user.id
                                        WHERE sale.archive = 0
                                         
                                         UNION 
                                        SELECT refund.id, date(refund.created_at) AS 'date', user.full_name, refund.sub_total AS 'total', NULL AS 'status', 'Refund' as 'type'
                                        FROM refund 
                                        LEFT JOIN user ON refund.user_id = user.id 
                                        WHERE refund.archive = 0
                                       
                                       UNION
                                    SELECT purchase.id, date(purchase.created_at) AS 'date', user.full_name, purchase.total AS 'total',purchase.purchase_status_id AS 'status',  'Purchase' AS 'type' 
                                        FROM purchase
                                        INNER JOIN user ON purchase.user_id = user.id
                                        WHERE (purchase.purchase_status_id = 4 OR purchase.purchase_status_id = 5 OR purchase.purchase_status_id = 6) AND  purchase.archive = 0
                                        UNION                                     
                                        SELECT expense.id, date(expense.created_at) AS 'date', user.full_name, expense.total AS 'total',NULL AS 'status',  'Expense' AS 'type' 
                                        FROM expense
                                        INNER JOIN user ON expense.user_id = user.id
                                        WHERE expense.archive = 0
                                        ORDER BY id DESC
                                        LIMIT $limit");
           
            if ($query->num_rows > 0) { ?>
            <div class="users_list ">
                <div class="table-responsive">
                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <!-- <th style="width:5em" scope="col">#</th> -->
                                <th style="width:10em" scope="col" class="trans-date">
                                    <?php echo _("transaction_date"); ?></th>
                                <th class="hidden-xs" style="width:15em" scope="col">
                                    <?php echo _("transaction_user"); ?></th>
                                <th style="width:7em" scope="col"><?php echo _("transaction_total"); ?></th>
                                <th style="width:6em" scope="col"><?php echo _("transaction_type"); ?></th>
                                <th class="hidden-xs" style="width:10em"></th>
                            </tr>
                        </thead>
                        <?php
                        $no=1;
                            while ($row = $query->fetch_assoc()) {
                                
                                //$transaction_no = $row['NOid'];
                                $transaction_no = $row['id'];
                                $date = $row['date'];
                                $user = $row['full_name'];
                                $total = number_format($row['total']);
                                $type = $row['type'];
                                if ($type == 'Purchase' && $row['status'] != 4) {
                                    continue;
                                }
        
                                switch($type){
                                      case "Purchase":
                                      $trans_type = _("dashboard_purchase");
                                      break;

                                      case "Sale":
                                      $trans_type = _("dashboard_sales");
                                      break;

                                      case "Refund":
                                      $trans_type ="Refund";
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

                            <td class="trans-date"><?php echo $date; ?></td>
                            <td class="hidden-xs"><?php echo $user; ?></td>
                            <td><?php echo $total; ?></td>
                            <td><?php echo $trans_type; ?></td>
                            <td class="hidden-xs">
                                <!-- <button class="create-new-btn" onclick="window.location.href='sale_bill.php?id=<?php //echo $row['id']; ?>';">View Details</button> -->

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
            <?php } ?>
        </div>
    </div>
</div> <!-- / End user-wrapper -->


<script>
function searchFilter(page_num) {
    page_num = page_num ? page_num : 0;
    var keywords = $('#keywords').val();
    var sortBy = $('#sortBy').val();
    $.ajax({
        type: 'POST',
        url: 'transaction_search.php',
        data: 'page=' + page_num + '&keywords=' + keywords + '&sortBy=' + sortBy,
        beforeSend: function() {
            $('.loading-overlay').show();
        },
        success: function(html) {
            $('#transaction_content').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
    });
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
    integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
</script>
<?php

include("includes/template/footer.php");
?>