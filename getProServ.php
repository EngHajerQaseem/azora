<?php
session_start();
  include_once("connect.php");
if(isset($_GET["typeOf"])){
    if($_GET["typeOf"]=="service"){
         $sql = "SELECT id , name  ,name_ar   FROM services where id!=0";
                                    $stmt = mysqli_prepare($mysqli,$sql);


                        // Extract result set and loop rows
                    if($stmt->execute()) {
        
        $result = $stmt->get_result();
                            $services=   $result->fetch_all(MYSQLI_ASSOC);
                            echo json_encode( $services)  ;
                    }

    }
    else{
        
            $sql = "SELECT id , name ,name_ar   FROM product";
                                    $stmt = mysqli_prepare($mysqli,$sql);


                        // Extract result set and loop rows
                    if($stmt->execute()) {
        
        $result = $stmt->get_result();
                            $products=   $result->fetch_all(MYSQLI_ASSOC);
                            echo json_encode( $products)  ;
                    }
    }
              
}
?>