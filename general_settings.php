<?php
include("includes/template/header.php");
include("connect2.php");

$userId = $_SESSION["id"];
$shop_name_err = $address_err = $phone_err = "";

$query = "SELECT * from users where id=$userId ";
$result = mysqli_query($mysqli, $query) or die(mysqli_error());
$row = mysqli_fetch_assoc($result);
$img = !empty($row['local_image_path']) ? 'upload/' . $row['local_image_path'] : 'layout/images/user.png';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["language"])) {
   
    $lang = $_REQUEST['language'];
   
    $sql = "UPDATE users SET language = '$lang' WHERE id= $userId ";        
    $stmt = $mysqli->prepare($sql);

    if(mysqli_stmt_execute($stmt)){   
        if ($_POST["language"] == "arabic") {
            $_SESSION["language"] = "ar_EG";
        } else if ($_POST["language"] == "english") {
            $_SESSION["language"] = "en_US";
        }           
        echo '<div class="done-msg"> Language Changed succefully </div>';        
    } else{
        echo '<div class="fail-msg">' . _("general_settings_something_went_wrong") . ' </div>';
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save_img"])) {
//     /////// image updating
//     $updateimage = '';
//     $type = explode('.', $_FILES['userImage']['name']);
//     $type = $type[count($type) - 1];
//     $uploadDir = "upload/";
//     $fileName = basename($_FILES["userImage"]["name"]);
//     $targetPath = $uploadDir . $fileName;

//     // if there is an update for image update it.
//     if (isset($_FILES['userImage']['name'])) {
//         if (in_array($type, array('gif', 'jpg', 'jpeg', 'png'))) {
//             if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
//                 if (move_uploaded_file($_FILES["userImage"]["tmp_name"], $targetPath)) {
//                     $updateimage = "UPDATE users SET local_image_path= '" . $fileName . "' where id='" . $userId . "' ";
//                     $stmt = $mysqli->prepare($updateimage);
//                     $stmt->execute();
//                     $stmt->close();
//                     // header("Refresh:0");
//                     // header("location:profile.php");
//                     // header('Location: ' . $_SERVER['PHP_SELF']);
//                     die('<META http-equiv="refresh" content="0;URL=' . $_SERVER['PHP_SELF'] . '">');
//                 }
//             }
//         }
//     }
// }

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_info"])) {

    $shopName = $_REQUEST['shopName'];
    $phone = $_REQUEST['phone'];
    $address = $_REQUEST['address'];
    /////// Validate Full Name
    if (empty(trim($_POST["shopName"]))) {
        $shop_name_err = _("general_settings_enter_shop_name_error");
    }

    if (empty(trim($_POST["address"]))) {
        $address_err = _("general_settings_enter_address_error");
    }
    //  /////// Validate Phone
    if (empty(trim($_POST["phone"]))) {
        $phone_err = _("general_settings_enter_phone_error");
    } else {
        $sql = "SELECT id FROM users WHERE phone = ? and id != $userId";

        if ($stmt = mysqli_prepare($mysqli, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_phone);

            $param_phone = trim($_POST["phone"]);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $phone_err = _("general_settings_phone_already_taken");
                } else {
                    $phone = trim($_POST["phone"]);
                }
            } else {
                echo _("general_settings_something_went_wrong_error");
            }
        }

        mysqli_stmt_close($stmt);
    }

    if (empty($shop_name_err) && empty($address_err) && empty($phone_err)) {
        // Prepare an insert statement
        $update = "UPDATE users SET shopName='" . $shopName . "', phone='" . $phone . "', address='" . $address . "' where id='" . $userId . "'";

        $stmt = $mysqli->prepare($update);
        $stmt->execute();

        if ($stmt->error) {
            echo '<div class="fail-msg"> ' . _("general_settings_something_went_wrong") . ' </div>';
        } else {
            // header('Location: ' . $_SERVER['PHP_SELF']);
            die('<META http-equiv="refresh" content="0;URL=' . $_SERVER['PHP_SELF'] . '">');
            // echo '<div class="done-msg"> User Updated Successfully. </div>';
        }
        $stmt->close();

        // Close connection
        mysqli_close($mysqli);
    }
}
//    else {

