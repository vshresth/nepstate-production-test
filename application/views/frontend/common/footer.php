
<?php
   $countryId = userCountryId();
?>


<?php if($this->uri->segment(1) != "new" && $this->uri->segment(1) != "submit" && $this->uri->segment(1) != "edit"){
    unset($_SESSION['storyimages']);
    unset($_SESSION['storyimagesOthers']);
    unset($_SESSION['ALREADY_SESSION_IMAGE']);
}
?>
<?php if($show_footer_ad != 1){?>
<div class="apps apps--layout2 overflow-hidden float_width" style="margin-bottom:40px; margin-top:30px; background: rgba(240, 150, 44, 0.36);"> 

            <div class="container-fluid custom-padding" style="padding:40px 20px">
                <div class="elementor-widget-container text-center" >
                        <div class="section-heading">
                           <div class="heading-subtitle" style="color:#202020; margin-bottom:20px">Promote Your Business</div>
                        </div>      
                    </div>
                <div class="text-center">
                    <a href="<?php echo base_url();?>promote">
                        <button class="custom_button_popup">Click to add your Business Ad  (AD # 3)</button>
                    </a>
                </div>
            <div class="ads_boxes_bottom photoswip-item">
                <?php
                    $bottom_promotions = $this->db->query("SELECT * FROM products_ads WHERE ad_for = 'web_footer' ".$country_ConditionQuery." ORDER BY id DESC LIMIT 8")->result_object();
                    
                    $total_empty_show = (8 - count($bottom_promotions));
                ?>
                <?php foreach($bottom_promotions as $k=>$bads){
                    if($bads->link != ""){
                        $link_display = $bads->link;
                    } else {
                        $link_display = $bads->image;
                    }
                ?>
                    <a href="<?php echo $link_display;?>" class="ads_inner_box " target="_blank" data-lightbox="image-<?php echo $k;?>">
                        <img src="<?php echo $bads->image;?>">
                    </a>
                <?php } ?>


                <?php for($i=1;$i<=$total_empty_show;$i++){?>


                    <div class="ads_inner_box">
                        <p>
                            Promote Your Business <br>Post your Ad Here
                        </p>

                        <!-- <span>Click Me!</span> -->
                    </div>
                <?php } ?>

            </div>
                     </div>      
</div>
<?php } ?>


<?php 
if($page_url == "index"){ 
   
    if(settings()->list_view == 1){
        
        include 'trsuted_data.php';
    }
} 
?>
 
</div>
<footer class="footer footer--layout1">
   <div class="footer-top">
      <div class="container">
         <div class="row justify-content-between">
            <div class="col-lg-4 col-md-6">
               <div id="listygo_about-3" class="widget footer-widgets widget_listygo_about">
                  <div class="widget-about">
                     <div class="footer-logo">
                        <a href="#" class="main-logo">
                        <img width="130" height="55" src="<?php echo settings()->site_logo; ?>" class="attachment-full size-full" alt="" title="">                  </a>
                     </div>
                     <p class="footer-text"><?php echo settings()->footer_about; ?></p>
                     <div class="footer-social footer-social--style2">
                        <h3 class="footer-social__heading">Follow Us On:</h3>
                        <ul>
                           <li>
                              <a class="facebook" href="<?php echo settings()->facebook; ?>" rel="nofollow">
                              <i class="fa-brands fa-facebook-f"></i>
                              </a>
                           </li>
                           <li>
                              <a class="twitter" href="<?php echo settings()->twitter; ?>" rel="nofollow">
                              <i class="fa-brands fa-twitter"></i>
                              </a>
                           </li>
                           <li>
                              <a class="linkedin" href="<?php echo settings()->linkedin; ?>" rel="nofollow">
                              <i class="fa-brands fa-linkedin-in"></i>
                              </a>
                           </li>
                           <li>
                              <a class="instagram" href="<?php echo settings()->instagram; ?>" rel="nofollow">
                              <i class="fa-brands fa-instagram"></i>
                              </a>
                           </li>
                           <li>
                              <a class="pinterest" href="<?php echo settings()->snapchat; ?>" rel="nofollow">
                              <i class="fa-brands fa-pinterest-p"></i>
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>  

             <div class="col-lg-2 col-md-6 col-6">
                <div id="categories-8" class="widget footer-widgets widget_categories">
                    <h3 class="widget-title">Categories</h3>
                    <ul>
                        <?php
                            $categories = $this->db->query("SELECT * FROM categories WHERE parent_id = 0 ORDER BY id ASC")->result_object();
                            foreach($categories as $k=>$row){
                            ?>
                        <li class="cat-item cat-item-36">
                            <a href="<?php echo base_url();?>classifieds/<?php echo $row->slug; ?>"><?php echo $row->title; ?></a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                </div>
                <div class="col-lg-2 col-md-6 col-6">
                <div id="nav_menu-8" class="widget footer-widgets widget_nav_menu">
                    <h3 class="widget-title">Other Links</h3>
                    <div class="menu-top-cities-container">
                        <ul id="menu-top-cities" class="menu">
                            <li id="menu-item-2790" class="menu-item menu-item-type-taxonomy menu-item-object-rtcl_location menu-item-2790"><a href="<?php echo base_url();?>blog">Blog</a></li>
                            <li id="menu-item-2790" class="menu-item menu-item-type-taxonomy menu-item-object-rtcl_location menu-item-2790"><a href="<?php echo base_url();?>confessions">Confessions</a></li>
                            <li id="menu-item-2790" class="menu-item menu-item-type-taxonomy menu-item-object-rtcl_location menu-item-2790"><a href="<?php echo base_url();?>forums">Forums</a></li>
                            <li id="menu-item-3759" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3759"><a href="<?php echo base_url();?>about-us">About Us</a></li>
                            <li id="menu-item-3760" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3760"><a href="<?php echo base_url();?>faq">FAQs</a></li>
                        </ul>
                    </div>
                </div>
                </div>
                <div class="col-lg-2 col-md-6 col-6">
                <div id="nav_menu-4" class="widget footer-widgets widget_nav_menu">
                    <h3 class="widget-title">Terms & privacy</h3>
                    <div class="menu-quick-links-container">
                        <ul id="menu-quick-links" class="menu">
                            <li id="menu-item-2790" class="menu-item menu-item-type-taxonomy menu-item-object-rtcl_location menu-item-2790"><a href="<?php echo base_url();?>pages/terms-conditions">Terms & Conditions</a></li>
                            <li id="menu-item-2791" class="menu-item menu-item-type-taxonomy menu-item-object-rtcl_location menu-item-2791"><a href="<?php echo base_url();?>pages/privacy-policy">Privacy Policy</a></li>
                            <li id="menu-item-2792" class="menu-item menu-item-type-taxonomy menu-item-object-rtcl_location menu-item-2792"><a href="<?php echo base_url();?>pages/cookie-policy">Cookie Policy</a></li>
                            <li id="menu-item-6849" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6849"><a <?php if(isset($_SESSION['LISTYLOGIN'])){ ?>href="<?php echo base_url();?>dashboard"<?php } else {?>href="javascript:;" onclick="show_login_popup()"<?php } ?> >My Account</a></li>
                            <li id="menu-item-3758" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3758"><a href="<?php echo base_url();?>contact-us">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>

         </div>
      </div>
   </div>
   <div class="footer-bottom">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-lg-6">
               <p class="footer-copyright mb-0"></p>
            </div>
            <div class="col-lg-6">
               <div class="footer-menu footer-menu--style2">
                  <ul id="menu-copyright-footer-menu" class="footer-bottom-link">
                     <!-- <li id="menu-item-6846" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6846"><a href="<?php echo base_url();?>faq">Faqs</a></li>
                        <li id="menu-item-67" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-67"><a <?php if(isset($_SESSION['LISTYLOGIN'])){ ?>href="<?php echo base_url();?>dashboard"<?php } else {?>href="javascript:;" onclick="show_login_popup()"<?php } ?> >My Account</a></li> -->
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</footer>
<!--=====================================-->
<!--=          Footer Area End          =-->
<!--=====================================-->     
	
<?php 
    
require_once 'vendor/autoload.php';
$google_app_id = '431763947394-anvjjaeadnv029919s6k02o6df8v5a4v.apps.googleusercontent.com';
$google_app_secret = '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';

$google_callbackurl   =  base_url().'nepstate/do_google_login';

$google_client = new Google_Client();
$google_client->setClientId($google_app_id);
$google_client->setClientSecret($google_app_secret);

$google_client->setRedirectUri($google_callbackurl);

$google_client->addScope('email');
$google_client->addScope('profile');




?>

 <?php 

                                                // $objOAuthService = new Google_Service_Oauth2($google_client);
                                                // echo "<pre>";
                                                // print($google_client->getAccessToken());
                                                // echo "bbbbb";
                                                // print_r($objOAuthService);
                                                // echo "</pre>";
                                                // if ($google_client->getAccessToken()) {
                                                //     echo "Bilal";
                                                // }
                                            ?>

<div class="outer_wrap" id="signup_popup" <?php echo isset($_SESSION['show_popup_login'])?"style='display:block'":""?>>
    <div class="outer_wrap_inner">
        <div class="center_white_outer">
             <div class="close_poup" onclick="close_popup()">
                <i class="fa fa-close"></i>
            </div>
        
            <main id="main" class="site-main">
                <article id="post-8" class="post-8 page type-page status-publish hentry">
                    <div class="">
                        <div class="entry-content">
                            <div class="rtcl">
                                <div class="row registration-disable registration-not-separate" id="rtcl-user-login-wrapper">
                                    <div class="col-md-12">
                                        <h2 class="text-center">Log in</h2>
                                        <form id="rtcl-login-form" class="form-horizontal" method="post" action="<?php echo base_url();?>do/login">
                                                        <div class="form-group">
                                                <label for="rtcl-user-login" class="control-label">
                                                    Email Address or Username           <strong class="rtcl-required">*</strong>
                                                </label>
                                                <input type="text" name="email" autocomplete="username" value="" class="form-control" required> 
                                            </div>

                                            <div class="form-group">
                                                <label for="rtcl-user-pass" class="control-label">
                                                    Password                    <strong class="rtcl-required">*</strong>
                                                </label>
                                                <div  style="position: relative;">
                                                    <input type="password" name="password" id="pass_login"  autocomplete="current-password" class="form-control" required>
                                                    <div class="view_icon" id="eye_icon_show" onclick="do_check_password()">
                                                        <i class="fa fa-eye"></i>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php if(isset($_SESSION['invalid'])) {?>
                                            <p style="color:red"><?php echo $_SESSION['invalid']; ?></p>
                                        <?php } ?>

                                            <div class="form-group flex_space_between">
                                                <div class="">
                                                    <input type="checkbox" name="rememberme" id="rtcl-rememberme" value="forever">
                                                    <label class="form-check-label" for="rtcl-rememberme">
                                                        <small>Remember Me</small>                    </label>
                                                </div>
                                                <p class="rtcl-forgot-password">
                                                    <a href="<?php echo base_url();?>forgot/password"><small>Forgot your password?</small></a>
                                                </p>
                                            </div>

                                            <div class="form-group text-center">
                                                <button type="submit" class="ff-btn ff-btn-submit ff-btn-md item-btn ff_btn_no_style btn btn-primary wd60">Login</button>
                                            </div>


                                            <div class="form-group text-center">
                                                Don't have an account? <a href="javascript:;" onclick="show_signup_form()">Sign up</a>
                                            </div>

                                            <div class="form-group text-center login_with">
                                                OR LOGIN WITH
                                            </div>



                                            <div class="form-group text-center">
                                                <a href="<?php echo $google_client->createAuthUrl(); ?>">
                                                    <img src="<?php echo base_url();?>google-signin-button.png" style="height: 60px">
                                                </a>
                                            </div>

                                                <div style="font-size:13px;text-align:center;">
                                                     By Continuing, you agree to Nepstate <a href="<?php echo base_url();?>pages/terms-conditions" target="_blank">Terms of Service</a> and <br> confirm that you have read Nepstate <a href="<?php echo base_url();?>pages/privacy-policy" target="_blank">Privacy Policy</a>.
                                                </div>

                                            </form>
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


<!-- SIGNUP POPUP -->
<div class="outer_wrap" id="register_popup" <?php echo isset($_SESSION['show_popup_signup'])?"style='display:block'":""?>>
    <div class="outer_wrap_inner">
        <div class="center_white_outer">
            <div class="close_poup" onclick="close_popup()">
                <i class="fa fa-close"></i>
            </div>
            <main id="main" class="site-main">
                <?php
                    if(isset($_SESSION['show_popup_signup'])){
                        $session = $_SESSION['SIGNUPFORM'];
                        $name = $session['fname'];
                        $email = $session['email'];
                        $username = $session['username'];

                    }
                ?>
                <article id="post-8" class="post-8 page type-page status-publish hentry">
                    <div class="">
                        <div class="entry-content">
                            <div class="rtcl">
                                <div class="row registration-disable registration-not-separate" id="rtcl-user-login-wrapper">
                                    <div class="col-md-12 custom_login_heading">
                                        <h2 class="text-center">Sign Up</h2>
                                        <form id="rtcl-login-form-google" class="form-horizontal" method="post" action="<?php echo base_url();?>do/signup">

                                            <?php 
                                                if(isset($_SESSION['invalid_popup'])){
                                            ?>
                                                <div class="invalid_class">
                                                    <?php echo $_SESSION['invalid_popup']; ?>
                                                </div>
                                            <?php
                                                unset($_SESSION['invalid_popup']);
                                                }
                                            ?>

                                            <div class="form-group">
                                                <label for="rtcl-user-login" class="control-label">
                                                    Full Name                   <strong class="rtcl-required">*</strong>
                                                </label>
                                                <input type="text" name="fname" value="<?php echo $name;?>" class="form-control" required="">
                                            </div>
                                            <div class="form-group">
                                                <label for="rtcl-user-login" class="control-label">
                                                    User Name                   <strong class="rtcl-required">*</strong>
                                                </label>
                                                <input type="text" name="username" value="<?php echo $username;?>" class="form-control" required="">
                                            </div>
                                            <div class="form-group">
                                                <label for="rtcl-user-login" class="control-label">
                                                    Email Address                   <strong class="rtcl-required">*</strong>
                                                </label>
                                                <input type="email" name="email" value="<?php echo $email;?>" class="form-control" required="">
                                            </div>

                                            <div class="form-group">
                                                <label for="rtcl-user-pass" class="control-label">
                                                    Password                    <strong class="rtcl-required">*</strong>
                                                </label>
                                                <input type="password" name="password"  autocomplete="current-password" class="form-control" required="">
                                            </div>

                                            <div id="pswd_info" style="display: none;">
                                                <h4 style="font-size: 14px;">Password must contain:</h4>
                                                <ul>
                                                  <li id="letter" class="invalid">At least <strong>one letter</strong></li>
                                                  <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
                                                  <li id="number" class="invalid">At least <strong>one number</strong></li>
                                                  <li id="length" class="invalid">At least <strong>6 characters</strong></li>
                                                </ul>
                                            </div>


                                            <div class="form-group text-center">
                                                <button type="submit" class="ff-btn ff-btn-submit ff-btn-md item-btn ff_btn_no_style btn btn-primary wd60" id="submit_btnnn" disabled>Sign up</button>
                                            </div>


                                            <div class="form-group text-center">
                                                Already have an account? <a href="javascript:;" onclick="show_login_popup()" >Log In</a>
                                            </div>
                                            <div style="font-size:13px;text-align:center;">
                                                     By Continuing, you agree to Nepstate <a href="<?php echo base_url();?>pages/terms-conditions" target="_blank">Terms of Service</a> and <br> confirm that you have read Nepstate <a href="<?php echo base_url();?>pages/privacy-policy" target="_blank">Privacy Policy</a>.
                                                </div>
                                             </form>
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
<!-- SIGNUP POPUP ENDS -->

<a href="#wrapper" data-type="section-switch" class="scrollup">
			<i class="fa-solid fa-arrow-up"></i>
		</a>
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" aria-label="Close (Esc)"></button>
                <button class="pswp__button pswp__button--share" aria-label="Share"></button>
                <button class="pswp__button pswp__button--fs" aria-label="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" aria-label="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" aria-label="Previous (arrow left)"></button>
            <button class="pswp__button pswp__button--arrow--right" aria-label="Next (arrow right)"></button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>

<div id="cookies-popup" class="cookies-popup">
        <p>We use cookies to improve your experience on our site. By using our site, you agree to our <a href="<?php echo base_url();?>pages/cookie-policy">Cookie Policy</a>.</p>
        <button id="accept-cookies">Accept</button>
    </div>
		<script>var c = document.body.className;
			c = c.replace(/rtcl-no-js/, 'rtcl-js');
			document.body.className = c;</script>
		<link rel="stylesheet" id="custom-fonts-css" href="<?php echo $assets;?>assets/vendor/fonts/custom-fonts.css?ver=1.2.4" media="all">
<link rel="stylesheet" id="fluent-form-styles-css" href="<?php echo $assets;?>plugins/fluentform/public/css/fluent-forms-public.css?ver=4.3.25" media="all">
<link rel="stylesheet" id="fluentform-public-default-css" href="<?php echo $assets;?>plugins/fluentform/public/css/fluentform-public-default.css?ver=4.3.25" media="all">
<link rel="stylesheet" id="e-animations-css" href="<?php echo $assets;?>plugins/elementor/assets/lib/animations/animations.min.css?ver=3.13.4" media="all">
<link rel="stylesheet" id="rt-animation-css" href="<?php echo $assets;?>assets/css/minified/rt-animation.css?ver=1.2.4" media="all">
<script src="<?php echo $assets;?>assets/js/jquery/ui/core.min.js?ver=1.13.2" id="jquery-ui-core-js"></script>
<script src="<?php echo $assets;?>assets/js/jquery/ui/menu.min.js?ver=1.13.2" id="jquery-ui-menu-js"></script>
<script src="<?php echo $assets;?>assets/js/dist/vendor/wp-polyfill-inert.min.js?ver=3.1.2" id="wp-polyfill-inert-js"></script>
<script src="<?php echo $assets;?>assets/js/dist/vendor/regenerator-runtime.min.js?ver=0.13.11" id="regenerator-runtime-js"></script>
<script src="<?php echo $assets;?>assets/js/dist/vendor/wp-polyfill.min.js?ver=3.15.0" id="wp-polyfill-js"></script>
<script src="<?php echo $assets;?>assets/js/dist/dom-ready.min.js?ver=392bdd43726760d1f3ca" id="wp-dom-ready-js"></script>
<script src="<?php echo $assets;?>assets/js/dist/hooks.min.js?ver=4169d3cf8e8d95a3d6d5" id="wp-hooks-js"></script>
<script src="<?php echo $assets;?>assets/js/dist/i18n.min.js?ver=9e794f35a71bb98672ae" id="wp-i18n-js"></script>
<script type="text/javascript" id="wp-i18n-js-after">
wp.i18n.setLocaleData( { 'text directionltr': [ 'ltr' ] } );
</script>
<script src="<?php echo $assets;?>assets/js/dist/a11y.min.js?ver=ecce20f002eda4c19664" id="wp-a11y-js"></script>
<script type="text/javascript" id="jquery-ui-autocomplete-js-extra">
/* <![CDATA[ */
var uiAutocompleteL10n = {"noResults":"No results found.","oneResult":"1 result found. Use up and down arrow keys to navigate.","manyResults":"%d results found. Use up and down arrow keys to navigate.","itemSelected":"Item selected."};
/* ]]> */
</script>
<script src="<?php echo $assets;?>assets/js/jquery/ui/autocomplete.min.js?ver=1.13.2" id="jquery-ui-autocomplete-js"></script>
<script type="text/javascript" id="rtcl-public-js-extra">
/* <![CDATA[ */
var rtcl = {"plugin_url":".\/\/wp-content\/plugins\/classified-listing","decimal_point":".","i18n_required_rating_text":"Please select a rating","i18n_decimal_error":"Please enter in decimal (.) format without thousand separators.","i18n_mon_decimal_error":"Please enter in monetary decimal (.) format without thousand separators and currency symbols.","is_rtl":"","is_admin":"","ajaxurl":".\/\/wp-admin\/admin-ajax.php","confirm_text":"Are you sure?","re_send_confirm_text":"Are you sure you want to re-send verification link?","__rtcl_wpnonce":"f782fef777","rtcl_category":"","category_text":"Category","go_back":"Go back","location_text":"Location","rtcl_location":"","user_login_alert_message":"Sorry, you need to login first.","upload_limit_alert_message":"Sorry, you have only %d images pending.","delete_label":"Delete Permanently","proceed_to_payment_btn_label":"Proceed to payment","finish_submission_btn_label":"Finish submission","phone_number_placeholder":"XXX","has_map":"1","online_status_seconds":"300","online_status_offline_text":"Offline Now","online_status_online_text":"Online Now"};
/* ]]> */
</script>
<script src="<?php echo $assets;?>assets/js/rtcl-public.min.js?ver=2.4.3" id="rtcl-public-js"></script>
<script src="<?php echo $assets;?>assets/js/public.min.js?ver=2.1.13" id="rtcl-pro-public-js"></script>
<script type="text/javascript" id="rtcl-map-js-extra">
/* <![CDATA[ */
var rtcl_map = {"plugin_url":".\/\/wp-content\/plugins\/classified-listing","location":"local","center":{"address":"","lat":0,"lng":0},"zoom":{"default":8,"search":17}};
/* ]]> */
</script>
<script src="<?php echo $assets;?>assets/js/osm-map.js?ver=2.4.3" id="rtcl-map-js"></script>
<script src="<?php echo $assets;?>assets/vendor/bootstrap/popper.min.js?ver=1.2.4" id="popper-js"></script>
<script src="<?php echo $assets;?>assets/vendor/bootstrap/bootstrap.min.js?ver=1.2.4" id="bootstrap-js"></script>
<script src="<?php echo $assets;?>assets/js/appear.min.js?ver=1.2.4" id="appear-js"></script>
<script src="<?php echo $assets;?>assets/js/wow.min.js?ver=1.2.4" id="wow-js"></script>
<script src="<?php echo $assets;?>assets/vendor/photoswipe/photoswipe.min.js?ver=4.1.3" id="photoswipe-js"></script>
<script src="<?php echo $assets;?>assets/vendor/photoswipe/photoswipe-ui-default.min.js?ver=4.1.3" id="photoswipe-ui-default-js"></script>
<script src="<?php echo $assets;?>assets/vendor/rangeSlider/ion.rangeSlider.min.js?ver=1.2.4" id="rangeSlider-js"></script>
<script src="<?php echo $assets;?>assets/css/inc/customizer/typography/assets/select2.min.js?ver=4.0.6" id="rttheme-select2-js-js"></script>
<script src="<?php echo $assets;?>assets/js/theia-sticky-sidebar.min.js?ver=1.2.4" id="theia-sticky-sidebar-js"></script>
<script src="<?php echo $assets;?>assets/js/rt-parallax.js?ver=1.2.4" id="rt-bg-parallax-js"></script>
<script src="<?php echo $assets;?>assets/vendor/countdown/jquery.countdown.min.js?ver=1.2.4" id="jquery-countdown-js"></script>
<script src="<?php echo $assets;?>assets/js/food-menu.js?ver=1.2.4" id="rt-food-menu-js"></script>
<script src="<?php echo $assets;?>assets/js/doctor-chamber.js?ver=1.2.4" id="rt-doctor-chamber-js"></script>
<script type="text/javascript" id="listygo-main-js-extra">
/* <![CDATA[ */
var ListygoObj = {"ajaxurl":".\/\/wp-admin\/admin-ajax.php","day":"Days","hour":"Hrs","minute":"Mins","second":"Secs"};
/* ]]> */
</script>
<script src="<?php echo $assets;?>assets/js/main.js?ver=<?php echo time();?>" id="listygo-main-js"></script>
<script src="<?php echo $assets;?>plugins/listygo-core/assets/js/listygo-core.js?ver=6.2.2" id="listygo-core-js"></script>
<script src="<?php echo $assets;?>assets/vendor/swiper/slider-func.js?ver=<?php echo time();?>" id="slider-func-js"></script>
<script src="<?php echo $assets;?>assets/js/imagesloaded.min.js?ver=4.1.4" id="imagesloaded-js"></script>
<script src="<?php echo $assets;?>assets/vendor/swiper/swiper-bundle.min.js?ver=7.4.1" id="swiper-js"></script>
<script src="<?php echo $assets;?>assets/vendor/zoom/jquery.zoom.min.js?ver=1.7.21" id="zoom-js"></script>
<script type="text/javascript" id="rtcl-single-listing-js-extra">
/* <![CDATA[ */
var rtcl_single_listing_localized_params = {"slider_options":{"rtl":false,"autoHeight":true},"slider_enabled":"1","zoom_enabled":"","photoswipe_enabled":"1","photoswipe_options":{"shareEl":false,"closeOnScroll":false,"history":false,"hideAnimationDuration":0,"showAnimationDuration":0},"zoom_options":[]};
/* ]]> */
</script>
<script src="<?php echo $assets;?>assets/js/single-listing.min.js?ver=2.4.3" id="rtcl-single-listing-js"></script>

<script type="text/javascript" id="fluent-form-submission-js-extra">
/* <![CDATA[ */
var fluentFormVars = {"ajaxUrl":".\/\/wp-admin\/admin-ajax.php","forms":[],"step_text":"Step %activeStep% of %totalStep% - %stepTitle%","is_rtl":"","date_i18n":{"previousMonth":"Previous Month","nextMonth":"Next Month","months":{"shorthand":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],"longhand":["January","February","March","April","May","June","July","August","September","October","November","December"]},"weekdays":{"longhand":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],"shorthand":["Sun","Mon","Tue","Wed","Thu","Fri","Sat"]},"daysInMonth":[31,28,31,30,31,30,31,31,30,31,30,31],"rangeSeparator":" to ","weekAbbreviation":"Wk","scrollTitle":"Scroll to increment","toggleTitle":"Click to toggle","amPM":["AM","PM"],"yearAriaLabel":"Year"},"pro_version":"","fluentform_version":"4.3.25","force_init":"","stepAnimationDuration":"350","upload_completed_txt":"100% Completed","upload_start_txt":"0% Completed","uploading_txt":"Uploading","choice_js_vars":{"noResultsText":"No results found","loadingText":"Loading...","noChoicesText":"No choices to choose from","itemSelectText":"Press to select","maxItemText":"Only %%maxItemCount%% options can be added"},"input_mask_vars":{"clearIfNotMatch":false}};
/* ]]> */
</script>
<script src="<?php echo $assets;?>plugins/fluentform/public/js/form-submission.js?ver=4.3.25" id="fluent-form-submission-js"></script>
<script src="<?php echo $assets;?>plugins/elementor/assets/js/webpack.runtime.min.js?ver=3.13.4" id="elementor-webpack-runtime-js"></script>
<script src="<?php echo $assets;?>plugins/elementor/assets/js/frontend-modules.min.js?ver=3.13.4" id="elementor-frontend-modules-js"></script>
<script src="<?php echo $assets;?>plugins/elementor/assets/lib/waypoints/waypoints.min.js?ver=4.0.2" id="elementor-waypoints-js"></script>
<?php //if($this->uri->segment(2) != "detail" && 2==3){?>
<script type="text/javascript" id="elementor-frontend-js-before">var elementorFrontendConfig = {"environmentMode":{"edit":false,"wpPreview":false,"isScriptDebug":false},"i18n":{"shareOnFacebook":"Share on Facebook","shareOnTwitter":"Share on Twitter","pinIt":"Pin it","download":"Download","downloadImage":"Download image","fullscreen":"Fullscreen","zoom":"Zoom","share":"Share","playVideo":"Play Video","previous":"Previous","next":"Next","close":"Close"},"is_rtl":false,"breakpoints":{"xs":0,"sm":480,"md":768,"lg":1025,"xl":1440,"xxl":1600},"responsive":{"breakpoints":{"mobile":{"label":"Mobile Portrait","value":767,"default_value":767,"direction":"max","is_enabled":true},"mobile_extra":{"label":"Mobile Landscape","value":880,"default_value":880,"direction":"max","is_enabled":false},"tablet":{"label":"Tablet Portrait","value":1024,"default_value":1024,"direction":"max","is_enabled":true},"tablet_extra":{"label":"Tablet Landscape","value":1200,"default_value":1200,"direction":"max","is_enabled":false},"laptop":{"label":"Laptop","value":1366,"default_value":1366,"direction":"max","is_enabled":false},"widescreen":{"label":"Widescreen","value":2400,"default_value":2400,"direction":"min","is_enabled":false}}},"version":"3.13.4","is_static":false,"experimentalFeatures":{"e_dom_optimization":true,"e_optimized_assets_loading":true,"a11y_improvements":true,"additional_custom_breakpoints":true,"landing-pages":true},"urls":{"assets":"<?php echo $assets;?>plugins\/elementor\/assets\/"},"swiperClass":"swiper-container","settings":{"page":[],"editorPreferences":[]},"kit":{"viewport_mobile":767,"viewport_tablet":1024,"active_breakpoints":["viewport_mobile","viewport_tablet"],"global_image_lightbox":"yes","lightbox_enable_counter":"yes","lightbox_enable_fullscreen":"yes","lightbox_enable_zoom":"yes","lightbox_enable_share":"yes","lightbox_title_src":"title","lightbox_description_src":"description"},"post":{"id":10,"title":"Listy%20Go%20WordPress","excerpt":"","featuredImage":false}};</script>
<?php //} ?>
<script src="<?php echo $assets;?>plugins/elementor/assets/js/frontend.min.js?ver=3.13.4" id="elementor-frontend-js"></script>
<script type="application/ld+json">{
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "@id": ".//",
    "url": ".//"
}</script>
<script src="<?php echo $assets;?>assets/js/custom.js?ver=<?php echo time();?>"></script>
<link href="<?php echo base_url(); ?>resources/backend/toast-master/css/jquery.toast.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>resources/backend/toast-master/js/jquery.toast.js"></script>
<script src="<?php echo $assets; ?>dropify/dist/js/dropify.min.js"></script>
<script src="<?php echo base_url(); ?>resources/backend/datatables/jquery.dataTables.min.js"></script>
 <!-- start - This is for export functionality only -->
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>


