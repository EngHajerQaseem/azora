<?php

session_start();
//$total=0;
$total_price = 0;
$total_item = 0;
$tax=0;
$total_tax=0;
$total_Amount=0;
$total_disc=0;
$output='';





if(!empty($_SESSION["shopping_cart"]))
{
 foreach($_SESSION["shopping_cart"]as $keys => $values)
 {

   
  $output .= '
  <div class="product-holder">
  <div class="row ">
<div class="col-md-5">
    <div class="product_item">
        <i class="fa fa-angle-right more"></i>
<p >'.$values["product_name"].'</p>
   

</div>
</div>
   <div class="col-md-4">
   <div class="product_Quantity">
      
       <div class="">


<div class="def-number-input number-input ">
<button  class="minus btn-number"></button>
<input data-id='.$values["product_id"].' class="quantity" min="1" name="quantity" value="'. $values["product_quantity"].'" type="number">
<input class="quantity" min="1" name="quantity" value="'. $values["product_tax"].'" type="hidden">
<button  class="plus btn-number"></button>
</div>
           <p></p>
       </div>
   </div>
</div>

<div class="col-md-2">
   <div class="product_price">
       <p> $'.$values["product_price"].'</p>
   </div>
</div>
<div class="col-md-1">
                                        <div class="product_delete  ">
                                        <i class="fa fa-trash trash" id="'. $values["product_id"].'"></i>
                                        </div>
                                    </div>

                                    </div>

                                    <div class="more_details">
                                    <div class="row">
                                               <div class="col-md-2">
                                            <div class="product_discount">
                                                <p>Discount(%)</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="product_discount">

                                            
                                             <select id="pro_discount" data-id='.$values["product_id"].'>
                                             <option value="0" >0</option>
                                             <option value="5">5</option>
                                             <option value="10">10</option>
                                             <option value="20">20</option>
                                             </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="product_total">
                                                <p>Total</p>

                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="product_totl">

                                                <p> $'.$values["product_total"].'</p>
                                               
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            </div>
                            
                           
                           
                     
                       
  
';
  
$total_price = $total_price + $values["product_total"] ;
//$total_item = $total_item + 1;
   $tax=$tax+$values["product_tax"];
   $total_tax=  $total_tax+$values["product_total"] * $values["product_tax"] / 100;
   $total_disc=$total_disc+ $values["product_total"] * $values["total_discount"] / 100; 
   
   $total_Amount= $total_price +$total_tax -$total_disc;
// $total= $total+ $values["product_total"]-($values["product_total"] * $values["product_discount"] /100);

     
 }

 $output .='<div class="cart_footer">
 <p>Order Summary</p>
 <div class="row">
     <div class="col-md-8 ">
         <ul>
             <li>Sub Total</li>
             <li>Tax</li>
             <li>Discount</li>
             <li>Total Amount</li>
         </ul>

     </div>

     <div class="col-md-4">
         <ul>
             <li>$'.$total_price.'</li>
             <li>%'.$tax.'</li>
             
             <li>
             <select   class="total_discount">
             <option  value="'. $values["total_discount"].'" selected>0</option>
             <option value="'. $values["total_discount"].'">5</option>
             <option value="'. $values["total_discount"].'">10</option>
             <option value="'. $values["total_discount"].'">20</option>
             </select>
             </li>
             <li>$'.$total_Amount.'</li>
         </ul>

     </div>


 </div>


</div>';
   
  

}
else
{
 $output .= '<p> Your Cart is Empty! </p> ';
   
 $output .='<div class="cart_footer">
 <p>Order Summary</p>
 <div class="row">
     <div class="col-md-9 ">
         <ul>
             <li>Sub Total</li>
             <li>Tax</li>
             <li>Discount</li>
             <li>Total Amount</li>
         </ul>

     </div>

     <div class="col-md-3">
         <ul>
             <li>$0</li>
             <li>%0</li>
             <li>%<input type="text"  value="0" class="total_discount"/></li>
             <li>$0</li>
         </ul>

     </div>


 </div>


</div>';
   
    
}
$_SESSION["payment_details"]['total_price']= $total_price;
$_SESSION["payment_details"]['tax']=  $tax;
$_SESSION["payment_details"]['total_desc']=  $total_disc;
$_SESSION["payment_details"]['total_Amount']= $total_Amount;



// $newitem=array(

//     'total_price'                =>   $total_price,  
//      'tax'                       =>   $tax,  
//      'total_Amount'              =>   $total_Amount
//      );
    


    //$_SESSION["payment_details"][]=$newitem;
   // print_r($_SESSION["payment_details"]);
// $_SESSION["shopping_cart"][]


//      foreach($_SESSION["shopping_cart"] as $keys => $values)
//  {

//            echo $values['total_price'];
//  }
  //   print_r($_SESSION["shopping_cart"]);

    //$lastsession = $_SESSION["shopping_cart"];

// CHECK IF SESSION IS EMPTY OR NOT
        // if(empty($lastsession)) {
          
        //    echo "yes";
        // } else {
        //     array_push($lastsession, $newitem);
        // }

    // $temp_array = $_SESSION["shopping_cart"];
    // $temp_array[] = $newitem;
    // if(!array_key_exists("total_price",$_SESSION["shopping_cart"])){
    //     $_SESSION["shopping_cart"][] = $newitem;
    //     // echo 'not there';
    // } else {
    //     echo 'it\'s there';
    // }

    // foreach ($_SESSION["shopping_cart"] as $key => $value) {
    //     foreach ($value as $inerKey => $inerValue) {
    //         if(!array_key_exists('total_price',$inerValue)){
    //         $_SESSION["shopping_cart"][] = $newitem;
    //         }
    //     }
    // }

    // if(isset($_SESSION['cart2'])){

    // } else {
    //     $temp_array = $_SESSION["shopping_cart"];
    //     $temp_array[] = $newitem;
    //     $_SESSION['cart2'][]= $temp_array;
    // }



    // $_SESSION["shopping_cart"] = array_unique($_SESSION["shopping_cart"], SORT_REGULAR);

    // foreach($_SESSION["shopping_cart"] as $key => $value) {
    //     if( $key == "total_price"){
    //         echo $value['total_price'];
    //     }
    //   }

    // var_dump($_SESSION['cart2']);
    // var_dump(array_unique($_SESSION["shopping_cart"], SORT_REGULAR));

    // $_SESSION["shopping_cart"]["cart"] = $temp_array;
    // $_SESSION["shopping_cart"][] = $newitem;
//$_SESSION["shopping_cart"]['tax']=  $tax;
//$_SESSION["shopping_cart"]['total_Amount']=  $total_Amount;
     
//    var_dump($_SESSION["shopping_cart"]["cart"]);
//var_dump($_SESSION["shopping_cart"]);
// print_r($_SESSION["shopping_cart"]["cart"]);




//<input type="number" value="'. $values["product_discount"].'" data-id='.$values["product_id"].' class="pro_discount"  />

 
$data = array(
  $output,
 //'total_price'  => '$' . number_format($total_price, 2),
 //'total_item'  => $total_item
); 

echo json_encode($data);


?>
