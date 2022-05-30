<?php
include("includes/template/header.php");
include("connect2.php");


$phone = $_SESSION["phone"];
$userId=$_SESSION["id"];
$query = "SELECT * FROM users where id=$userId
--  INNER JOIN user_role ON user.role_id = user_role.id 
";  
$result = mysqli_query($mysqli, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
$img= !empty($row['local_image_path']) ? 'upload/'.$row['local_image_path'] : 'layout/images/user.png';  

  if($_SERVER["REQUEST_METHOD"] == "POST") {
   


     /////// image updating
     $updateimage = '';
     $type = explode('.', $_FILES['userImage']['name']);
     $type = $type[count($type) - 1];
     $uploadDir = "upload/";
     $fileName = basename($_FILES["userImage"]["name"]);
     $targetPath = $uploadDir. $fileName;

    // if there is an update for image update it.
    // if(isset($_FILES['userImage']['name'])) {
    //   if(in_array($type, array('gif', 'jpg', 'jpeg', 'png'))) {
    //       if (is_uploaded_file($_FILES['userImage']['tmp_name'])){
    //           if(move_uploaded_file($_FILES["userImage"]["tmp_name"], $targetPath)){ 
    //               $updateimage = "UPDATE users SET local_image_path= '".$fileName."' where id='".$userId."' ";
    //               $stmt = $mysqli->prepare($updateimage);
    //               $stmt->execute();
    //               $stmt->close();
    //               // header("Refresh:0");
    //              // header("location:profile.php");
    //             // header('Location: ' . $_SERVER['PHP_SELF']);
    //            die('<META http-equiv="refresh" content="0;URL=' . $_SERVER['PHP_SELF'] .'">');
                 
    //           }
    //       }
    //   }
    // }

  }
  ?>


        <div class="col basic-information-box">
            <h4><?php echo _("basic_information_header");?></h4>
            <div class="row">
                <!-- <div class="col profile-info">
                    <div>
                    <img src="layout/images/<?php // echo $row["local_image_path"];?>">
                    <button>Change Photo</button>
                    </div>

                   
                    <h5 id="full"><?php //echo $row["full_name"];?></h5>
                    <p>Admin</p>
                </div> -->
                <div class="col-lg-4  col-sm-12">
                <div class="img-container">
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data" >
                    <div class="form-group">		    
                        <div id="kv-avatar-errors-2" class="center-block" style="width:800px;display:none"></div>
                            <div class="kv-avatar center-block">
                                <input id="avatar-2" name="userImage" type="file" class="file-loading">
                            </div>
                        </div>
                        <div id="save-img" class="text-center">
                        
                        </div>
                       
                        </form>
                       
                    </div>
                    <div class="user-title">
                    <h5 class="text-center" id="full_name_user"><?php echo $row["full_name"];?></h5>
                    <p class="text-center"><?php echo _("admin");?></p>
                 </div>
                     </div>
                
                <div class="col-lg-8  col-sm-12  user-profile-options">

                    <div class="row user-profile-info-container">
                        <div></div>
                        <i class="fa fa-user"></i>
                        <div>
                            <p><?php echo _("full_name");?></p>
                            <p id="fullname"><?php echo $row["full_name"];?></p>
                        </div>
                        <!-- <p data-toggle="modal" data-target="#username" ><?php echo _("edit");?></p> -->

                    </div>

                    <div class="row user-profile-info-container">
                        <div></div>
                        <i class="fa fa-phone"></i>
                        <div>
                            <p><?php echo _("profile_phone_number");?></p>
                            <p id="userPhone"><?php echo $row["phone"];?></p>
                        </div>
                        <!-- <p data-toggle="modal" data-target="#phone"><?php echo _("edit");?></p> -->
                    </div>

                    <div class="row user-profile-info-container">
                        <div></div>
                        <i class="fa fa-lock"></i>
                        <div class="position-relative">
                            <p class="user-profile-options-password"><?php echo _("profile_password");?></p>
                            <p ></p>
                        </div>
                        <!-- <p data-toggle="modal" data-target="#passwordModal"><?php echo _("reset");?></p> -->
                    </div>
                </div>
               
                    
                </div>   
            </div>

           
        </div>


    </div>


    <div class="modal fade" id="username" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo _("edit_full_name");?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_user_name" method="post">
        <div class="form-group" >
              
              <label for="full_name"><?php echo _("full_name");?> </label>
              <input type="text" name="full_name" class="form-control" id="full_name"   required>
             
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo _("close");?></button>
        <button type="submit" class="btn btn-primary"><?php echo _("save_changes");?></button>
       </div>
          
       </form>
      </div>
     
    </div>
  </div>
</div>



<div class="modal fade" id="phone" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo _("edit_phone_number");?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_user_phone"  method="post">
        <div class="form-group" >
        
              <label for="user_phone"><?php echo _("profile_phone_number");?></label>
              <input type="number" name="phone" class="form-control" id="user_phone" required>
              <div id="error-phone">
               
              </div>
            </div>
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo _("close");?></button>
        <button type="submit" class="btn btn-primary"><?php echo _("save_changes");?></button>
      </div>
       </form>
      </div>
      
    </div>
  </div>
</div>



<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo _("edit_password");?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_user_password">
        <div class="form-group" >
               
              <label for="pass"><?php echo _("current_password");?></label>
              <input type="password" name="pass" class="form-control" id="current_pass" required>
              <div class="err">
              <span class="help-block" id="check_pass"></span>
              </div>
            </div>

            <div class="form-group" >
              <label for="pass"><?php echo _("current_password");?></label>
              <input type="password" name="newpass" class="form-control" id="new_pass" required>
              <div id="error-pass">
               
              </div>
            </div>
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo _("close");?></button>
        <button type="submit" class="btn btn-primary"><?php echo _("save_changes");?></button>
      </div>
       </form>
      </div>
     
    </div>
  </div>
</div>
    <!-- <div class="row margin-zero">
        <div class="col user-profile-sales">
        
           
            <h4>Sales</h4>
            <table>
                <thead>
                    <tr>
                        <th>Invoice.NO</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Paid</th>
                        <th>Customer</th>
                    </tr>
                </thead>

                <tbody> -->
                    
                    <?php
            //         $query = $mysqli->query("SELECT sale.id AS 'Invoice.No', sale.created_at AS 'date', sale.sub_total AS 'total', sale.paid AS 'paid', CONCAT(customer.fname, ' ', customer.lname) AS 'customer', user.full_name AS 'user'  
            //                             FROM ((sale 
            //                             INNER JOIN customer ON sale.customer_id = customer.id)
            //                             INNER JOIN user ON sale.user_id = user.id)
            //                             Where user.id=$userId
            //                             ORDER BY sale.id DESC
            //                             LIMIT 5");
                                       

            // if ($query->num_rows > 0) {
              
            //   while ($row = $query->fetch_assoc()) {
                  
            //       $Invoice_No = $row['Invoice.No'];
            //       $date = $row['date'];
            //       $total = $row['total'];
            //       $paid = $row['paid'];
            //       $customer = $row['customer'];
            //       $user = $row['user'];
                 
                 
                  ?>
              
              
                    <!-- <tr>
                        <td><?php //echo $Invoice_No; ?></td>
                        <td><?php //echo $date; ?></td>
                        <td class="blue-text">$<?php //echo $total; ?></td>
                        <td class="blue-text">$<?php //echo $paid; ?></td>
                        <td><?php //echo $customer; ?></td>
                    </tr> -->
                    <?php
          //   }
          // }
          // else{
          //   echo "<tr class='text-center'><td>You haven't made sales yet</td></tr>";
          // }
                    ?>
                <!-- </tbody>
               
            </table>
           <a href="#">See More</a> 
        </div>
    </div> -->


    <!-- <div class="row margin-zero">
        <div class="col user-profile-sales">
           
            <h4>Purchase</h4>
            <table>
                <thead>
                    <tr>
                        <th>Invoice.NO</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Paid</th>
                        <th>Supplier</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>1</td>
                        <td>15/03/209</td>
                        <td class="blue-text">$2000</td>
                        <td class="blue-text">$2000</td>
                        <td>Supplier Name</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>15/03/209</td>
                        <td class="blue-text">$2000</td>
                        <td class="blue-text">$2000</td>
                        <td>Supplier Name</td>
                    </tr>
                </tbody>

            </table>
            <a href="#">See More</a>
        </div>
    </div> -->

    <!-- <div class="row margin-zero">
        <div class="col-12 col-sm-3 user-profile-logout">
            <div></div>
            <img src="layout/images/user.png">
            <p>Logout</p>
            <p></p>
        </div>
    </div> -->




 <script src="layout/js/fileinput.min.js"></script>
 <script type="text/javascript"> 
            $("#avatar-2").fileinput({
                    overwriteInitial: true,
                    maxFileSize: 1500,
                    showClose: false,
                    showCaption: false,
                    showBrowse: false,
                    browseOnZoneClick: false,
                    removeLabel: '',
                    removeIcon: '<i class="fas fa-times"></i>',
                    removeTitle: '<?php echo _("profile_cancel_or_reset");?>',
                    elErrorContainer: '#kv-avatar-errors-2',
                    msgErrorClass: 'alert alert-block alert-danger',
                    defaultPreviewContent: '<img src="<?php echo $img;?>" alt="<?php echo _("profile_your_avater");?>" class="user-img">',
                    layoutTemplates: {main2: '{preview} '},
                    allowedFileExtensions: ["jpg", "png", "gif"]
                });    
            </script>

<?php
include("includes/template/footer.php");
?>