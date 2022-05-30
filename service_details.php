<?php

      include("includes/template/header.php");
      include("includes/template/functions.php");
      include("connect.php");

      $id=$_GET['id'];


      $query = "SELECT services.name as ProductName,services.name_ar as ProductNameAr, services.code, services.price, services.price as taxes, services.status as status, services.description as description
      FROM services where services.id='".$id."' ";

      $result = mysqli_query($mysqli, $query) or die ( mysqli_error());
      $row = mysqli_fetch_assoc($result);

      // $userPicture = !empty($row['server_image_path'])?$row['server_image_path']:'camera.png';
      // $userPictureURL = 'https://www.azora.tech/Dashboard/syncing/picture/images/'.$userPicture.".jpg";

     
      
        $name=checkProductsNames($row['ProductName'],$row['ProductNameAr']);
        // $ProductImage=checkProductsImages($row['ProductImage'],$row['category']);
        // $categoryName=checkProductsNames($row['categoryName'],$row['categoryNameAR']);
        // $subCategoryName=checkProductsNames($row['subCategoryName'],$row['subCategoryNameAr']);

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="service.php"><?php echo"Service"?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo"Service Details"?></li>
    </ol>
</nav>

<div class="new-product">

    <div class="row">
        <!-- <div class="col-md-4">
        <div class=" product_image">
          <img src="<?php echo $ProductImage;?>"/>
        </div>
      </div> -->

        <div class="col-md-6">
            <div class="productDetails">
                <h3><?php echo $name;?></h3>
                <ul>
                    <li class="price">YR<?php //echo _("product_details_price");?><span> <?php echo $row['price'];?>
                        </span></li>
                    <li><?php //echo _("product_details_Name");?> <span> <?php// echo $name;?> </span></li>
                    <li><?php echo _("product_details_code");?>: <span> <?php echo $row['code'];?> </span></li>
                    <!-- <li><?php echo _("product_details_category");?>  : <span> <?php echo $categoryName;?> </span></li> -->

                    <?php if(!empty($subCategoryName)) {?>
                    <li><?php echo _("product_details_subcategory");?> : <span> <?php echo $subCategoryName;?> </span>
                    </li>
                    <?php } ?>

                    <?php if(!empty($row['length'])) {?>
                    <li><?php echo _("product_details_length");?> : <span> <?php echo $row['length'];?> </span></li>
                    <?php } ?>
                    <?php if(!empty($row['height'])) {?>
                    <li><?php echo _("product_details_height");?> : <span> <?php echo $row['height'];?> </span></li>
                    <?php } ?>
                    <?php if(!empty($row['width'])) {?>
                    <li><?php echo _("product_details_width");?> : <span> <?php echo $row['width'];?> </span></li>
                    <?php } ?>


                    <li><?php echo _("product_details_tax");?> :
                        <span> <?php if(!empty($row['taxes'])) {
            echo $row['taxes'];?> </span>
                    </li>
                    <?php } 
          else{
            echo 0;
          }
          
          ?>
                    <li><?php echo _("product_details_status");?> : <span>
                            <?php  echo $row['status'] == 0 ? _("product_details_status_Active") : _("product_details_status_InActive") ;?></span>
                    </li>

                    <li><?php echo "Description";?> : <span>
                            <?php  echo $row['description']?></span></li>
                </ul>
            </div>

        </div>

        <!-- <div class="col-md-4">
        <ul>            
          <?php if(!empty($row['length'])) {?>
            <li><?php echo _("product_details_length");?> : <span> <?php echo $row['length'];?> </span></li>
          <?php } ?>
          <?php if(!empty($row['height'])) {?>
            <li><?php echo _("product_details_height");?> : <span> <?php echo $row['height'];?> </span></li>
          <?php } ?>
          <?php if(!empty($row['width'])) {?>
            <li><?php echo _("product_details_width");?> : <span> <?php echo $row['width'];?> </span></li>
          <?php } ?>   
          
         
          <li><?php echo _("product_details_tax");?> :
           <span>  <?php if(!empty($row['taxes'])) {
            echo $row['taxes'];?> </span></li>
          <?php } 
          else{
            echo 0;
          }
          
          ?> 
          <li><?php echo _("product_details_status");?> : <span>
            <?php  echo $row['status'] == 0 ? _("product_details_status_Active") : _("product_details_status_InActive") ;?></span></li>
        </ul>
      </div> -->

        <!-- <div class="col-md-12">
        <ul class="nav nav-tabs">
          <li class="nav-item" data-class="purchase-history">
            <a class="nav-link active" href="#"><?php echo _("product_details_purchase");?></a>
          </li>
          <li class="nav-item" data-class="sales-history">
            <a class="nav-link" href="#"><?php echo _("product_details_sales");?></a>
          </li>
        </ul>
      </div> -->

        <!-- <div class="col-md-12">
        <div class="purchase-history">
          <table class="table table-hover ">
            <thead>
              <tr>
                <th scope="col"><?php echo _("product_details_purchase_date");?></th>
                <th scope="col"><?php echo _("product_details_purchase_supplier");?></th>
                <th scope="col"><?php echo _("product_details_purchase_quantity");?></th>              
              </tr>
            </thead>
            <tbody>
              <tr>
                <td> 20/2/2020</td>
                <td>Abdo Qassem</td>
                <td>200</td>                
              </tr>

              <tr>
                <td> 20/2/2020</td>
                <td>Abdo Qassem</td>
                <td>200</td>              
              </tr>

              <tr>
                <td> 20/2/2020</td>
                <td>Abdo Qassem</td>
                <td>200</td>              
              </tr>

              <tr>
                <td> 20/2/2020</td>
                <td>Abdo Qassem</td>
                <td>200</td>                
              </tr>

              <tr>
                <td> 20/2/2020</td>
                <td>Abdo Qassem</td>
                <td>300</td>                
              </tr>

            </tbody>
          </table>
        </div>
      </div> -->


        <div class="col-md-12">
            <div class="sales-history">
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th scope="col"><?php echo _("product_details_sales_date");?></th>
                            <th scope="col"><?php echo _("product_details_sales_customer");?></th>
                            <th scope="col"><?php echo _("product_details_sales_quantity");?></th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td> 20/2/2020</td>
                            <td>Abdo Qassem</td>
                            <td>200</td>
                        </tr>

                        <tr>
                            <td> 20/2/2020</td>
                            <td>Abdo Qassem</td>
                            <td>200</td>
                        </tr>

                        <tr>
                            <td> 20/2/2020</td>
                            <td>Abdo Qassem</td>
                            <td>200</td>
                        </tr>

                        <tr>
                            <td> 20/2/2020</td>
                            <td>Abdo Qassem</td>
                            <td>200</td>
                        </tr>

                        <tr>
                            <td> 20/2/2020</td>
                            <td>Abdo Qassem</td>
                            <td>300</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
    integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
</script>
<?php include("includes/template/footer.php"); ?>