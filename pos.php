<?php
// session_start();
// include("init.php");
include('pagination.php');
?>



         <div class="container">
           <div class="row">
                <div class="col-md-8">
                    <div class="product_list">
                        <div class="input-group md-form form-sm form-1 pl-0">

                            <input class="form-control my-0 py-1" type="text" id="keywords" placeholder="Search by product" onkeyup="searchFilter()"  aria-label="Search">
                            <div class="input-group-append">
                                <span class="input-group-text search-icon" id="basic-text1"><i class="fa fa-search text-white"
                                                            aria-hidden="true"></i></span>
                            </div>
                        </div>

                        <div class="category_list">
                            <!-- <span class="pre_cat"><i class="fa fa-angle-left"></i></span>
                            <span class="next_cat"><i class="fa fa-angle-right"></i></span> -->
                            <div class="cat_slider">
                                <!-- <ul>
                                <li class="btn main_btn all" data-filter=".all" data-cate=".all">All product</li> -->
                                <div class="btn main_btn all" data-filter=".all" onclick="productFilter()">All product</div>
                                <?php
                                $sql = "SELECT * FROM category Where status=1 ";
                            if($result = mysqli_query($mysqli, $sql)){
                                if(mysqli_num_rows($result) > 0){
                                //    $static_url = "http://localhost/Web-azora/azora/search?=";
                                    while($row = mysqli_fetch_array($result)){

                                        ?>
                                   
                                    <!-- <div class="btn cate_btn"   data-filter="<?php //echo $row['id'] ;?>"  data-cate=".<?php //echo $row['category_name'] ;?>"><?php //echo $row['category_name'] ;?></div> -->



                                   <!-- <a href=  "<?php //echo $static_url?><?php //echo $row['category_name'] ;?> "><?php //echo $row['category_name'] ;?><a> -->


                                   <div class="btn cate_btn"  onclick="productFilter(0,<?php echo $row['id'] ;?>)"  data-filter=".<?php echo $row['category_name'] ;?>" ><?php echo $row['category_name'] ;?></div>
                                   <?php
                                   
                                    }
                                }
                            }
                                   ?>
                                <!-- </ul> -->

                            </div>



                        </div>

                        <div class="subcategory_list">
                            <!-- <span class="pre_cat"><i class="fa fa-angle-left"></i></span>
                            <span class="next_cat"><i class="fa fa-angle-right"></i></span> -->
                            <div class="subcat_slider">
                                <!-- <ul> -->

                                <?php
                                $sql = "SELECT subcategory.id as id,subcategory.name,category.id as cate_id, category.category_name
                                 FROM subcategory
                                 INNER JOIN category ON subcategory.category_id = category.id 
                                  where subcategory.status=1";
                            if($result = mysqli_query($mysqli, $sql)){
                                if(mysqli_num_rows($result) > 0){
                                   
                                    while($row = mysqli_fetch_array($result)){

                                        ?>
                                    <div class="btn cate_btn  <?php echo $row['category_name'];?>"  onclick="productFilter(0,<?php echo $row['cate_id'] ;?>,<?php echo $row['id'] ;?>)" ><?php echo $row['name'] ;?></div>
                                  
                                     <?php
                                    }
                                }
                            }
                                     ?>
                                <!-- </ul> -->

                            </div>


                        </div>
                        
                        <div class="products">
                       
                            <div class="row">
                            <div class="loading-overlay"><div class="overlay-content">Loading.....</div></div>
                            <?php
                        //     $query=$db->prepare("SELECT * from product");
                        //    $query->execute();
                        //    $products=$query->fetchAll();
                        // //    //$_SESSION["shopping_cart"]=$products;
                          
                        //     foreach($products as $product){

                            // $page = isset($_GET['page']) ? $_GET['page'] : 1;
                            // $limit = 5;
                            // $start = ($page - 1) * $limit;


                            // $total_pages_sql = "SELECT COUNT(*) FROM inventory";
                            // $result = mysqli_query($mysqli,$total_pages_sql);
                            // $total_rows = mysqli_fetch_array($result)[0];
                            // $total_pages = ceil($total_rows / $limit);
                              

                            $limit =2;

                            //get number of rows
                            $queryNum = $mysqli->query("SELECT COUNT(distinct product_id) as invNum FROM inventory");
                            $resultNum = $queryNum->fetch_assoc();
                            $rowCount = $resultNum['invNum'];
                             
                            //initialize pagination class
                            $pagConfig = array(
                                'totalRows' => $rowCount,
                                'perPage' => $limit,
                                'link_func' => 'searchFilter'
                            );
                            $pagination =  new Pagination($pagConfig);
                
                           
                


                            $query = $mysqli->query("SELECT product.id, product.name, product.price,sum(inventory.quantity) as Quantity ,category.category_name,product.local_image_path as img
                             FROM inventory 
                            
                             INNER JOIN product ON inventory.product_id = product.id 
                             INNER JOIN category ON product.category_id = category.id 
                             WHERE inventory.status=1
                             GROUP BY inventory.product_id
                             order by inventory.product_id ASC
                             LIMIT  $limit
                            
                            ");
                            
                            if($query->num_rows > 0){
                                while($row = $query->fetch_assoc()){ 

                           
                        ?>
                        
						 <div class="col-md-3">
                               <div class="product_container text-center ">    
                                   <?php //echo '<img src="data:image/jpeg;base64,'.base64_encode( $product['key_image'] ).'"/>';?>
                                   <img src="upload/<?php echo $row["img"]; ?>"/>
                                        <input type="hidden"  value="<?php echo $row["id"]; ?>" />
										<p ><?php echo $row["name"]; ?></p>
										<span class="price">$ <?php echo $row["price"];?></span>

                                        
                                        <span class="quantity"><?php echo $row['Quantity'] ;?> in stock</span>
                                   
                                </div>
                               
                                    
                                 
                                    </div>
                               
                             
                                <?php 
                            // }
                        //}
                      
                    }
                                ?>

                        </div>
                        <?php echo $pagination->createLinks(); ?>
                <?php
                    }
                                ?>


                        
           <!-- <nav aria-label="Page navigation example" id="pagination-container">
            <ul class="pagination justify-content-center">
            <li class="page-item">
            <a class="page-link" href="<?php //if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
            </a>
            </li>
            <li class="page-item">
            <a class="page-link" href="<?php //if($page >= $total_pages){ echo '#'; } else { echo "?page=".($page + 1); } ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
            </a>
            </li>
            </ul>
            </nav> -->

           


                          
                        </div>
                        <div class="cash-payment">
                          
                    </div>
                </div>
                    </div>



                    


              

                <div class="col-md-4">
                    <div class="cart">
                        <div class="cart_header">
                            <div class="row">
                                <div class="col-md-5">
                                    <p>Product</p>

                                </div>
                                <div class="col-md-4">
                                    <p>Quantity</p>

                                </div>

                                <div class="col-md-2">
                                    <p>Price</p>

                                </div>

                            </div>


                        </div>

                        <div class="cart_body">

                       
                            <div class="added_product">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="product_item">
                                            <i class="fa fa-angle-right more"></i>
                                            <p>
                                            <?php
                                        


?>
                                           
                                           
                                           
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="product_Quantity">
                                           
                                            <div class="">

                                               <!-- <div class="input-group">
                                                    <span class="input-group-btn">
                                                              <button type="button" class="btn-number"  >
                                                                  <i class="fa fa-minus"></i>
                                                              </button>
                                                          </span>
                                                    <input type="text" name="qty" class="form-control input-number" value="1"  >
                                                    <span class="input-group-btn">
                                                              <button type="button" class="btn-number" >
                                                                  <i class="fa fa-plus"></i>
                                                              </button>
                                                          </span>
                                                </div>-->
												
												<!-- <div class="def-number-input number-input ">
												  <button  class="minus btn-number"></button>
												  <input class="quantity" min="1" name="quantity" value="1" type="number">
												  <button  class="plus btn-number"></button>
												</div>
                                                <p></p>
                                            </div> -->
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <!-- <div class="product_price">
                                            <p>$1000</p>
                                        </div> -->
                                    </div>

                                    <div class="col-md-1">
                                        <!-- <div class="product_delete  ">
                                            <i class="fa fa-trash "></i>
                                        </div> -->
                                    </div>

                                </div>
                                <div class="more_details">
                                    <div class="row">

                                        <div class="col-md-2">
                                            <div class="product_discount">
                                                <p>Discount</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="product_discount">

                                                <select>
                                                                                <option>5%</option>
                                                                                <option>10%</option>
                                                                                <option>15%</option>
                                                                            </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="product_total">
                                                <p>Total</p>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="product_totl">

                                                <p>$1000</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                                
                        </div>
                        <!-- <div class="cart_footer">
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
                                        <li>$1000</li>
                                        <li>%10</li>
                                        <li>%5</li>
                                        <li>$1000</li>
                                    </ul>

                                </div>


                            </div>


                        </div> -->

                        <button class="btn btn_payment">Pay</button>
                       
                    </div>
                    
                    <div class="payment-method-cart">
                        <!-- <p>The total is </p>
                       <h3>choose payment method</h3>
                         <button class="btn cash"><i class="fa fa-money"></i> Cash</button>
                         <button class="btn "><i class="fa fa-money"></i> On Account</button>
                         <button class="btn "><i class="fa fa-money"></i> Credit</button>
                         <a href="#" class="cancel_payment">Cancel</a>
                     </div> -->
                </div>
                     
                <div class="modal2"></div>

                     

                <!-- <div class="thumbnailgallery">
                                    <div class="showrooms clearfix">
                                            
                                                    <button class="btn main_btn all logo">All product</button>
                                                    <button class="btn cate_btn logo">Men</button>
                                                    <button class="btn cate_btn logo">Women</button>
                                                    <button class="btn cate_btn logo">Kids</button>
                                                    <button class="btn cate_btn logo">Men</button>
                                                    <button class="btn cate_btn logo">Women</button>
                                                    <button class="btn cate_btn logo">Kids</button>
                                                    <button class="btn cate_btn logo">Men</button>
                                                    <button class="btn cate_btn logo">Women</button>
                                                    <button class="btn cate_btn logo">Kids</button>
                                                    <button class="btn cate_btn logo">Men</button>
                                                    <button class="btn cate_btn logo">Women</button>
                                                    <button class="btn cate_btn logo">Kids</button>
                                                    <button class="btn cate_btn logo">Men</button>
                                                    <button class="btn cate_btn logo">Women</button>
                                                    <button class="btn cate_btn logo">Kids</button>
                                                    <button class="btn cate_btn logo">Men</button>
                                                    <button class="btn cate_btn logo">Men</button>
                                                    <button class="btn cate_btn logo">Kids</button>

                                                  
                                    </div>
                                   
                                </div>
                                <span class="arrowleft" id="prev"><i class="icon-chevron-left"></i></span>
                                 <span class="arrowright" id="next"><i class="icon-chevron-right"></i></span> -->

            </div>
                                        </div>
                        </div>

                        
<!-- paginition  -->
<script>
 function searchFilter(page_num) {
      page_num = page_num?page_num:0;
      var keywords = $('#keywords').val();
    

      $.ajax({
        type: 'POST',
        url: 'pos_search.php',
        data:'page='+page_num+'&keywords='+keywords,
        beforeSend: function () {
            $('.loading-overlay').show();
           
        },
        success: function (html) {
           
            $('.product_list .products').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
      });
    }

    function productFilter(page_num,cate_id,sub_cate) {
      page_num = page_num?page_num:0;
    
     var cate_id = cate_id;
     var sub_cate=sub_cate;
    
     //   console.log(cate_id);

      $.ajax({
        type: 'POST',
        url: 'pos_search.php',
        data:'page='+page_num+'&cate_id='+cate_id+'&sub_cate='+sub_cate,
        beforeSend: function () {
            $('.loading-overlay').show();
           
        },
        success: function (html) {
           
            $('.product_list .products').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
      });
    }
  </script>
                      
        <?php

include"includes/template/footer.php";
            ?>