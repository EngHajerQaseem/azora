<?php
include_once("includes/template/language.php");
if (isset($_POST['page'])) {
    //Include pagination class file
    include('pagination.php');

    //Include database configuration file
    include('connect.php');
    include("includes/template/functions.php");

    $start = !empty($_POST['page']) ? $_POST['page'] : 0;
    $limit = 8;

    //set conditions for search
    $whereSQL = $orderSQL = '';
    $keywords = $_POST['keywords'];
    $sortBy = $_POST['sortBy'];
    if (!empty($keywords)) {
       // $whereSQL = "WHERE name LIKE '%" . $keywords . "%'";

       if($_SESSION["language"] == "ar_EG"){
        $whereSQL = "WHERE 
        
        (nameAR LIKE '%".$keywords."%' AND name IS NULL)
        OR
        (name LIKE '%".$keywords."%' AND nameAR IS NULL)
        OR
        (nameAR LIKE '%".$keywords."%')
        
        AND archive = 0";

       
      }
      else{
        $whereSQL = "WHERE 
        (name LIKE '%".$keywords."%' AND nameAR IS NULL)
        OR 
        (nameAR LIKE '%".$keywords."%' AND name IS NULL)
        OR
        (name LIKE '%".$keywords."%')
        AND archive = 0";
        
      
      }
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
    $queryNum = $mysqli->query("SELECT COUNT(id) as categoryNum FROM category " . $whereSQL);

    // $queryNum = $mysqli->query("SELECT * FROM (SELECT COUNT(purchase.id) as purchaseNum, CONCAT(suppliers.fname, ' ', suppliers.lname) AS 'supplier'
    //                             FROM purchase
    //                             INNER JOIN suppliers ON purchase.supplier_id = suppliers.id 
    //                             ) AS data ".$whereSQL);

    $resultNum = $queryNum->fetch_assoc();
    $rowCount = $resultNum['categoryNum'];

    //initialize pagination class
    $pagConfig = array(
        'currentPage' => $start,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'categorySearchFilter'
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
    $query = $mysqli->query("SELECT id AS 'id', name AS 'categoryName', nameAR as 'categoryNameAR'
                            FROM category 
                            $whereSQL
                            ORDER BY id ASC
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
    <table class="table table-hover ">
        <thead>
            <tr>
                <th scope="col"><?php echo _("Category_Search_Name");?></th>
                <!-- <th scope="col"><?php echo _("Category_Search_Status");?></th>
                        <th scope="col"></th> -->
            </tr>
        </thead>
        <?php
                        while ($row = $query->fetch_assoc()) {
                            $counter++;
                            $name = checkProductsNames($row['categoryName'],$row['categoryNameAR']);
                           // $status = $row['status'];
                            ?>
        <!-- content -->
        <tbody>
            <tr>
                <td><?php echo $name; ?></td>
                <!-- <td>
                                <label class="switch">
                                    <?php
                                                // if ($status == 1) {
                                                //     echo '<input type="checkbox" checked onclick="return false;">';
                                                // } else {
                                                //     echo '<input type="checkbox" onclick="return false;">';
                                                // }
                                                ?>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td class="align-content-end">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php //echo _("Category_Search_Action");?>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#"><i class="fa fa-edit"></i> <?php //echo _("Category_Search_Edit");?> </a>
                                        <a class="dropdown-item delete_cat" data-cat-id="<?php //echo $row["id"]; ?>" href="javascript:void(0)"><i class="fa fa-trash"></i>  <?php echo _("Category_Search_Delete");?> </a>
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
    $('.delete_cat').click(function(e) {
        e.preventDefault();
        var catid = $(this).attr('data-cat-id');
        var parent = $(this).parent(".dropdown-menu").parent(".dropdown").parent("td").parent("tr");
        bootbox.dialog({
            message: "<div class='delete_user_popup'><div class='icon-trash'><i class='fas fa-trash'></i></div><div class='delete-text'><?php echo _("Category_Search_delete_alert_message"); ?></div></div>",
            title: "<i class='glyphicon glyphicon-trash'></i>",
            buttons: {
                success: {
                    label: "<?php echo _("Category_Search_alert_cancel"); ?>",
                    className: "btn-normal",
                    callback: function() {
                        $('.bootbox').modal('hide');
                    }
                },
                danger: {
                    label: "<?php echo _("Category_Search_alert_delete"); ?>!",
                    className: "btn-danger",
                    callback: function() {
                        $.ajax({
                                type: 'POST',
                                url: 'category_rmv.php',
                                data: 'catid=' + catid
                            })
                            .done(function(response) {
                                bootbox.alert(response);
                                parent.fadeOut('slow');
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