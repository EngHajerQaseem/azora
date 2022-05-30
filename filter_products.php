<?php
if(isset($_POST['cate_id'])){
    include('pagination.php');
    include('connect.php');
    $limit =1;
    $start=!empty($_POST['page'])?$_POST['page']:0;
   
    $cate_id = $_POST['cate_id'];
   

    $queryNum = $mysqli->query("SELECT COUNT( distinct product_id) as invNum FROM (inventory INNER JOIN product ON inventory.product_id = product.id  INNER JOIN category ON product.category_id = category.id )  where product.category_id=$cate_id");
    $resultNum = $queryNum->fetch_assoc();
    $rowCount = $resultNum['invNum'];
    echo $rowCount;
  
    //initialize pagination class
    $pagConfig = array(
        'currentPage' => $start,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'searchFilter2'
    );
    $pagination =  new Pagination($pagConfig);


   

    $query = $mysqli->query("
    SELECT product.id, product.name, product.price,sum(inventory.quantity) as Quantity ,category.category_name,product.local_image_path as img
                             FROM inventory 
                            
                             INNER JOIN product ON inventory.product_id = product.id 
                             INNER JOIN category ON product.category_id = category.id 
                              where product.category_id=$cate_id
                             GROUP BY inventory.product_id
                             order by inventory.product_id ASC
                             LIMIT $start,$limit
                            
    
    
   ");
    
    if($query->num_rows > 0){  
        ?>
               



               <div class="row">
                <?php 
          
                while($row = $query->fetch_assoc()){ 
                   
                     ?>
                    <!-- content -->
                    <div class="col-md-3">
                               <div class="product_container text-center <?php echo $row['category_name']; ?>">    
                                  
                                   <img src="upload/<?php echo $row["img"]; ?>"/>
                                        <input type="hidden"  value="<?php echo $row["id"]; ?>" />
										<p ><?php echo $row["name"]; ?></p>
										<span class="price">$ <?php echo $row["price"];?></span>

                                        
                                        <span class="quantity"><?php echo $row['Quantity'] ;?> in stock</span>
                                   
                                </div>
                               
                                    
                                 
                                    </div>
                               
                             
                              

                      
                       
                                    <?php 
                        
                      
                    }
                                ?>
                                  </div>
                        <?php echo $pagination->createLinks(); ?>
                <?php
                    } else {

                    }
                }
                                ?>
