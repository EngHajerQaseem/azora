
<?php
session_start();
?>




<h2>Total Amount <?php echo $_SESSION["payment_details"]['total_Amount'];?></h2>
 

<h5>choose payment method</h5>
 <button class="btn cash"><i class="fa fa-money"></i> Cash</button>
 <button class="btn "><i class="fa fa-money"></i> On Account</button>
 <button class="btn "><i class="fa fa-money"></i> Credit</button>
 <a href="#" class="cancel_payment">Cancel</a>
</div>







                     