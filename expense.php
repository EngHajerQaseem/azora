<?php

include("includes/template/header.php");
include("connect.php");
//Include pagination class file
include('pagination.php');

if (isset($_GET['id'])){
  $id = $_GET['id'];
}
?>
<div class="products-page">

    <div class="product-header">
        <div class="row">
            <div class="col-lg-4  col-12">
                <!-- <div class="dropdown">
           <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            All Expense
          </button> 
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Recent </a>
            <a class="dropdown-item" href="#">Categroy Name</a>
            <a class="dropdown-item" href="#">Categroy Name</a>
          </div>
        </div> -->
                <h3 class="page-title"><?php echo _("Page_Title_Expense");?></h3>
            </div>

            <div class="col-lx-4 col-md-6 col-12">
                <div class="input-group md-form form-sm form-1 pl-0">

                    <!-- <input class="form-control my-0 py-1" type="text" placeholder="Search Expense" aria-label="Search"> -->
                    <input class="form-control my-0 py-1" type="text" id="keywords"
                        placeholder="<?php echo _("expense_Search");?>" onkeyup="searchFilter()" />
                    <div class="input-group-append">
                        <span class="input-group-text search-icon" id="basic-text1"><i class="fa fa-search text-white"
                                aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4  col-12  d-flex justify-content-end">

                <!-- <a class="btn main-btn" href="expense_add.php"><?php //echo _("expense_Add_New");?></a> -->
            </div>

        </div>
    </div>

    <div class="user-wrapper">
        <div class="loading-overlay">
            <div class="overlay-content"><?php echo _("expense_Loading");?></div>
        </div>
        <div id="expense_content">
            <?php

      $limit = 10;

      //get number of rows
      $queryNum = $mysqli->query("SELECT COUNT(id) as expenseNum FROM expense where archive = 0");
      $resultNum = $queryNum->fetch_assoc();
      $rowCount = $resultNum['expenseNum'];

      //initialize pagination class
      $pagConfig = array(
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'searchFilter'
      );
      $pagination =  new Pagination($pagConfig);

      // Count Rows and number them
      $counter = 0;

      // //get rows
      // if(isset($id)){
      //   $query = $mysqli->query("SELECT expense.id AS 'id' ,expense.created_at AS 'date', expense.type AS 'type', expense.description AS 'description', user.full_name AS 'user', expense.total AS 'total'
      //                                   FROM (expense 
      //                                   INNER JOIN user ON expense.user_id = user.id)
      //                                   WHERE expense.id LIKE $id
      //                                   ORDER BY expense.id ASC
      //                                   LIMIT $limit");
      // } else {
      $query = $mysqli->query("SELECT expense.id AS 'id' ,date(expense.created_at) AS 'date', expense.type AS 'type', expense.description AS 'description', user.full_name AS 'user', expense.total AS 'total'
                                        FROM (expense 
                                        INNER JOIN user ON expense.user_id = user.id)
                                        where expense.archive = 0
                                        ORDER BY expense.id DESC
                                        LIMIT $limit");
      //}
      if ($query->num_rows > 0) { ?>
            <div class="users_list">
                <button class="expanded">➡</button>
                <div class=" table-responsive-lg ">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width:5em" scope="col">ID</th>
                                <th style="width:9em" scope="col"><?php echo _("expense_Date");?></th>
                                <th class="expensesTable hidden-xs" style="width:15em" scope="col">
                                    <?php echo _("expense_Type");?></th>
                                <th class="expensesTable hidden-xs" style="width:15em" scope="col">
                                    <?php echo _("expense_Description");?></th>
                                <th class="expensesTable hidden-xs" style="width:15em" scope="col">
                                    <?php echo _("expense_User");?></th>
                                <th style="width:7em" scope="col"><?php echo _("expense_Total");?></th>
                                <!-- <th scope="col"></th> -->
                            </tr>
                        </thead>
                        <?php
            $no=1;
              while ($row = $query->fetch_assoc()) {
                $counter++;
                $num=$row['id'];
                $date = $row['date'];
                $type = $row['type'];
                $description = $row['description'];
                $user = $row['user'];
                $total = $row['total'];
                ?>

                        <!-- content -->
                        <tbody>
                            <tr>
                                <td><?php echo $num; ?></td>
                                <td><?php echo $date; ?></td>
                                <td class="expensesTable hidden-xs"><?php echo $type; ?></td>
                                <td class="expensesTable hidden-xs"><?php echo $description; ?></td>
                                <td class="expensesTable hidden-xs"><?php echo $user; ?></td>
                                <td><?php echo $total; ?></td>
                                <!-- <td class="align-content-end">
                    <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <?php //echo _("expense_Action");?>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="expense_edit.php?id=<?php //echo $row['id'] ?>"><i class="fa fa-edit"></i> <?php //echo _("expense_Edit");?> </a>
                        <a class="dropdown-item delete_exp" data-exp-id="<?php //echo $row["id"]; ?>" href="javascript:void(0)"><i class="fa fa-trash"></i> <?php //echo _("expense_Delete");?> </a>
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
            <script>
            let expensesTable = document.querySelectorAll(".expensesTable")
            let expanded = document.querySelector(".expanded");
            expanded.addEventListener("click", () => {
                console.log(expanded.innerHTML);

                expanded.innerHTML == "➡" ? expanded.innerHTML = "⬅" : expanded.innerHTML = "➡";

                expensesTable.forEach(element => {
                    element.classList.toggle("hidden-xs")
                });
                // elemente.classList = "notexpanded expensesTable"

            })
            </script>
        </div>
    </div>
</div> <!-- / End user-wrapper -->

<script>
function searchFilter(page_num) {
    page_num = page_num ? page_num : 0;
    var keywords = $('#keywords').val();
    var sortBy = $('#sortBy').val();
    $.ajax({
        type: 'POST',
        url: 'expense_search.php',
        data: 'page=' + page_num + '&keywords=' + keywords + '&sortBy=' + sortBy,
        beforeSend: function() {
            $('.loading-overlay').show();
        },
        success: function(html) {
            $('#expense_content').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
    });
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
    integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
</script>

<script>
$(document).ready(function() {
    $('.delete_exp').click(function(e) {
        e.preventDefault();
        var expid = $(this).attr('data-exp-id');
        var parent = $(this).parent(".dropdown-menu").parent(".dropdown").parent("td").parent("tr");
        bootbox.dialog({
            message: "<div class='delete_user_popup'><div class='icon-trash'><i class='fas fa-trash'></i></div><div class='delete-text'><?php echo _("expense_delete_alert_message"); ?></div></div>",
            title: "<i class='glyphicon glyphicon-trash'></i>",
            buttons: {
                success: {
                    label: "<?php echo _("expense_alert_cancel"); ?>",
                    className: "btn-normal",
                    callback: function() {
                        $('.bootbox').modal('hide');
                    }
                },
                danger: {
                    label: "<?php echo _("expense_alert_delete"); ?>!",
                    className: "btn-danger",
                    callback: function() {
                        $.ajax({
                                type: 'POST',
                                url: 'expense_rmv.php',
                                data: 'expid=' + expid
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

<?php

include("includes/template/footer.php");
?>