<?php

include("includes/template/header.php");
include("connect.php");
  $query = $mysqli->query("SELECT * FROM warehouse WHERE archive = 0 ORDER BY id DESC");
  
?>
<div class="products-page">

    <h3 class="page-title"><?php echo _("Page_Title_Inventory");?></h3>

    <div class="area-box-section" id="inventory_table">
        <?php
      while($invent = mysqli_fetch_array($query))
      { ?>
        <div class="box-sq">
            <a class="view_data" href="#" name="view" id="<?php echo $invent["id"]; ?>">
                <img src="./layout/images/warehouse.png">
                <div class="inv-name">
                    <?php echo $invent["name"]; ?>
                </div>
                <!-- <div class="more-dots">
              <button class="more-options" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <button class="dropdown-item" data-toggle="modal" data-target="#editWarehouse" data-whatever="<?php echo $invent["id"];?>" ><?php echo _("inventory_area_edit");?></button>
                <button class="dropdown-item delete_product" data-id="<?php echo $invent["id"]; ?>" href="javascript:void(0)"><?php echo _("inventory_area_remove");?></button>
              </div>
            </div> -->
            </a>
        </div>
        <?php } 
    ?>

    </div>
    <div class="col-lg-4  col-12 mx-auto inventory_search">
        <div class="input-group ">
            <input class="form-control " type="text" id="keywords"
                placeholder="<?php echo _("product_search_input"); ?>" onkeyup="searchFilter()" />
            <!-- <input class="form-control my-0 py-1" id="search_text" type="text" placeholder="Search Sales" aria-label="Search"> -->
            <div class="input-group-append">
                <span class="input-group-text search-icon" id="basic-text1"><i class="fa fa-search text-white"
                        aria-hidden="true"></i></span>
            </div>
        </div>
    </div>

    <!-- Add New Warehouse -->
    <div id="add_data_Modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo _("inventory_area_add_to_inventory");?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="post" id="insert_form">
                        <label><?php echo _("inventory_area_add_name_of_area");?></label>
                        <input type="text" name="name" id="name" class="form-control" />
                        <br />
                        <label><?php echo _("inventory_area_add_location_of_area");?></label>
                        <textarea name="address" id="address" class="form-control"></textarea>
                        <br />
                        <label><?php echo _("inventory_area_add_capacity_of_area");?></label>
                        <input type="text" name="capacity" id="capacity" class="form-control" />
                        <br />
                        <label><?php echo _("inventory_area_add_size_of_area");?></label>
                        <input type="text" name="size" id="size" class="form-control" />
                        <br />
                        <label><?php echo _("inventory_area_add_type_of_area");?></label>
                        <input type="text" name="type" id="type" class="form-control" />
                        <br />
                        <div class="modal-footer">
                            <input type="submit" name="insert" id="insert"
                                value="<?php echo _("inventory_area_add_Add"); ?>" class="btn main-btn" />
                            <button type="button" class="btn btn-default"
                                data-dismiss="modal"><?php echo _("inventory_area_add_close"); ?></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal-body" id="inventory_detail">
    </div>

    <!-- Edit warehouse -->
    <div class="modal fade" id="editWarehouse" tabindex="-1" role="dialog" aria-labelledby="PriceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo _("inventory_area_edit_area"); ?></h4>
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span
                            class="sr-only"><?php echo _("inventory_area_add_close"); ?></span></button>
                </div>
                <div class="dash">

                </div>

            </div>
        </div>
    </div>

</div>



<!-- Dropdown Menu -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
    integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
</script>
<!-- Add new warehouse and show All of them -->
<script>
$(document).ready(function() {
    $('#insert_form').on("submit", function(event) {
        event.preventDefault();
        if ($('#name').val() == "") {
            alert("<?php echo _("inventory_area_add_name_laert");?>");
        } else {
            $.ajax({
                url: "warehouse_add.php",
                method: "POST",
                data: $('#insert_form').serialize(),
                beforeSend: function() {
                    $('#insert').val("Inserting");
                },
                success: function(data) {
                    $('#insert_form')[0].reset();
                    $('#add_data_Modal').modal('hide');
                    $('#inventory_table').html(data);
                }
            });
        }
    });
    $(document).on('click', '.view_data', function() {
        var inventory_id = $(this).attr("id");
        $('.inventory_search').fadeIn("slow");
        $.ajax({
            url: "inventory_fetch.php",
            method: "POST",
            data: {
                inventory_id: inventory_id
            },
            success: function(data) {

                $('#inventory_detail').html(data);
            }
        });
    });
});
</script>
<script>
// function searchFilter(page_num) {
//     console.log("jjj")
//     page_num = page_num ? page_num : 0;
//     var keywords = $('#keywords').val();
//     var sortBy = $('#sortBy').val();
//     var warehouseId = $('#wareID').val();

//     $.ajax({
//         type: 'POST',
//         url: 'inventory_search.php',
//         data: 'page=' + page_num + '&keywords=' + keywords + '&sortBy=' + sortBy + '&warehouseId=' +
//             warehouseId,
//         beforeSend: function() {
//             $('.loading-overlay').show();
//         },
//         success: function(html) {

//             $('#inventory_detail').html(html);
//             $('.loading-overlay').fadeOut("slow");

//         }
//     });
// }
</script>
<!--------------------- Edit Price ------------------------>
<!-- <script>
  $('#editWarehouse').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var recipient = button.data('whatever') 
    var modal = $(this);
    var dataString = 'id=' + recipient;

    $.ajax({
      type: "GET",
      url: "warehouse_edit.php",
      data: dataString,
      cache: false,
      success: function (data) {
        console.log(data);
        modal.find('.dash').html(data);
      },
      error: function(err) {
        console.log(err);
      }
    });
  })
</script> -->
<!-- Delete Product -->
<!-- <script>
 $(document).ready(function(){
  $('.delete_product').click(function(e){   
    e.preventDefault();   
    var pid = $(this).attr('data-id');
    var parent = $(this).parent(".dropdown-menu").parent(".more-dots").parent(".view_data").parent(".box-sq");   
    bootbox.dialog({
      message: "<div class='delete_user_popup'><div class='icon-trash'><i class='fas fa-trash'></i></div><div class='delete-text'><?php echo _("inventory_area_delete_alert_message");?></div></div>",
      title: "<i class='glyphicon glyphicon-trash'></i>",
      buttons: {
        success: {
          label: "<?php echo _("inventory_area_delete_alert_cancel");?>",
          className: "btn-success",
          callback: function() {
            $('.bootbox').modal('hide');           
          }
        },
        danger: {
          label: "<?php echo _("inventory_area_delete_alert_delete");?>!",
          className: "btn-danger",
          callback: function() {        
            $.ajax({          
              type: 'POST',
              url: 'warehouse_rmv.php',
              data: 'delete='+pid          
            })
            .done(function(response){          
              bootbox.alert(response);
              parent.fadeOut('slow');  
              $('.bootbox').modal('hide');        
            })
            .fail(function(){          
              bootbox.alert('<?php echo _("inventory_area_delete_alert_error"); ?>');                  
            })
                  
          }
        }
      }
    });   
  });
});
</script> -->
<?php include("includes/template/footer.php"); ?>