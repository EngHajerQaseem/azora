<?php

include("includes/template/header.php");
include("connect.php");
  ////// Define variables and initialize with empty values
  $name = $code = $category_id = $subcategory_id = $unit_of_counting_id = $weight_type_id =  $pieces_per_box = $price = $length = $width = $height = $description = $tax_id = $status = $local_image_path = "";
  $name_err = "";

   ////// Processing form data when form is submitted
   if($_SERVER["REQUEST_METHOD"] == "POST"){
 
  
    /////// Validate Name of product
    if(empty(trim($_POST["name"]))){
      $name_err = "Please enter the name of product.";
      } else{
      // Prepare a select statement
      $sql = "SELECT id FROM product WHERE name = ?";
      
      if($stmt = mysqli_prepare($mysqli, $sql)){
          // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "s", $name);
          
          // Set parameters
          $name = trim($_POST["name"]);
          
          // Attempt to execute the prepared statement
          if(mysqli_stmt_execute($stmt)){
              /* store result */
              mysqli_stmt_store_result($stmt);
              
          } else{
              echo "Oops! Something went wrong. Please try again later.";
          }
      }
      
      // Close statement
      mysqli_stmt_close($stmt);
    }


    // Validate Image_url
    $type = explode('.', $_FILES['userImage']['name']);
    $type = $type[count($type) - 1];
    $uploadDir = "upload/";
    $fileName =  basename($_FILES["userImage"]["name"]);
    $targetPath = $uploadDir. $fileName;

  
    // Check input errors before inserting in database
    if(empty($name_err)){
      
      // if uploaded done, save it.
      if (is_uploaded_file($_FILES['userImage']['tmp_name'])){
          move_uploaded_file($_FILES['userImage']['tmp_name'], $targetPath);
      }

      // Prepare an insert statement
      $sql = "INSERT INTO product (name, code, category_id, subcategory_id, unit_of_counting_id, weight_type_id, pieces_per_box, price, length, width, height, description, tax_id, status, local_image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      if($stmt = mysqli_prepare($mysqli, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssiiiiiiiiisiis", $param_name, $param_code, $param_category_id, $param_subcategory_id, $param_unit_of_counting_id, $param_weight_type_id, $param_pieces_per_box, $param_price, $param_length, $param_width, $param_height, $param_description, $param_tax_id, $param_status, $param_local_image_path);
        
        // Set parameters
        $param_name =  $_POST["name"];
        $param_code = $_POST["code"];
        $param_category_id = $_POST['category_id'];
        $param_subcategory_id = $_POST['subcategory_id'];
        $param_unit_of_counting_id = $_POST['unit_of_counting_id'];
        $param_weight_type_id = $_POST['weight_type_id'];
        $param_pieces_per_box = $_POST['pieces_per_box'];
        $param_price = $_POST['price'];
        $param_length = $_POST['length'];
        $param_width = $_POST['width'];
        $param_height = $_POST['height'];
        $param_description = $_POST['description']; 
        $param_tax_id = $_POST['tax_id'];
        $param_status = $_POST['status'];                     
        $param_local_image_path = $fileName;
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){              
            echo '<div class="done-msg"> ';echo _("product_Add_successfully_added"); echo'</div>';
          } else{
            echo '<div class="fail-msg">';echo _("product_Add_something_went_wrong"); echo'</div>';
        }
      }
    
      // // Close statement
      mysqli_stmt_close($stmt);
    }

  }

?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="products.php"><?php echo _("product_Add_header");?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo _("product_Add_New_header");?></li>
  </ol>
