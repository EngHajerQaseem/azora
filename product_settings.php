<?php
include("includes/template/header.php");
include("connect.php");
?>

<div class="col white-background">

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $action = isset($_POST['action']) ? $_POST['action'] : null;
        $price;
        $description;
        $table = null;
        switch ($action) {
            case 'tax':
                $price = $_REQUEST['tax-value'];
                $description = $_REQUEST['tax-description'];
                $table = "tax";
                break;
            case 'discount':
                $price = $_REQUEST['discount-value'];
                $description = $_REQUEST['discount-description'];
                $table = "discount";
                break;
            default:
                echo '<div class="fail-msg"> Sorry Something went wrong </div>';
                break;
        }
        if ($table != null) {

            if($_REQUEST['id'] != null){
                $id = $_REQUEST['id'];

                $sql = "UPDATE " . $table . " SET price = ?, description = ? WHERE id = ?";

                $stmt = mysqli_prepare($mysqli, $sql);
    
                mysqli_stmt_bind_param($stmt, "isi", $price, $description, $id);
    
                if (mysqli_stmt_execute($stmt)) {
                    echo '<div class="done-msg"> Updated ' . $table . ' successfully </div>';
                } else {
                    echo '<div class="fail-msg"> Sorry, Something went wrong </div>';
                }
            } else {
                $sql = "INSERT INTO " . $table . " (price, description) VALUES (?, ?)";

                $stmt = mysqli_prepare($mysqli, $sql);
    
                mysqli_stmt_bind_param($stmt, "is", $price, $description);
    
                if (mysqli_stmt_execute($stmt)) {
                    echo '<div class="done-msg"> Added ' . $table . ' successfully </div>';
                } else {
                    echo '<div class="fail-msg"> Sorry, Something went wrong </div>';
                }
            }
            
            mysqli_stmt_close($stmt);
        }
    }
    ?>

    <div class="row">
        <div class="col-12 col-xl-5 product-settings-column-header">
            <img src="layout/images/user.png">
            <h4><?php echo _("product_settings_tax");?></h4>

            <?php
            $query = $mysqli->query("SELECT * FROM tax");

            if ($query->num_rows > 0) {

                while ($row =  $query->fetch_assoc()) {

                    $amount = $row['price'];
                    $description = $row['description'];
                    $id = $row['id'];
            ?>

                    <div class="product-settings-column-row">
                        <div></div>
                        <p><?php echo $amount; ?>%</p>
                        <p><?php echo $description; ?></p>
                        <div class="product-settings-column-row-action">
                            <div class="dropdown">
                                <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo _("product_settings_tax_Action");?>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item dropdown-item-edit" data-toggle="modal" data-target="#tax-modal" data-product-id="<?php echo $id; ?>"><i class="fa fa-edit"></i> <?php echo _("product_settings_tax_edit");?> </a>
                                    <a class="dropdown-item product-settings-delete" data-product-type="tax" data-product-id="<?php echo $id; ?>" href="javascript:void(0)"><i class="fa fa-trash"></i> <?php echo _("product_settings_tax_delete");?> </a>
                                </div>
                            </div>
                        </div>
                    </div>

            <?php }
            } ?>

            <div class="clear-fix"></div>
            <input type="button" value="Add Tax" class="create-new-btn margin-bottom-20" data-toggle="modal" data-target="#tax-modal">

        </div>
        <div class="col-xl-2"></div>
        <div class="col-12 col-xl-5 product-settings-column-header">
            <img src="layout/images/user.png">
            <h4><?php echo _("product_settings_discount");?></h4>

            <?php
                $query = $mysqli->query("SELECT * FROM discount");

                if ($query->num_rows > 0) {

                    while ($row =  $query->fetch_assoc()) {

                        $amount = $row['price'];
                        $description = $row['description'];
                        $id = $row['id'];
            ?>

                    <div class="product-settings-column-row">
                        <div></div>
                        <p><?php echo $amount; ?>%</p>
                        <p><?php echo $description; ?></p>
                        <div class="product-settings-column-row-action">
                            <div class="dropdown">
                                <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo _("product_settings_discount_Action");?>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item dropdown-item-edit" data-toggle="modal" data-target="#discount-modal" data-product-id="<?php echo $id; ?>"><i class="fa fa-edit"></i> <?php echo _("product_settings_discount_edit");?> </a>
                                    <a class="dropdown-item product-settings-delete" data-product-type="discount" data-product-id="<?php echo $id; ?>" href="javascript:void(0)"><i class="fa fa-trash"></i> <?php echo _("product_settings_discount_delete");?> </a>
                                </div>
                            </div>
                        </div>
                    </div>

            <?php }
                } ?>

            <div class="clear-fix"></div>
            <input type="button" value="Add Discount" class="create-new-btn margin-bottom-20" data-toggle="modal" data-target="#discount-modal">

        </div>
    </div>

    <!-- Tax Modal -->
    <div class="modal fade" id="tax-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo _("product_settings_tax_add");?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="action" value="tax">
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="tax-value"><?php echo _("product_settings_tax_add_input");?></label>
                                    <input type="number" class="form-control" id="tax-value" name="tax-value">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="tax-value"><?php echo _("product_settings_tax_add_description");?></label>
                                    <input type="text" class="form-control" id="tax-value" name="tax-description">
                                </div>
                            </div>
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn main-btn"><?php echo _("product_settings_tax_save");?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo _("product_settings_tax_cancel");?></button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Discount Modal -->
    <div class="modal fade" id="discount-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo _("product_settings_discount_add");?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="action" value="discount">
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="tax-value"><?php echo _("product_settings_discount_add_input");?></label>
                                    <input type="number" class="form-control" id="tax-value" name="discount-value">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="tax-value"><?php echo _("product_settings_discount_add_description");?></label>
                                    <input type="text" class="form-control" id="tax-value" name="discount-description">
                                </div>
                            </div>
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn main-btn"><?php echo _("product_settings_discount_save");?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo _("product_settings_discount_cancel");?></button>
                </div>
                </form>
            </div>
        </div>
    </div>

</div>

<?php
    include("includes/template/footer.php");
?>
<script>
$('.product-settings-delete').click(function (e) {
        e.preventDefault();
        var id = $(this).attr('data-product-id');
        var type = $(this).attr('data-product-type');
        bootbox.dialog({
            message: "<div class='delete_user_popup'><div class='icon-trash'><i class='fas fa-trash'></i></div><div class='delete-text'><?php echo _("product_settings_delete_alert_message"); ?></div></div>",
            title: "<i class='glyphicon glyphicon-trash'></i>",
            buttons: {
                success: {
                    label: "<?php echo _("product_settings_alert_cancel"); ?>",
                    className: "btn-normal",
                    callback: function () {
                        $('.bootbox').modal('hide');
                    }
                },
                danger: {
                    label: "<?php echo _("product_settings_alert_delete"); ?>!",
                    className: "btn-danger",
                    callback: function () {
                        $.ajax({
                            type: 'POST',
                            url: 'product_settings_rmv.php',
                            data: 'id=' + id + '&type=' + type
                        })
                            .done(function (response) {
                                bootbox.alert(response);
                                parent.fadeOut('slow');
                            })
                            .fail(function () {
                                bootbox.alert('Error....');
                            })
                    }
                }
            }
        });
    });
    </script>