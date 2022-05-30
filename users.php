<?php
include("includes/template/header.php");
include("connect.php");
//Include pagination class file
include('pagination.php');
?>
<div class="products-page">
    <div class="product-header">
        <div class="row">
            <!-- All users dropdown -->
            <div class="col-lg-4 col-12">
                <!--<div class="dropdown">
           <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            All users
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Recent </a>
            <a class="dropdown-item" href="#">Categroy Name</a>
            <a class="dropdown-item" href="#">Categroy Name</a>
          </div>
        </div>-->
                <h3 class="page-title"><?php echo _("Page_Title_Users");?></h3>
            </div>
            <!-- Search  -->
            <div class="col-lg-4 col-12">
                <div class="input-group md-form form-sm form-1 pl-0 search-box user-search-panel">
                    <input class="form-control my-0 py-1" type="text" id="keywords"
                        placeholder="<?php echo _("users_search_by_username"); ?>" onkeyup="searchFilter()" />
                    <select class="sort-users" id="sortBy" onchange="searchFilter()">
                        <option value="">Sort By</option>
                        <option value="asc">Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                    <div class="input-group-append">
                        <span class="input-group-text search-icon" id="basic-text1">
                            <i class="fa fa-search text-white" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
            </div>
            <!-- Add New User btn -->

        </div>
    </div> <!-- End Header -->

    <!-- Search Result -->
    <div class="user-wrapper">
        <div class="loading-overlay">
            <div class="overlay-content"><?php echo _("users_loading"); ?></div>
        </div>
        <div id="users_content">
            <?php

      $limit = 10;

      //get number of rows
      $queryNum = $mysqli->query("SELECT COUNT(*) as userNum FROM user");
      $resultNum = $queryNum->fetch_assoc();
      $rowCount = $resultNum['userNum'];

      //initialize pagination class
      $pagConfig = array(
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'searchFilter'
      );
      $pagination =  new Pagination($pagConfig);

      // Count Rows and number them
      $counter = 0;

      //get rows
      $query = $mysqli->query("SELECT * FROM user WHERE archive = 0 ORDER BY id ASC LIMIT $limit");

      if ($query->num_rows > 0) { ?>
            <div class="users_list">
                <div class=" table-responsive-lg">
                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <!-- <th style="width:5em" scope="col">#</th> -->
                                <th style="width:10em" scope="col"><?php echo _("users_users"); ?></th>
                                <th style="width:10em" scope="col"><?php echo _("users_role"); ?></th>
                                <th class="hidden-xs" style="width:10em" scope="col"><?php echo _("users_action"); ?>
                                </th>
                            </tr>
                        </thead>
                        <?php
            while ($row = $query->fetch_assoc()) {
              $counter++;
              $id = $row['id'];
              $username = $row['full_name'];
            ?>

                        <!-- content -->
                        <tr style="cursor: pointer;"
                            onclick="window.location='user_details.php?id=<?php echo $row["id"];?>'">
                            <!-- <td><?php echo $id; ?></td> -->
                            <td><?php echo $username; ?></td>
                            <td> <?php echo _("users_admin"); ?> </td>
                            <td class='hidden-xs align-content-end'>
                                <div class='dropdown'>
                                    <button class='create-new-btn main-btn btn' type='button' id='dropdownMenuButton'
                                        data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'
                                        onclick="window.location='user_details.php?id=<?php echo $row["id"];?>'">
                                        <?php echo _("transaction_view_details") ?>
                                    </button>
                            </td>
                        </tr>

                        <?php } ?>
                    </table>
                </div>
                <?php echo $pagination->createLinks(); ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div> <!-- / End user-wrapper -->
</div>
<!-- Dropdown Menu -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
    integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
</script>
<!-- paginition  -->
<script>
function searchFilter(page_num) {
    page_num = page_num ? page_num : 0;
    var keywords = $('#keywords').val();
    var sortBy = $('#sortBy').val();
    $.ajax({
        type: 'POST',
        url: 'users_search.php',
        data: 'page=' + page_num + '&keywords=' + keywords + '&sortBy=' + sortBy,
        beforeSend: function() {
            $('.loading-overlay').show();
        },
        success: function(html) {
            $('#users_content').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
    });
}

$('.delete_usr').click(function(e) {
    e.preventDefault();
    var usrid = $(this).attr('data-usr-id');
    var parent = $(this).parent(".dropdown-menu").parent(".dropdown").parent("td").parent("tr");
    bootbox.dialog({
        message: "<div class='delete_user_popup'><div class='icon-trash'><i class='fas fa-trash'></i></div><div class='delete-text'><?php echo _("users_delete_alert_message"); ?></div></div>",
        title: "<i class='glyphicon glyphicon-trash'></i>",
        buttons: {
            success: {
                label: "<?php echo _("users_cancel"); ?>",
                className: "btn-normal",
                callback: function() {
                    $('.bootbox').modal('hide');
                }
            },
            danger: {
                label: "<?php echo _("users_delete"); ?>!",
                className: "btn-danger",
                callback: function() {
                    $.ajax({
                            type: 'POST',
                            url: 'user_rmv.php',
                            data: 'usrid=' + usrid
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
</script>
<!-- Including Footer -->
<?php include("includes/template/footer.php"); ?>