</nav>
<div class="new-product">
  <h2><?php echo _("product_Add_main_header");?></h2>

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" method="post">
    <div class="row">
      <div class="col-sm-10">
        <div class="row">

          <div class="col-sm-6">
            <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
              <label for="name"><?php echo _("product_Add_Name");?> </label>
              <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
            
            </div>
          </div>


          <div class="col-sm-6">
            <div class="form-group <?php echo (!empty($code_err)) ? 'has-error' : ''; ?>">
              <label for="code"><?php echo _("product_Add_code");?> </label>
              <input type="text" name="code" class="form-control" value="<?php echo $code; ?>">
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="cate"><?php echo _("product_Add_category");?></label> 
              <select name="category_id" class="form-control" id="category">
              <option value="">------- <?php echo _("product_Add_choose");?> -------</option>
                <?php
                  $queryCategories = "SELECT id as catId,category_name FROM category";
                  $resultCategories = $mysqli->query($queryCategories);
                  while ($rowCats = $resultCategories->fetch_assoc()) {?>
                   
                    <option value="<?php echo $rowCats['catId']; ?>">
                      <?php echo $rowCats['category_name'];?>
                    </option>

                  <?php }                
                ?>
              </select>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="sub"><?php echo _("product_Add_subcategory");?></label> 
              <select name="subcategory_id" class="form-control" id="Subcategory">
              <option value="">------- <?php echo _("product_Add_subcategory_choose");?> -------</option>
                <?php
                  $querySubCategories = "SELECT id,name FROM subcategory";
                  $resultSubCategories = $mysqli->query($querySubCategories);

                  while ($rowSubCats = $resultSubCategories->fetch_assoc()) {?>
                    <option value="<?php echo $rowSubCats['id']; ?>">
                      <?php echo $rowSubCats['name'];?>
                    </option>
                  <?php }
                ?>
              </select>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="unit"><?php echo _("product_Add_unit");?></label> 
              <select name="unit_of_counting_id" class="form-control">
                <option value="">------- <?php echo _("product_Add_unit_choose");?> -------</option>
                <?php
                  $queryUnit = "SELECT id,name FROM unit_of_counting";
                  $resultUnit = $mysqli->query($queryUnit);

                  while ($rowUnit = $resultUnit->fetch_assoc()) {?>
                   <option value="<?php echo $rowUnit['id']; ?>">
                      <?php echo $rowUnit['name'];?>
                    </option>
                  <?php }
                ?>
              </select>
            </div>
          </div>

          <div class="col-sm-6 weight">
            <div class="form-group">
              <label for="weight_type"><?php echo _("product_Add_weight_type");?></label> 
              <select name="weight_type_id" class="form-control">
                <?php
                  $queryWt = "SELECT id,name FROM weight_type";
                  $resultWt = $mysqli->query($queryWt);
                  while ($rowWt = $resultWt->fetch_assoc()) { ?>                    
                      <option value="<?php echo $rowWt['id']; ?>">
                          <?php echo $rowWt['name'];?>
                      </option>
                  <?php }                    
                ?>    
              </select>
            </div>
          </div>



          <div class="col-sm-6 pieces">
            <div class="form-group">
              <label for="pieces"><?php echo _("product_Add_pieces_box");?></label>
              <input type="number" name="pieces_per_box" class="form-control" value="<?php echo $pieces_per_box; ?>">
            </div>
          </div>



          <div class="col-sm-6">
            <div class="form-group">
              <label for="weight"><?php echo _("product_Add_price");?></label>
              <input type="number" name="price" class="form-control" value="<?php echo $price; ?>">
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="length"><?php echo _("product_Add_length");?></label>
              <input type="number" name="length" class="form-control" value="<?php echo $length; ?>">
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="width"><?php echo _("product_Add_width");?></label>
              <input type="number" name="width" class="form-control" value="<?php echo $width; ?>">
            </div>
          </div>


          <div class="col-sm-6">
            <div class="form-group">
              <label for="height"><?php echo _("product_Add_height");?></label>
              <input type="number" name="height" class="form-control" value="<?php echo $height; ?>">
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="tax"><?php echo _("product_Add_tax");?></label> 
              <select name="tax_id" class="form-control">
                <option value="">------- <?php echo _("product_Add_tax_choose");?> --------</option>
                  <?php
                      $queryTax = "SELECT id,price FROM tax";
                      $resultTax = $mysqli->query($queryTax);

                      while ($rowTax = $resultTax->fetch_assoc()) { ?>                    
                              <option value="<?php echo $rowTax['id']; ?>">
                                  <?php echo $rowTax['price'];?>
                              </option>
                      <?php } 
                  
                  ?>
              </select>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="status"><?php echo _("product_Add_status");?></label> 
              <select name="status" class="form-control">
                <option value="1"><?php echo _("product_Add_active");?></option>
                <option value="0"><?php echo _("product_Add_Inactive");?></option>
              </select>
            </div>
          </div>


          <div class="col-sm-12">
            <div class="form-group">
              <label for="desc"><?php echo _("product_Add_description");?></label>
              <textarea class="form-control" id="desc" rows="3" name="description" class="form-control" value="<?php echo $description; ?>"></textarea>
            </div>
          </div>




        </div>
      </div>
   
      <div class="col-md-2 col-sm-2 col-md-offset-2 col-sm-offset-2">
        <div class="form-group">		    
          <div id="kv-avatar-errors-2" class="center-block" style="width:800px;display:none"></div>
            <div class="kv-avatar center-block">
              <input id="avatar-2" name="userImage" type="file" class="file-loading">
            </div>
          </div>
        </div>
      </div>   
    </div>

    <div class="col-sm-12 d-flex justify-content-end">
      <button type="submit" class="btn main-btn save"><?php echo _("product_Add_save");?></button>
      <button type="button" class="btn btn-secondary  cancel" ><?php echo _("product_Add_cancel");?></button>
    </div>
  </form>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<!------------------ hide and show input fields ------------------>
