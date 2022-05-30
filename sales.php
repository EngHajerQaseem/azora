<?php
include("includes/template/header.php");
include("connect.php");
//Include pagination class file
include('pagination.php');
?>
<div class="products-page">
    <div class="product-header">
        <div class="row">
            <div class="col-lg-4  col-12">
                <!-- <div class="dropdown">
                     <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        All Sales
                    </button> 
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Recent </a>
                        <a class="dropdown-item" href="#">Categroy Name</a>
                        <a class="dropdown-item" href="#">Categroy Name</a>
                    </div>
                </div> -->
                <h3 class="page-title"><?php echo _("Page_Title_sales");?></h3>
            </div>

            <div class="col-lg-4  col-12">
                <div class="input-group ">
                    <input class="form-control" type="text" id="keywords"
                        placeholder="<?php echo _("sales_search_by_customer"); ?>" onkeyup="searchFilter()" />
                    <!-- <input class="form-control my-0 py-1" id="search_text" type="text" placeholder="Search Sales" aria-label="Search"> -->
                    <div class="input-group-append">
                        <span class="input-group-text search-icon" id="basic-text1"><i class="fa fa-search text-white"
                                aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4  col-12  d-flex justify-content-end">
                <!-- <a class="btn main-btn" href="#">Add New Sale</a> -->
            </div>

        </div>
    </div>

    <div class="user-wrapper">
        <div class="loading-overlay">
            <div class="overlay-content"><?php echo _("sales_loading"); ?></div>
        </div>
        <div id="sales_content">
            <?php

            $limit = 10;

            //get number of rows
            $queryNum = $mysqli->query("SELECT COUNT(sale.id) as salesNum , COUNT(refund.id) as refundNum FROM sale  LEFT JOIN refund ON sale.id = refund.sale_id");
            $resultNum = $queryNum->fetch_assoc();
            $rowCount = $resultNum['salesNum']+$resultNum['refundNum'];

            //initialize pagination class
            $pagConfig = array(
                'totalRows' => $rowCount,
                'perPage' => $limit,
                'link_func' => 'searchFilter'
            );
            $pagination =  new Pagination($pagConfig);

            // Count Rows and number them
            $counter = 0;

            //get rows
            $query =$mysqli->query("(SELECT sale.id AS 'Invoice_No', date(sale.created_at) AS 'date', sale.sub_total AS 'total', sale.paid AS 'paid', CONCAT(customer.fname, ' ', customer.lname) AS 'customer', user.full_name AS 'user','Sale' as Type_of_Transaction ,1 as ordering
                                        FROM ((sale 
                                        LEFT JOIN customer ON sale.customer_id = customer.id)
                                        LEFT JOIN user ON sale.user_id = user.id) WHERE sale.archive = 0
                                       )
                                       
                                        UNION 
                                        (SELECT refund.id AS 'Invoice_No', date(refund.created_at) AS 'date', refund.sub_total AS 'total', refund.paid AS 'paid', CONCAT(customer.fname, ' ', customer.lname) AS 'customer', user.full_name AS 'user','Refund' as Type_of_Transaction,2 as ordering
                                        FROM ((refund 
                                        LEFT JOIN customer ON refund.customer_id = customer.id)
                                        LEFT JOIN user ON refund.user_id = user.id) WHERE refund.archive = 0
                                       )
                                       ORDER BY Invoice_No DESC,ordering ASC
                                       limit $limit
                                        ");
                                       // echo $query;
                                         // LIMIT $limit
               // $query=$mysqli->query($query);
            if ($query->num_rows > 0) { ?>
            <div class="users_list">
                <div class=" table-responsive-lg">
                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <th style="width:4em" scope="col">#</th>
                                <th style="width:7em" scope="col"><?php echo _("sales_date"); ?></th>
                                <th style="width:5em" scope="col"><?php echo _("sales_total"); ?></th>
                                <th class="hidden-xs" style="width:10em" scope="col"><?php echo _("sales_paid"); ?></th>
                                <th class="hidden-xs" style="width:15em" scope="col"><?php echo _("sales_customer"); ?>
                                </th>
                                <th class="hidden-xs" style="width:14em" scope="col"><?php echo _("sales_user"); ?></th>
                                <th class="hidden-xs" style="width:15em" scope="col">
                                    <?php echo _("sales_Type_Of_Transaction"); ?></th>
                                <th class="hidden-xs" style="width:12em" scope="col"></th>

                            </tr>
                        </thead>
                        <?php
                         $no=1;
                            while ($row = $query->fetch_assoc()) {
                                $counter++;
                                 $Invoice_No = $row['Invoice_No'];
                                
                                $date =$row['date'];
                                
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
                                    <?php echo $transaction==="Sale" ?  _("sale_transaction") :  _("refund_transaction") ; ?>
                                <td class="hidden-xs align-content-end">
                                    <div class="dropdown">
                                        <button class="create-new-btn main-btn btn" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"
                                            onclick="window.location='sale_bill.php?id=<?php echo $row['Invoice_No'].'&trans='.$transaction;?>'">
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
            <?php } ?>
        </div>
    </div>
</div> <!-- / End user-wrapper -->
</div>


</div>

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
    //                             bootbox.alert('<?php echo _("sales_error");?>');
    //                         })
    //                 }
    //             }
    //         }
    //     });
    // });
});
</script>


<script>
function searchFilter(page_num) {
    page_num = page_num ? page_num : 0;
    var keywords = $('#keywords').val();
    var sortBy = $('#sortBy').val();
    $.ajax({
        type: 'POST',
        url: 'sales_search.php',
        data: 'page=' + page_num + '&keywords=' + keywords + '&sortBy=' + sortBy,
        beforeSend: function() {
            $('.loading-overlay').show();
        },
        success: function(html) {
            $('#sales_content').html(html);
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