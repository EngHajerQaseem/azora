<?php
include("includes/template/header.php");
include("connect.php");
?>

    <div class="products-page">
        <div class="about">
        <div class="row">

            <div class="col-lg-4  col-sm-12 offset-md-1">
                <div class="about-img">
                <img src="layout/images/Azora.png">

                </div>
                
             </div>


             <div class="col-lg-5 col-sm-12 ">
                 <div class="about-desc">
                           <!-- <p><?php echo _("about_azora_system"); ?></p>

                <p><?php echo _("about_description"); ?></p>

                <p><?php echo _("about_developed"); ?></p> -->

                <h3><?php echo _("about_azora_system"); ?> </h3>
                <p><?php echo _("about_description"); ?></p>

                <p><?php echo _("about_developed"); ?></p>
                 </div>
              

            </div>
          </div>
            

          <div class="row">

            <div class="col-lg-6 col-sm-12 offset-5">
                <div class="contact-info">
                    <h3><?php echo _("about_contact"); ?></h3>
                    <ul>
                        <li><i class="fa fa-phone-alt"></i>01-573062</li>
                        <li><i class="fa fa-envelope-open-text"></i>info@azora.tech</li>
                        <li><i class="fa fa-globe"></i><a href="https://azora.tech" target=_blink>Azora POS</a></li>
                    </ul>
                </div>
            </div>
        </div>

          <div class="row">

         
            <div class="col-lg-3 col-sm-6 offset-5">
                <div class="follow-info">
                    <h3><?php echo _("about_follow"); ?></h3>
                    <ul>
                        <li><a href="https://www.facebook.com/azorasystem/" target="_blank"><i class="fab fa-facebook-f face"></i></a></li>
                        <li><a href="https://www.linkedin.com/company/azora-pos" target="_blank"><i class="fab fa-linkedin-in linked "></i></a></li>
                        <!-- <li><a href="https://medium.com/@blackgemtech"target="_blank"><i class="fab fa-medium-m medium"></i></a></li> -->
                        <li><a href="https://www.youtube.com/channel/UCNldsbRR_aXY-NFTM_e5duQ" target="_blank"><i class="fab fa-youtube youtube "></i></a></li>
                    </ul>
                </div>
            </div>

        </div>
        </div>
    </div>
</div>


<?php
include ("includes/template/footer.php");
?>