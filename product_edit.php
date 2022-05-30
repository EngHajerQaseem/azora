<?php
    include("includes/template/header.php");
    include("connect.php");

    $id= $_REQUEST['id'];

    $query = "SELECT *,product.id as id, product.name as productName, 
    category.id as CatId, 
    subcategory.id as SubcatId,
    subcategory.name as SubcatName,
    unit_of_counting.id as UnitId,
    unit_of_counting.name as UnitName,
    weight_type.id as WtId,
    weight_type.name as WtName
    FROM ((((product
    INNER JOIN category ON product.category_id = category.id)
    INNER JOIN unit_of_counting ON product.unit_of_counting_id = unit_of_counting.id)
    INNER JOIN weight_type ON product.weight_type_id = weight_type.id)
    INNER JOIN subcategory ON product.subcategory_id = subcategory.id) WHERE product.id='".$id."' ";

    $result = mysqli_query($mysqli, $query) or die ( mysqli_error());
    $row = mysqli_fetch_assoc($result);

    $name_err = "";

    //picture
    $userPicture = !empty($row['local_image_path'])?$row['local_image_path']:'no-image.png';
    $userPictureURL = ''.$userPicture;
?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="products.php"><?php echo _("product_edit_header");?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo _("product_edit_New_header");?></li>
  </ol>
