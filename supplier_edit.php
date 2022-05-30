<?php
    include("includes/template/header.php");
    include("connect.php");

    $id=$_REQUEST['id'];
    $query = "SELECT * from suppliers where id='".$id."'"; 
    $result = mysqli_query($mysqli, $query) or die ( mysqli_error());
    $row = mysqli_fetch_assoc($result);

    $fname_err = $lname_err =  $company_name_err = $email_err = $phone_err =  $address_err = "";

    //User profile picture
    $userPicture = !empty($row['local_image_path'])?$row['local_image_path']:'no-image.png';
    $userPictureURL = ''.$userPicture;

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="supplier.php"><?php echo _("supplier_edit_suppliers"); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo _("supplier_edit_edit_suppliers"); ?></li>
    </ol>
</nav>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_REQUEST['id'];
        $fname = $_REQUEST['fname'];
        $lname = $_REQUEST['lname'];
        $company_name = $_REQUEST['company_name'];
        $phone = $_REQUEST['phone'];
        $address = $_REQUEST['address'];
        $email = $_REQUEST['email'];



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
                        $updateimage = "UPDATE suppliers SET local_image_path = '".$fileName."' where id='".$id."' ";
                        $stmt = $mysqli->prepare($updateimage);
                        $stmt->execute();
                        $stmt->close();

                    }
                }
            }
        }

        // Prepare an insert statement
        $update="UPDATE suppliers SET fname='".$fname."', lname='".$lname."', email='".$email."', phone='".$phone."', address='".$address."', company_name='".$company_name."'  where id='".$id."'";

        $stmt = $mysqli->prepare($update);

        // $stmt->bind_param('sssisssi', $fname, $lname, $company, $phone, $address, $email, $fileName, $id);
        $stmt->execute();

        if ($stmt->error) {
            echo '<div class="fail-msg"> '._("supplier_edit_something_went_wrong").' </div>';
        }
        else {      
            echo '<div class="done-msg"> '._("supplier_edit_updated_successfully").' </div>';
        }


        $stmt->close();

        // Close connection
        // mysqli_close($mysqli);
    }   
else { ?>

<div class="new-product">
  <h2><?php echo _("supplier_edit_edit_suppliers");?></h2>

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" method="post">
    <div class="row">
      <div class="col-lg-10 col-md-12 col-sm-12">
        <div class="row">
           
            <input name="id" type="hidden" value="<?php echo $row['id'];?>" />

            <div class="col-lg-6 col-sm-12">
                <div class="form-group <?php echo (!empty($fname_err)) ? 'has-error' : ''; ?>">
                    <label><?php echo _("supplier_edit_first_name");?></label>
                    <input type="text" name="fname" class="form-control" value="<?php echo $row['fname'];?>">
                    <span class="help-block"><?php echo $fname_err; ?></span>
                </div>   
            </div>

            <div class="col-lg-6 col-sm-12">
                <div class="form-group <?php echo (!empty($lname_err)) ? 'has-error' : ''; ?>">
                    <label><?php echo _("supplier_edit_last_name");?></label>
                    <input type="text" name="lname" class="form-control" value="<?php echo $row['lname'];?>">
                    <span class="help-block"><?php echo $lname_err; ?></span>
                </div>   
            </div>

            <div class="col-lg-6 col-sm-12">
                <div class="form-group <?php echo (!empty($company_name_err)) ? 'has-error' : ''; ?>">
                    <label><?php echo _("supplier_edit_company_name");?></label>
                    <input type="text" name="company_name" class="form-control" value="<?php echo $row['company_name'];?>">
                    <span class="help-block"><?php echo $company_name_err; ?></span>
                </div>   
            </div>


            <div class="col-lg-6 col-sm-12">
                <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                    <label><?php echo _("supplier_edit_email");?></label>
                    <input type="email" name="email" class="form-control" value="<?php echo $row['email'];?>">
                    <span class="help-block"><?php echo $email_err; ?></span>
                </div>   
            </div>

            <div class="col-lg-6 col-sm-12">
                <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                    <label><?php echo _("supplier_edit_phone_number");?></label>
                    <input type="number" name="phone" class="form-control" value="<?php echo $row['phone'];?>">
                    <span class="help-block"><?php echo $phone_err; ?></span>
                </div>   
            </div>

            <div class="col-lg-6 col-sm-12">
              <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                  <label><?php echo _("supplier_edit_address");?></label>
                  <input type="text" name="address" class="form-control" value="<?php echo $row['address'];?>">
                  <span class="help-block"><?php echo $address_err; ?></span>
              </div>   
            </div>
        </div>
      </div>
   
      <div class="col-lg-2 col-md-12 col-sm-12">
          <div class="form-group">		    
              <div id="kv-avatar-errors-2" class="center-block" style="width:800px;display:none"></div>
                  <div class="kv-avatar center-block">
                      <input id="avatar-2" name="userImage" type="file" class="file-loading">
                  </div>
              </div>
          </div>
      </div>   

      <div class="col-sm-12 d-flex justify-content-end end-space">
        <button type="submit" value="Update" class="btn main-btn save"><?php echo _("supplier_edit_save");?></button>
        <button type="button" class="btn btn-secondary  cancel" ><?php echo _("supplier_edit_cancel");?></button>
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
                    removeTitle: '<?php echo _("supplier_edit_cancel_or_reset");?>',
                    elErrorContainer: '#kv-avatar-errors-2',
                    msgErrorClass: 'alert alert-block alert-danger',
                    defaultPreviewContent: '<img src="upload/<?php echo $userPictureURL; ?>" alt="<?php echo _("supplier_edit_your_avater");?>" class="user-img"><h6 class="text-muted btn btn-secondary"><?php echo _("supplier_edit_update_image");?></h6>',
                    layoutTemplates: {main2: '{preview} ' + ' {remove} '},
                    allowedFileExtensions: ["jpg", "png", "gif"]
                });
            </script>
<!-- Include footer -->
<?php include("includes/template/footer.php");?>  