<?php  

include_once("includes/template/language.php");
include('pagination.php');
include("includes/template/functions.php");

if(isset($_POST["inventory_id"]))
{  include("connect.php");
  $output = $output2 = $output3 = '';
  $inventory_id = $_POST["inventory_id"];
  $today = date('Y-m-d');
  
  $limit = 1;

  //
 // Work fine but not search
  // Pagantion count for all details
    $queryNum = $mysqli->query("SELECT COUNT(DISTINCT(inventory.id)) as pId  ,product.name ,product.name_ar
     FROM (((((inventory
INNER JOIN warehouse ON inventory.warehouse_id = warehouse.id)
INNER JOIN product ON inventory.product_id = product.id)
LEFT JOIN subcategory ON product.subcategory_id = subcategory.id)
LEFT JOIN category ON product.category_id = category.id)
LEFT JOIN purchase_orders ON inventory.product_id = purchase_orders.product_id) WHERE inventory.warehouse_id = $inventory_id AND inventory.quantity > 0   ");

    $resultNum = $queryNum->fetch_assoc();
   // $rowCount = mysqli_num_rows($queryNum);
   $rowCount = $resultNum['pId'];
    //initialize pagination class
    $pagConfig = array(
    'totalRows' => $rowCount,
      'perPage' => $limit,
      'link_func' => 'searchFilter'
    );
    $paginationDetail =  new Pagination($pagConfig);
// Pagantion count for normal detail
    $queryNum = $mysqli->query("SELECT COUNT(DISTINCT(inventory.product_id)) as pId  ,product.name ,product.name_ar
     FROM inventory
     INNER JOIN product ON inventory.product_id = product.id   ");
     
     
    
    $resultNum = $queryNum->fetch_assoc();
   // $rowCount = mysqli_num_rows($queryNum);
   $rowCount = $resultNum['pId'];
    //initialize pagination class
    $pagConfig = array(
       'totalRows' => $rowCount,
      'perPage' => $limit,
      'link_func' => 'searchFilter'
    );
    $pagination =  new Pagination($pagConfig);

  // Count Rows and number them
  $counter = 0;


  $query = "SELECT *,inventory.id As invId, product.name AS ProductName,product.name_ar as ProductNameAr, warehouse.name as warehouseName,  SUM(inventory.quantity) AS sumQuantity,inventory.status AS status,date(expiry_date) As expiry,category.id AS catId ,category.name as categoryName,category.nameAR as categoryNameAR, subcategory.name as subCategoryName,subcategory.name_ar as subCategoryNameAr 
  FROM ((((inventory
  INNER JOIN warehouse ON inventory.warehouse_id = warehouse.id)
  INNER JOIN product ON inventory.product_id = product.id)
  LEFT JOIN subcategory ON product.subcategory_id = subcategory.id)
  INNER JOIN category ON product.category_id = category.id)
  WHERE inventory.warehouse_id = $inventory_id AND inventory.quantity > 0 AND inventory.archive = 0 
  GROUP BY product.id
  ORDER BY inventory.id DESC
  limit $limit
 
  ";

  
  $result = mysqli_query($mysqli, $query);
  $num_rows = mysqli_num_rows($result);

  // echo "$num_rows Rows\n";
  
  $output .= '  
  
 
    <div class="table-responsive all-detials">  
    <input type="hidden" value='.$inventory_id.' id="wareID">
      <table class="table">
        <thead>
          <tr>
            <th style="width:9em" scope="col">'._("inventory_fetch_name").'</th>
            <th class="hidden-xs" style=" width:20em" scope="col">'._("inventory_fetch_category").'</th>
            <th class="hidden-xs" style=" width:20em" scope="col">'._("inventory_fetch_sub_category").'</th>
            <th style="width:3em" scope="col">'._("inventory_fetch_quantity").'</th>            
            <th style="width:5em" class="align-content-end"><div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              '._("inventory_fetch_action").'
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  '.
                  //<a class="dropdown-item" href="purchase_order_add.php"> Add a purchase </a>
                  //<a class="dropdown-item" href="#"> Select all products </a>
                  //<a class="dropdown-item" href="reports.php"> Report all products </a>
                  '<a class="dropdown-item show-expired" href="#"> '._("inventory_fetch_show_ruined_and_expired").' </a>
                  <a class="dropdown-item moreDetials" href="#" > '._("inventory_fetch_show_all_detalis").' </a>
              </div>
            </th>
          </tr>
        </thead>
           
  ';
  if (empty($result)) {
    echo _("inventory_fetch_nothing_here");
  }
  
  // if ( mysqli_fetch_array($result) >0){
    while($row = mysqli_fetch_array($result))
    {
      $switch = $row['status'] == 0 ? ' ' : 'checked';
      $name=checkProductsNames($row['ProductName'],$row['ProductNameAr']);
      $categoryName=checkProductsNames($row['categoryName'],$row['categoryNameAR']);
      $subCategoryName=checkProductsNames($row['subCategoryName'],$row['subCategoryNameAr']);
      $output .= '
        <tr>   
          <td >'.$name.'</td> 
          <td class="hidden-xs">'.$categoryName.'</td>  
          <td class="hidden-xs">'.$subCategoryName.'</td>  
          <td >'.$row["sumQuantity"].'</td>            
          
          <td >'.
            // <div class="dropdown">
            //   <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            //   Action
            //   </button>
            //   <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            //     <a class="dropdown-item" href="#"><i class="fa fa-eye"></i>  Select product </a>
            //     <a class="dropdown-item" data-toggle="modal" data-target="#inventModel" data-whatever="'.$row["invId"].'" href="javascript:void(0)"><i class="fa fa-edit"></i>  Edit </a>
            //   </div>
            '</div>
          </td>  
        </tr>
      ';
    }
      $output .= '</table>'.( $pagination->createLinks()).'</div>';
      echo $output;


////////////////////////////////////////////////
      // Start table with all details //
////////////////////////////////////////////


$query_dtls = "SELECT *,inventory.id As invId,product.name AS ProductName,product.name_ar as ProductNameAr, warehouse.name as warehouseName, inventory.status AS status,date_format(inventory.expiry_date, '%Y-%m-%d') As expiry,category.id AS catId ,category.name as categoryName,category.nameAR as categoryNameAR, subcategory.name as subCategoryName,subcategory.name_ar as subCategoryNameAr 
  FROM (((((inventory
  INNER JOIN warehouse ON inventory.warehouse_id = warehouse.id)
  INNER JOIN product ON inventory.product_id = product.id)
  INNER JOIN subcategory ON product.subcategory_id = subcategory.id)
  INNER JOIN category ON product.category_id = category.id)
  INNER JOIN purchase_orders ON inventory.product_id = purchase_orders.product_id) WHERE inventory.warehouse_id = $inventory_id AND inventory.quantity > 0  GROUP BY inventory.id
  ORDER BY inventory.id DESC
  LIMIT $limit
   ";
  $result_dtls = mysqli_query($mysqli, $query_dtls);
  $output2 .= '  
    <div class="table-responsive hidden_details t_details">  
      <table class="table">
        <thead>
          <tr>
            <th style="width:5em" scope="col">'._("inventory_fetch_name").'</th>
            <th class="hidden-xs" style=" width:20em" scope="col">'._("inventory_fetch_category").'</th>
            <th class="hidden-xs" style=" width:20em" scope="col">'._("inventory_fetch_sub_category").'</th>
            <th class="hidden-xs" style="width:10em" scope="col">'._("inventory_fetch_quantity").'</th>
            <th style="width:3em" scope="col">'._("inventory_fetch_total_cost").'</th>
            <th class="hidden-xs" style="width:20em" scope="col">'._("inventory_fetch_expiray_date").'</th>
            <th style="width:5em" class="align-content-end"><div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              '._("inventory_fetch_action").'
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  '.
                  //<a class="dropdown-item" href="purchase_order_add.php"> Add a purchase </a>
                  //<a class="dropdown-item" href="#"> Select all products </a>
                  //<a class="dropdown-item" href="reports.php"> Report all products </a>
                  '<a class="dropdown-item show-expired" href="#"> '._("inventory_fetch_show_ruined_and_expired").' </a>
                  <a class="dropdown-item moreDetials" href="#" > '._("inventory_fetch_show_all_detalis").' </a>
              </div>
            </th>
          </tr>
        </thead>
           
  ';
  // if ( mysqli_fetch_array($result) >0){
    while($row2 = mysqli_fetch_array($result_dtls))
    {
      $name=checkProductsNames($row2['ProductName'],$row2['ProductNameAr']);
      $categoryName=checkProductsNames($row2['categoryName'],$row2['categoryNameAR']);
      $subCategoryName=checkProductsNames($row2['subCategoryName'],$row2['subCategoryNameAr']);
      $output2 .= '
        <tr>   
          <td >'.$name.'</td> 
          <td class="hidden-xs">'.$categoryName.'</td>  
          <td class="hidden-xs">'.$subCategoryName.'</td>  
          <td class="hidden-xs">'.$row2["quantity"].'</td>   
          <td >'.$row2["price_of_purchase"].'</td>  
          <td class="hidden-xs">'.$row2["expiry"].'</td>  
          
          <td >'.
            // <div class="dropdown">
            //   <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            //   Action
            //   </button>
            //   <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            //     <a class="dropdown-item" href="#"><i class="fa fa-eye"></i>  Select product </a>
            //     <a class="dropdown-item" data-toggle="modal" data-target="#inventModel" data-whatever="'.$row["invId"].'" href="javascript:void(0)"><i class="fa fa-edit"></i>  Edit </a>
            //   </div>
            '</div>
          </td>  
        </tr>
      ';
    }
    $output2 .= '</table>'.( $paginationDetail->createLinks()).'</div>';
    echo $output2;


    ////////////////////////////////////////////////
          // Start table with ruined and expired //
    ////////////////////////////////////////////


    $query_expired = "SELECT *,inventory.id As invId,product.name AS ProductName,product.name_ar as ProductNameAr, warehouse.name as warehouseName, inventory.status AS status, date_format(inventory.expiry_date, '%Y-%m-%d') As expiry,category.id AS catId ,category.name as categoryName,category.nameAR as categoryNameAR, subcategory.name as subCategoryName,subcategory.name_ar as subCategoryNameAr 
    FROM (((((inventory
    INNER JOIN warehouse ON inventory.warehouse_id = warehouse.id)
    INNER JOIN product ON inventory.product_id = product.id)
    INNER JOIN subcategory ON product.subcategory_id = subcategory.id)
    INNER JOIN category ON product.category_id = category.id)    
    INNER JOIN purchase_orders ON inventory.product_id = purchase_orders.product_id) WHERE inventory.warehouse_id = $inventory_id AND inventory.quantity > 0 AND date_format(inventory.expiry_date, '%Y-%m-%d') <= ('$today') GROUP BY inventory.id

    ORDER BY inventory.id DESC
    LIMIT $limit
    ";
    $result_expired = mysqli_query($mysqli, $query_expired);
    $output3 .= '  
    <div class="modal-body" id="inventory_detail"> </div>
      <div class="table-responsive hidden_details t-expired">  
        <table class="table">
          <thead>
            <tr>
              <th style="width:9em" scope="col">'._("inventory_fetch_name").'</th>
              <th class="hidden-xs" style=" width:20em" scope="col">'._("inventory_fetch_category").'</th>
              <th class="hidden-xs" style=" width:20em" scope="col">'._("inventory_fetch_sub_category").'</th>
              <th class="hidden-xs" style="width:10em" scope="col">'._("inventory_fetch_quantity").'</th>
              <th style="width:3em" scope="col">'._("inventory_fetch_total_cost").'</th>
              <th class="hidden-xs" style="width:15em" scope="col">'._("inventory_fetch_expiray_date").'</th>
              <th style="width:5em" class="align-content-end"><div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                '._("inventory_fetch_action").'
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    '.
                    //<a class="dropdown-item" href="purchase_order_add.php"> Add a purchase </a>
                    //<a class="dropdown-item" href="#"> Select all products </a>
                    //<a class="dropdown-item" href="reports.php"> Report all products </a>
                    '<a class="dropdown-item show-expired" href="#"> '._("inventory_fetch_show_ruined_and_expired").' </a>
                    <a class="dropdown-item moreDetials" href="#" > '._("inventory_fetch_show_all_detalis").' </a>
                </div>
              </th>
            </tr>
          </thead>            
    ';
      while($row3 = mysqli_fetch_array($result_expired))
      {
        $name=checkProductsNames($row3['ProductName'],$row3['ProductNameAr']);
        $categoryName=checkProductsNames($row3['categoryName'],$row3['categoryNameAR']);
        $subCategoryName=checkProductsNames($row3['subCategoryName'],$row3['subCategoryNameAr']);
        $output3 .= '
          <tr>   
            <td >'.$name.'</td> 
            <td class="hidden-xs">'.$categoryName.'</td>  
            <td class="hidden-xs">'.$subCategoryName.'</td>  
            <td class="hidden-xs">'.$row3["quantity"].'</td>   
            <td >'.$row3["price_of_purchase"].'</td>  
            <td class="hidden-xs">'.$row3["expiry"].'</td>  
            
            <td >'.
              // <div class="dropdown">
              //   <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              //   Action
              //   </button>
              //   <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              //     <a class="dropdown-item" href="#"><i class="fa fa-eye"></i>  Select product </a>
              //     <a class="dropdown-item" data-toggle="modal" data-target="#inventModel" data-whatever="'.$row["invId"].'" href="javascript:void(0)"><i class="fa fa-edit"></i>  Edit </a>
              //   </div>
              '</div>
            </td>  
          </tr>
        ';
      }
      $output3 .= '</table>'.( $paginationDetail->createLinks()).'</div>';
      echo $output3;
  
  } 
?>
<?php  ?>

<!-- Price Edit Modal -->
<div class="modal fade" id="inventModel" tabindex="-1" role="dialog" aria-labelledby="PriceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only"><?php  echo _("inventory_fetch_close"); ?></span></button>
            </div>
            <div class="dash">
            </div>
        </div>
    </div>
</div>


<!--------------------- Edit Price ------------------------>
<script>
$('#inventModel').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var recipient = button.data('whatever')
    var modal = $(this);
    var dataString = 'id=' + recipient;

    $.ajax({
        type: "GET",
        url: "inventory_edit.php",
        data: dataString,
        cache: false,
        success: function(data) {
            console.log(data);
            modal.find('.dash').html(data);
        },
        error: function(err) {
            console.log(err);
        }
    });
})
</script>

