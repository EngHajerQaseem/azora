<?php

include_once("includes/template/language.php");

if(isset($_POST['page'])){
    //Include pagination class file
    include('pagination.php');
    
    //Include database configuration file
    include('connect.php');
    
    $start = !empty($_POST['page'])?$_POST['page']:0;
    $limit = 10;
    
    //set conditions for search
    $whereSQL = $orderSQL = '';
    $keywords = $_POST['keywords'];
    $sortBy = $_POST['sortBy'];
    if(!empty($keywords)){
        $whereSQL = "WHERE full_name LIKE '%".$keywords."%' AND archive = 0";
    }
    if(!empty($sortBy)){
        $orderSQL = " ORDER BY id ".$sortBy;
    }else{
        $orderSQL = " ORDER BY id ASC ";
    }

    //get number of rows
    $queryNum = $mysqli->query("SELECT COUNT(*) as userNum FROM user ".$whereSQL.$orderSQL);
    $resultNum = $queryNum->fetch_assoc();
    $rowCount = $resultNum['userNum'];

    //initialize pagination class
    $pagConfig = array(
        'currentPage' => $start,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'searchFilter'
    );
    $pagination =  new Pagination($pagConfig);
    
      // Count Rows and number them
      $counter = 0;

    //get rows
    $query = $mysqli->query("SELECT * FROM user $whereSQL $orderSQL LIMIT $start,$limit");
    
    if($query->num_rows > 0){ ?>
<div class="users_list">
    <div class=" table-responsive-lg">
        <table class="table table-hover ">
            <thead>
                <tr>
                    <!-- <th style="width:5em" scope="col">#</th> -->
                    <th style="width:10em" scope="col"><?php echo _("users_users"); ?></th>
                    <th style="width:10em" scope="col"><?php echo _("users_role"); ?></th>
                    <th class="hidden-xs" style="width:10em" scope="col"><?php echo _("users_action"); ?></th>
                </tr>
            </thead>
            <?php
                while($row = $query->fetch_assoc()){ 
                    $counter++; 
                    $userID = $row['id'];
                     ?>
            <!-- content -->
            <tbody>
                <tr>
                    <!-- <td><?php echo $id; ?></td> -->
                    <td><?php echo $row["full_name"]; ?></td>
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
            </tbody>

            <?php } ?>
        </table>
    </div>
</div>
<?php echo $pagination->createLinks(); ?>
<!-- popup modal of deleting user -->
<script type="text/javascript" src="layout/js/bootbox.min.js"></script>
<script>
// Delete User
// $('.delete_usr').click(function(e){   
//     e.preventDefault();   
//     var usrid = $(this).attr('data-usr-id');
//     var parent = $(this).parent(".dropdown-menu").parent(".dropdown").parent("td").parent("tr");   
//     bootbox.dialog({
//         message: "<div class='delete_user_popup'><div class='icon-trash'><i class='fas fa-trash'></i></div><div class='delete-text'><?php echo _("users_delete_alert_message"); ?></div></div>",
//         title: "<i class='glyphicon glyphicon-trash'></i>",
//         buttons: {
//             success: {
//                 label: "<?php echo _("users_cancel"); ?>",
//                 className: "btn-normal",
//                 callback: function() {
//                 $('.bootbox').modal('hide');
//             }
//             },
//             danger: {
//                 label: "<?php echo _("users_delete"); ?>!",
//             className: "btn-danger",
//             callback: function() {       
//                 $.ajax({        
//                     type: 'POST',
//                     url: 'user_rmv.php',
//                     data: 'usrid='+usrid        
//                 })
//                 .done(function(response){        
//                     bootbox.alert(response);
//                     parent.fadeOut('slow');        
//                 })
//                 .fail(function(){        
//                     bootbox.alert('Error....');               
//                 })              
//             }
//             }
//         }
//     });   
// });  
</script>
<?php } } ?>