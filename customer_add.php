<?php

include("includes/template/header.php");
include("connect.php");
////// Define variables and initialize with empty values
$fname = $lname = $company_name = $email = $phone =  $address = "";
$fname_err = $lname_err = $company_name_err = $email_err = $phone_err =  $address_err = "";


////// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {


  /////// Validate first Name
  if (empty(trim($_POST["fname"]))) {
    $fname_err = _('customer_add_please_enter_first_name');
  } else {
    // Prepare a select statement
    $sql = "SELECT id FROM customer WHERE fname = ?";

    if ($stmt = mysqli_prepare($mysqli, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $fname);

      // Set parameters
      $fname = trim($_POST["fname"]);

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        /* store result */
        mysqli_stmt_store_result($stmt);
      } else {
        echo _('customer_add_something_went_wrong_error');
      }
    }

    // Close statement
    mysqli_stmt_close($stmt);
  }


  /////// Validate Last Name
  if (empty(trim($_POST["lname"]))) {
    $lname_err = _('customer_add_please_enter_last_name');
  } else {
    // Prepare a select statement
    $sql = "SELECT id FROM customer WHERE lname = ?";

    if ($stmt = mysqli_prepare($mysqli, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $lname);

      // Set parameters
      $lname = trim($_POST["lname"]);

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        /* store result */
        mysqli_stmt_store_result($stmt);
      } else {
        echo _('customer_add_something_went_wrong_error');
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
  $targetPath = $uploadDir . $fileName;


  // Check input errors before inserting in database
  if (empty($fname_err) && empty($lname_err)) {

    // if uploaded done, save it.
    if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
      move_uploaded_file($_FILES['userImage']['tmp_name'], $targetPath);
    }

    // Prepare an insert statement
    $sql = "INSERT INTO customer (fname, lname, company_name, email, phone, address, local_image_path) VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($mysqli, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "ssssiss", $param_fname, $param_lname, $param_company, $param_email, $param_phone, $param_address, $param_image);

      // Set parameters
      $param_fname = $fname;
      $param_lname = $lname;
      $param_company = $_POST["company_name"];;
      $param_email = $_POST["email"];;
      $param_phone = $_POST["phone"];
      $param_address = $_POST["address"];
      $param_image = $fileName;

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        echo '<div class="done-msg"> ' . _("customer_add_successfully_added") . ' </div>';
      } else {
        echo '<div class="fail-msg"> ' . _("customer_add_something_went_wrong") . ' </div>';
      }
    }

    // Close statement
    mysqli_stmt_close($stmt);
  }

  // Close connection
  mysqli_close($mysqli);
}

?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="customers.php"><?php echo _("customer_add_customers"); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo _("customer_add_new_customers"); ?></li>
  </ol>
</nav>

<div class="new-product">
  <h2><?php echo _("customer_add_new_customers"); ?></h2>

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" method="post">
    <div class="row">
      <div class="col-lg-10 col-md-12 col-sm-12">
        <div class="row">

          <div class="col-lg-6 col-sm-12">
            <div class="form-group <?php echo (!empty($fname_err)) ? 'has-error' : ''; ?>">
              <label><?php echo _("customer_add_first_name"); ?></label>
              <input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>">
              <span class="help-block"><?php echo $fname_err; ?></span>
            </div>
          </div>

          <div class="col-lg-6 col-sm-12">
            <div class="form-group <?php echo (!empty($lname_err)) ? 'has-error' : ''; ?>">
              <label><?php echo _("customer_add_last_name"); ?></label>
              <input type="text" name="lname" class="form-control" value="<?php echo $lname; ?>">
              <span class="help-block"><?php echo $lname_err; ?></span>
            </div>
          </div>

          <div class="col-lg-6 col-sm-12">
            <div class="form-group <?php echo (!empty($company_name_err)) ? 'has-error' : ''; ?>">
              <label><?php echo _("customer_add_company_name"); ?></label>
              <input type="text" name="company_name" class="form-control" value="<?php echo $company_name; ?>">
              <span class="help-block"><?php echo $company_name_err; ?></span>
            </div>
          </div>

          <div class="col-lg-6 col-sm-12">
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
              <label><?php echo _("customer_add_email"); ?></label>
              <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
              <span class="help-block"><?php echo $email_err; ?></span>
            </div>
          </div>

          <div class="col-lg-6 col-sm-12">
            <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
              <label><?php echo _("customer_add_phone_number"); ?></label>
              <input type="number" name="phone" class="form-control" value="<?php echo $phone; ?>">
              <span class="help-block"><?php echo $phone_err; ?></span>
            </div>
          </div>

          <div class="col-lg-6 col-sm-12">
            <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
              <label><?php echo _("customer_add_address"); ?></label>
              <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
              <span class="help-block"><?php echo $address_err; ?></span>
            </div>
          </div>

        </div>
      </div>

      <div class="col-lg-2 col-md-12 col-sm-12 ">
      <div class="img-container">
        <div class="form-group">
          <div id="kv-avatar-errors-2" class="center-block" style="width:800px;display:none"></div>
          <div class="kv-avatar center-block">
            <input id="avatar-2" name="userImage" type="file" class="file-loading">
          </div>
        </div>
        </div>
      </div>
    </div>

    <div class="col-sm-12 d-flex justify-content-end end-space">
      <button type="submit" class="btn main-btn save"><?php echo _("customer_add_save"); ?></button>
      <button type="button" class="btn btn-secondary  cancel"><?php echo _("customer_add_cancel"); ?></button>
    </div>

</div>
</form>
</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

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
    removeTitle: '<?php echo _("customer_add_cancel_or_reset"); ?>',
    elErrorContainer: '#kv-avatar-errors-2',
    msgErrorClass: 'alert alert-block alert-danger',
    defaultPreviewContent: '<img src="layout/images/user.png" alt="<?php echo _("customer_add_your_avater"); ?>" class="user-img"><h6 class="text-muted btn btn-secondary"><?php echo _("customer_add_change_image"); ?></h6>',
    layoutTemplates: {
      main2: '{preview} ' + ' {remove} '
    },
    allowedFileExtensions: ["jpg", "png", "gif"]
  });
</script>
<!-- Include footer -->
<?php include("includes/template/footer.php"); ?>