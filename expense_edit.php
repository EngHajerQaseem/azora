<?php
include("includes/template/header.php");
include("connect.php");

$id = $_REQUEST['id'];
$query = "SELECT * from expense where id='" . $id . "'";
$result = mysqli_query($mysqli, $query) or die(mysqli_error());
$row = mysqli_fetch_assoc($result);

?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="expense.php"><?php echo _("expense_edit_header");?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo _("expense_edit_New_header");?></li>
  </ol>
</nav>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_REQUEST['id'];
  $type = $_REQUEST['type'];
  $description = $_REQUEST['expense_description'];
  $total = $_REQUEST['total'];
  $user_id = 2; //Get user Id here.

  $update = "UPDATE expense SET type ='" . $type . "',user_id ='" . $user_id . "' , description ='" . $description . "', total ='" . $total . "' WHERE id ='" . $id . "' ";

  $stmt = $mysqli->prepare($update);

  $stmt->execute();

  if ($stmt->error) {

    echo '<div class="fail-msg">'; echo _("expense_edit_something_went_wrong"); echo'</div>';
  } else {

    echo '<div class="done-msg"> '; echo _("expense_edit_successfully_added"); echo' </div>';
  }

  $stmt->close();

  // Close connection
  mysqli_close($mysqli);
} else {
  ?>

  <div class="row">
    <div class="col-md-12">
      <div class="new-category">

        <h2><?php echo _("expense_edit_main_header");?></h2>


        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" name="form">

          <div class="row">
            <input name="id" type="hidden" value="<?php echo $row['id']; ?>" />
            <div class="col-sm-6">
              <div class="form-group">
                <label for="cate"><?php echo _("expense_edit_Type");?> *</label>
                <select class="form-control" name="type" required>
                  <option <?php if ($row['type'] == 'Utilities') echo 'selected'; ?>><?php echo _("expense_edit_Type_Utilities");?></option>
                  <option <?php if ($row['type'] == 'Telecommuncation') echo 'selected'; ?>><?php echo _("expense_edit_Type_Telecommunication");?></option>
                  <option <?php if ($row['type'] == 'Salaries') echo 'selected'; ?>><?php echo _("expense_edit_Type_Salaries");?> </option>
                  <option <?php if ($row['type'] == 'Rent') echo 'selected'; ?>><?php echo _("expense_edit_Type_Rent");?> </option>
                  <option <?php if ($row['type'] == 'Maintenance') echo 'selected'; ?>><?php echo _("expense_edit_Type_Maintenance");?></option>

                </select>
              </div>
            </div>

            <div class="col-sm-6">
            </div>

            <div class="col-sm-6 ">
              <div class="form-group">
                <label for="total"><?php echo _("expense_edit_Total");?></label>
                <input type="number" main="1" id="total" name="total" class="form-control" value="<?php echo $row['total']; ?>" required>
              </div>
            </div>

            <div class="col-sm-6">
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label for="desc"><?php echo _("expense_edit_Description");?></label>
                <textarea class="form-control" id="desc" rows="3" name="expense_description"><?php echo $row['description']; ?></textarea>
              </div>
            </div>

            <div class="col-sm-12 d-flex justify-content-end">
              <input type="submit" class="btn main-btn save" value="<?php echo _("expense_edit_update");?>">
              <button type="button" class="btn btn-secondary  cancel"><?php echo _("expense_edit_Cancel");?></button>
            </div>

        </form>

      </div>

    </div>

  <?php } ?>

  <?php include("includes/template/footer.php"); ?>