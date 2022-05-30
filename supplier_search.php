<?php

include_once("includes/template/language.php");

if(isset($_POST['page'])){
    include('pagination.php');
    include('connect.php');
    
    $start = !empty($_POST['page'])?$_POST['page']:0;
    $limit = 10;
    
    //set conditions for search
    $whereSQL = $orderSQL = '';
    $keywords = $_POST['keywords'];
    $sortBy = $_POST['sortBy'];
    if(!empty($keywords)){
        // $whereSQL = "WHERE fname LIKE '%".$keywords."%'";
        $whereSQL = "WHERE  CONCAT(fname, ' ',lname, ' ') LIKE '%".$keywords."%' AND archive = 0 ";  
    }
    if(!empty($sortBy)){
        $orderSQL = " ORDER BY id ".$sortBy;
    }else{
        $orderSQL = " ORDER BY id ASC ";
    }

    //get number of rows
    $queryNum = $mysqli->query("SELECT COUNT(*) as userNum FROM suppliers ".$whereSQL.$orderSQL);
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
    $query = $mysqli->query("SELECT * FROM suppliers $whereSQL $orderSQL LIMIT $start,$limit");
    
    if($query->num_rows > 0){ ?>
<div class="users_list">
    <div class="table-responsive">
        <table class="table table-hover ">
            <thead>
                <tr>
                    <th style="width:5em" scope="col">#</th>
                    <th style="width:15em" scope="col"><?php echo _("suppliers_users");?></th>
                    <!-- <th scope="col"><?php //echo _("suppliers_role");?></th> -->
                    <th class="hidden-xs" style="width:10em" scope="col"><?php echo _("suppliers_action");?></th>
                </tr>
            </thead>
            <?php while($row = $query->fetch_assoc()){ 
                    $counter++; 
                    $userID = $row['id'];
                    $fname = $row['fname'];
                    $lname = $row['lname'];
                    $fullName = $fname. "&nbsp;". $lname;
                     ?>
            <!-- content -->
            <tbody>
                <tr style="cursor: pointer;"
                    onclick="window.location='supplier_details.php?id=<?php echo $row["id"];?>'">
                    <td><?php echo $userID; ?></td>
                    <td><?php echo $fullName; ?></td>

                    <td class='hidden-xs align-content-end'>
                        <div class='dropdown'>
                            <button class='create-new-btn main-btn btn' type='button' id='dropdownMenuButton'
                                data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'
                                onclick="window.location='supplier_details.php?id=<?php echo $row["id"];?>'">
                                <?php echo _("transaction_view_details");?>
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
//         message: "<div class='delete_user_popup'><div class='icon-trash'><i class='fas fa-trash'></i></div><div class='delete-text'>Are you sure you want to Delete ?</div></div>",
//         title: "<i class='glyphicon glyphicon-trash'></i>",
//         buttons: {
//             success: {
//                 label: "Cancel",
//                 className: "btn-normal",
//                 callback: function() {
//                 $('.bootbox').modal('hide');
//                 }
//             },
//             danger: {
//             label: "Delete!",
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