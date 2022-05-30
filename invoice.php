<?php
session_start();
include("connect.php");




$user_id=1;
$customer_id=$_POST['customer_id'];
$customer=$_POST['customer'];
$sub_total=$_SESSION["payment_details"]['total_price'];
$total_discount=$_SESSION["payment_details"]['total_desc'];
$total_tax=$_SESSION["payment_details"]['tax'];
$collected=$_POST['collected'];
$change=$_POST['change']; 



foreach($_SESSION["shopping_cart"]as $keys => $values)
 {

    $warehouse_id=$values['warehouse_id'];
 }


if($_SERVER["REQUEST_METHOD"] == "POST"){

   
        
       

        // Prepare an insert statement
        $sql = "INSERT INTO sale (customer_id,warehouse_id,user_id,sub_total,discount,total_tax,paid) VALUES (?,?,?,?,?,?,?)";
       
         
        if($stmt = mysqli_prepare($mysqli, $sql)){
            
            mysqli_stmt_bind_param($stmt,"iiiiiii" ,$param_customer_id, $param_warehouse_id,$param_user_id,$param_subtotal,$param_total_discount,$param_total_tax,$param_paid );

            // Bind variables to the prepared statement as parameters
            $param_customer_id = $customer_id;
            $param_warehouse_id = $warehouse_id;
            $param_user_id = 2;                    ///// get the value from user session
            $param_subtotal = $sub_total;
            $param_total_discount = $total_discount;           
            $param_total_tax = $total_tax;
            $param_paid = $collected;
            
           
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){              
               // getting the last id from the previous query
                $id=mysqli_insert_id($mysqli);

                // insert into the sales orders table            
                $sql2 = "INSERT INTO sale_orders (sale_id,product_id,quantity,price,discount,tax) VALUES (?,?,?,?,?,?)";


                if($stmt2 = mysqli_prepare($mysqli, $sql2)){
                mysqli_stmt_bind_param($stmt2,"iiiiii" ,$param_sale_id,$param_product_id,$param_qty, $param_price,$param_discount,$param_tax);

               
                    $param_sale_id = $id;

                    // get the variables value from session
                foreach($_SESSION["shopping_cart"] as $keys => $values){

                   
                    $param_product_id =  $values['product_id'];
                    $param_qty        =  $values['product_quantity'];
                    $param_price      =  $values['product_price'];
                    $param_discount   =  $values['product_discount'];           
                    $param_tax        =  $values['product_tax'];
               
                    
                    mysqli_stmt_execute($stmt2);

                   // query to get the quantity of this product

                    // $select="Select quantity from inventory WHERE product_id=$param_product_id AND  expiry_date=(select MIN(expiry_date) from inventory where product_id=$param_product_id)";

                    $select="Select id as inv_id ,product_id,quantity  from inventory WHERE product_id=$param_product_id Order by expiry_date ASC";
                    $result = mysqli_query($mysqli, $select);
                    $num_rows = mysqli_num_rows($result);
                   
                    while($row = mysqli_fetch_assoc($result)){
                        $pid=$row['product_id'];
                        $inv_id=$row['inv_id'];

                      if($num_rows ==1){
                        $qty=$row['quantity']- $param_qty;
                        
                        $update="UPDATE inventory SET quantity=$qty,updated_at =NOW()  where product_id= $pid AND id=$inv_id ";
                        $stmt3 = $mysqli->prepare($update);
                        $stmt3->execute();
                        $stmt3->close();



                      }
                      else{

                        if($row['quantity']>= $param_qty  ){  

                            $qty=$row['quantity']- $param_qty;
                            // $pid=$row['product_id'];
                            // $inv_id=$row['inv_id'];
                               //  echo $qty;
        
                           $update="UPDATE inventory SET quantity=$qty,updated_at =NOW()  where product_id= $pid AND id=$inv_id ";
                            $stmt3 = $mysqli->prepare($update);
                            $stmt3->execute();
                            $stmt3->close();
                            break;
                        }
                       
                    else{
                       
                       
                        $qty=$param_qty - $row['quantity'];
                        // $pid=$row['product_id'];
                        // $inv_id=$row['inv_id'];

                       // echo $qty;
                        $update="UPDATE inventory SET quantity=0 ,updated_at =NOW()  where product_id= $pid AND id=$inv_id ";
                        $stmt3 = $mysqli->prepare($update);
                        $stmt3->execute();
                        $stmt3->close();
                        $param_qty=$param_qty - $row['quantity'];

                    }
                        

                      }
                   
                     
      

                }

               
                
                }
               
            } 
            
            else{
                echo '<div class="fail-msg"> Sorry Something went wrong </div>';
            }

           // $id = $mysqli->lastInsertId();
        //    $id=mysqli_insert_id($mysqli);
        //     echo $id;
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
        //mysqli_close($mysqli);
        

        
       

      
        // if ($stmt3->error) {
        // echo '<div class="fail-msg"> Sorry Something went wrong </div>';
        // }
        // else {      
        
        // echo '<div class="done-msg"> User Updated Successfully. </div>';
        // }
  
  
}


}




