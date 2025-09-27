<?php include("common/header.php"); ?>

<section class="breadcrumbs-banner">
   <div class="container">
      <div class="breadcrumbs-area">
        <h1 class="heading-title">My Account</h1>
       </div>
   </div>
</section>

<!--=====================================-->
<!--=         Inner Banner Start        =-->
<!--=====================================--><div id="primary" class="page-details-wrap-layout bg--accent">
    <div class="container">
        <div class="row justify-content-center gutters-40">     
            <div class="col-12">        
                <main id="main" class="site-main">
                                            <article id="post-8" class="post-8 page type-page status-publish hentry">
        <div class="">
        <div class="entry-content">
            <div class="rtcl">
<div class="row registration-disable registration-not-separate" id="rtcl-user-login-wrapper">
    <div class="col-md-12 rtcl-login-form-wrap">
        <h2 class="text-center">Log in</h2>
        <form action="dashboard.php" id="rtcl-login-form" class="form-horizontal" method="post">
                        <div class="form-group">
                <label for="rtcl-user-login" class="control-label">
                    Email Address                   <strong class="rtcl-required">*</strong>
                </label>
                <input type="text" name="username" autocomplete="username" value="" id="rtcl-user-login" class="form-control">
            </div>

            <div class="form-group">
                <label for="rtcl-user-pass" class="control-label">
                    Password                    <strong class="rtcl-required">*</strong>
                </label>
                <input type="password" name="password" id="rtcl-user-pass" autocomplete="current-password" class="form-control">
            </div>

            <div class="form-group flex_space_between">
                <div class="">
                    <input type="checkbox" name="rememberme" id="rtcl-rememberme" value="forever">
                    <label class="form-check-label" for="rtcl-rememberme">
                        <small>Remember Me</small>                    </label>
                </div>
                <p class="rtcl-forgot-password">
                                        <a href="forgot.php"><small>Forgot your password?</small></a>
                </p>
            </div>

            <div class="form-group text-center">
                <button type="submit" class="ff-btn ff-btn-submit ff-btn-md item-btn ff_btn_no_style btn btn-primary wd60">Login</button>
            </div>


            <div class="form-group text-center">
                Don't have an account? <a href="signup.php">Sign up</a>
            </div>

            <div class="form-group text-center login_with">
                OR LOGIN WITH
            </div>

            <div class="form-group text-center">
                <img src="assets/images/google-plus.png" style="width:44px">
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