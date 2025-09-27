<?php include("common/header.php"); ?>

<section class="breadcrumbs-banner">
   <div class="container">
      <div class="breadcrumbs-area">
        <h1 class="heading-title">Forgot password</h1>
       </div>
   </div>
</section>

<!--=====================================-->
<!--=         Inner Banner Start        =-->
<!--=====================================-->
<div id="primary" class="page-details-wrap-layout bg--accent">
    <div class="container">
        <div class="row justify-content-center gutters-40">     
            <div class="col-6 forgotPasswordBox">        
                <main id="main" class="site-main">
                                            <article id="post-8" class="post-8 page type-page status-publish hentry">
        <div class="">
        <div class="entry-content">
            <div class="rtcl">
<div class="row registration-disable registration-not-separate" id="rtcl-user-login-wrapper">
    <div class="col-md-12 rtcl-login-form-wrap">
        <h2 class="text-center">Forgot Password</h2>
        <p class="text-center">
            Please enter your username or email address. <br>You will receive a link to create a new password via email.
            
        </p>
        <form id="rtcl-login-form" class="form-horizontal" method="post" action="<?php echo base_url();?>do/forgot/password">
                        <div class="form-group">
                <label for="rtcl-user-login" class="control-label">
                    Email Address                   <strong class="rtcl-required">*</strong>
                </label>
                <input type="email" name="username" autocomplete="username" value="" id="rtcl-user-login" class="form-control" required>
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
    </article>                                  </main>
            </div>
                    </div>
    </div>
</div>

<?php include("common/footer.php"); ?>