</nav>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_REQUEST['id'];
        $name = $_REQUEST['name'];
        $code = $_REQUEST['code'];
        $category = $_REQUEST['category_id'];
        $subcategory = $_REQUEST['subcategory_id'];
        $unitOfCounting = $_REQUEST['unit_of_counting_id'];
        $weightType = $_REQUEST['weight_type_id'];
        $pieces = $_REQUEST['pieces_per_box'];
        $price = $_REQUEST['price'];
        $length = $_REQUEST['length'];
        $width = $_REQUEST['width'];
        $height = $_REQUEST['height'];
        $description = $_REQUEST['description'];
        $taxId = $_REQUEST['tax_id'];
        $status = $_REQUEST['status'];

        /////// image updating
        $updateimage = '';
        $type = explode('.', $_FILES['userImage']['name']);
        $type = $type[count($type) - 1];
        $uploadDir = "upload/";
        $fileName = basename($_FILES["userImage"]["name"]);
        $targetPath = $uploadDir. $fileName;

        // if there is an update for image update it.
        if(isset($_FILES['userImage']['name'])) {
            if(in_array($type, array('gif', 'jpg', 'jpeg', 'png'))) {
                if (is_uploaded_file($_FILES['userImage']['tmp_name'])){
                    if(move_uploaded_file($_FILES["userImage"]["tmp_name"], $targetPath)){ 
                        $updateimage = "UPDATE product SET local_image_path = '".$fileName."' where id='".$id."' ";
                        $stmt = $mysqli->prepare($updateimage);
                        $stmt->execute();
                        $stmt->close();

                    }
                }
            }
        }


        // Prepare an insert statement
        $sql = "UPDATE product SET name='".$name."', code='".$code."', category_id='".$category."',subcategory_id='".$subcategory."',unit_of_counting_id='".$unitOfCounting."', weight_type_id='".$weightType."', pieces_per_box='".$pieces."', price='".$price."',length='".$length."',width='".$width."',height='".$height."',description='".$description."',tax_id='".$taxId."',status='".$status."' WHERE id='".$id."'";
        
        $stmt = $mysqli->prepare($sql);
        $stmt = mysqli_prepare($mysqli, $sql);

        if(mysqli_stmt_execute($stmt)){              
            echo '<div class="done-msg"> ';echo _("product_edit_successfully_edited"); echo' </div>';
        } else{
            echo '<div class="fail-msg">';echo _("product_edit_something_went_wrong"); echo' </div>';
        }

        // Close statement
        mysqli_stmt_close($stmt);
    
    }
    else { ?>

<div class="new-product">
    <h2><?php echo _("product_edit_main_header");?></h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" method="post">
        <div class="row">
            <div class="col-sm-10">
                <div class="row">
                    <input name="id" type="hidden" value="<?php echo $row['id'];?>" />

                    <div class="col-sm-6">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label for="name"><?php echo _("product_edit_Name");?></label>
                            <input type="text" name="name" class="form-control" value="<?php echo $row['productName'];?>">                        
                        </div>
                    </div>


                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="code"><?php echo _("product_edit_code");?></label>
                            <input type="text" name="code" class="form-control" value="<?php echo $row['code'];?>">
                        </div>
                    </div>


                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="cate"><?php echo _("product_edit_category");?></label> 
                        <select name="category_id" class="form-control" id="category">
                            <?php 
                                $queryCategories = "SELECT id as catId,category_name FROM category";                      
                                $resultCategories = $mysqli->query($queryCategories);
                                while ($rowCats = $resultCategories->fetch_assoc()) { ?>                    
                                    <option value="<?php echo $rowCats['catId']; ?>"<?php if (!(strcmp($rowCats['catId'], $row['CatId']))) { echo " selected=\"selected\""; } ?>>
                                        <?php echo $rowCats['category_name'];?>
                                    </option>
                                <?php }                    
                            ?>                              
                        </select>
                        </div>
                    </div>

             
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="sub"><?php echo _("product_edit_subcategory");?></label> 
                        <select name="subcategory_id" class="form-control" id="Subcategory" >
                            <?php
                                $querySubCategories = "SELECT id,name FROM subcategory ";
                                $resultSubCategories = $mysqli->query($querySubCategories);

                                while ($subrowCats = $resultSubCategories->fetch_assoc()) { ?>                    
                                    <option value="<?php echo $subrowCats['id']; ?>"<?php if (!(strcmp($subrowCats['id'], $row['SubcatId']))) { echo " selected=\"selected\""; } ?>>
                                        <?php echo $subrowCats['name'];?>
                                    </option>
                                <?php }                    
                            ?>           
                        </select>
                        </div>
                    </div>


                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="unit"><?php echo _("product_edit_unit");?></label> 
                        <select name="unit_of_counting_id" class="form-control">                            
                            <?php
                                $queryUnit = "SELECT id,name FROM unit_of_counting";
                                $resultUnit = $mysqli->query($queryUnit);
                                while ($rowUnit = $resultUnit->fetch_assoc()) { ?>                    
                                    <option value="<?php echo $rowUnit['id']; ?>"<?php if (!(strcmp($rowUnit['id'], $row['unit_of_counting_id']))) { echo " selected=\"selected\""; } ?>>
                                        <?php echo $rowUnit['name'];?>
                                    </option>
                                <?php }                    
                            ?>            
                        </select>
                        </div>
                    </div>

                    <div class="col-sm-6 weight">
                        <div class="form-group">
                        <label for="weight_type"><?php echo _("product_edit_weight_type");?></label> 
                        <select name="weight_type_id" class="form-control">
                            <?php
                                $queryWt = "SELECT id,name FROM weight_type";
                                $resultWt = $mysqli->query($queryWt);
                                while ($rowWt = $resultWt->fetch_assoc()) { ?>                    
                                    <option value="<?php echo $rowWt['id']; ?>"<?php if (!(strcmp($rowWt['id'], $row['weight_type_id']))) { echo " selected=\"selected\""; } ?>>
                                        <?php echo $rowWt['name'];?>
                                    </option>
                                <?php }                    
                            ?>    
                        </select>
                        </div>
                    </div>

                  
                    <div class="col-sm-6 pieces">
                        <div class="form-group">
                        <label for="pieces"><?php echo _("product_edit_pieces_box");?></label>
                        <input type="number" name="pieces_per_box" class="form-control" value="<?php echo $row['pieces_per_box'];?>">
                        </div>
                    </div>


                    <div class="col-sm-6 price">
                        <div class="form-group">
                        <label for="weight"><?php echo _("product_edit_price");?></label>
                        <input type="number" name="price" class="form-control" value="<?php echo $row['price'];?>">
                        </div>
                    </div>
                    

                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="length"><?php echo _("product_edit_length");?></label>
                        <input type="number" name="length" class="form-control" value="<?php echo $row['length'];?>">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="width"><?php echo _("product_edit_width");?></label>
                        <input type="number" name="width" class="form-control" value="<?php echo $row['width'];?>">
                        </div>
                    </div>


                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="height"><?php echo _("product_edit_height");?></label>
                        <input type="number" name="height" class="form-control" value="<?php echo $row['height'];?>">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="tax"><?php echo _("product_edit_tax");?></label> 
                        <select name="tax_id" class="form-control">
                
                                <?php
                                    $queryTax = "SELECT id,price FROM tax";
                                    $resultTax = $mysqli->query($queryTax);

                                    while ($rowTax = $resultTax->fetch_assoc()) { ?>                    
                                            <option value="<?php echo $rowTax['id']; ?>"<?php if (!(strcmp($rowTax['id'], $row['tax_id']))) { echo " selected=\"selected\""; } ?>>
                                                <?php echo $rowTax['price'];?>
                                            </option>
                                    <?php } 
                                
                                ?>
                        </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="status"><?php echo _("product_edit_status");?></label> 
                        <select name="status" class="form-control">                        
                          <option value="1" <?php if ($row['status'] == '1') echo 'selected'; ?>><?php echo _("product_edit_active");?></option>
                          <option value="0" <?php if ($row['status'] == '0') echo 'selected'; ?>><?php echo _("product_edit_Inactive");?></option>
                        </select>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="form-group">
                        <label for="desc"><?php echo _("product_edit_description");?></label>
                        <textarea class="form-control" id="desc" rows="3" name="description" class="form-control" value="<?php echo $row['description'];?>"></textarea>
                        </div>
                    </div>
                  
                    <!-- End Row of col-10 -->
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

            <div class="col-sm-12 d-flex justify-content-end">
                <button type="submit" value="Update" class="btn main-btn save"><?php echo _("product_edit_save");?></button>
                <button type="button" class="btn btn-secondary  cancel" ><?php echo _("product_edit_cancel");?></button>
            </div>                   

        </div>
    </form>
</div>
<?php } ?>


<!-- Dropdown Menu -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<!-------------------  Update images scripts --------------------->
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
    defaultPreviewContent: '<img src="upload/<?php echo $userPictureURL; ?>" alt="Your Avatar" class="user-img"><h6 class="text-muted btn btn-secondary">Update Image</h6>',
    layoutTemplates: {main2: '{preview} ' + ' {remove} '},
    allowedFileExtensions: ["jpg", "png", "gif"]
    });
</script>

<!------------------ hide and show input fields ------------------>
<script>
  jQuery(document).ready(function($){
    $('select[name=unit_of_counting_id]').change(function () {
      $('.weight').hide();
      $('.pieces').hide();
    //   $('.price').hide();
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
                    //var resp = $.trim(response);
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




   

