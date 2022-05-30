<?php
//session_start();
include("includes/template/header.php");
include("includes/template/functions.php");
include("connect.php");

$id=$_GET['id'];

$query = "SELECT * from user where id='".$id."' "; 
$result = mysqli_query($mysqli, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
//$userPicture = !empty($row['server_image_path'])?'upload/'.$row['server_image_path']:'layout/images/user.png';
$userPictureURL = checkImages($row['server_image_path']);
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="users.php"><?php echo _("user_details_users"); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo _("user_details_user_details"); ?></li>
  </ol>
</nav>
<?php
  // if(isset($_GET['id']) && $_GET['id']==1){
  //   $sql="SELECT * from user where id='".$id."'";
  //   mysqli_query($mysqli, $sql) or die(mysqli_error());
  //   }else {
    ?>
    <div class="new-product">
      <div class="profile_details">
        <div class="details-title">
          <h2><?php echo $row['full_name'];?> <?php// echo _("user_details_details"); ?></h2>
        </div>
        <div class="detials-content">
          <div class="row">    
            <div class="col-md-4">
                <div class="proImg profile_image">
                  <img src="<?php echo $userPictureURL;?>"/>
                </div>
            </div>       
            <div class="col-md-8">
              <div class="user-details">
                <ul>
                  <li><span><?php echo _("user_details_user_name"); ?> </span><?php echo $row['full_name'];?></li>
                  <li><span><?php echo _("user_details_phone_number"); ?> </span><?php echo $row['phone'];?></li>
                  <?php if(!empty($row['email'])) {?>
                  <li><span><?php echo _("user_details_email"); ?> </span><?php echo $row['email'] ;?></li>
                  <?php } ?>
                  <li><span><?php echo _("user_details_role"); ?></span><?php echo $row['role_id'] == 0 ? _("user_details_admin") : _("user_details_cashier") ; ?></li>
                </ul>
              </div>
            </div>                  
          </div>
        </div>
      </div>
    </div>
<?php //}?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<?php include("includes/template/footer.php"); ?>