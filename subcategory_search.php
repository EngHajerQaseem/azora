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
        
        (subcategory.name_ar LIKE '%".$keywords."%' AND subcategory.name IS NULL)
        OR
        (subcategory.name LIKE '%".$keywords."%' AND subcategory.name_ar IS NULL)
        OR
        (subcategory.name_ar LIKE '%".$keywords."%')
        
        AND subcategory.archive = 0";

       
      }
      else{
        $whereSQL = "WHERE 
        (subcategory.name LIKE '%".$keywords."%' AND subcategory.name_ar IS NULL)
        OR 
        (subcategory.name_ar LIKE '%".$keywords."%' AND subcategory.name IS NULL)
        OR
        (subcategory.name LIKE '%".$keywords."%')
        AND subcategory.archive = 0";
        
      
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
    $queryNum = $mysqli->query("SELECT COUNT(id) as subcategoryNum FROM subcategory " . $whereSQL);

    // $queryNum = $mysqli->query("SELECT * FROM (SELECT COUNT(purchase.id) as purchaseNum, CONCAT(suppliers.fname, ' ', suppliers.lname) AS 'supplier'
    //                             FROM purchase
    //                             INNER JOIN suppliers ON purchase.supplier_id = suppliers.id 
    //                             ) AS data ".$whereSQL);

    $resultNum = $queryNum->fetch_assoc();
    $rowCount = $resultNum['subcategoryNum'];

    //initialize pagination class
    $pagConfig = array(
        'currentPage' => $start,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'subCategorySearchFilter'
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
    $query = $mysqli->query("SELECT subcategory.id AS 'id' ,subcategory.name AS 'subCategoryName',subcategory.name_ar AS 'subCategoryNameAr' ,subcategory.status AS 'status', category.name AS 'categoryName' , category.nameAR as 'categoryNameAR'
                                                    FROM subcategory 
                                                    INNER JOIN category ON subcategory.category_id = category.id 
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
                <th scope="col"><?php echo _("subcategory_Search_Name");?></th>
                <th scope="col"><?php echo _("subcategory_Search_Status");?></th>
                <!-- <th scope="col"></th>
                        <th scope="col"></th> -->
            </tr>
        </thead>
        <?php
                        while ($row = $query->fetch_assoc()) {
                            $counter++;
                            $name = checkProductsNames($row['subCategoryName'],$row['subCategoryNameAr']);
                            $category_name =checkProductsNames($row['categoryName'],$row['categoryNameAR']);;
                           // $status = $row['status'];
                        ?>
        <!-- content -->
        <tbody>
            <tr>
                <td><?php echo $name; ?></td>
                <td><?php echo $category_name; ?></td>
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
                            </td> -->
                <!-- <td class="align-content-end">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php //echo _("subcategory_Search_Action");?>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#"><i class="fa fa-edit"></i> <?php //echo _("subcategory_Search_Edit");?> </a>
                                        <a class="dropdown-item delete_subcat" data-subcat-id="<?php// echo $row["id"]; ?>" href="javascript:void(0)"><i class="fa fa-trash"></i>  <?php echo _("subcategory_Search_Delete");?> </a>
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
    $('.delete_subcat').click(function(e) {
        e.preventDefault();
        var subcatid = $(this).attr('data-subcat-id');
        var parent = $(this).parent(".dropdown-menu").parent(".dropdown").parent("td").parent("tr");
        bootbox.dialog({
            message: "<div class='delete_user_popup'><div class='icon-trash'><i class='fas fa-trash'></i></div><div class='delete-text'><?php echo _("subcategory_Search_delete_alert_message"); ?></div></div>",
            title: "<i class='glyphicon glyphicon-trash'></i>",
            buttons: {
                success: {
                    label: "<?php echo _("subcategory_Search_alert_cancel"); ?>",
                    className: "btn-normal",
                    callback: function() {
                        $('.bootbox').modal('hide');
                    }
                },
                danger: {
                    label: "<?php echo _("subcategory_Search_alert_delete"); ?>!",
                    className: "btn-danger",
                    callback: function() {
                        $.ajax({
                                type: 'POST',
                                url: 'subcategory_rmv.php',
                                data: 'subcatid=' + subcatid
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