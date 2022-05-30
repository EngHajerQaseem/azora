
<?php 



//action.php

session_start();
include('connect.php');
 $total_price=0;
 $sub_total=0;
if(isset($_POST["action"]))
{
 if($_POST["action"] == "add")
 {
  $id=$_POST['product_id'];
 
 
  if(!empty($_SESSION["shopping_cart"]))
  {
     $is_available = 0;
   foreach($_SESSION["shopping_cart"] as $keys => $values)
   {
    if($_SESSION["shopping_cart"][$keys]['product_id'] ==$id)
    {
      $is_available++;
     $_SESSION["shopping_cart"][$keys]['product_quantity'] = $_SESSION["shopping_cart"][$keys]['product_quantity'] + $_POST["qty"];
//         $_SESSION["shopping_cart"][$keys]['product_total']    = $_SESSION["shopping_cart"][$keys]['product_total']+($_SESSION["shopping_cart"][$keys]['product_price'] * $_POST["qty"]);
//    
     
    // $_SESSION["shopping_cart"][$keys]['sub_total']        =  $_SESSION["shopping_cart"][$keys]['sub_total'] +$_SESSION["shopping_cart"][$keys]['product_total'] ;

    
    // echo  $_SESSION["shopping_cart"][$keys]['sub_total'] ;
        
        if($_SESSION["shopping_cart"][$keys]['product_discount']>0){
         $temp_total= $_SESSION["shopping_cart"][$keys]['product_price']* $_SESSION["shopping_cart"][$keys]['product_quantity'];
        $_SESSION["shopping_cart"][$keys]['product_total']= $temp_total-($temp_total*$_SESSION["shopping_cart"][$keys]['product_discount']/100);
            echo $_SESSION["shopping_cart"][$keys]['product_quantity'];
       }
        else{
            
             $_SESSION["shopping_cart"][$keys]['product_total']    = $_SESSION["shopping_cart"][$keys]['product_total']+($_SESSION["shopping_cart"][$keys]['product_price'] * $_POST["qty"]);
        }
    }
  }
  if($is_available == 0){
    $sql = " SELECT product.id, product.name, product.price ,tax.price As tax_price,inventory.warehouse_id
    FROM inventory 
    INNER JOIN product ON inventory.product_id = product.id 
    INNER JOIN tax ON product.tax_id = tax.id
    WHERE inventory.product_id=$id
    GROUP BY inventory.product_id 
    
   ";
    if($result = mysqli_query($mysqli, $sql)){
        if(mysqli_num_rows($result) > 0){
           
       while($row = mysqli_fetch_array($result)){
    
        $total_price = $_POST["qty"] * $row["price"];
        //$sub_total= $_SESSION["shopping_cart"][$keys]['sub_total']+  $total_price;
    
    $item_array = array(
       'product_id'               =>     $_POST["product_id"],  
       'product_name'             =>     $row["name"],  
       'product_price'            =>     $row["price"],  
       'product_quantity'         =>     $_POST["qty"],
       'product_total'            =>     $total_price ,
       'product_tax'              =>     $row["tax_price"],
       'product_discount'         =>     0,
       'total_discount'           =>     $_SESSION["shopping_cart"][$keys]['total_discount'],
      // 'sub_total'                =>     $sub_total
        "warehouse_id"            =>     $row["warehouse_id"]
       );
     $_SESSION["shopping_cart"][] = $item_array;
    // echo $_SESSION["shopping_cart"]['product_name'];
     //echo json_encode($item_array['product_name' ]);
  }
        }
      }
    //  echo "nooo";
  }

  
   
}
	 
	else{
    
    $sql = "SELECT product.id, product.name, product.price ,tax.price As tax_price,inventory.warehouse_id
    FROM inventory 
    INNER JOIN product ON inventory.product_id = product.id
    INNER JOIN tax ON product.tax_id = tax.id
    WHERE inventory.product_id=$id
    GROUP BY inventory.product_id 
    ";

    if($result = mysqli_query($mysqli, $sql)){
        if(mysqli_num_rows($result) > 0){
           
       while($row = mysqli_fetch_array($result)){
    
        $total_price = $_POST["qty"] * $row["price"];
        // $sub_total=  $sub_total+  $total_price;
        // $total_disc=$_POST['total_discount'];   
    
    $item_array = array(
       'product_id'               =>     $_POST["product_id"],  
       'product_name'             =>     $row["name"],  
       'product_price'            =>     $row["price"],  
       'product_quantity'         =>     $_POST['qty'],
       'product_total'            =>     $total_price,
       'product_tax'              =>     $row["tax_price"],
       'product_discount'         =>     0,
       'total_discount'           =>     0   ,
       "warehouse_id"            =>     $row["warehouse_id"]                 
      // 'sub_total'                =>     $sub_total
       );
     $_SESSION["shopping_cart"][] = $item_array;
    // echo $_SESSION["shopping_cart"]['product_name'];
     //echo json_encode($item_array['product_name' ]);
  }
        }
      }
     


 }
 
	
  }


  if($_POST["action"] == "changeQty"){
    
    $id=$_POST['pro_id'];
    $qtyval=$_POST['qtyval'];
    
   
    if(!empty($_SESSION["shopping_cart"]))
    {
       $is_available = 0;
     foreach($_SESSION["shopping_cart"] as $keys => $values)
     {
     
      if($_SESSION["shopping_cart"][$keys]['product_id'] ==$id)
      {   
        $is_available++;
       
       $_SESSION["shopping_cart"][$keys]['product_quantity'] =  $qtyval;
      
      //  $_SESSION["shopping_cart"][$keys]['product_total']    =$_SESSION["shopping_cart"][$keys]['product_total'] -($_SESSION["shopping_cart"][$keys]['product_total'] * $_SESSION["shopping_cart"][$keys]['product_discount'] /100 )  ;
     
       if($_SESSION["shopping_cart"][$keys]['product_discount']>0){
         $temp_total= $_SESSION["shopping_cart"][$keys]['product_price']*$qtyval;
        $_SESSION["shopping_cart"][$keys]['product_total']= $temp_total-($temp_total*$_SESSION["shopping_cart"][$keys]['product_discount']/100);
       }
        else{
            
            $_SESSION["shopping_cart"][$keys]['product_total']= $_SESSION["shopping_cart"][$keys]['product_price']*$qtyval; 
        }
  
      
       echo  $_SESSION["shopping_cart"][$keys]['product_total'];
      }
    }
    if($is_available == 0){
      $sql = " SELECT product.id, product.name, product.price,tax.price As tax_price
      FROM inventory 
      INNER JOIN product ON inventory.product_id = product.id 
      INNER JOIN tax ON product.tax_id = tax.id
      WHERE inventory.product_id=$id
      
     ";
      if($result = mysqli_query($mysqli, $sql)){
          if(mysqli_num_rows($result) > 0){
             
         while($row = mysqli_fetch_array($result)){
      
          $total_price = $total_price + ($_POST["qtyval"] * $row["price"]);
         // $sub_total= $_SESSION["shopping_cart"][$keys]['sub_total']+  $total_price;
      
      $item_array = array(
         'product_id'               =>     $_POST["product_id"],  
         'product_name'             =>     $row["name"],  
         'product_price'            =>     $row["price"],  
         'product_quantity'         =>     $_POST["qtyval"],
         'product_total'            =>     $total_price ,
         'product_tax'              =>     $row["tax_price"],
         'product_discount'         =>      $_SESSION["shopping_cart"][$keys]['product_discount'],
        // 'sub_total'                =>     $sub_total
         );
       $_SESSION["shopping_cart"][] = $item_array;
      // echo $_SESSION["shopping_cart"]['product_name'];
       //echo json_encode($item_array['product_name' ]);
    }
          }
        }
    }
  
    
     
  }
     
  
   
     
     
    
  }






  if($_POST["action"] == "addDiscount"){
    
    $id=$_POST['pro_id'];
    $disc=$_POST['discount'];
    
    if(!empty($_SESSION["shopping_cart"]))
    {
       $is_available = 0;
     foreach($_SESSION["shopping_cart"] as $keys => $values)
     {
      if($_SESSION["shopping_cart"][$keys]['product_id'] ==$id)
      {
        $is_available++;
        $_SESSION["shopping_cart"][$keys]['product_discount']=$disc;
       $_SESSION["shopping_cart"][$keys]['product_total']  =$_SESSION["shopping_cart"][$keys]['product_total']-($_SESSION["shopping_cart"][$keys]['product_total'] * $disc/100) ;
       

  
      
      
      }
         
    }

  }
  }
    
    if($_POST["action"] == "TotalDiscount"){
    
   $total_disc=$_POST['total_discount']; 
    
    if(!empty($_SESSION["shopping_cart"]))
    {
      
     foreach($_SESSION["shopping_cart"] as $keys => $values)
     {
     
     
          
          $_SESSION["shopping_cart"][$keys]['total_discount']=$total_disc;
    }

  }
  }






  if($_POST["action"] == "remove"){
   foreach($_SESSION["shopping_cart"] as $keys => $values)
   {
    if($values["product_id"] == $_POST["product_id"])
   {
     unset($_SESSION["shopping_cart"][$keys]);
   }
   
      }

 
 }
 
}
// $newitem=array(