?>

<div class="col basic-information-box">
    <h4><?php _("general_settings_business_information"); ?></h4>
    <div class="row">
        <div class="col-lg-4  col-sm-12 ">
        <div class="img-container">
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
                <div class="form-group <?php echo (!empty($full_name_err)) ? 'has-error' : ''; ?>">
                    <div id="kv-avatar-errors-2" class="center-block" style="width:800px;height:200px;display:none"></div>
                    <div class="kv-avatar center-block">
                        <input id="avatar-2" name="userImage" type="file" class="file-loading">
                    </div>
                </div>
                <div id="save-img" class="text-center">

                </div>

            </form>
               </div>
        </div>

        <div class="col-lg-8  col-sm-12   business-information">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="form">
                <label for="shopName"><?php echo _("general_settings_shop_name"); ?></label>
                <input type="text" value="<?php echo $row['shopName']; ?>" name="shopName">
                <span class="help-block"><?php echo $shop_name_err; ?></span>

                <label for="phone"><?php echo _("general_settings_phone"); ?></label>
                <input type="phone" value="<?php echo $row['phone']; ?>" name="phone">
                <span class="help-block"><?php echo $phone_err; ?></span>


                <label for="address"><?php echo _("general_settings_address"); ?></label>
                <input type="text" value="<?php echo $row['address']; ?>" name="address">
                <span class="help-block"><?php echo $address_err; ?></span>

            </form>
        </div>

    </div>
</div>
<?php // } 
?>

<div class="col">
    <div class="row">
        <div class="col-12 col-sm-6 user-profile-logout">
            <!-- <div></div> 
            <img src="layout/images/globe.png"> -->
            <i class="fa fa-globe-europe"></i>
            <p><?php echo _("general_settings_language"); ?></p>
            <p></p>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="lang-select general_Settings_select">               
                <select name="language" onchange="this.form.submit()" class="remove-border">                        
                    <option value="english" <?php if ($row['language'] == 'english') echo 'selected'; ?>><?php echo _("general_settings_english");?></option>
                    <option value="arabic" <?php if ($row['language'] == 'arabic') echo 'selected'; ?>><?php echo _("general_settings_arabic");?></option>
                </select>
            </form>
        </div>
        <!-- <div class="col-2"></div>
            <div class="col-12 col-sm-5 user-profile-logout">
                <div></div>
                <img src="layout/images/user.png">
                <p>Theme</p>
                <p>Light Theme</p>
            </div> -->
    </div>
</div>

<script src="layout/js/fileinput.min.js"></script>
<script type="text/javascript">
    $("#avatar-2").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        showBrowse: false,
        browseOnZoneClick: false,
        removeLabel: '',
        removeIcon: '<i class="fas fa-times"></i>',
        removeTitle: '<?php echo _("general_settings_cancel_or_reset"); ?>',
        elErrorContainer: '#kv-avatar-errors-2',
        msgErrorClass: 'alert alert-block alert-danger',
         defaultPreviewContent: '<img src="<?php echo $img; ?>" alt="<?php echo _("general_settings_your_avater"); ?>" class="user-img">',
        layoutTemplates: {
            main2: '{preview} '
        },
        allowedFileExtensions: ["jpg", "png", "gif"]
    });
</script>
<script>
    if (!localStorage.getItem("reload")) {
        /* set reload to true and then reload the page */
        localStorage.setItem("reload", "true");
        window.location=window.location;
    }
    /* after reloading remove "reload" from localStorage */
    else {
        localStorage.removeItem("reload");
        // localStorage.clear(); // or clear it, instead
    }
</script>
<?php
include "includes/template/footer.php";
?>