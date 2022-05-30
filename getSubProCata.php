<?php
session_start();
  include_once("connect.php");
if(isset($_GET["category"])){
    $cata=$_GET["category"];
  
    $sql = "SELECT id as subCategoryId, subcategory.name AS 'subCategoryName',subcategory.name_ar AS 'subCategoryNameAr' FROM subcategory where category_id= ?";
                              $stmt = mysqli_prepare($mysqli,$sql);

                // Bind params and execute
                $stmt->bind_param("s", $cata);

                // Extract result set and loop rows
               if($stmt->execute()) {
  
  $result = $stmt->get_result();
                    $subCata=   $result->fetch_all(MYSQLI_ASSOC);
                    echo json_encode( $subCata)  ;
               }
              
}
?>