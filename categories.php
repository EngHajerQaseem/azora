<?php

include("includes/template/header.php");
include("connect.php");
include("includes/template/functions.php");

//Include pagination class file
include('pagination.php');

?>




<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'Category')"
        id="defaultOpen"><?php echo _("Category_header");?></button>
    <button class="tablinks" onclick="openCity(event, 'SubCategory')"><?php echo _("subCategory_header");?></button>
</div>

<!-- Tab Content -->
<div id="Category" class="tabcontent">


    <div class="products-page">
        <div class="product-header">
            <div class="row">
                <div class="col">
                    <!-- <div class="dropdown">
                             <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                All Categories
                            </button> 
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Recent </a>
                                <a class="dropdown-item" href="#">Categroy Name</a>
                                <a class="dropdown-item" href="#">Categroy Name</a>
                            </div>
                        </div> -->
                </div>

                <div class="col-lg-4  col-12">
                    <div class="input-group md-form form-sm form-1 pl-0">
                        <input class="form-control my-0 py-1" type="text" id="category_keyword"
                            placeholder="<?php echo _("Category_search_input");?>" onkeyup="categorySearchFilter()" />
                        <!-- <input class="form-control my-0 py-1" type="text" placeholder="Search Categories" aria-label="Search"> -->
                        <div class="input-group-append">
                            <span class="input-group-text search-icon" id="basic-text1"><i
                                    class="fa fa-search text-white" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>



                <div class="col d-flex justify-content-end">
                    <!-- <a class="btn main-btn" href="category_add.php"><?php //echo _("Category_Add_New_category");?></a> -->
                </div>


            </div>
        </div>

        <div class="user-wrapper">
            <div class="loading-overlay">
                <div class="overlay-content"><?php echo _("Category_loading");?></div>
            </div>
            <div id="category_content">
                <?php

                    $limit = 8;

                    //get number of rows
                    $queryNum = $mysqli->query("SELECT COUNT(id) as categoryNum FROM category");
                    $resultNum = $queryNum->fetch_assoc();
                    $rowCount = $resultNum['categoryNum'];

                    //initialize pagination class
                    $pagConfig = array(
                        'totalRows' => $rowCount,
                        'perPage' => $limit,
                        'link_func' => 'categorySearchFilter'
                    );
                    $pagination =  new Pagination($pagConfig);

                    // Count Rows and number them
                    $counter = 0;

                    //get rows
                    $query = $mysqli->query("SELECT id AS 'id', name AS 'categoryName', nameAR as 'categoryNameAR'
                                        FROM category
                                        where archive=0
                                        ORDER BY id ASC
                                        LIMIT $limit");

                    if ($query->num_rows > 0) { ?>
                <div class="users_list">
                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <th scope="col"><?php echo _("Category_Name");?></th>
                                <!-- <th scope="col"><?php //echo _("Category_Status");?></th>
                                        <th scope="col"></th> -->
                            </tr>
                        </thead>
                        <?php
                                    while ($row = $query->fetch_assoc()) {
                                        $counter++;
                                        $name = checkProductsNames($row['categoryName'],$row['categoryNameAR']);
                                       // $status = $row['status'];
                                        ?>

                        <!-- content -->
                        <tbody>
                            <tr>
                                <td><?php echo $name; ?></td>
                                <!-- <td>
                                                <label class="switch">
                                                    <?php
                                                            // if ($status == 1) {
                                                            //     echo '<input type="checkbox" checked onclick="return false;">';
                                                            // } else {
                                                            //     echo '<input type="checkbox" onclick="return false;">';
                                                            // }
                                                            ?>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td class="align-content-end">
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <?php //echo _("Category_Action");?>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="category_edit.php?id=<?php //echo $row['id']; ?>&category=<?php echo 'category'; ?>"><i class="fa fa-edit"></i> <?php echo _("Category_Edit");?> </a>
                                                        <a class="dropdown-item delete_cat" data-cat-id="<?php //echo $row["id"]; ?>" href="javascript:void(0)"><i class="fa fa-trash"></i> <?php echo _("Category_Delete");?> </a>
                                                    </div>
                                                </div>
                                            </td> -->
                            </tr>
                        </tbody>
                        <?php } ?>
                    </table>
                </div>
                <?php echo $pagination->createLinks(); ?>
                <?php } ?>
            </div>
        </div>
    </div> <!-- / End user-wrapper -->
</div>


<!-- </div> -->



<div id="SubCategory" class="tabcontent">
    <div class="products-page">
        <div class="product-header">
            <div class="row">
                <div class="col">
                    <!-- <div class="dropdown"> -->
                    <!-- <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                All Categories
                            </button> -->
                    <!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Recent </a>
                                <a class="dropdown-item" href="#">Categroy Name</a>
                                <a class="dropdown-item" href="#">Categroy Name</a>
                            </div> -->
                    <!-- </div> -->
                </div>

                <div class="col-lg-4  col-12">
                    <div class="input-group md-form form-sm form-1 pl-0">
                        <input class="form-control my-0 py-1" type="text" id="subcategory_keyword"
                            placeholder="<?php echo _("subCategory_search_input");?>"
                            onkeyup="subCategorySearchFilter()" />
                        <!-- <input class="form-control my-0 py-1" type="text" placeholder="Search Categories" aria-label="Search"> -->
                        <div class="input-group-append">
                            <span class="input-group-text search-icon" id="basic-text1"><i
                                    class="fa fa-search text-white" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col  d-flex justify-content-end">
                    <!-- <a class="btn main-btn" href="category_add.php"><?php //echo _("subCategory_Add_New_category");?></a> -->
                </div>
            </div>
        </div>
        <div class="user-wrapper">
            <div class="loading-overlay">
                <div class="overlay-content"><?php echo _("subCategory_loading");?></div>
            </div>
            <div id="subcategory_content">
                <?php
                    $limit = 8;
                    //get number of rows
                    $queryNum = $mysqli->query("SELECT COUNT(id) as subcategoryNum FROM subcategory");
                    $resultNum = $queryNum->fetch_assoc();
                    $rowCount = $resultNum['subcategoryNum'];
                    //initialize pagination class
                    $pagConfig = array(
                        'totalRows' => $rowCount,
                        'perPage' => $limit,
                        'link_func' => 'subCategorySearchFilter'
                    );
                    $pagination =  new Pagination($pagConfig);
                    // Count Rows and number them
                    $counter = 0;
                    //get rows
                    $query = $mysqli->query("SELECT subcategory.id AS 'id' ,subcategory.name AS 'subCategoryName',subcategory.name_ar AS 'subCategoryNameAr', subcategory.status AS 'status', category.name AS 'categoryName' , category.nameAR as 'categoryNameAR'
                                                        FROM subcategory 
                                                        INNER JOIN category ON subcategory.category_id = category.id
                                                        ORDER BY subcategory.id ASC
                                                        LIMIT $limit");
                    if ($query->num_rows > 0) { ?>
                <div class="users_list">
                    <div class="table-responsive">
                        <table class="table table-hover ">
                            <thead>
                                <tr>
                                    <th style="width:15em" scope="col"><?php echo _("subCategory_Name");?></th>
                                    <th style="width:15em" scope="col"><?php echo _("subCategory_category_Name");?></th>
                                    <!-- <th scope="col"><?php echo _("subCategory_Status");?></th>
                                        <th scope="col"></th> -->
                                </tr>
                            </thead>
                            <?php
                                    while ($row = $query->fetch_assoc()) {
                                        $counter++;
                                        $name = checkProductsNames($row['subCategoryName'],$row['subCategoryNameAr']);
                                        $category_name = checkProductsNames($row['categoryName'],$row['categoryNameAR']);
                                        $status = $row['status'];
                                        ?>
                            <!-- content -->
                            <tbody>
                                <tr>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $category_name; ?></td>
                                    <!-- <td>
                                                <label class="switch">
                                                    <?php
                                                            // if ($status == 1) {
                                                            //     echo '<input type="checkbox" checked onclick="return false;">';
                                                            // } else {
                                                            //     echo '<input type="checkbox" onclick="return false;">';
                                                            // }
                                                            ?>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td> -->
                                    <!-- <td class="align-content-end">
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <?php //echo _("subCategory_Action");?>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="category_edit.php?id=<?php //echo $row['id']; ?>&category=<?php //echo 'subcategory'; ?>"><i class="fa fa-edit"></i> <?php //echo _("subCategory_Edit");?> </a>
                                                        <a class="dropdown-item delete_subcat" data-subcat-id="<?php //echo $row["id"]; ?>" href="javascript:void(0)"><i class="fa fa-trash"></i> <?php //echo _("subCategory_Delete");?> </a>
                                                    </div>
                                                </div>
                                            </td> -->
                                </tr>
                            </tbody>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <?php echo $pagination->createLinks(); ?>
                <?php } ?>
            </div>
        </div>
    </div> <!-- / End user-wrapper -->
</div>
</div>
<!-- Sub End -->
</div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
    integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
</script>

<script>
function categorySearchFilter(page_num) {
    page_num = page_num ? page_num : 0;
    var keywords = $('#category_keyword').val();
    var sortBy = $('#sortBy').val();
    $.ajax({
        type: 'POST',
        url: 'category_search.php',
        data: 'page=' + page_num + '&keywords=' + keywords + '&sortBy=' + sortBy,
        beforeSend: function() {
            $('.loading-overlay').show();
        },
        success: function(html) {
            $('#category_content').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
    });
}
</script>

<script>
function subCategorySearchFilter(page_num) {
    page_num = page_num ? page_num : 0;
    var keywords = $('#subcategory_keyword').val();
    var sortBy = $('#sortBy').val();
    $.ajax({
        type: 'POST',
        url: 'subcategory_search.php',
        data: 'page=' + page_num + '&keywords=' + keywords + '&sortBy=' + sortBy,
        beforeSend: function() {
            $('.loading-overlay').show();
        },
        success: function(html) {
            $('#subcategory_content').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
    });
}
</script>

<script>
$(document).ready(function() {
    $('.delete_cat').click(function(e) {
        e.preventDefault();
        var catid = $(this).attr('data-cat-id');
        var parent = $(this).parent(".dropdown-menu").parent(".dropdown").parent("td").parent("tr");
        bootbox.dialog({
            message: "<div class='delete_user_popup'><div class='icon-trash'><i class='fas fa-trash'></i></div><div class='delete-text'><?php echo _("category_delete_alert_message"); ?></div></div>",
            title: "<i class='glyphicon glyphicon-trash'></i>",
            buttons: {
                success: {
                    label: "<?php echo _("category_alert_cancel"); ?>",
                    className: "btn-normal",
                    callback: function() {
                        $('.bootbox').modal('hide');
                    }
                },
                danger: {
                    label: "<?php echo _("category_alert_delete"); ?>!",
                    className: "btn-danger",
                    callback: function() {
                        $.ajax({
                                type: 'POST',
                                url: 'category_rmv.php',
                                data: 'catid=' + catid
                            })
                            .done(function(response) {
                                bootbox.alert(response);
                                parent.fadeOut('slow');
                            })
                            .fail(function() {
                                bootbox.alert('Error....');
                            })
                    }
                }
            }
        });
    });
});
</script>


<script>
$(document).ready(function() {
    $('.delete_subcat').click(function(e) {
        e.preventDefault();
        var subcatid = $(this).attr('data-subcat-id');
        var parent = $(this).parent(".dropdown-menu").parent(".dropdown").parent("td").parent("tr");
        bootbox.dialog({
            message: "<div class='delete_user_popup'><div class='icon-trash'><i class='fas fa-trash'></i></div><div class='delete-text'><?php echo _("subCategory_delete_alert_message"); ?></div></div>",
            title: "<i class='glyphicon glyphicon-trash'></i>",
            buttons: {
                success: {
                    label: "<?php echo _("subCategory_alert_cancel"); ?>",
                    className: "btn-normal",
                    callback: function() {
                        $('.bootbox').modal('hide');
                    }
                },
                danger: {
                    label: "<?php echo _("subCategory_alert_delete"); ?>!",
                    className: "btn-danger",
                    callback: function() {
                        $.ajax({
                                type: 'POST',
                                url: 'subcategory_rmv.php',
                                data: 'subcatid=' + subcatid
                            })
                            .done(function(response) {
                                bootbox.alert(response);
                                parent.fadeOut('slow');
                            })
                            .fail(function() {
                                bootbox.alert('Error....');
                            })
                    }
                }
            }
        });
    });
});
</script>

<script>
document.getElementById("defaultOpen").click();

function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
        tablinks[i].className = tablinks[i].className.replace(" tab-button-selected", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
    evt.currentTarget.className += " tab-button-selected";
}

function toggleDisplay(elementName) {
    var AddNewCategory = document.getElementById(elementName);
    if (AddNewCategory.style.display === "none") {
        AddNewCategory.style.display = "block";
    } else {
        AddNewCategory.style.display = "none";
    }
}
</script>


<?php
include("includes/template/footer.php");
?>