<script type="text/javascript">



function  do_show_share(val) {
        // jQuery(".show_share_button_"+val).css('visibility', 'visible');
        var shareButtonContainer = jQuery(".show_share_button_" + val);
        if (shareButtonContainer.is(":visible")) {
            shareButtonContainer.css('visibility', 'visible');
        } else {
            shareButtonContainer.css('visibility', 'hidden');
        }
    }

    jQuery(document).ready(function(){
        <?php if(isset($_SESSION['LISTYLOGIN'])){ ?>
            // setInterval(function(){ 
            //     do_check_login()    
            // }, 5000);
        <?php } ?>

        jQuery(document).ready(function() {
          // jQuery("#notification_div").hide();

            jQuery("#menu-item-21").on("mouseover", function(){
                jQuery("#profile_dropdown").hide(); // Hide the notification_div
            })

          jQuery(document).on("click", function(e) {
            if (
              !jQuery("#profile_dropdown, .header-login").is(e.target) && // Check if the clicked element is not one of these
              !jQuery("#profile_dropdown, .header-login").has(e.target).length // Check if the clicked element is not a descendant of these
            ) {
              jQuery("#profile_dropdown").hide(); // Hide the notification_div
            }
          });
        });
    })
    
    // function do_check_login(){
    //     jQuery.ajax({
    //             url: '<?php echo base_url();?>nepstate/do_check_login_user/',
    //             cache: false,
    //             contentType: false,
    //             processData: false,
    //             type: 'post',
    //             success: function(response){
    //                 if(response==99){
    //                    window.location.href = "<?php echo base_url();?>";
    //                 }
    //             }
    //     });
    // }

    // function do_check_password(){
    //     if(jQuery("#eye_icon_show i").hasClass( "fa fa-eye-slash" )){
    //          jQuery("#eye_icon_show i").removeClass('fa-eye-slash');
    //          jQuery("#eye_icon_show i").addClass('fa-eye');
    //          jQuery("#password").attr('type', 'text');    
    //     } else {
    //          jQuery("#eye_icon_show i").removeClass('fa-eye');
    //          jQuery("#eye_icon_show i").addClass('fa-eye-slash');
    //          jQuery("#password").attr('type', 'password');
    //     }
    // }

     function do_redirect(val){
        window.location.href = val;
    }
    jQuery(document).ready(function () {
        <?php /* ?>
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                jQuery.ajax({
                        url: '<?php echo base_url();?>nepstate/do_save_location_browser/'+latitude+"/"+longitude,
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: 'post',
                        success: function(response){
                            console.log(response);
                            if(response==1){
                                window.location.reload();
                            }
                        }
                });
                // alert("Latitude: " + latitude + "<br>Longitude: " + longitude);
            });
        } else {
            alert("Geolocation is not available in your browser.");
        }

        <?php */ ?>

      //you have to use keyup, because keydown will not catch the currently entered value
      jQuery("input[type=password]").keyup(function () {
          // set password variable
          var pswd = jQuery(this).val();
          //validate the length
          if (pswd.length < 6) {
            jQuery("#length").removeClass("valid").addClass("invalid");
          } else {
            jQuery("#length").removeClass("invalid").addClass("valid");
          }

          //validate letter
          if (pswd.match(/[A-z]/)) {
            jQuery("#letter").removeClass("invalid").addClass("valid");
          } else {
            jQuery("#letter").removeClass("valid").addClass("invalid");
          }

          //validate uppercase letter
          if (pswd.match(/[A-Z]/)) {
            jQuery("#capital").removeClass("invalid").addClass("valid");
          } else {
            jQuery("#capital").removeClass("valid").addClass("invalid");
          }

          //validate number
          if (pswd.match(/\d/)) {
            jQuery("#number").removeClass("invalid").addClass("valid");
          } else {
            jQuery("#number").removeClass("valid").addClass("invalid");
          }

          if(pswd.length >= 6 && pswd.match(/[A-z]/) && pswd.match(/[A-Z]/) && pswd.match(/\d/)){
            jQuery("#submit_btnnn").attr("disabled", false);
          } else {
            jQuery("#submit_btnnn").attr("disabled", true);
          }

        })
        .focus(function () {
          jQuery("#pswd_info").show();
        })
        .blur(function () {
          jQuery("#pswd_info").hide();
        });


    });

    function show_profile_option(){
        jQuery('.rt-slide-nav').hide();
        jQuery("#profile_dropdown").slideToggle();
    }


    jQuery("#eye_icon_show").on("click", function(){
        var atval = jQuery("#pass_login").attr("type");
        if(atval=="text"){
            jQuery("#eye_icon_show i").removeClass('fa fa-eye-slash');
            jQuery("#eye_icon_show i").addClass('fa fa-eye');
            jQuery("#pass_login").attr("type", "password");
        } else {
            jQuery("#pass_login").attr('type', 'text');
            jQuery("#eye_icon_show i").removeClass('fa fa-eye');
            jQuery("#eye_icon_show i").addClass('fa fa-eye-slash');
        }
    });
   jQuery(document).ready(function() {
        jQuery('.listing_table').DataTable({
                "order": []
        });
        jQuery('.dropify').dropify();

        // var showButton = jQuery(".user-login__icon");
        // jQuery(document).on("click", function(event) {
        //     if (!jQuery(event.target).closest("#profile_dropdown").length && !jQuery(event.target).is(showButton)) {
        //       jQuery("#profile_dropdown").slideUp();
        //     }
        // });
    });
    function close_popup(){
        jQuery(".outer_wrap").fadeOut();
        jQuery.ajax({
                url: '<?php echo base_url();?>nepstate/do_clear_session_popup',
                cache: false,
                contentType: false,
                processData: false,
                type: 'post',
                success: function(response){
                        
                }
        });
    }
