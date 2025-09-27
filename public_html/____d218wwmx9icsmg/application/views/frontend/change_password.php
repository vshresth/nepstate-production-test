<?php include("common/header.php"); ?>
<?php include("common/breadcrum_dashboard.php"); ?>

                                        <?php include("common/siderbar.php"); ?>
                                        <div class="rtcl-MyAccount-content">
                                            <div class="rtcl-user-info media">

                                                <?php 
                                                    if(validation_errors()){
                                                ?>
                                                    <div class="invalid_class">
                                                        <?php echo validation_errors(); ?>
                                                    </div>
                                                <?php
                                                    }
                                                ?>
                                                    <form id="rtcl-login-form" class="form-horizontal" method="post" action="">
                                                        <div class="form-group">
                                                            <label for="rtcl-user-login" class="control-label">
                                                                Old password                   <strong class="rtcl-required">*</strong>
                                                            </label>
                                                            <input type="password" name="opass" autocomplete="New Password" value="" id="rtcl-user-login" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="rtcl-user-login" class="control-label">
                                                                New password                   <strong class="rtcl-required">*</strong>
                                                            </label>
                                                            <input type="password" name="npass" autocomplete="New Password" value="" id="rtcl-user-login" class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="rtcl-user-login" class="control-label">
                                                                Confirm New password                   <strong class="rtcl-required">*</strong>
                                                            </label>
                                                            <input type="password" name="cnpass" autocomplete="Confirm New Password" value="" id="rtcl-user-login" class="form-control" required>
                                                        </div>


                                                        <div class="form-group text-center">
                                                            <button type="submit" class="ff-btn ff-btn-submit ff-btn-md item-btn ff_btn_no_style btn btn-primary wd60">Submit</button>
                                                        </div>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>                                  
                </main>
            </div>
        </div>
    </div>
</div>
<?php include("common/footer.php"); ?>