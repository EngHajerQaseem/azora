<?php

include("includes/template/header.php");
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!empty($_POST['total'])) {
    // Prepare an insert statement
    $sql = "INSERT INTO expense ( user_id, type, description, total ) VALUES (?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($mysqli, $sql)) {

      mysqli_stmt_bind_param($stmt, "issi", $user_id, $type, $description, $total);

      $user_id = 2; // Take the current user Id here.
      $type = $_POST['type'];
      $description = $_POST['expense_description'];
      $total = $_POST['total'];

      if (mysqli_stmt_execute($stmt)) {
        echo '<div class="done-msg">'; echo _("expense_Add_successfully_added"); echo'</div>';
      } else {
        echo '<div class="fail-msg"> '; echo _("expense_Add_something_went_wrong"); echo'</div>';
      }
    }
    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($mysqli);
  }
}

?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="expense.php"><?php echo _("expense_Add_header");?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo _("expense_Add_New_header");?></li>
  </ol>
</nav>
<div class="row">
  <div class="col-md-12">
    <div class="new-category">

      <h2><?php echo _("expense_Add_main_header");?></h2>

      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <div class="row">

          <div class="col-sm-6">
            <div class="form-group">
              <label for="cate"><?php echo _("expense_Add_Type");?> *</label>
              <select class="form-control" name="type" required>
                <option value="" disabled selected hidden><?php echo _("expense_Add_Type_choose");?></option>
                <option><?php echo _("expense_Add_Type_Utilities");?></option>
                <option><?php echo _("expense_Add_Type_Telecommunication");?> </option>
                <option><?php echo _("expense_Add_Type_Salaries");?></option>
                <option><?php echo _("expense_Add_Type_Rent");?> </option>
                <option><?php echo _("expense_Add_Type_Maintenance");?> </option>

              </select>
            </div>
          </div>

          <div class="col-sm-6">
          </div>

          <div class="col-sm-6 ">
            <div class="form-group">
              <label for="total"><?php echo _("expense_Add_Total");?></label>
              <input type="number" main="1" id="total" name="total" class="form-control" required>
            </div>
          </div>

          <div class="col-sm-6">
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="desc"><?php echo _("expense_Add_Description");?></label>
              <textarea class="form-control" id="desc" rows="3" name="expense_description"></textarea>
            </div>
          </div>

          <div class="col-sm-12 d-flex justify-content-end">
            <input type="submit" class="btn main-btn save" value="<?php echo _("expense_Add_Save");?>" name="insertExpense">
            <button type="button" class="btn btn-secondary  cancel"><?php echo _("expense_Add_Cancel");?></button>
          </div>

      </form>

    </div>

  </div>
  <?php
  include("includes/template/footer.php");
  ?>