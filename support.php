<?php
include("includes/template/header.php");
include("connect.php");
?>
<div class="support-container">
<div class="row">

    <div data-toggle="modal" data-target="#phoneModal" class="col-lg-4 col-12 support-box cursor-pointer">
        <div></div>
        <i class="fa fa-phone"></i>
        <p><?php echo _("support_phone_number"); ?></p>
    </div>

    <div class="col-lg-3">
    </div>

    <div id="support-email" data-toggle="modal" data-target="#emailModal" class="col-lg-4 col-12 support-box cursor-pointer">
        <div></div>
        <i class="fa fa-envelope-open-text"></i>
        <p><?php echo _("support_email"); ?></p>
    </div>

</div>

<div class="row">

    <div id="support-website" class="col-lg-4 col-12 support-box cursor-pointer">
        <div></div>
        <i class="fa fa-globe"></i>
        <p><?php echo _("support_website"); ?></p>
    </div>

    <div class="col-lg-3 col-12">
    </div>

    <div data-toggle="modal" data-target="#socialMediaModal" class="col-lg-4 col-12 support-box cursor-pointer">
        <div></div>
        <i class="fa fa-user-friends"></i>
        <p><?php echo _("support_social_media"); ?></p>
    </div>

</div>

<div class="row">

    <div class="col-lg-4 col-12 support-box">
        <div></div>
        <i class="fa fa-question-circle"></i>
        <p><?php echo _("support_faq"); ?></p>
    </div>

</div>
</div>

<!-- Email modal -->
<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo _("support_azora_emails"); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <?php echo _("support_email"); ?> :info@azora.tech
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo _("support_close"); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Social Media modal -->
<div class="modal fade" id="socialMediaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo _("support_social_media"); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a href="https://www.facebook.com/azorasystem/" target="_black">Facebook</a> 
                <br/>
                <a href="https://www.linkedin.com/company/azora-pos" target="_black">Linkedin</a>
                <br/>
                <a href="https://medium.com/@blackgemtech" target="_black">Medium</a>
                <br/>
                <a href="https://www.youtube.com/channel/UCNldsbRR_aXY-NFTM_e5duQ" target="_black">Youtube</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo _("support_close"); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Phone modal -->
<div class="modal fade" id="phoneModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo _("support_phone_number"); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo _("support_phone_number"); ?> :01-573062 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo _("support_close"); ?></button>
            </div>
        </div>
    </div>
</div>


<?php
include "includes/template/footer.php";
?>