//   'total_price'                =>     0,  
//    'tax'                       =>    0,  
//    'total_Amount'              =>    0
//    );

   

//    $newitem2=array(

//     'bla'                =>     100,  
//      'blaaaa'                       =>    200,  
//      'blaaaaaaa'              =>    300
//      );
  
   // $test[]=$_SESSION["shopping_cart"][];

   //$test = array_merge($_SESSION["shopping_cart"],$newitem);
  //  $_SESSION["shopping_cart"][]=$test;
   //array_push($_SESSION["shopping_cart"][], $newitem);
// if(isset($_SESSION['cart2'])){

//     } else {
//         $temp_array = $_SESSION["shopping_cart"];
//         $temp_array[] = $newitem;
//         $_SESSION['cart2'][]= $temp_array;
//     }


  // array_push($_SESSION["shopping_cart"],$newitem);
 //print_r($test);

//  $arr = $_SESSION["shopping_cart"]; 
          
// // New element to be added at 'zero' => 0 
  
// // Create an array using the new element 
//  $temp =$newitem; 
      
// // // Append the $temp in the beginning of $arr 
      
// // // Using array union(+) operator 
//   $arr2 = $newitem + $_SESSION["shopping_cart"]; 
      
// // //echo "Result of array union(+) : "; 
// // //print_r($arr2); 
      
// // // Using array_merge() function 
 // $arr3 = array_merge( $newitem2,$newitem); 
      
// echo "\n" . "Result of array_merge() : "; 
 //print_r($arr3);
// $_SESSION['test'][]=$arr3


//echo "\n" . "Result of session : "; 
//var_dump($_SESSION["shopping_cart"]);
  
 ?>


 

