<?php
    session_start();
if(isset($_POST['page'])){
    include('pagination.php');
    include('connect.php');
    include("includes/template/functions.php");

    $start = !empty($_POST['page'])?$_POST['page']:0;
    $limit = 10;
    
    //set conditions for search
    $whereSQL = 'where product.archive = 0 ';
     $orderSQL = '';
    $whereSQL2= 'where product.archive = 0 '; 
    $orderSQL ='';
    $keywords = $_POST['keywords'];
    $sortBy = $_POST['sortBy'];
    if(!empty($keywords)){

        if($_SESSION["language"] == "ar_EG"){
            $whereSQL2 .= " AND (
            
            (product.name_ar LIKE '%".$keywords."%' AND product.name IS NULL)
            OR
            (product.name LIKE '%".$keywords."%' AND product.name_ar IS NULL)
            OR
            (product.name_ar LIKE '%".$keywords."%')) ";
    
            $whereSQL .= " AND name_ar LIKE '%".$keywords."%' ";
          }
          else{
            $whereSQL2 .= " AND (
            (product.name LIKE '%".$keywords."%' AND product.name_ar IS NULL)
            OR 
            (product.name_ar LIKE '%".$keywords."%' AND product.name IS NULL)
            OR
            (product.name LIKE '%".$keywords."%')) ";
            $whereSQL .= " AND name LIKE '%".$keywords."%' ";
          
          }
        
       // $whereSQL = "WHERE name LIKE '%".$keywords."%' AND archive = 0";
       
    }
    
    if(!empty($sortBy)){
        $orderSQL = " ORDER BY id ".$sortBy;
    }else{
        $orderSQL = " ORDER BY id ASC ";
    }

    //get number of rows
    $queryNum = $mysqli->query("SELECT COUNT(*) as userNum FROM product ".$whereSQL.$orderSQL);
    $resultNum = $queryNum->fetch_assoc();
    $rowCount = $resultNum['userNum'];

    //initialize pagination class
    $pagConfig = array(
        'currentPage' => $start,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'searchFilter'
    );
    $pagination =  new Pagination($pagConfig);

    //get rows
    $query = $mysqli->query("SELECT product.id as id, product.server_image_path as ProductImage, COALESCE(sum(inventory.quantity),0) as product_stock, product.name as ProductName,product.name_ar as ProductNameAr, product.price as product_price,product.category_id as category from product left join inventory on product.id=inventory.product_id  $whereSQL2 group by product.id ORDER BY product.id Limit $start,$limit");
   // $query = $mysqli->query("SELECT * FROM product $whereSQL $orderSQL LIMIT $start,$limit");
  //echo "SELECT  product.id as id, product.server_image_path, COALESCE(sum(inventory.quantity),0) as product_stock, product.name as product_Name, product.price as product_price from product left join inventory on product.id $whereSQL2 $orderSQL LIMIT $start,$limit";
    if($query->num_rows > 0){ ?>

<div class="users_list">
    <div class="table-responsive">
        <table class="table table-hover ">
            <thead>
                <tr>
                    <!-- <th style="width:5em">#</th> -->
                    <th style="width:12em"><?php echo _("product_Name");?></th>
                    <th style="width:7em"><?php echo _("product_price");?></th>
                    <th style="width:5em"><?php echo _("product_stock");?></th>
                    <th class='hidden-xs' style="width:7em"></th>
                </tr>
            </thead>
            <?php
                while($row = $query->fetch_assoc()){ 

                    $name=checkProductsNames($row['ProductName'],$row['ProductNameAr']);
                    $ProductImage=checkProductsImages($row['ProductImage'],$row['category']);
                    $price = $row['product_price'];
                    $stock = $row['product_stock'];
                    
                     ?>
            <!-- content -->
            <tbody>
                <tr style="cursor: pointer;"
                    onclick="window.location='product_details.php?id=<?php echo $row["id"];?>'">
                    <!-- <td scope="col"><?php echo $row['id']; ?></td> -->
                    <td class="w-auto">
                        <div class="product-img">
                            <div class="hidden-xs product-img-wrapper">
                                <img class="prdct_img" src="<?php echo $ProductImage; ?>">
                            </div>

                            <span><?php echo $name; ?></span>
                        </div>

                    </td>
                    <td scope="col"><?php echo $price; ?></td>
                    <td scope="col"> <?php echo $stock; ?> </td>
                    <td class='hidden-xs align-content-end'>
                        <div class='dropdown'>
                            <button class='create-new-btn main-btn btn' type='button' id='dropdownMenuButton'
                                data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'
                                onclick="window.location='product_details.php?id=<?php echo $row["id"];?>'">
                                <?php echo "View Details";?>
                            </button>
                    </td>
                </tr>
            </tbody>

            <?php } ?>
        </table>
    </div>
    <?php echo $pagination->createLinks(); ?>
    <!-- Modal Price-->
    <!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="PriceModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>                
                    </div>
                    <div class="dash">

                    </div>

                </div>
            </div>
        </div> -->
    <!-- popup modal of deleting  -->
    <script type="text/javascript" src="layout/js/bootbox.min.js"></script>
    <!-- Delete Product -->
    <!-- <script>
            $(document).ready(function() {
                $('.delete_prdct').click(function(e){   
                e.preventDefault();   
                var prdctid = $(this).attr('data-prdct-id');
                var parent = $(this).parent(".dropdown-menu").parent(".dropdown").parent("td").parent("tr");   
                bootbox.dialog({
                    message: "<div class='delete_user_popup'><div class='icon-trash'><i class='fas fa-trash'></i></div><div class='delete-text'><?php echo _("product_search_delete_alert_message"); ?></div></div>",
                    title: "<i class='glyphicon glyphicon-trash'></i>",
                    buttons: {
                    success: {
                        label: "<?php echo _("product_search_alert_cancel"); ?>",
                        className: "btn-normal",
                        callback: function() {
                        $('.bootbox').modal('hide');
                        }
                    },
                    danger: {
                        label: "<?php echo _("product_search_alert_delete"); ?>!",
                        className: "btn-danger",
                        callback: function() {       
                        $.ajax({        
                            type: 'POST',
                            url: 'product_rmv.php',
                            data: 'prdctid='+prdctid        
                        })
                        .done(function(response){        
                            bootbox.alert(response);
                            parent.fadeOut('slow');        
                        })
                        .fail(function(){        
                            bootbox.alert('Error....');               
                        })              
                        }
                    }
                    }
                });   
                });
            });
        </script> -->
    <!--------------------- Edit Price ------------------------>
    <!-- <script>
            $('#exampleModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var product = button.data('whatever') // Extract info from data-* attributes
                var modal = $(this);
                var dataString = 'id=' + product;

                    $.ajax({
                        type: "GET",
                        url: "product_update.php",
                        data: dataString,
                        cache: false,
                        success: function (data) {
                            console.log(data);
                            modal.find('.dash').html(data);
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    });
            })
        </script> -->
    <?php } 
} ?>