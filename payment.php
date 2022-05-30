<?php
session_start();
?>

<div class="cash-details">
                           <h2>Cash Payment</h2>
                              <form  method="POST">
                            <div class="row">

                            <div class="col-md-12">
                                <label for="customer">Customer</label> 
                                <select class="form-control " id="customer" >
                                <option value="0">Walk-in</option>
                         <?php
                            include("connect.php");         
                            $sql = "SELECT CONCAT(fname, ' ', lname) as customerName,id as Customer_id
                            FROM customer ";
                           
                           
                           
                           if($result = mysqli_query($mysqli, $sql)){
                               if(mysqli_num_rows($result) > 0){
                                  
                                   while($row = mysqli_fetch_array($result))
                                   {


                            ?>
                                

                                <option value="<?php echo $row['Customer_id'];?>"><?php echo $row['customerName'];?></option>
                              

                                <?php  
                                   }
                               }
                            }
                                ?>
                              </select>
                              </div>
                              
                  

                               <div class="col-md-3">
                               <label>Due &nbsp;</label>
                        <div class="input-group mb-3">
                        
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" class="form-control" value="<?php   echo $_SESSION["payment_details"]['total_Amount'];  ?>" type="number" class="form-control" name="amount" id="amount" readonly />
                             </div>


                             </div>

                             <div class="col-md-3">
                             <label>Collected &nbsp;</label>
                           <div class="input-group mb-3">
                        
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" class="form-control" min="0" value="0" type="number" class="form-control" name="collected" id="collected"/>
                             </div>


                             </div>

                             <div class="col-md-3">
                             <label>Change &nbsp;</label>
                        <div class="input-group mb-3">
                        
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" class="form-control" min="0" value="0" type="number" class="form-control" name="change" id="change"/>
                             </div>


                             </div>

                             <div class="col-md-3">
                                   <label>Method</label>
                                   <input type="text" value="Cash" readonly/>
                             </div>
                             <div class="col-md-12 d-flex justify-content-end  align-text-bottom">
                             <button class="btn main-btn show_invoice" type="submit">Next </button>
                             <button class="btn btn-secondary">Cancel </button>
                             </div>
                            </div>
                        </form>
                        </div>








                      

<!-- Modal -->