?>
<div class="modal fade" id="InvoiceModal" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!-- <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Invoice</h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
      <div class="modal-body">
          <div class="invoice-header text-center">
          <h5>Store Name</h5>
          <p>Yemen - Sana'a -Haddah street</p>
          <p>(967) - 711111111</p>
          <img src="layout/images/QR.png" />

          </div>


          <div class="invoice-details">
             <div class="row">
                <div class="col-md-4">
                    <div class="invoice-details-title">
                    <p>Invoice No</p>
                     </div>   
                  
                </div>
                <div class="col-md-8">
                   <?php
               $query = $mysqli->query("SELECT id ,created_at as sale_date FROM sale ORDER BY id DESC LIMIT 1");
             
              
                if($query->num_rows > 0){
                   
                    while($row = $query->fetch_assoc())
                    { 
              
                        $saleid = $row['id'];
                        $date=$row['sale_date'];

                   ?>

                 

                   <p><?php echo $saleid ;?></p>


                   <?php 
               }
            }
       
                   
                   ?>
                </div>

                </div>

                <div class="row">
                <div class="col-md-4">
                    <div class="invoice-details-title">
                    <p>Date</p>
                     </div>   
                  
                </div>
                <div class="col-md-8">
                   <p><?php echo $date; ?></p>
                </div>
                </div>

                <div class="row">
                <div class="col-md-4">
                    <div class="invoice-details-title">
                    <p>Cashier</p>
                     </div>   
                  
                </div>
                <div class="col-md-8">
                   <p>Abdo Qassem</p>
                </div>
            </div>

                <div class="row">
                <div class="col-md-4">
                    <div class="invoice-details-title">
                    <p>Customer Name</p>
                     </div>   
                  
                </div>
                <div class="col-md-8">
                   <p><?php echo $customer ;?></p>
                </div>
             </div>

         </div>

         <div class="invoice-product">

         <div class="invoice-product-header">
                            <div class="row">
                                <div class="col-md-5">
                                    <p>Product</p>

                                </div>
                                <div class="col-md-2">
                                    <p>Quantity</p>

                                </div>

                                <div class="col-md-2">
                                    <p>Price</p>

                                </div>

                                <div class="col-md-2">
                                    <p>Total</p>

                                </div>

                            </div>


                        </div>


                        <div class="invoice-product-body">
                          <?php
                         $sql = " SELECT sale_orders.product_id,sale_orders.quantity, product.name, sale_orders.price,sale_orders.discount,product.code
                         FROM sale_orders
                         INNER JOIN product ON sale_orders.product_id= product.id 
                         WHERE sale_orders.sale_id=$id
                        ";
                           if($result = mysqli_query($mysqli, $sql)){
                            if(mysqli_num_rows($result) > 0){
                               
                           while($row = mysqli_fetch_array($result)){



                          ?>
                            <div class="row">
                                <div class="col-md-5">
                                  
                                    <p><?php echo $row["name"]; ?></p>
                                    <p><?php echo $row["code"]; ?></p>

                                </div>
                                <div class="col-md-2 text-center">
                                    <p><?php echo $row["quantity"];  ?></p>

                                </div>

                                <div class="col-md-2">
                                    <p>$<?php echo $row["price"]; ?></p>

                                </div>

                                <div class="col-md-2">

                                <?php
                                $total=$row["quantity"] * $row["price"];
                                $dis=$total*$row["discount"]/100;
                                
                                ?>
                                    <p>$<?php echo $total-$dis;?></p>

                                </div>

                            </div>
                            <hr>
                             <?php
                             
                           }
                        }
                    }
                         
                             ?>

                      

                        </div>


                       
            </div>

            <div class="invoice-summary">
              <p>Summary</p>


              <?php
               $query = $mysqli->query("SELECT * FROM sale ORDER BY id DESC LIMIT 1");
             
              
               if($query->num_rows > 0){
                  
                   while($row = $query->fetch_assoc())
                   { 
              
              ?>
                           <div class="row">
                               <div class="col-md-5">
                                    <p>Subtotal</p>
                                 </div>
                                 <div class="col-md-6">
                                    <p>$<?php echo $row['sub_total']; ?></p>
                                 </div>
                           </div>


                           <div class="row">
                               <div class="col-md-5">
                                    <p>Tax</p>
                                 </div>
                                 <div class="col-md-6">
                                    <p>%<?php echo $row['total_tax'];?></p>
                                 </div>
                           </div>

                           <div class="row">
                               <div class="col-md-5">
                                    <p>Discount</p>
                                 </div>
                                 <div class="col-md-6">
                                
                                    <p>%<?php echo $row['discount'];?></p>

                                   
                                 </div>
                           </div>

                           

                        </div>


                        <div class="invoice-payment">
              
                           <div class="row">
                               <div class="col-md-5">
                                    <p>Total Amount</p>
                                 </div>
                                 <div class="col-md-6">
                                    <p>$<?php 
                                    echo $_SESSION["payment_details"]['total_Amount'];
                                    
                                    ?></p>
                                 </div>
                           </div>


                           <div class="row">
                               <div class="col-md-5">
                                    <p>Cash</p>
                                 </div>
                                 <div class="col-md-6">
                                    <p>$ <?php echo $row['paid']; ?></p>
                                 </div>
                           </div>

                           <div class="row">
                               <div class="col-md-5">
                                    <p>Change</p>
                                 </div>
                                 <div class="col-md-6">
                                    <p>$ <?php echo $change; ?></p>
                                 </div>
                           </div>

                           <?php 
                                    
                   }
                }
                                    
                                    ?> 

                        </div>

                        <div class="invoice-footer text-center">
                        <img src="layout/images/barcode.png" />

                            <p>Thank you For shopping</p>
                         </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary hide-invoice" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn main-btn">Print</button>
      </div>
    </div>
  </div>
</div>

<?php 

mysqli_close($mysqli);

?>
