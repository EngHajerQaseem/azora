<?php

include_once("includes/template/language.php");

if (isset($_POST['page'])) {
    //Include pagination class file
    include('pagination.php');

    //Include database configuration file
    include('connect.php');
    include("includes/template/functions.php");

    $inventory_id = $_POST["warehouseId"];
    
   
    
     $output = $output2 = $output3 = '';
     $today = date('Y-m-d');
    $start = !empty($_POST['page']) ? $_POST['page'] : 0;
    $limit = 1;

    //set conditions for search
    $whereSQL = $orderSQL = '';
    $keywords = $_POST['keywords'];
    $sortBy = $_POST['sortBy'];

    $allDetail=$_POST['moreDisplay'];
    if (!empty($keywords)) {
       // $whereSQL = "where inventory.warehouse_id=".$inventory_id." AND inventory.archive  = 0  AND product.name LIKE '%" . $keywords . "%' " ;
       if($_SESSION["language"] == "ar_EG"){
         
        $whereSQL = " where  inventory.archive  = 0 
        AND(
        (product.name_ar LIKE '%".$keywords."%' AND product.name IS NULL)
        OR
        (product.name LIKE '%".$keywords."%' AND product.name_ar IS NULL)
        OR
        (product.name_ar LIKE '%".$keywords."%')
        )

        AND inventory.warehouse_id=$inventory_id

        AND product.archive = 0 ";

      
      }
      else{
       
        $whereSQL = " where inventory.archive  = 0 
        AND(
        (product.name LIKE '%".$keywords."%' AND product.name_ar IS NULL )
        OR 
        (product.name_ar LIKE '%".$keywords."%' AND product.name IS NULL )
        OR
        (product.name LIKE '%".$keywords."%')
        )

        AND inventory.warehouse_id=$inventory_id

        AND product.archive = 0 ";
       
      
      }
    }
    else{
      $whereSQL = "where inventory.archive  = 0 AND inventory.warehouse_id=$inventory_id ";
    }
    if (!empty($sortBy)) {
        $orderSQL = " ORDER BY id " . $sortBy;
    } else {
        $orderSQL = " ORDER BY id DESC ";
    }

   
    $var_value = "hhhhhhhhhhhhhhhhhhhhhhhh";
    $_SESSION['varname'] = $var_value;

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
        'currentPage' => $start,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'searchFilter'
    );
    $paginationDetail =  new Pagination($pagConfig);
// Pagantion count for normal detail
    $queryNum = $mysqli->query("SELECT COUNT(DISTINCT(inventory.product_id)) as pId  ,product.name ,product.name_ar
     FROM inventory
     INNER JOIN product ON inventory.product_id = product.id  $whereSQL ");
     
     
    
    $resultNum = $queryNum->fetch_assoc();
   // $rowCount = mysqli_num_rows($queryNum);
   $rowCount = $resultNum['pId'];
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

   
    $result = $mysqli->query("SELECT *,inventory.id As invId, product.name AS ProductName,product.name_ar as ProductNameAr, warehouse.name as warehouseName, SUM(inventory.quantity) AS sumQuantity,inventory.status AS status,date(expiry_date) As expiry,category.id AS catId ,category.name as categoryName,category.nameAR as categoryNameAR, subcategory.name as subCategoryName,subcategory.name_ar as subCategoryNameAr 
    FROM ((((inventory
    INNER JOIN warehouse ON inventory.warehouse_id = warehouse.id)
    INNER JOIN product ON inventory.product_id = product.id)
    LEFT JOIN subcategory ON product.subcategory_id = subcategory.id)
    LEFT JOIN category ON product.category_id = category.id)
    $whereSQL
    GROUP BY product.id
    ORDER BY inventory.id DESC
      LIMIT $start,$limit");

    $output .= '  

    <input type="hidden" value='.$inventory_id.' id="wareID">
    <div class="table-responsive all-detials">  
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
       echo $_SESSION['varname'];

      $switch = $row['status'] == 0 ? ' ' : 'checked';
      $name=checkProductsNames($row['ProductName'],$row['ProductNameAr']);
      $categoryName=checkProductsNames($row['categoryName'],$row['categoryNameAR']);
      $subCategoryName=checkProductsNames($row['subCategoryName'],$row['subCategoryNameAr']);
      $output .= '
        <tr>   
          <td >'.$name.'</td> 
          <td class="hidden-xs" >'.$categoryName.'</td>  
          <td class="hidden-xs" >'.$subCategoryName.'</td>  
          <td >'.$row["sumQuantity"].'</td>            
          
          <td >
            </div>
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
LEFT JOIN subcategory ON product.subcategory_id = subcategory.id)
LEFT JOIN category ON product.category_id = category.id)
LEFT JOIN purchase_orders ON inventory.product_id = purchase_orders.product_id) WHERE inventory.warehouse_id = $inventory_id AND inventory.quantity > 0  GROUP BY inventory.id
LIMIT $start,$limit
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
          <th  class="hidden-xs" style="width:10em" scope="col">'._("inventory_fetch_quantity").'</th>
          <th style="width:3em" scope="col">'._("inventory_fetch_total_cost").'</th>
          <th  class="hidden-xs" style="width:20em" scope="col">'._("inventory_fetch_expiray_date").'</th>
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
  LEFT JOIN subcategory ON product.subcategory_id = subcategory.id)
  LEFT JOIN category ON product.category_id = category.id)    
  INNER JOIN purchase_orders ON inventory.product_id = purchase_orders.product_id) WHERE inventory.warehouse_id = $inventory_id AND inventory.quantity > 0 AND date_format(inventory.expiry_date, '%Y-%m-%d') <= ('$today') GROUP BY inventory.id
LIMIT $start,$limit
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
    while($row3 = mysqli_fetch_array($result_expired))
    {
      $name=checkProductsNames($row3['ProductName'],$row3['ProductNameAr']);
      $categoryName=checkProductsNames($row3['categoryName'],$row3['categoryNameAR']);
      $subCategoryName=checkProductsNames($row3['subCategoryName'],$row3['subCategoryNameAr']);
      $output3 .= '
        <tr>   
          <td >'.$name.'</td> 
          <td class="hidden-xs" >'.$categoryName.'</td>  
          <td class="hidden-xs" >'.$subCategoryName.'</td>  
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
    $output3 .= '</table>'.( $pagination->createLinks()).'</div>';
    echo $output3;
   
} 
?>
<?php  ?>


<script type="text/javascript">
$(function() {
    $('.moreDetials').click(function() {
        console.log(" more search");
        $('.t_details').show();
        $('.all-detials,.t-expired').hide();
    });
    $('.show-expired').click(function() {
        console.log("expired search");
        $('.t-expired').show();
        $('.all-detials,.t_details').hide();
    });
});
</script>