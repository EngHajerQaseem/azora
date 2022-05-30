<?php
include("includes/template/header.php");
include("connect.php");


$id = $_REQUEST['id'];
$category = $_REQUEST['category'];

if($_SESSION["language"] == "ar_EG" && $category == 'category'){

  $category_tab = "صنف";
}

else if($_SESSION["language"] == "ar_EG" && $category == 'subcategory'){

  $category_tab = "صنف فرعي";
}
if($_SESSION["language"] == "en_US" && $category == 'category'){

  $category_tab = "category";
}

else if($_SESSION["language"] == "en_US" && $category == 'subcategory'){

  $category_tab = "subcategory";
}
$query = "SELECT * from $category where id='" . $id . "'";
$result = mysqli_query($mysqli, $query) or die(mysqli_error());
$row = mysqli_fetch_assoc($result);
?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="categories.php"><?php echo _("category_edit_New_header");?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo _("category_edit_header");?> <?php echo $category_tab ?></li>
  </ol>
</nav>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_REQUEST['id'];
  $name = $_REQUEST['name'];
  $description = $_REQUEST['description'];

  $status = 0;
  if (isset($_REQUEST['status']) && $_REQUEST['status'] == 1) {
    $status = 1;
  }

  if($category == 'subcategory'){
    $category_id = $_REQUEST['category_id'];

    $update = "UPDATE subcategory SET name ='" . $name . "',category_id ='" . $category_id . "' , description ='" . $description . "', status ='" . $status . "' WHERE id ='" . $id . "' ";
  } else {
    $update = "UPDATE category SET category_name ='" . $name . "',description ='" . $description . "', status ='" . $status . "' WHERE id ='" . $id . "' ";
  }
  $stmt = $mysqli->prepare($update);
  
  $stmt->execute();

  if ($stmt->error) {

    echo '<div class="fail-msg">';echo _("category_edit_something_went_wrong"); echo'</div>';
  } else {

    echo '<div class="done-msg"> '.$category.' ';echo _("category_edit_successfully_edited"); echo' </div>';
  }

  $stmt->close();

  // Close connection
  mysqli_close($mysqli);
} else {
  ?>

<div class="row">
  <div class="col-md-12">
    <div class="category-tabs">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <?php
        if ($category == 'category') {
          echo '<li class="nav-item" data-class="addCategory">
                  <a class="nav-link active" id="home-tab" href="#">';echo _("category_edit_tab"); echo'</a>
                </li>';
        } else {
          echo '<li class="nav-item" data-class="addSubCategory">
                  <a class="nav-link active" id="profile-tab" href="#">';echo _("subcategory_edit_tab"); echo'</a>
                </li>';
        }
        ?>
      </ul>
    </div>
  </div>
</div>

<div class="new-category">
<?php if ($category == 'category') { ?>
    <div class="addCategory  active" id="cate">
      <h2><?php echo _("category_edit_main_header");?></h2>

      <form method="post">

        <div class="row">
          <input name="id" type="hidden" value="<?php echo $row['id']; ?>" />
          <div class="  col-sm-6 ">
            <div class="form-group">
              <label for="name"><?php echo _("category_edit_Name");?> *</label>
              <input type="text" class="form-control" id="name" name="name" required value="<?php echo $row['category_name']; ?>">
            </div>
          </div>

          <div class=" col-sm-7 ">
            <div class="form-group">
              <label for="desc"><?php echo _("category_edit_Description");?></label>
              <textarea class="form-control" id="desc" rows="3" name="description"><?php echo $row['description']; ?></textarea>
            </div>
          </div>

          <div class="col-sm-6 ">
            <div class="form-group">
              <label for="status"><?php echo _("category_edit_Status");?></label>
              <label class="switch" style="display:block">
                <input type="checkbox" id="status" name="status" value="1" <?php echo ($row['status']==1 ? 'checked': ''); ?> >
                <span class="slider round"></span>
              </label>
            </div>
          </div>

          <div class="col-sm-12 d-flex justify-content-end">
            <input type="submit" class="btn main-btn save" value="<?php echo _("category_edit_Save");?>" name="insertCategory">
            <button type="button" class="btn btn-secondary  cancel"><?php echo _("category_edit_Cancel");?></button>
          </div>

      </form>
    </div>
<?php } else { ?>
  <div class=" active" id="sub">
    <h2><?php echo _("subcategory_edit_main_header");?></h2>

    <form method="post">

      <div class="row">
        <input name="id" type="hidden" value="<?php echo $row['id']; ?>" />
        <div class="col-sm-6">
          <div class="form-group">
            <label for="name"><?php echo _("subcategory_edit_Name");?> *</label>
            <input type="text" class="form-control" id="name" name="name" required value="<?php echo $row['name']; ?>">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="cate"><?php echo _("subcategory_edit_Category");?> *</label>
            <select class="form-control" name="category_id" required>
              <option value="" disabled selected hidden><?php echo _("subcategory_edit_Category_Choose");?></option>
              <?php
                $categoryResult = $mysqli->query("SELECT category_name, id FROM category");
                $categories = $categoryResult->fetch_all(MYSQLI_ASSOC);
                foreach ($categories as $category) {
                  if ($category['id'] == $row['category_id']){
                    echo '<option value="' . $category['id'] . '" selected>' . $category['category_name'] . '</option>';
                  } else {
                    echo '<option value="' . $category['id'] . '">' . $category['category_name'] . '</option>';
                  }
                }
                ?>
            </select>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            <label for="desc"><?php echo _("subcategory_edit_Description");?></label>
            <textarea class="form-control" id="desc" rows="3" name="description"><?php echo $row['description']; ?></textarea>
          </div>
        </div>

        <div class="col-sm-6 ">
          <div class="form-group">
            <label for="status"><?php echo _("subcategory_edit_Status");?></label>
            <label class="switch" style="display:block">
              <input type="checkbox" id="status" name="status" value="1" <?php echo ($row['status']==1 ? 'checked': ''); ?>>
              <span class="slider round"></span>
            </label>
          </div>
        </div>

        <div class="col-sm-12 d-flex justify-content-end">
          <input type="submit" class="btn main-btn save" value="<?php echo _("subcategory_edit_Save");?>" name="insertSubCategory">
          <button type="button" class="btn btn-secondary  cancel"><?php echo _("subcategory_edit_Cancel");?></button>
        </div>

    </form>
  </div>
<?php } ?>

</div>

<?php } ?>

<?php
include("includes/template/footer.php");
?>