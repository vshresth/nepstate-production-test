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
                                                    <form id="rtcl-login-form" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                                                        <div class="wrap_2_inputs">
                                                            <div class="form-group">
                                                                <label for="rtcl-user-login" class="control-label">
                                                                    Name <strong class="rtcl-required">*</strong>
                                                                </label>
                                                                <input type="text" name="name" autocomplete="" value="<?php echo user_info()->name;?>" id="rtcl-user-login" class="form-control" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="rtcl-user-login" class="control-label">
                                                                    Username                   <strong class="rtcl-required">*</strong>
                                                                </label>
                                                                <input type="text" name="username" autocomplete="" value="<?php echo user_info()->username;?>" id="rtcl-user-login" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="rtcl-user-login" class="control-label">
                                                                Email Address  
                                                            </label>
                                                            <input type="email" disabled name="email" autocomplete="" value="<?php echo user_info()->email;?>" id="rtcl-user-login" class="form-control" style="background: #cfcfcfd6;">
                                                            <?php if(user_info()->g_id != null){?>
                                                                <span class="error_msg">
                                                                    This account is associated with Google!
                                                                </span>
                                                            <?php } ?>
                                                        </div>
                                                        <?php 
                                                            if(user_info()->g_id != null){
                                                                $url_image = user_info()->profile_pic;
                                                                $ex = explode("=", $url_image);
                                                                $url_image = $ex[0];
                                                            } else {
                                                                $url_image = user_info()->profile_pic;
                                                            }
                                                        ?>
                                                        <div class="form-group">
                                                            <label for="rtcl-user-login" class="control-label">Profile Picture</label>
                                                            <br>
                                                             <?php if(user_info()->g_id != null){ ?>
                                                                <div class="text-center">
                                                                <input type="file" id="input-file-disable-remove logo" class="dropify" data-show-errors="true" data-show-loader="true" data-errors-position="outside" data-show-remove="false" name="logo" data-allowed-file-extensions="png jpg jpeg gif" data-default-file="<?php echo $url_image; ?>" />
                                                                </div>
                                                            <?php }  else { ?>
                                                                <input type="file" id="input-file-disable-remove logo" class="dropify" data-show-errors="true" data-show-loader="true" data-errors-position="outside" data-show-remove="false" name="logo" data-allowed-file-extensions="png jpg jpeg gif" data-default-file="<?php echo $url_image; ?>" />
                                                            <?php } ?> 
                                                        </div>


                                                        <div class="form-group text-center">
                                                            <button type="submit" class="ff-btn ff-btn-submit ff-btn-md item-btn ff_btn_no_style btn btn-primary wd60">Update</button>
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