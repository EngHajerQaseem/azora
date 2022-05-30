<?php
include("includes/template/header.php");
include("connect.php");

$id = $_REQUEST['id'];
$query = "SELECT * from user where id='" . $id . "'";
$result = mysqli_query($mysqli, $query) or die(mysqli_error());
$row = mysqli_fetch_assoc($result);

$full_name_err = $password_err = $phone_err = $email_err = "";

//User profile picture
$userPicture = !empty($row['local_image_path']) ? $row['local_image_path'] : 'no-image.png';
$userPictureURL = '' . $userPicture;
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="users.php"><?php echo _("user_edit_users");?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo _("user_edit_edit_users");?></li>
  </ol>
</nav>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_REQUEST['id'];
  $full_name = $_REQUEST['full_name'];
  $phone = $_REQUEST['phone'];
  $email = $_REQUEST['email'];
  $password = $_REQUEST['password'];


  /////// image updating
  $updateimage = '';
  $type = explode('.', $_FILES['userImage']['name']);
  $type = $type[count($type) - 1];
  $uploadDir = "upload/";
  $fileName = basename($_FILES["userImage"]["name"]);
  $targetPath = $uploadDir . $fileName;

  // if there is an update for image update it.
  if (isset($_FILES['userImage']['name'])) {
    if (in_array($type, array('gif', 'jpg', 'jpeg', 'png'))) {
      if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
        if (move_uploaded_file($_FILES["userImage"]["tmp_name"], $targetPath)) {
          $updateimage = "UPDATE user SET local_image_path= '" . $fileName . "' where id='" . $id . "' ";
          $stmt = $mysqli->prepare($updateimage);
          $stmt->execute();
          $stmt->close();
        }
      }
    }
  }


  // Prepare an insert statement
  $update = "UPDATE user SET full_name='" . $full_name . "', password='" . $password . "', phone='" . $phone . "', email='" . $email . "' where id='" . $id . "'";

  $stmt = $mysqli->prepare($update);

  // $stmt->bind_param('ississ', $id, $full_name, $password, $phone, $email, $fileName);
  $stmt->execute();

  if ($stmt->error) {
    echo '<div class="fail-msg"> '._("user_edit_something_went_wrong").' </div>';
  } else {
    // header('Location: ' . $_SERVER['PHP_SELF']);
    // die('<META http-equiv="refresh" content="0;URL=' . $_SERVER['PHP_SELF'] .'?id=' .$id = $_REQUEST['id']. '">');
    echo '<div class="done-msg"> '._("user_edit_successfully_added").' </div>';
  }


  $stmt->close();

  // Close connection
  mysqli_close($mysqli);
} else {

?>




  <div class="new-product edit-usr">
    <h2><?php echo _("user_edit_edit_users");?></h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" name="form">
      <div class="row">
        <div class="col-lg-10 col-md-12 col-sm-12">
          <div class="row">
            <input type="hidden" name="new" value="1" />
            <input name="id" type="hidden" value="<?php echo $row['id']; ?>" />

            <div class="col-lg-6 col-sm-12">
              <div class="form-group" <?php echo (!empty($full_name_err)) ? 'has-error' : ''; ?>>
                <label for="full_name"><?php echo _("user_edit_full_name");?></label>
                <input type="text" name="full_name" class="form-control" id="full_name" value="<?php echo $row['full_name']; ?>">
                <div class="err">
                  <span class="help-block"><?php echo $full_name_err; ?></span>
                </div>
              </div>
            </div>

            <div class="col-lg-6 col-sm-12">
              <div class="form-group" <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>>
                <label for="phone"><?php echo _("user_edit_phone_number");?></label>
                <input type="number" name="phone" class="form-control" id="phone" value="<?php echo $row['phone']; ?>">
                <div class="err">
                  <span class="help-block"><?php echo $phone_err; ?></span>
                </div>
              </div>
            </div>

            <div class="col-lg-6 col-sm-12">
              <div class="form-group" <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>>
                <label for="email"><?php echo _("user_edit_email");?></label>
                <input type="email" name="email" class="form-control" id="email" value="<?php echo $row['email']; ?>">
                <div class="err">
                  <span class="help-block"><?php echo $email_err; ?></span>
                </div>
              </div>
            </div>

            <div class="col-lg-6 col-sm-12">
              <div class="form-group">
                <label for="pass"><?php echo _("user_edit_password");?></label>
                <input type="password" name="password" class="form-control" id="pass" value="<?php echo $row['password']; ?>">
              </div>
            </div>

            <div class="col-lg-6 col-sm-12">
              <div class="form-group">
                <label for="role"><?php echo _("user_edit_role");?></label>
                <select class="form-control">
                  <option>---</option>
                  <option><?php echo _("user_edit_cashier");?></option>
                  <option><?php echo _("user_edit_admin");?></option>
                </select>
              </div>
            </div>

            <!-- <div class="col-sm-12">
              <h5>Privileges</h5>
            </div> -->

            <!-- <div class="col-sm-6"> -->
            <!-- <button class="btn main-btn">Copy Privileges from another user</button> -->
            <!-- <div class="form-group">
                <label for="role">Copy Privileges from another user</label>
                <select class="form-control">
                  <option>---</option>
                  <option>Ali (Cashier)</option>
                  <option>Ahmed (Admin)</option>
                  <option>Mohamed (Cashier)</option>
                </select>
              </div>
            </div> -->

            <!-- <div class="col-sm-12">
              <h6>Home Reports</h6>
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input " type="checkbox" value="" id="sales">
                <label class="custom-control-label" for="sales">
                  Total Sales
                </label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="purchase">
                <label class="custom-control-label" for="purchase">
                  Total purchases
                </label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="trans">
                <label class="custom-control-label" for="trans">
                  Total transactions
                </label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="Sells">
                <label class="custom-control-label" for="Sells">
                  Sells vs Purchase
                </label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="stock">
                <label class="custom-control-label" for="stock">
                  Stock value
                </label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="products">
                <label class="custom-control-label" for="products">
                  Hot Products
                </label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="profit">
                <label class="custom-control-label" for="profit">
                  Profit
                </label>
              </div>
            </div> -->

            <!-- <div class="col-sm-12">
              <h6>Category</h6>
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="cateView">
                <label class="custom-control-label" for="cateView">
                  View
                </label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="cateAdd">
                <label class="custom-control-label" for="cateAdd">
                  Add
                </label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="cateEdit">
                <label class="custom-control-label" for="cateEdit">
                  Edit
                </label>
              </div>


              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="cateSearch">
                <label class="custom-control-label" for="cateSearch">
                  Search
                </label>
              </div>


              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="cateDelete">
                <label class="custom-control-label" for="cateDelete">
                  Delete
                </label>
              </div>

            </div> -->


            <!-- <div class="col-sm-12">
              <h6>Subcategory</h6>
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="subView">
                <label class="custom-control-label" for="subView">
                  View
                </label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="subAdd">
                <label class="custom-control-label" for="subAdd">
                  Add
                </label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="subEdit">
                <label class="custom-control-label" for="subEdit">
                  Edit
                </label>
              </div>


              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="subSearch">
                <label class="custom-control-label" for="subSearch">
                  Search
                </label>
              </div>


              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="subDelete">
                <label class="custom-control-label" for="subDelete">
                  Delete
                </label>
              </div>

            </div> -->


            <!-- <div class="col-sm-12">
              <h6>Products</h6>
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="proView">
                <label class="custom-control-label" for="proView">
                  View
                </label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="proAdd">
                <label class="custom-control-label" for="proAdd">
                  Add
                </label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="proEdit">
                <label class="custom-control-label" for="proEdit">
                  Edit
                </label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="proSearch">
                <label class="custom-control-label" for="proSearch">
                  Search
                </label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="proDelete">
                <label class="custom-control-label" for="proDelete">
                  Delete
                </label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="price">
                <label class="custom-control-label" for="price">
                  Update Price
                </label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="barcode">
                <label class="custom-control-label" for="barcode">
                  Print Barcode
                </label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="details">
                <label class="custom-control-label" for="details">
                  Details
                </label>
              </div>

            </div> -->


            <!-- <div class="col-sm-6">
              <h6>App Users</h6>
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="userView">
                <label class="custom-control-label" for="userView">
                  View
                </label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="userAdd">
                <label class="custom-control-label" for="userAdd">
                  Add
                </label>
              </div>

              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="userEdit">
                <label class="custom-control-label" for="userEdit">
                  Edit
                </label>
              </div>


              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="" id="privilege">
                <label class="custom-control-label" for="privilege">
                  Change privileges
                </label>
              </div>

            </div> -->

          </div>
        </div>

        <!-- User Image -->
        <div class="col-lg-2 col-md-12 col-sm-12 ">
          <div class="form-group">
            <div id="kv-avatar-errors-2" class="center-block" style="width:800px;display:none"></div>
            <div class="kv-avatar center-block">
              <input id="avatar-2" name="userImage" type="file" class="file-loading">
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-12 d-flex justify-content-end">
        <button type="submit" value="Update" class="btn main-btn save"><?php echo _("user_edit_save"); ?></button>
        <button type="button" class="btn btn-secondary  cancel"><a href="users.php"><?php echo _("user_edit_cancel"); ?></a></button>
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
    removeTitle: '<?php echo _("user_edit_cancel_or_reset"); ?>',
    elErrorContainer: '#kv-avatar-errors-2',
    msgErrorClass: 'alert alert-block alert-danger',
    defaultPreviewContent: '<img src="upload/<?php echo $userPictureURL; ?>" alt="<?php echo _("user_edit_your_avater"); ?>" class="user-img"><h6 class="text-muted btn btn-secondary"><?php echo _("user_edit_change_image"); ?></h6>',
    layoutTemplates: {
      main2: '{preview} ' + ' {remove} '
    },
    allowedFileExtensions: ["jpg", "png", "gif"]
  });
</script>
<!-- Include footer -->
<?php include("includes/template/footer.php"); ?>