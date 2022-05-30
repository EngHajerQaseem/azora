<?php

include("includes/template/header.php");
include("connect.php");
//Include pagination class file
include('pagination.php');
?>
<div class="products-page">

    <div class="product-header">
        <div class="row">
            <div class="col">
                <!-- <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php //echo _("All_purchase_order");?>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#"><?php echo _("Received_purchase_order");?> </a>
            <a class="dropdown-item" href="#"><?php echo _("Sent_purchase_order");?></a>
            <a class="dropdown-item" href="#"><?php echo _("Archived_purchase_order");?></a>
          </div>
        </div> -->
                <h3 class="page-title"><?php echo _("Page_Title_Purchase");?></h3>
            </div>

            <div class="col-lg-4  col-12">
                <div class="input-group md-form form-sm form-1 pl-0">
                    <!-- <input class="form-control my-0 py-1" type="text" placeholder="Search" aria-label="Search"> -->
                    <input class="form-control my-0 py-1" type="text" id="keywords"
                        placeholder="<?php echo _("purchas_order_search_by_user_name");?>" onkeyup="searchFilter()" />

                    <div class="input-group-append">
                        <span class="input-group-text search-icon" id="basic-text1"><i class="fa fa-search text-white"
                                aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>



            <div class="col d-flex justify-content-end">

                <!-- <a class="btn main-btn" href="purchase_order_add.php"><?php echo _("add_new_purchase_order");?></a> -->
            </div>


        </div>
    </div>

    <div class="user-wrapper">
        <div class="loading-overlay">
            <div class="overlay-content"><?php echo _("purchase_order_Loading");?></div>
        </div>
        <div id="purchase_content">
            <?php

      $limit = 10;

      //get number of rows
      $queryNum = $mysqli->query("SELECT COUNT(id) as purchaseNum FROM purchase");
      $resultNum = $queryNum->fetch_assoc();
      $rowCount = $resultNum['purchaseNum'];

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
      $query = $mysqli->query("SELECT purchase.id AS 'PO.NO', date(purchase.created_at) AS 'date', purchase.total AS 'total',purchase.paid AS 'paid', purchase.purchase_status_id AS 'purchase_id', purchase_status.status AS 'PO_status', CONCAT(suppliers.fname, ' ', suppliers.lname) AS 'supplier', user.full_name AS 'user'
                                        FROM (((purchase 
                                        INNER JOIN purchase_status ON purchase.purchase_status_id = purchase_status.id)
                                        INNER JOIN suppliers ON purchase.supplier_id = suppliers.id)
                                        INNER JOIN user ON purchase.user_id = user.id)
                                        where purchase.id!=0
                                        ORDER BY purchase.id DESC
                                        LIMIT $limit");

      if ($query->num_rows > 0) { ?>
            <div class="users_list">
                <div class=" table-responsive">
                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <th style="width:5em" scope="col">#</th>
                                <th style="width:9em" scope="col"><?php echo _("Purchase_order_Date");?></th>
                                <th style="width:5em" scope="col"><?php echo _("Purchase_order_Total");?></th>
                                <th class="hidden-xs" style="width:8em" scope="col">
                                    <?php echo _("Purchase_order_Paid");?></th>
                                <th class="hidden-xs" style="width:10em" scope="col">
                                    <?php echo _("Purchase_order_Status");?></th>
                                <th class="hidden-xs" style="width:10em" scope="col">
                                    <?php echo _("Purchase_order_Supplier");?></th>
                                <th class="hidden-xs" style="width:10em" scope="col">
                                    <?php echo _("Purchase_order_username");?></th>
                                <th class="hidden-xs" style="width:10em" scope="col"></th>
                            </tr>
                        </thead>
                        <?php
           
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
            <?php } ?>
        </div>
    </div>
</div> <!-- / End user-wrapper -->

<!-- <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav> -->

</div>


</div>

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


<script>
function searchFilter(page_num) {
    page_num = page_num ? page_num : 0;
    var keywords = $('#keywords').val();
    var sortBy = $('#sortBy').val();
    $.ajax({
        type: 'POST',
        url: 'purchase_order_search.php',
        data: 'page=' + page_num + '&keywords=' + keywords + '&sortBy=' + sortBy,
        beforeSend: function() {
            $('.loading-overlay').show();
        },
        success: function(html) {
            $('#purchase_content').html(html);
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