<script>
  jQuery(document).ready(function($){
    $('select[name=unit_of_counting_id]').change(function () {
      $('.weight').hide();
      $('.pieces').hide();
        
      $("select[name=unit_of_counting_id] option:selected").each(function () {
        var value = $(this).val();
        if(value == "2") {
            $('.pieces').show();
        
        } else if(value == "3") {
            $('.weight').show();
        
        } 
        else if(value == "1") {
            $('.price').show();
        
        } 
      });
    }); 
  });
</script>
<!-------------------  upload images scripts --------------------->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="layout/js/fileinput.min.js"></script>
        <script type="text/javascript"> 
        $("#avatar-2").fileinput({
                overwriteInitial: true,
                maxFileSize: 1500,
                showClose: false,
                showCaption: false,
                showBrowse: false,
                browseOnZoneClick: true,
                removeLabel: '',
                removeIcon: '<i class="fas fa-times"></i>',
                removeTitle: 'Cancel or reset changes',
                elErrorContainer: '#kv-avatar-errors-2',
                msgErrorClass: 'alert alert-block alert-danger',
                defaultPreviewContent: '<img src="upload/camera.png" alt="product image" class="user-img"><h6 class="text-muted btn btn-secondary">Upload Image</h6>',
                layoutTemplates: {main2: '{preview} ' + ' {remove} '},
                allowedFileExtensions: ["jpg", "png", "gif"]
            });    
        </script>
<!------------------------- populate input dropdown menu ----------------------->
<script>
    $(document).ready(function() {
    $(document).on('change','#category', function() {
        var catId = $(this).val();
        if(catId != "") {
            $.ajax({
                url:"product_fetch.php",
                type:'POST',
                data:{catId:catId},
                success:function(response) {
                    if(response != '') {
                        $("#Subcategory").removeAttr('disabled','disabled').html(response);                       
                    } else {
                        $("#Subcategory").attr('disabled','disabled').html("<option value=''>------- Select --------</option>");
                    }
                }
            });
        } else {
            $("#Subcategory").attr('disabled','disabled').html("<option value=''>------- Select --------</option>");
        }
    });

});
</script>
<!-- Include footer -->
<?php include("includes/template/footer.php");?> 