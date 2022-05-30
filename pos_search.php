<?php
if(isset($_POST['page'])){
    include('pagination.php');
    include('connect.php');
    
    $start = !empty($_POST['page'])?$_POST['page']:0;
    $limit =2;
    
    if(isset($_POST['cate_id'])){
        $cate_id=$_POST['cate_id'];

        $sub_cate=$_POST['sub_cate'];
        //echo $sub_cate;
        $searchFunc='productFilter';

        if($cate_id=='undefined'){
            $whereSQL = '';
            $searchFunc='searchFilter';
        }else{
            $whereSQL = " where product.category_id=$cate_id ";
            $searchFunc='productFilter';
        }

        if($sub_cate=='undefined'){
            $andSQL='';
        }else{
            $andSQL = " and product.subcategory_id=$sub_cate ";
        }

        $queryNum = $mysqli->query("SELECT COUNT( distinct product_id) as invNum FROM (inventory INNER JOIN product ON inventory.product_id = product.id  INNER JOIN category ON 
        product.category_id = category.id  INNER JOIN subcategory ON product.subcategory_id = subcategory.id) $whereSQL $andSQL");
        $resultNum = $queryNum->fetch_assoc();
        $rowCount = $resultNum['invNum'];
       

        $query = $mysqli->query("
        SELECT product.id, product.name, product.price,sum(inventory.quantity) as Quantity ,category.category_name,product.local_image_path as img
                                 FROM inventory 
                                
                                 INNER JOIN product ON inventory.product_id = product.id 
                                 INNER JOIN category ON product.category_id = category.id 
                                 INNER JOIN subcategory ON product.subcategory_id = subcategory.id 
                                 $whereSQL $andSQL
                                 GROUP BY inventory.product_id
                                 order by inventory.product_id ASC
                                 LIMIT $start,$limit
                                 ");    
       //initialize pagination class
    $pagConfig = array(
        'currentPage' => $start,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' =>$searchFunc
    );
    $pagination =  new Pagination($pagConfig);
    }
     else{
        //set conditions for search
    $whereSQL = '';
    $keywords = $_POST['keywords'];


    
   
    if(!empty($keywords)){
        $whereSQL = "WHERE product.name LIKE '%".$keywords."%'";
    }
   
    //get number of rows
    $queryNum = $mysqli->query("SELECT COUNT( distinct product_id) as invNum FROM (inventory INNER JOIN product ON inventory.product_id = product.id) $whereSQL");
    $resultNum = $queryNum->fetch_assoc();
    $rowCount = $resultNum['invNum'];
   
  
    //initialize pagination class
    $pagConfig = array(
        'currentPage' => $start,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'searchFilter'
    );
    $pagination =  new Pagination($pagConfig);

    //get rows
    $query = $mysqli->query("
    SELECT product.id, product.name, product.price,sum(inventory.quantity) as Quantity ,category.category_name,product.local_image_path as img
                             FROM inventory 
                            
                             INNER JOIN product ON inventory.product_id = product.id 
                             INNER JOIN category ON product.category_id = category.id 
                             $whereSQL
                             GROUP BY inventory.product_id
                             order by inventory.product_id ASC
                             LIMIT $start,$limit
    
    
   ");
     }
   
   
    
    if($query->num_rows > 0){  
        ?>
               



               <div class="row">
                <?php 
          
                while($row = $query->fetch_assoc()){ 
                   
                     ?>
                    <!-- content -->
                    <div class="col-md-3">
                               <div class="product_container text-center <?php echo $row['category_name']; ?>">    
                                   <?php //echo '<img src="data:image/jpeg;base64,'.base64_encode( $product['key_image'] ).'"/>';?>
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
