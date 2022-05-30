<?php
  include("includes/template/header.php");
  include("includes/template/functions.php");
  include("connect.php");
  include('pagination.php');
?>

<div class="products-page">
    <div class="product-header">
        <div class="row">
            <!-- dropdown menu -->

            <!-- <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          All Products
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Recent </a>
            <a class="dropdown-item" href="#">Product Name</a>
            <a class="dropdown-item" href="#">Product Name</a>
          </div>
        </div> -->


            <!-- Search  -->
            <div class="col">
                <h3 class="page-title"><?php echo _("Page_Title_Products");?></h3>
            </div>

            <!-- Search  -->
            <div class="col-lg-4  col-12">

                <div class="input-group md-form form-sm form-1 pl-0 search-box user-search-panel">
                    <input class="form-control my-0 py-1" type="text" id="keywords"
                        placeholder="<?php echo _("product_search_input");?>" onkeyup="searchFilter()" />
                    <select class="sort-users" id="sortBy" onchange="searchFilter()">
                        <option value="">Sort By</option>
                        <option value="asc">Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                    <div class="input-group-append">
                        <span class="input-group-text search-icon" id="basic-text1">
                            <i class="fa fa-search text-white" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Add New User btn -->
            <div class="col  d-flex justify-content-end">
                <!-- <a class="btn main-btn" href="product_add.php"><?php echo _("product_Add_New_product");?></a> -->
            </div>

        </div>
    </div>
    <!-- Search Result -->
    <div class="user-wrapper">
        <div class="loading-overlay">
            <div class="overlay-content"><?php echo _("product_loading");?></div>
        </div>
        <div id="product_content">
            <?php
        $limit = 10;

        //get number of rows
        $queryNum = $mysqli->query("SELECT COUNT(*) as userNum FROM product where archive=0");
        $resultNum = $queryNum->fetch_assoc();
        $rowCount = $resultNum['userNum'];

        //initialize pagination class
        $pagConfig = array(
            'totalRows' => $rowCount,
            'perPage' => $limit,
            'link_func' => 'searchFilter'
        );
        $pagination =  new Pagination($pagConfig);
        $counter = 0;
        //get rows
        $query = $mysqli->query("select product.id as id, product.server_image_path as ProductImage, COALESCE(sum(inventory.quantity),0) as product_stock, product.name as ProductName,product.name_ar as ProductNameAr, product.price as product_price,product.category_id as category from product left join inventory on product.id=inventory.product_id  WHERE product.archive = 0 group by product.id ORDER BY product.updated_at DESC, product.id DESC LIMIT $limit");

        if($query->num_rows > 0){ 
          $counter++;
          ?>
            <div class="products_list">
                <div class="table-responsive">
                    <table class="table table-hover ">
                        <thead>
                            <tr>

                                <!-- <th style="width:5em">#</th> -->
                                <th style="width:12em"><?php echo _("product_Name");?></th>
                                <th style="width:7em"><?php echo _("product_price");?></th>
                                <th style="width:5em"><?php echo _("product_stock");?></th>
                                <th class="hidden-xs viewDetailsWidthXL"></th>
                            </tr>
                        </thead>
                        <?php
                while($row = $query->fetch_assoc()){ 
                 
                  $name=checkProductsNames($row['ProductName'],$row['ProductNameAr']);

                
                   
                  $ProductImage=checkProductsImages($row['ProductImage'],$row['category']);
                    
                  //$name = $row['ProductName'];
                  $price = $row['product_price'];
                  $stock =$row['product_stock'];
                  //$ProductImage =$row['ProductImage'];
                  //$userPicture = !empty($row['server_image_path'])?$row['server_image_path']:'camera.png';
                //  $ProductImageURL = '../Dashboard/syncing/picture/images/'.$ProductImage;
                  // $test=var_dump(getimagesize($ProductImageURL));
                  // echo $test;
                //   $test=glob($ProductImageURL.".*");
                  

                //   $extension=pathinfo($test[0],PATHINFO_EXTENSION);
                  //$test3=$test2['extension'];
                 // echo $test2;
                  // $extension=getimagesize($ProductImageURL);
                  // $extension = image_type_to_extension($test2[2]);
                  
                  // $extension = pathinfo(parse_url($ProductImageURL, PHP_URL_PATH), PATHINFO_EXTENSION);
                  // echo  $extension."tst"
                  ?>

                        <!-- content -->
                        <tr style="cursor: pointer;"
                            onclick="window.location='product_details.php?id=<?php echo $row["id"];?>'">

                            <!-- <td><?php echo $row['id']; ?></td> -->
                            <td class="w-auto">
                                <div class="product-img">
                                    <div class="hidden-xs-img product-img-wrapper">
                                        <img class="prdct_img" src="<?php echo $ProductImage; ?>">
                                    </div>

                                    <span><?php echo $name; ?></span>
                                </div>

                            </td>
                            <td><?php echo $price; ?></td>
                            <td><?php echo $stock; ?></td>
                            <td class='hidden-xs align-content-end'>
                                <button class='create-new-btn main-btn btn' type='button' id='dropdownMenuButton'
                                    data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'
                                    onclick="window.location='product_details.php?id=<?php echo $row["id"];?>'">
                                    <?php echo "View Details";?>
                                </button>
                            </td>
                        </tr>
                        <?php } 
              ?>
                    </table>
                </div>
            </div>
            <?php echo $pagination->createLinks(); ?>
            <?php } 
      ?>
        </div>
    </div>
</div>
<!-- Modal -->
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
<!-- Dropdown Menu -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
    integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
</script>
<!-- Delete Product -->
<!-- <script>
    $(document).ready(function() {
        $('.delete_prdct').click(function(e){   
          e.preventDefault();   
          var prdctid = $(this).attr('data-prdct-id');
          var parent = $(this).parent(".dropdown-menu").parent(".dropdown").parent("td").parent("tr");   
          bootbox.dialog({
            message: "<div class='delete_user_popup'><div class='icon-trash'><i class='fas fa-trash'></i></div><div class='delete-text'><?php echo _("product_delete_alert_message"); ?></div></div>",
            title: "<i class='glyphicon glyphicon-trash'></i>",
            buttons: {
              success: {
                label: "<?php echo _("product_alert_cancel"); ?>",
                className: "btn-normal",
                callback: function() {
                  $('.bootbox').modal('hide');
                }
              },
              danger: {
                label: "<?php echo _("product_alert_delete"); ?>!",
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
<!-- paginition  -->
<script>
function searchFilter(page_num) {
    page_num = page_num ? page_num : 0;
    var keywords = $('#keywords').val();
    var sortBy = $('#sortBy').val();
    $.ajax({
        type: 'POST',
        url: 'product_search.php',
        data: 'page=' + page_num + '&keywords=' + keywords + '&sortBy=' + sortBy,
        beforeSend: function() {
            $('.loading-overlay').show();
        },
        success: function(html) {
            $('#product_content').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
    });
}
</script>
<!--------------------- Edit Price ------------------------>
<!-- Latest compiled and minified JavaScript -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script>
    $('#exampleModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'id=' + recipient;

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
<!-- Including Footer -->
<?php include("includes/template/footer.php"); ?>