<style type="text/css">
    .page-details-wrap-layout {
        padding-top: 50px;
    }
</style>
<div id="primary" class="page-details-wrap-layout bg--accent">
    <div class="container-fluid custom-padding">
         <div class="dashboard_heading flex_space_between">
            <h2>Hello,   
                <span>
                    <?php echo user_info()->name;?>!
                </span>

            </h2>
            <button class="show_menu_mobile_view btn btn-dark mb-2" id="showMenuBtn">+</button>
        </div>
        <div class="row justify-content-center gutters-40" >   

            <div class="col-12">     

                <main id="main" class="site-main">
                    <article id="post-8" class="post-8 page type-page status-publish hentry">
                        <div class="">
                            <div class="entry-content" >
                                <div class="rtcl">
                                    <div class="rtcl-MyAccount-wrap" >

<nav class="rtcl-MyAccount-navigation" id="menuSection">
        <?php $uro = $this->uri->segment(1); ?>
        <ul>
                <li class="rtcl-MyAccount-navigation-link rtcl-MyAccount-navigation-link--dashboard <?php echo $uro=="dashboard"?"is-active":"";?>">
                    <a href="<?php echo base_url();?>dashboard">Dashboard</a>
                </li>
                
                <li class="rtcl-MyAccount-navigation-link rtcl-MyAccount-navigation-link--edit-account <?php echo $uro=="profile"?"is-active":"";?>">
                    <a href="<?php echo base_url();?>profile">Account details</a>
                </li>
                
                <li class="rtcl-MyAccount-navigation-link rtcl-MyAccount-navigation-link--listings <?php echo $uro=="my-chats"?"is-active":"";?>">
                    <a href="<?php echo base_url();?>my-chats?slug=dashboard">My Chats</a>
                </li>

                <li class="rtcl-MyAccount-navigation-link rtcl-MyAccount-navigation-link--listings <?php echo $uro=="my-listings"?"is-active":"";?>">
                    <a href="<?php echo base_url();?>my-listings">My Listings</a>
                </li>
                
                <li class="rtcl-MyAccount-navigation-link rtcl-MyAccount-navigation-link--listings <?php echo $uro=="my-blogs"?"is-active":"";?>">
                    <a href="<?php echo base_url();?>my-blogs">My Blogs</a>
                </li>
                
                <li class="rtcl-MyAccount-navigation-link rtcl-MyAccount-navigation-link--listings <?php echo $uro=="my-ads"?"is-active":"";?>">
                    <a href="<?php echo base_url();?>my-ads">My Ads</a>
                </li>
                
                <li class="rtcl-MyAccount-navigation-link rtcl-MyAccount-navigation-link--listings <?php echo $uro=="my-confessions"?"is-active":"";?>">
                    <a href="<?php echo base_url();?>my-confessions">My Confessions</a>
                </li>
                
                <li class="rtcl-MyAccount-navigation-link rtcl-MyAccount-navigation-link--listings <?php echo $uro=="my-forums"?"is-active":"";?>">
                    <a href="<?php echo base_url();?>my-forums">My Forums</a>
                </li>
                
                <li class="rtcl-MyAccount-navigation-link rtcl-MyAccount-navigation-link--favourites <?php echo $uro=="favorites"?"is-active":"";?>">
                    <a href="<?php echo base_url();?>favorites">Favourites</a>
                </li>
               
                <!-- <li class="rtcl-MyAccount-navigation-link rtcl-MyAccount-navigation-link--chat rtcl-chat-unread-count">
                    <a href="#">Chat</a>
                </li> -->
                
                <li class="rtcl-MyAccount-navigation-link rtcl-MyAccount-navigation-link--my-bookings <?php echo $uro=="my-comments"?"is-active":"";?>">
                    <a href="<?php echo base_url();?>my-comments">My Comments</a>
                </li>
                
                <li class="rtcl-MyAccount-navigation-link rtcl-MyAccount-navigation-link--my-bookings <?php echo $uro=="my-reviews"?"is-active":"";?>">
                    <a href="<?php echo base_url();?>my-reviews">My Reviews</a>
                </li>
                
                <li class="rtcl-MyAccount-navigation-link rtcl-MyAccount-navigation-link--my-bookings <?php echo $uro=="notifications"?"is-active":"";?>">
                    <a href="<?php echo base_url();?>notifications">Notifications <span class="notificationCount"></span></a>
                </li>
                
                <!-- <li class="rtcl-MyAccount-navigation-link rtcl-MyAccount-navigation-link--my-bookings <?php echo $uro=="payments"?"is-active":"";?>">
                    <a href="<?php echo base_url();?>payments">Payments</a>
                </li> -->
                
                <li class="rtcl-MyAccount-navigation-link rtcl-MyAccount-navigation-link--my-bookings <?php echo $uro=="change"?"is-active":"";?>">
                    <a href="<?php echo base_url();?>change/password">Change Password</a>
                </li>
                
                <li class="rtcl-MyAccount-navigation-link rtcl-MyAccount-navigation-link--my-bookings <?php echo $uro=="delete-account"?"is-active":"";?>">
                <a href="<?php echo base_url();?>delete-account" class="profile_links_b">
					<div class="bold_head">Delete Account</div>
				</a>
                </li>

               
                <li class="rtcl-MyAccount-navigation-link rtcl-MyAccount-navigation-link--logout">
                    <a href="<?php echo base_url();?>logout">Logout</a>
                </li>
        </ul>
    </nav>

    <script>
   jQuery("#showMenuBtn").click(function() {
    jQuery("#menuSection").slideToggle(function() {
        if (jQuery("#menuSection").is(":visible")) {
            jQuery("#showMenuBtn").text("-");
        } else {
            jQuery("#showMenuBtn").text("+");
        }
    });
});

    </script>