</script>

<?php if($_SESSION['valid'] !=''){ ?>
    <script>
    jQuery(function(){
        jQuery.toast({
            heading: 'Success',
            text: '<?php echo $_SESSION['valid'];?>',
            position: 'bottom-right',
            loaderBg:'#ff6849',
            icon: 'success',
            hideAfter: 5000, 
            stack: 6
          });
    });
    </script>
    <?php 
        unset($_SESSION['valid']);
        } 
    ?>
    <?php if($_SESSION['invalid'] !=''){ ?>
    <script>
    jQuery(function(){
        jQuery.toast({
            heading: 'Error',
            text: '<?php echo $_SESSION['invalid'];?>',
            position: 'bottom-right',
            loaderBg:'#ff6849',
            icon: 'error',
            hideAfter: 5000,
            stack: 6
            
          });
    });
    </script>
    <?php
        unset($_SESSION['invalid']); 
        } 
    ?>


<script>

var inactivityTime = 0;
var timeoutValue = 60 * 30;
var interval;

jQuery(document).ready(function () {
    var timestamp = new Date().getTime();

    function checkSession() {
        var currentTime = new Date().getTime();
        var elapsedTime = Math.floor((currentTime - timestamp) / 1000);

        if (elapsedTime >= timeoutValue) {
            clearInterval(interval);
            jQuery.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>ApiController/sessionUnset',
                success: function(response) {
                    window.location.href = '<?= base_url() ?>'; 
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); 
                }
            });
            return;
        }
    }

     <?php if(isset($_SESSION['LISTYLOGIN'])){ ?>
    interval = setInterval(checkSession, 1000);

    jQuery(document).on('mousemove keypress', function() {
        inactivityTime = 0;
        timestamp = new Date().getTime();
    });
    <?php } ?>
});
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXLSGnMNN051ESCBh-mKv__W_m-tbkFlg&libraries=places"></script>

