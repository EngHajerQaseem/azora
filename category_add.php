<?php

include("includes/template/header.php");
include("connect.php");

$conn = $mysqli;

$result = $conn->query("SELECT category_name, id FROM category");

$categories = $result->fetch_all(MYSQLI_ASSOC);


if (isset($_POST['insertCategory'])) {

  $status = 0;
  if (isset($_POST['category_status']) && $_POST['category_status'] == 1) {
    $status = 1;
  }

  insertCategory($_POST['category_name'], $_POST['category_description'], $status, $conn);
}

if (isset($_POST['insertSubCategory'])) {

  $status = 0;
  if (isset($_POST['subcategory_status']) && $_POST['subcategory_status'] == 1) {
    $status = 1;
  }

  insertSubCategory($_POST['category_id'], $_POST['subcategory_name'], $_POST['subcategory_description'], $status, $conn);
}


function insertCategory($category_name, $description, $status, $conn)
{
  try {
    $stmt = $conn->prepare("INSERT INTO category (category_name, description, status)
      VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $category_name, $description, $status);
    $stmt->execute();
    $stmt->close();
    echo '<div class="done-msg">';echo _("category_Add_successfully_added"); echo'</div>';
  } catch (PDOException $e) {
    echo $stmt . "<br>" . $e->getMessage();
    echo '<div class="fail-msg">';echo _("category_Add_something_went_wrong"); echo'</div>';
  }
}

function insertSubCategory($category_id, $subcategory_name, $description, $status, $conn)
{
  try {
    $stmt = $conn->prepare("INSERT INTO subcategory (category_id, name, description, status)
      VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issi", $category_id, $subcategory_name, $description, $status);
    $stmt->execute();
    $stmt->close();
    echo '<div class="done-msg">';echo _("subcategory_Add_successfully_added"); echo'</div>';
  } catch (PDOException $e) {
    echo $stmt . "<br>" . $e->getMessage();
    echo '<div class="fail-msg">';echo _("subcategory_Add_something_went_wrong"); echo'</div>';
  }
}




?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="categories.php"><?php echo _("category_Add_header");?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo _("category_Add_New_header");?></li>
  </ol>
</nav>
<div class="row">
  <div class="col-md-12">
    <div class="category-tabs">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" data-class="addCategory">
          <a class="nav-link active" id="home-tab" href="#"><?php echo _("category_Add_tab");?></a>
        </li>
        <li class="nav-item" data-class="addSubCategory">
          <a class="nav-link" id="profile-tab" href="#"><?php echo _("subcategory_Add_tab");?></a>
        </li>


      </ul>
    </div>
  </div>
</div>
<div class="new-category">
  <div class="addCategory  active" id="cate">
    <h2><?php echo _("category_Add_main_header");?></h2>


    <form method="post">


      <div class="row">
        <div class="  col-sm-6 ">
          <div class="form-group">
            <label for="name"><?php echo _("category_Add_Name");?> *</label>
            <input type="text" class="form-control" id="name" name="category_name" required>

          </div>
        </div>



        <div class=" col-sm-7 ">
          <div class="form-group">
            <label for="desc"><?php echo _("category_Add_Description");?></label>
            <textarea class="form-control" id="desc" rows="3" name="category_description"></textarea>
          </div>
        </div>

        <div class="col-sm-6 ">
          <div class="form-group">
            <label for="status"><?php echo _("category_Add_Status");?></label>
            <label class="switch" style="display:block">
              <input type="checkbox" id="status" name="category_status" value="1" checked>
              <span class="slider round"></span>
            </label>
          </div>
        </div>



        <div class="col-sm-12 d-flex justify-content-end">
          <input type="submit" class="btn main-btn save" value="<?php echo _("category_Add_Save");?>" name="insertCategory">
          <button type="button" class="btn btn-secondary  cancel"><?php echo _("category_Add_Cancel");?></button>
        </div>


    </form>

  </div>

</div>


<div class="addSubCategory" id="sub">
  <h2><?php echo _("subcategory_Add_main_header");?></h2>


  <form method="post">


    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <label for="name"><?php echo _("subcategory_Add_Name");?> *</label>
          <input type="text" class="form-control" id="name" name="subcategory_name" required>

        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="cate"><?php echo _("subcategory_Add_Category");?> *</label>
          <select class="form-control" name="category_id" required>
            <option value="" disabled selected hidden><?php echo _("subcategory_Add_Category_Choose");?></option>
            <?php
            foreach ($categories as $category) {
              echo '<option value="' . $category['id'] . '">' . $category['category_name'] . '</option>';
            }
            ?>
          </select>
        </div>
      </div>


      <div class="col-sm-6">
        <div class="form-group">
          <label for="desc"><?php echo _("subcategory_Add_Description");?></label>
          <textarea class="form-control" id="desc" rows="3" name="subcategory_description"></textarea>
        </div>
      </div>


      <div class="col-sm-6 ">
        <div class="form-group">
          <label for="status"><?php echo _("subcategory_Add_Status");?></label>
          <label class="switch" style="display:block">
            <input type="checkbox" id="status" name="subcategory_status" value="1" checked>
            <span class="slider round"></span>
          </label>
        </div>
      </div>



      <div class="col-sm-12 d-flex justify-content-end">
        <input type="submit" class="btn main-btn save" value="<?php echo _("subcategory_Add_Save");?>" name="insertSubCategory">
        <button type="button" class="btn btn-secondary  cancel"><?php echo _("subcategory_Add_Cancel");?></button>
      </div>


  </form>

</div>

</div>
<?php
include("includes/template/footer.php");
?>