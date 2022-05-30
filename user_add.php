<?php
include("includes/template/header.php");
include("connect.php");

$full_name = $phone = $email = $password = $image_url = "";
$full_name_err = $phone_err = $email_err = $password_err = $form_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["full_name"]))) {
        $full_name_err = _("user_add_please_enter_full_name");
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM user WHERE full_name = ?";

        if ($stmt = mysqli_prepare($mysqli, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_full_name);

            // Set parameters
            $param_full_name = trim($_POST["full_name"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $full_name_err = _("user_add_full_name_already_taken");
                    echo '<div class="fail-msg">' . $form_err = _("user_add_full_name_cehck_field") . '</div>';
                } else {
                    $full_name = trim($_POST["full_name"]);
                }
            } else {
                echo _("user_add_something_went_wrong_error");
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    if (empty(trim($_POST["phone"]))) {
        $phone_err = _("user_add_please_enter_phone_number");
    } else {
        $sql = "SELECT id FROM user WHERE phone = ?";

        if ($stmt = mysqli_prepare($mysqli, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_phone);

            $param_phone = trim($_POST["phone"]);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $phone_err = _("user_add_phone_number_already_taken");
                    echo '<div class="fail-msg">' . $form_err = _("user_add_phone_number_cehck_field") . '</div>';
                } else {
                    $phone = trim($_POST["phone"]);
                }
            } else {
                echo _("user_add_something_went_wrong_error");
            }
        }

        mysqli_stmt_close($stmt);
    }

    if (empty(trim($_POST["email"]))) {
        $email_err = _("user_add_please_enter_email");
    } else {
        $sql = "SELECT id FROM user WHERE email = ?";

        if ($stmt = mysqli_prepare($mysqli, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            $param_email = trim($_POST["email"]);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = _("user_add_email_already_taken");
                    echo '<div class="fail-msg">' . $form_err = _("user_add_email_cehck_field") . '</div>';
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo _("user_add_something_went_wrong_error");
            }
        }

        mysqli_stmt_close($stmt);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = _("user_add_password_length");
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = _("user_add_password_length");
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate Image_url
    $type = explode('.', $_FILES['userImage']['name']);
    $type = $type[count($type) - 1];
    $uploadDir = "upload/";
    $fileName =  uniqid(rand()) . '.' . $type;
    $targetPath = $uploadDir . $fileName;

    // Check input errors before inserting in database
    if (empty($phone_err) && empty($password_err)) {

        // if uploaded done, save it.
        if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
            move_uploaded_file($_FILES['userImage']['tmp_name'], $targetPath);
        }
        else{
            $fileName="";
        }

        // Prepare an insert statement
        $sql = "INSERT INTO user (full_name, password, phone, email, local_image_path) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($mysqli, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssiss", $param_full_name, $param_password, $param_phone, $param_email, $param_image);

            // Set parameters
            $param_full_name = $full_name;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_phone = $phone;
            $param_email = $email;
            $param_image = $fileName;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                echo '<div class="done-msg"> ' . _("user_add_successfully_added") . ' </div>';
            } else {
                echo '<div class="fail-msg"> ' . _("user_add_something_went_wrong") . ' </div>';
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
        <li class="breadcrumb-item"><a href="users.php"><?php echo _("user_add_users"); ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo _("user_add_new_users"); ?></li>
    </ol>
</nav>

<div class="new-product">
    <h2><?php echo _("user_add_new_users"); ?></h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" method="post">
        <div class="row">
            <div class="col-lg-10 col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group <?php echo (!empty($full_name_err)) ? 'has-error' : ''; ?>">
                            <label><?php echo _("user_add_full_name"); ?></label>
                            <input type="text" name="full_name" class="form-control" value="<?php echo $full_name; ?>">
                            <span class="help-block"><?php echo $full_name_err; ?></span>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                            <label><?php echo _("user_add_phone_number"); ?></label>
                            <input type="number" name="phone" class="form-control" value="<?php echo $phone; ?>">
                            <span class="help-block"><?php echo $phone_err; ?></span>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label><?php echo _("user_add_email"); ?></label>
                            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_err; ?></span>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label><?php echo _("user_add_password"); ?></label>
                            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                            <span class="help-block"><?php echo $password_err; ?></span>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="role"><?php echo _("user_add_role"); ?></label>
                            <select class="form-control" name="role" required>
                                <option>---</option>
                                <option value="0"><?php echo _("user_add_admin"); ?></option>
                                <option value="1"><?php echo _("user_add_cashier"); ?></option>
                            </select>
                        </div>
                    </div>
                </div> <!-- /row -->
            </div> <!-- /col 10 -->

            <!-- User Image -->
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
        <div class="col-sm-12 d-flex justify-content-end">
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="<?php echo _("user_add_save"); ?>">
                <input type="reset" class="btn btn-default" value="<?php echo _("user_add_cancel"); ?>">
            </div>
        </div>
</div> <!-- /row -->
</form>
</div>

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
        removeTitle: '<?php echo _("user_add_cancel_or_reset"); ?>',
        elErrorContainer: '#kv-avatar-errors-2',
        msgErrorClass: 'alert alert-block alert-danger',
        defaultPreviewContent: '<img src="layout/images/user.png" alt="<?php echo _("user_add_your_avater"); ?>" class="user-img"><h6 class="text-muted btn btn-secondary"><?php echo _("user_add_upload_image"); ?></h6>',
        layoutTemplates: {
            main2: '{preview} ' + ' {remove} '
        },
        allowedFileExtensions: ["jpg", "png", "gif"]
    });
</script>
<!-- Include footer -->
<?php include("includes/template/footer.php"); ?>