<!-- Script to initialize Google Maps autocomplete -->
<script>

 let locationLink = document.getElementById('locationLink');
 let cityPopup = document.querySelector('.cityPopup');

 document.getElementById('locationLink').addEventListener('click',()=>{

      cityPopup.style.display = 'block';
 });

 document.getElementById('closeBtn').addEventListener('click',()=>{
       cityPopup.style.display = 'none';
  });



  
  document.getElementById('citySelectionBtn').addEventListener('click', function(event) {
  event.preventDefault();

  var popupCities = document.querySelector('.cityPopup');

  if (popupCities.style.display === "none") {
      popupCities.style.display = "block";
  } else {
      popupCities.style.display = "none";
  }
});

</script>

<script>
     document.addEventListener('DOMContentLoaded', () => {
    const popup = document.getElementById('cookies-popup');
    const acceptButton = document.getElementById('accept-cookies');

    function setCookie(name, value, days) {
        const expires = new Date();
        expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
        document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/;SameSite=Lax`;
        console.log(`Cookie set: ${name}=${value}`); 
    }

    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }

    console.log('Current cookies:', document.cookie);
    console.log('Cookie check:', getCookie('cookiesAccepted')); 

    if (!getCookie('cookiesAccepted')) {
        popup.style.display = 'block';
    }

    acceptButton.addEventListener('click', () => {
        setCookie('cookiesAccepted', 'true', 365);
        popup.style.display = 'none';
    });
});
</script>
<style>
.cookies-popup {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: #333;
    color: #fff;
    padding: 15px;
    text-align: center;
    display: none;
    z-index: 1000;
}



.cookies-popup p {
    margin: 0;
    padding: 0;
}


.cookies-popup button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 10px 2px;
    cursor: pointer;
}

    </style>
</div> 

<audio id="myAudio">
  <source src="<?= base_url() ?>resources/notification.mp3" type="audio/mpeg">
</audio>

<script>

<?php if(isset($_SESSION['LISTYLOGIN'])) { ?>


   setInterval(() => {
      getNotificationCount();
   }, 2000);

<?php } ?>
   
// function getNotificationCount() {

//     // Retrieve old count from the hidden field or default to 0 if empty
//     let oldCount = jQuery('#oldCount').val() || 0;
    
//     jQuery.ajax({
//         url: '<?php echo base_url();?>nepstate/getNotifiationCount',
//         cache: false,
//         contentType: false,
//         processData: false,
//         type: 'GET',
       
//         success: function(data) {
//             let response = JSON.parse(data);
//             console.log(response);
            
//             if (response.count != 0) {
                
//                 jQuery('.notificationCount').addClass('notif_ball');
//                 jQuery('.notificationCount').html(response.count);

//                 let userId = '<?php echo user_info()->id; ?>';
                
//                 // Compare current count with the old count from the session
//                 if (response.count > response.old_count) {

//                     if (response.creator_id == userId) {
//                         var audio = document.getElementById("myAudio");
//                         audio.play();
//                     }
//                 }
                
//                 // Update the hidden field with the new count after comparison
//                 jQuery('#oldCount').val(response.count);
//             }
//         },
//         error: function(error) {
//             console.log("Error:", error);
//         }
//     });
// }




function getNotificationCount() {


jQuery.ajax({
    url: '<?php echo base_url();?>nepstate/getNotifiationCount',
    cache: false,
    contentType: false,
    processData: false,
    type: 'GET',
   
    success: function(data) {
        let response = JSON.parse(data);

        if (response.count != 0) {
            
            jQuery('.notificationCount').addClass('notif_ball');
            jQuery('.notificationCount').html(response.count);
            
            
            let userId = '<?php echo user_info()->id; ?>';
            
            if (response.count > response.old_count) {
                if (response.creator_id == userId) {
                    var audio = document.getElementById("myAudio");
                    audio.play();
                }
            }
            
        }

        if(response.chat_count != 0) {
            jQuery('.chatCount').addClass('notif_ball');
            jQuery('.chatCount').html(response.chat_count);
            
        }
        
        $('#conversationsBox').html(response.conversations_html);

        // console.log(response.conversations_html);
    },
    error: function(error) {
        console.log("Error:", error);
    }
});
}

</script>
</body>
</html>