<script type="text/javascript">
$(function() {
    $('.moreDetials').click(function() {
        console.log("more");
        $('.t_details').show();
        $('.all-detials,.t-expired').hide();
    });
    $('.show-expired').click(function() {
        console.log("expired");
        $('.t-expired').show();
        $('.all-detials,.t_details').hide();
    });
});
</script>

<script>
function searchFilter(page_num) {
    var moreSearch = document.querySelector(".t_details");
    var moreDisplay = moreSearch.style.display;
    console.log("serch inventory fetch")
    page_num = page_num ? page_num : 0;
    var keywords = $('#keywords').val();
    var sortBy = $('#sortBy').val();
    var warehouseId = $('#wareID').val();

    $.ajax({
        type: 'POST',
        url: 'inventory_search.php',
        data: 'page=' + page_num + '&keywords=' + keywords + '&sortBy=' + sortBy + '&warehouseId=' +
            warehouseId + "&moreDisplay=" + moreDisplay,
        beforeSend: function() {
            $('.loading-overlay').show();
        },
        success: function(html) {
            $('#inventory_detail').html(html);
            $('.loading-overlay').fadeOut("slow");
            if (moreDisplay == "block") {
                $('.t_details').show();
                $('.all-detials,.t-expired').hide();
            }
        }
    });
}
</script>