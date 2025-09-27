
<?php include("common/header.php"); ?>

<style>
</style>

<?php
    
    $productInfo_ = $this->db->query("SELECT * FROM products WHERE slug = '".$slug."' ")->result_object()[0];
    if(user_info()->id == $productInfo_->uID){
         $country_city_ConditionQuery_classified = "";
    }
  
    $row = $this->db->query("SELECT * FROM products WHERE slug = '".$slug."' ".$country_city_ConditionQuery_classified." ")->result_object()[0];
    
    if(empty($row)) {

        if(!empty($productInfo_)) {
            redirect(base_url().'classifieds/'.$productInfo_->category);
        }else{
            redirect(base_url());
        }
    }

    $json = json_decode($row->json_content, false);
    $category = $this->db->query("SELECT * FROM categories WHERE slug = '".$row->category."'")->result_object()[0];
    $images = $this->db->query("SELECT * FROM product_images WHERE gallery = 0 AND product_id = ".$row->id)->result_object();
    $user = $this->db->query("SELECT * FROM users WHERE id = ".$row->uID)->result_object()[0];
?>
<?php if(count($images)<=3){?>
<style type="text/css">
    .top_slider .swiper-wrapper {
        justify-content: center;
    }
</style>
<?php } ?>

<style>
    .multiple_image_show_ .swiper-slide img {
        height: 280px;
        width: 336px;
        object-fit: cover
    }
</style>
<link rel="stylesheet" type="text/css" href="<?php echo $assets;?>assets/css/app.css?ver=1686243998">
<div class="listing-details-page">
    <div id="primary" class="content-area rtcl-container"><main id="main" class="site-main" role="main">
<div id="rtcl-listing-7613" class="listing-item rtcl-listing-item post-7613 status-publish is-sell rtcl_category-italian rtcl_location-los-angeles">
    
<div class="page-header container-fluid custom-padding top_slider" style="background: #fff;">
    <?php if(!empty($images)){?>
              <!-- Listing Banner Area Start Here -->
            <section class="single-listing-carousel-wrap " <?php if(count($images) ==  1){ ?> style="text-align: center"<?php } ?>>
                <?php if(count($images) ==  1){ ?>
                    <a href="<?php echo $images[0]->image;?>" data-lightbox="top_slider-<?php echo $ki;?>" class="image_popup" >
                        <img src="<?php echo $images[0]->image;?>" class="attachment-listygo-size-4 size-listygo-size-4" alt="" decoding="async" title="" style="object-fit: cover; border-radius: 10px; width: 100%;">  
                    </a>

                <?php } else if(count($images) ==  2){ ?>
                    <div class="image_double_popup">
                        <?php foreach($images as $ki => $img){
                        ?>
                                 <a href="<?php echo $img->image;?>" data-lightbox="top_slider-<?php echo $ki;?>" class="double_imm" >
                                <img src="<?php echo $img->image;?>" class="attachment-listygo-size-4 size-listygo-size-4" alt="" decoding="async" title="" style="object-fit: cover; border-radius: 10px; width: 100%;">  
                            </a>
                        <?php } ?>
                    </div>

                <?php } else { ?>
                                    <div class=" slick-navigation-layout2 multiple_image_show_">
                        <div class="rtcl-related-slider rtcl-carousel-slider" id="rtcl-related-slider-banner" data-options="{&quot;allowSlideNext&quot;:true,&quot;allowSlidePrev&quot;:true,&quot;navigation&quot;:{&quot;nextEl&quot;:&quot;.swiper-button-next&quot;,&quot;prevEl&quot;:&quot;.swiper-button-prev&quot;},&quot;loop&quot;:false,&quot;autoplay&quot;:{&quot;delay&quot;:3000,&quot;disableOnInteraction&quot;:false,&quot;pauseOnMouseEnter&quot;:true},&quot;speed&quot;:1000,&quot;spaceBetween&quot;:0,&quot;breakpoints&quot;:{&quot;0&quot;:{&quot;slidesPerView&quot;:1},&quot;576&quot;:{&quot;slidesPerView&quot;:2},&quot;800&quot;:{&quot;slidesPerView&quot;:3},&quot;1200&quot;:{&quot;slidesPerView&quot;:4}}}">
                            <div class="swiper-wrapper">
                                 <?php foreach($images as $ki => $img){?>
                                    <div class="swiper-slide nav-item ">
                                        <a href="<?php echo $img->image;?>" data-lightbox="top_slider-<?php echo $ki;?>" >
                                            <img src="<?php echo $img->image;?>" class="attachment-listygo-size-4 size-listygo-size-4" alt="" decoding="async" title="" style="object-fit: cover;">                                            </a>
                                    </div>
                                <?php } ?>                               
                                                                           
                                                                           
                             </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                <?php } ?>
                            </section>
<?php } ?>
            <!-- Listing Banner Area End Here -->
        </div>
<!-- listing Details --> 


<section class="listing-details listing-details--layout1 ">
  <div class="listingDetails-top listingDetails-top--bg white-bg header-banner-1" style="padding-top:10px; padding-bottom: 10px;">
    <div class="container">
        <div class="listing-header--top">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="listingDetails-header">
                                                <figure class="listingDetails-header__thumb" style="height: 100px; width:100px">
                            <img src="<?php echo $images[0]->image;?>" class="attachment-full size-full" alt="" decoding="async" title="" style="height: 100%; width: 100%;">                        </figure>
                                                <div class="listingDetails-header__content">
                            <div class="listingDetails-header__fetures">
                              <ul>
                                <li>
                                    <a href="#" class="listingDetails-header__tag"><?php echo $category->title;?></a>
                                </li> 
                                <li>
                                    <div class="rtcl-listing-badge-wrap"></div>
                                </li>
                              </ul>
                            </div>
                           
                            <h2 class="listingDetails-header__heading">
                                <?php echo $row->title; ?>                                       
                            </h2>
                            <?php if($json->address != ""){?>
                            <div class="listingDetails-header__fetures">
                              <ul class="info-list">
                                                                  <li class="meta-address">
                                        <span class="listingDetails-header__info">
                                           <svg width="14" height="16" viewbox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.62225 6.83378C4.62225 5.42809 5.7614 4.28894 7.16709 4.28894C8.57215 4.28894 9.71114 5.42825 9.71114 6.83378C9.71114 8.23868 8.572 9.37783 7.16709 9.37783C5.76156 9.37783 4.62225 8.23884 4.62225 6.83378ZM7.16709 5.48894C6.42414 5.48894 5.82225 6.09083 5.82225 6.83378C5.82225 7.57578 6.42398 8.17783 7.16709 8.17783C7.90925 8.17783 8.51114 7.57594 8.51114 6.83378C8.51114 6.09067 7.9091 5.48894 7.16709 5.48894Z" fill="#FF3C48"></path>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.16596 1.59999C4.28028 1.59999 1.933 3.96056 1.933 6.88255C1.933 8.7379 3.04199 10.6278 4.34853 12.0989C4.99287 12.8244 5.6623 13.4216 6.21812 13.8328C6.4967 14.0389 6.73773 14.1915 6.9255 14.2896C7.06206 14.3609 7.13847 14.3862 7.16596 14.3951C7.19345 14.3862 7.26987 14.3609 7.40647 14.2896C7.59426 14.1915 7.83532 14.0388 8.11393 13.8328C8.66983 13.4216 9.33935 12.8244 9.98379 12.0989C11.2905 10.6278 12.3997 8.73787 12.3997 6.88255C12.3997 3.96067 10.0517 1.59999 7.16596 1.59999ZM0.733002 6.88255C0.733002 3.30752 3.60788 0.399994 7.16596 0.399994C10.7239 0.399994 13.5997 3.30742 13.5997 6.88255C13.5997 9.17675 12.258 11.3455 10.8809 12.8958C10.1835 13.681 9.45283 14.3351 8.82751 14.7976C8.51552 15.0283 8.22071 15.2181 7.96204 15.3532C7.7325 15.4731 7.44058 15.6 7.16596 15.6C6.89132 15.6 6.59941 15.4731 6.36989 15.3532C6.11123 15.2181 5.81645 15.0283 5.50449 14.7975C4.87924 14.335 4.14869 13.681 3.45132 12.8958C2.07442 11.3455 0.733002 9.17671 0.733002 6.88255Z" fill="#FF3C48"></path>
        </svg>                                           <?php echo $json->address;?>                                       </span>
                                    </li>
                                                                       
                                                              </ul>
                           </div>
                       <?php } ?>
                                                           <!-- <div class="product-price">
                                    Price:  <div class="rtcl-price price-type-fixed"><span class="rtcl-price-amount amount"><bdi><span class="rtcl-price-currencySymbol">&#36;</span>250</bdi></span></div>                                </div> -->
                                                   </div>
                    </div>
                </div>
                <div class="col-md-5 text-xl-end text-md-end text-md-center text-center">
                    <div class="listing-actions">
                                               <!--  <li class="tooltip-item meta-favourite" data-bs-toggle="Favourite" data-bs-placement="top" data-bs-trigger="hover" title="Favourite">
                     <a 
                        <?php if(isset($_SESSION['LISTYLOGIN'])){
                           $whishlist = $this->db->query("SELECT * FROM wishlist WHERE user_id = ".user_info()->id." AND product_id = ".$row->id)->result_object()[0];
                        }
                        ?>

                        <?php if(!empty($whishlist)){?> class="hover_heart"<?php } ?>
                        <?php if(isset($_SESSION['LISTYLOGIN'])){ ?>href="<?php echo base_url();?>do/favorite/<?php echo $row->id;?>"<?php } else {?>href="javascript:;" onclick="show_login_popup()"<?php } ?>>

                        
                        <i class="rtcl-icon rtcl-icon-heart<?php echo !empty($whishlist)?"":"-empty";?>" <?php if(!empty($whishlist)){?>style="color: #fff; <?php } ?>"></i><span class="favourite-label">Favourite</span></a>  

                  </li> -->
                        
                  <div class="row">
                  <div class="col-md-8 col-md-6">
                        <div class="show_share_button_<?php echo $row->id;?>" style="visibility: hidden; margin-left: 2px;">
                                <div class="sharethis-inline-share-buttons" data-title="<?php echo $row->slug;?>" data-url="<?php echo base_url();?><?php echo $this->uri->segment(1);?>/detail/<?php echo $row->slug;?>"></div>
                            </div>
                        </div>
                    <div class="col-md-3 col-sm-2">
                            <div class="icon_box_wrap"  onclick="do_show_share(<?php echo $row->id;?>)" stlye="border:5px solid red !important;">
                                <div class="svg_conf">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M352 0c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9L370.7 96 201.4 265.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L416 141.3l41.4 41.4c9.2 9.2 22.9 11.9 34.9 6.9s19.8-16.6 19.8-29.6V32c0-17.7-14.3-32-32-32H352zM80 32C35.8 32 0 67.8 0 112V432c0 44.2 35.8 80 80 80H400c44.2 0 80-35.8 80-80V320c0-17.7-14.3-32-32-32s-32 14.3-32 32V432c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16H192c17.7 0 32-14.3 32-32s-14.3-32-32-32H80z"/></svg>
                                </div>
                                <a href="javascript:void(0)"> <div class="text_icon_conf"  >Share</div></a>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        
                  </div>
                        
                    </div>
                    
                </div>
                <!-- Add Listing Button Start -->
                <div class="wd100 container-fluid custom-padding">

                    <?php 
                        if($tags == 1){
                            $url_after_login = "new/post/events";
                        } else {
                            $url_after_login = "new/post/".$row->category;
                        } 
                    ?>
                        <a 
                        <?php if(isset($_SESSION['LISTYLOGIN'])){ ?>href="<?php echo base_url();?><?php echo $url_after_login;?>"<?php } else {?>href="javascript:;" onclick="show_login_popup()"<?php } ?>
                        class="listygo-btn listygo-btn--style1" style="margin-bottom: 10px; float: right; margin-right: -25px;">
                            <span class="listygo-btn__icon">
                                <i class="fa-solid fa-plus"></i>
                            </span>
                            <span class="listygo-btn__text">Add Listing</span>
                        </a>
                    </div>
                <!-- Add Listing Button End -->
            </div>
        </div>
    </div>
</div>

<div class="listing-breadcrumb listing-archive-page" style="margin-left: -40px;margin-top: 20px;">
    <div class="container-fluid custom-padding">
        <div class="breadcrumb-area"><div class="entry-breadcrumb">
            <!-- Breadcrumb NavXT 7.2.0 -->
            <span property="itemListElement" typeof="ListItem">
                <a property="item" typeof="WebPage" title="" href="<?php echo base_url(); ?>" class="home"><span property="name">Home </span></a> >
                <a property="item" typeof="WebPage" title="" href="<?php echo base_url().'classifieds/'.$row->category.''; ?>" class="home"><span property="name"> <?php echo $row->category;?> </span></a>
                <meta property="position" content="1"></span> &gt; <span property="itemListElement" typeof="ListItem"><span property="name" class="archive post-rtcl_listing-archive current-item"> <?php echo $row->title; ?></span><meta property="url" content="<?php echo base_url(); ?>">
            <meta property="position" content="2"></span>
    </div>
</div>

        <!-- Modal -->
        <div class="modal fade social-share" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><img src="<?php echo $assets;?>assets/images/cross.svg" alt="Cross"></span>
                        </button>
                        <img src="<?php echo $assets;?>assets/images/popup.png" alt="Popup">
                        <h5 class="modal-title" id="exampleModalLongTitle">Share This Link Via</h5>
                    </div>
                    <div class="modal-body">
                        <div class="share-icon">
                            <?php /* ?>
                                <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo current_url();?>" target="_blank" rel="nofollow"><span class="rtcl-icon rtcl-icon-facebook"></span></a>

    <a class="twitter" href="https://twitter.com/intent/tweet?text=The%20shapes%20of%20pasta%20food&amp;<?php echo current_url();?>" target="_blank" rel="nofollow"><span class="rtcl-icon rtcl-icon-twitter"></span></a>

    <a class="linkedin" href="https://www.linkedin.com/shareArticle?url=<?php echo current_url();?>&amp;title=" target="_blank" rel="nofollow"><span class="rtcl-icon rtcl-icon-linkedin"></span></a>

    <a class="pinterest" href="https://pinterest.com/pin/create/button/?url=<?php echo current_url();?>&amp;media=&amp;description=<?php echo $row->title;?>" target="_blank" rel="nofollow"><span class="rtcl-icon rtcl-icon-pinterest-circled"></span></a>
    <?php */ ?>
                            <div class="sharethis-inline-share-buttons"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
          <div class="listingDetails-main" style="padding-top: 40px;">
    <div class="container">
      <div class="row g-30">
        <div class="col-lg-8 order-1 listing-content">
         
    <?php 
            $images_gallery = $this->db->query("SELECT * FROM product_images WHERE gallery = 1 AND product_id = ".$row->id)->result_object();
    ?>

<div class="listingDetails-block seller-info mb-30">


<?php if($json->ticket_link != ""){?>
    <a href="<?php echo $json->ticket_link;?>" target="_blank" class="wd100">
        <button class="ff-btn ff-btn-submit ff-btn-md item-btn wd100 custom_link custom_button_ticket">
            Get your tickets here
        </button>
    </a>
<?php } ?>

<div class="rtcl-listing-user-info">
        <div class="rtcl-listing-side-title">
        <h3>Contact Details</h3>
    </div>
    <div class="list-group">
                    <!-- <div class="listing-author"> -->
            <!-- <div class="author-logo-wrapper">
                      <div class="directory-block__poster__thumb">
          <a class="directory-block__poster__link--image" href="./../../author/martin/index.html"> -->

     <!-- <img src="<?php echo $user->profile_pic == 'dummy_image.png' ? base_url()."resources/uploads/profiles/".$user->profile_pic : $user->profile_pic ;?>" class="attachment-80x80 size-80x80" alt="" decoding="async" title="" style="height: 70px; width: 80px;">        </a> -->
          <!-- </div>
                </div> -->
            <!-- <h4 class="author-name">
                <a class="author-link" href="#">
                     <?php echo $user->name;?>                  
                </a>
             </h4> -->
        <!-- </div> -->
                    <ul class="info-list">
                                  <?php if($json->address != ""){?>
                                    <li>
                        <svg width="14" height="16" viewbox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.62225 6.83378C4.62225 5.42809 5.7614 4.28894 7.16709 4.28894C8.57215 4.28894 9.71114 5.42825 9.71114 6.83378C9.71114 8.23868 8.572 9.37783 7.16709 9.37783C5.76156 9.37783 4.62225 8.23884 4.62225 6.83378ZM7.16709 5.48894C6.42414 5.48894 5.82225 6.09083 5.82225 6.83378C5.82225 7.57578 6.42398 8.17783 7.16709 8.17783C7.90925 8.17783 8.51114 7.57594 8.51114 6.83378C8.51114 6.09067 7.9091 5.48894 7.16709 5.48894Z" fill="#FF3C48"></path>
    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.16596 1.59999C4.28028 1.59999 1.933 3.96056 1.933 6.88255C1.933 8.7379 3.04199 10.6278 4.34853 12.0989C4.99287 12.8244 5.6623 13.4216 6.21812 13.8328C6.4967 14.0389 6.73773 14.1915 6.9255 14.2896C7.06206 14.3609 7.13847 14.3862 7.16596 14.3951C7.19345 14.3862 7.26987 14.3609 7.40647 14.2896C7.59426 14.1915 7.83532 14.0388 8.11393 13.8328C8.66983 13.4216 9.33935 12.8244 9.98379 12.0989C11.2905 10.6278 12.3997 8.73787 12.3997 6.88255C12.3997 3.96067 10.0517 1.59999 7.16596 1.59999ZM0.733002 6.88255C0.733002 3.30752 3.60788 0.399994 7.16596 0.399994C10.7239 0.399994 13.5997 3.30742 13.5997 6.88255C13.5997 9.17675 12.258 11.3455 10.8809 12.8958C10.1835 13.681 9.45283 14.3351 8.82751 14.7976C8.51552 15.0283 8.22071 15.2181 7.96204 15.3532C7.7325 15.4731 7.44058 15.6 7.16596 15.6C6.89132 15.6 6.59941 15.4731 6.36989 15.3532C6.11123 15.2181 5.81645 15.0283 5.50449 14.7975C4.87924 14.335 4.14869 13.681 3.45132 12.8958C2.07442 11.3455 0.733002 9.17671 0.733002 6.88255Z" fill="#FF3C48"></path>
    </svg>                          <?php echo $json->address; ?>                    </li>
<?php } ?>
<?php if($json->contact_number != ""){?>
                                             <li>
                  <a class="rtcl-phone-link" href="tel:<?php echo $json->contact_number; ?>" target="_blank">
                        <svg width="16" height="16" viewbox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M14.6468 12.22C14.6468 12.46 14.5935 12.7067 14.4802 12.9467C14.3668 13.1867 14.2202 13.4133 14.0268 13.6267C13.7002 13.9867 13.3402 14.2467 12.9335 14.4133C12.5335 14.58 12.1002 14.6667 11.6335 14.6667C10.9535 14.6667 10.2268 14.5067 9.46016 14.18C8.6935 13.8533 7.92683 13.4133 7.16683 12.86C6.40016 12.3 5.6735 11.68 4.98016 10.9933C4.2935 10.3 3.6735 9.57334 3.12016 8.81334C2.5735 8.05334 2.1335 7.29334 1.8135 6.54001C1.4935 5.78001 1.3335 5.05334 1.3335 4.36001C1.3335 3.90668 1.4135 3.47334 1.5735 3.07334C1.7335 2.66668 1.98683 2.29334 2.34016 1.96001C2.76683 1.54001 3.2335 1.33334 3.72683 1.33334C3.9135 1.33334 4.10016 1.37334 4.26683 1.45334C4.44016 1.53334 4.5935 1.65334 4.7135 1.82668L6.26016 4.00668C6.38016 4.17334 6.46683 4.32668 6.52683 4.47334C6.58683 4.61334 6.62016 4.75334 6.62016 4.88001C6.62016 5.04001 6.5735 5.20001 6.48016 5.35334C6.3935 5.50668 6.26683 5.66668 6.10683 5.82668L5.60016 6.35334C5.52683 6.42668 5.4935 6.51334 5.4935 6.62001C5.4935 6.67334 5.50016 6.72001 5.5135 6.77334C5.5335 6.82668 5.5535 6.86668 5.56683 6.90668C5.68683 7.12668 5.8935 7.41334 6.18683 7.76001C6.48683 8.10668 6.80683 8.46001 7.1535 8.81334C7.5135 9.16668 7.86016 9.49334 8.2135 9.79334C8.56016 10.0867 8.84683 10.2867 9.0735 10.4067C9.10683 10.42 9.14683 10.44 9.1935 10.46C9.24683 10.48 9.30016 10.4867 9.36016 10.4867C9.4735 10.4867 9.56016 10.4467 9.6335 10.3733L10.1402 9.87334C10.3068 9.70668 10.4668 9.58001 10.6202 9.50001C10.7735 9.40668 10.9268 9.36001 11.0935 9.36001C11.2202 9.36001 11.3535 9.38668 11.5002 9.44668C11.6468 9.50668 11.8002 9.59334 11.9668 9.70668L14.1735 11.2733C14.3468 11.3933 14.4668 11.5333 14.5402 11.7C14.6068 11.8667 14.6468 12.0333 14.6468 12.22Z" stroke="#FF3C48" stroke-width="1.2" stroke-miterlimit="10"></path>
    </svg>                          <?php echo $json->contact_number; ?>                     </a>
             </li>
    <?php } ?>    
    
    
          
              
        </ul>


        <?php if($row->uID != user_info()->id) { ?>
            <a href="<?php echo base_url().'chat/'.$row->id.'?slug='. $row->slug;?>" class="ff-btn ff-btn-submit ff-btn-md item-btn wd100 custom_link custom_button_ticket">Chat Now</a>
        <?php } ?>

        </div>
</div>


</div>
    <?php if(!empty($images_gallery)){?>
        <div class="listingDetails-block mb-30">
             <div class="listingDetails-block__header">
                <h3 class="listingDetails-block__heading">Gallery</h3>
            </div>
            <div class="page-header" style="background: #fff;">
                      <!-- Listing Banner Area Start Here -->
                    <section class="single-listing-carousel-wrap ">
                            <div class=" slick-navigation-layout2">
                                <div class="rtcl-related-slider rtcl-carousel-slider" id="rtcl-related-slider-banner" data-options="{&quot;allowSlideNext&quot;:true,&quot;allowSlidePrev&quot;:true,&quot;navigation&quot;:{&quot;nextEl&quot;:&quot;.swiper-button-next&quot;,&quot;prevEl&quot;:&quot;.swiper-button-prev&quot;},&quot;loop&quot;:false,&quot;autoplay&quot;:{&quot;delay&quot;:3000,&quot;disableOnInteraction&quot;:false,&quot;pauseOnMouseEnter&quot;:true},&quot;speed&quot;:1000,&quot;spaceBetween&quot;:10,&quot;breakpoints&quot;:{&quot;0&quot;:{&quot;slidesPerView&quot;:1},&quot;576&quot;:{&quot;slidesPerView&quot;:1},&quot;800&quot;:{&quot;slidesPerView&quot;:1},&quot;1200&quot;:{&quot;slidesPerView&quot;:4}}}">
                                    <div class="swiper-wrapper">
                                         <?php foreach($images_gallery as $ki => $img){?>
                                            <div class="swiper-slide nav-item" style="height: auto;" >
                                                <a data-lightbox="iabc-<?php echo $ki;?>" href="<?php echo $img->image;?>" >
                                                    <img src="<?php echo $img->image;?>" class="attachment-listygo-size-4 size-listygo-size-4" alt="" decoding="async" title="" style="object-fit: cover; height:170px"> 
                                                </a>
                                            </div>
                                        <?php } ?>                               
                                                                                   
                                                                                   
                                     </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                </section>
        </div>
        </div>
    <?php } ?>

<div class="listingDetails-block mb-30">
    <div class="listingDetails-block__header">
        <h3 class="listingDetails-block__heading">Description</h3>
    </div>
    <div class="listingDetails-block__des">
        <div class="listingDetails-block__des__text custom_description_text">
            <?php echo $json->description; ?>
        </div>
    </div>
</div>

<?php

function addAnchorTags($text) {
    // Define a regular expression pattern to match links
    $pattern = '/(https?:\/\/\S+)/';
    
    // Use preg_replace_callback to replace links with anchor tags
    $text_with_links = preg_replace_callback($pattern, function($matches) {
        $url = $matches[0];
        return '<a href="' . $url . '" target="_blank">' . $url . '</a>';
    }, $text);
    
    return $text_with_links;
}

 ?>

<div class="listingDetails-block mb-30">
    <div class="listingDetails-block__header">
        <h3 class="listingDetails-block__heading">Additional Details</h3>
    </div>
    <div class="listingDetails-block__des">
        <div class="listingDetails-block__des__text custom_description_text">
            <table class="classifed_table_json">
                <?php
                    $not_show = array("is_coupon_apply","is_free_plan","description", "file", "subcategory", "category", "title", "video_link", "plan", "show_on_banners", "plan_amount", "sub_plan_amount", "stripeToken", "latitude", "longitude", "file_gallery", "banner_type");
                    foreach($json as $jk=>$jrow){
                        if (!in_array($jk, $not_show) && $jrow != "") {
                    ?>
                    <tr>
                        <th style="text-transform: capitalize;"><?php echo str_replace("_"," ",$jk);?></th>
                        <td>
                            <?php 
                                if($jk == "event_type" || $jk == "refundable_policy"){
                                    echo $jrow == 1 ? "Yes":"No"; 
                                } 
                                else {
                                    if(is_array($jrow)){
                                        foreach($jrow as $jjj=>$jii){
                                            echo '<span class="pillss">'.$jii."</span>";
                                        }
                                    } else {
                                        if($jk == "event_tags" || $jk == "service_tags" || $jk == "training_courses"){
                                            $tags = explode(",", $jrow);
                                            foreach($tags as $jjj=>$jii){
                                                $l_tag = base_url()."tags/".strtolower(trim($jii));
                                                echo '<a href="'.$l_tag.'" class="pillss">'.$jii."</a>";
                                            }
                                        } else {
                                            if($jk=="event_start_time" || $jk=="event_end_time" || $jk == "open_start_time" || $jk == "open_house_end_time"|| $jk=="event_time"){
                                                echo date("h:i A", strtotime($jrow));
                                            } else {
                                                echo addAnchorTags($jrow);
                                            }
                                            
                                        }
                                    }
                                }
                            ?>
                        </td>
                    </tr>
                <?php 
                        }
                    } 
                ?>
            </table>
        </div>
    </div>
</div>

<div class="listingDetails-block mb-30">
    <div class="listingDetails-block__header">
        <h3 class="listingDetails-block__heading">Terms & Privacy</h3>
    </div>
    <div class="listingDetails-block__des">
        <div class="listingDetails-block__des__text custom_description_text custom_terms" style="padding-top: 0px;">
                <a href="<?php echo base_url();?>pages/refunds-policy" target="_blank">
                    Refunds Policy
                </a>
             | 

                <a href="<?php echo base_url();?>pages/terms-conditions" target="_blank">
                    Website Terms of Use
                </a>
             | 
                <a href="<?php echo base_url();?>pages/privacy-policy" target="_blank">
                    Privacy policy
                </a>
            | 
                <a href="<?php echo base_url();?>pages/sales-terms" target="_blank">
                    Sales terms
                </a>
             
        </div>
    </div>
</div>
                    

<!-- Food Menu -->
    <?php 
        if($json->video_link != ""){
            $url = explode("v=", $json->video_link);
    ?>
        <div class="listingDetails-block mb-30">
            <div class="listingDetails-block__header">
                <h3 class="listingDetails-block__heading mb-30">Video</h3>
            </div>
            <div class="video-info ratio-16x9">
                <iframe class="rtcl-lightbox-iframe" src="https://www.youtube.com/embed/<?php echo $url[1];?>?feature=oembed"></iframe>
            </div>
        </div>
    <?php } ?>

    <div class="listingDetails-block">
    <div class="listingDetails-block__header">
        <h3 class="listingDetails-block__heading mb-30">Rating</h3>
    </div>
    <div class="listingDetails-block__rating listingDetails-block__rating--style2">
          
<div class="rtrs-review-wrap  rtrs-review-post-type-rtcl_listing rtrs-review-sc-198" id="comments">
     
<?php 
    $reviews = $this->db->query("SELECT * FROM order_reviews WHERE order_id = ".$row->id." ORDER BY id DESC")->result_object(); 
?>
<div class="rtrs-summary-3 rtrs-summary-4-by-user">
    <div class="rtrs-rating-summary">
        <div class="rtrs-rating-item grid-span-2"> 
            <ul class="rtrs-rating-category">
                     
                    <li> 
                        <div class="rating-icon">
                            <i class="rtrs-star"></i><i class="rtrs-star"></i><i class="rtrs-star"></i><i class="rtrs-star"></i><i class="rtrs-star"></i> 
                        </div>
                        
                        <div class="rtrs-progress-wrap">
                            <div class="rtrs-progress"> 
                                                                <progress class="rtrs-progress-bar starting-preogress" value="<?php echo do_get_review_count(5, $row->id); ?>" max="100"></progress> 
                            </div> 
                        </div>

                        <div class="rating-number-user">
                            <span class="total-number"><?php echo do_get_review_count(5, $row->id); ?></span> 
                        </div>
                    </li>
                     
                    <li> 
                        <div class="rating-icon">
                            <i class="rtrs-star"></i><i class="rtrs-star"></i><i class="rtrs-star"></i><i class="rtrs-star"></i><i class="rtrs-star-empty"></i> 
                        </div>
                        
                        <div class="rtrs-progress-wrap">
                            <div class="rtrs-progress"> 
                                                                <progress class="rtrs-progress-bar starting-preogress" value="<?php echo do_get_review_count(4, $row->id); ?>" max="100"></progress> 
                            </div> 
                        </div>

                        <div class="rating-number-user">
                            <span class="total-number"><?php echo do_get_review_count(4, $row->id); ?></span> 
                        </div>
                    </li>
                     
                    <li> 
                        <div class="rating-icon">
                            <i class="rtrs-star"></i><i class="rtrs-star"></i><i class="rtrs-star"></i><i class="rtrs-star-empty"></i><i class="rtrs-star-empty"></i> 
                        </div>
                        
                        <div class="rtrs-progress-wrap">
                            <div class="rtrs-progress"> 
                                                                <progress class="rtrs-progress-bar starting-preogress" value="<?php echo do_get_review_count(3, $row->id); ?>" max="100"></progress> 
                            </div> 
                        </div>

                        <div class="rating-number-user">
                            <span class="total-number"><?php echo do_get_review_count(3, $row->id); ?></span> 
                        </div>
                    </li>
                     
                    <li> 
                        <div class="rating-icon">
                            <i class="rtrs-star"></i><i class="rtrs-star"></i><i class="rtrs-star-empty"></i><i class="rtrs-star-empty"></i><i class="rtrs-star-empty"></i> 
                        </div>
                        
                        <div class="rtrs-progress-wrap">
                            <div class="rtrs-progress"> 
                                                                <progress class="rtrs-progress-bar starting-preogress" value="<?php echo do_get_review_count(2, $row->id); ?>" max="100"></progress> 
                            </div> 
                        </div>

                        <div class="rating-number-user">
                            <span class="total-number"><?php echo do_get_review_count(2, $row->id); ?></span> 
                        </div>
                    </li>
                     
                    <li> 
                        <div class="rating-icon">
                            <i class="rtrs-star"></i><i class="rtrs-star-empty"></i><i class="rtrs-star-empty"></i><i class="rtrs-star-empty"></i><i class="rtrs-star-empty"></i> 
                        </div>
                        
                        <div class="rtrs-progress-wrap">
                            <div class="rtrs-progress"> 
                                                                <progress class="rtrs-progress-bar starting-preogress" value="<?php echo do_get_review_count(1, $row->id); ?>" max="100"></progress> 
                            </div> 
                        </div>

                        <div class="rating-number-user">
                            <span class="total-number"><?php echo do_get_review_count(1, $row->id); ?></span> 
                        </div>
                    </li>
                 
            </ul>
        </div> 

        <?php 
        $query = "SELECT SUM(rating) / COUNT(*) as average_rating FROM order_reviews WHERE order_id = ".$row->id;
        $overall_Rating = $this->db->query($query)->result_object()[0];
        $round_rating = round($overall_Rating->average_rating);

        ?>
        
                <div class="rtrs-rating-item">
            <div class="rtrs-rating-overall">
                <div class="rating-percent" style="margin-bottom: 10px;"><?php echo $overall_Rating->average_rating==0?0:number_format($overall_Rating->average_rating,1);?><span class="rtrs-out-of">/5</span></div>
                <div class="rating-text">OVERALL</div>
                <div class="rating-icon">
                    <?php for($i=1;$i<=$round_rating;$i++){?>
                        <i class="rtrs-star"></i>
                    <?php } ?>
                    <?php for($i=1;$i<=(5-$round_rating);$i++){?>
                    <i class="rtrs-star-empty"></i>
                    <?php } ?>
                   </div>
                <p>
                    Based on <?php echo count($reviews); ?> rating                </p>
            </div>
        </div>
         
    </div>
</div>
                <div class="" style="margin-top:20px">
            <h3 class="rtrs-sorting-title"> 
               <?php echo count($reviews);?> Reviews          
            </h3>
            
        </div>
        
        <?php if(!empty($reviews)){?>
            <div class="rtrs-review-box">
                <ul class="rtrs-review-list"> 
                    <?php 
                        foreach($reviews as $rk => $rev){
                           

                            $total_stars = 5;
                            $star_fill = ($rev->rating);
                            $star_remaining = ($total_stars - $star_fill);
                            $ureview = $this->db->query("SELECT * FROM users WHERE id = ".$rev->user_id)->result_object()[0];
                            $image_append = base_url()."resources/uploads/profiles/";
            
                            if($ureview->profile_pic == "dummy_image.png"){
                                $image_user = $image_append."dummy_image.png";
                            }else{
                                $image_user = $ureview->profile_pic;
                            }
                    
                    ?>
                        <li class="review even thread-even depth-1  rtrs-main-review" id="div-comment-12"> 
                            <div class="rtrs-each-review  "> 
                                    <div class="rtrs-review-imgholder">
                                        <img src="<?php echo $image_user;?>" alt="" class="image_64">    
                                    </div> 
                                    <div class="rtrs-review-body"> 
                                        <ul class="rtrs-review-meta">  
                                            <li class="rtrs-review-rating">
                                                <?php for($i=1;$i<=$star_fill;$i++){?>
                                                    <i class="rtrs-star"></i>
                                                <?php } ?>
                                                <?php for($i=1;$i<=$star_remaining;$i++){?>
                                                <i class="rtrs-star-empty"></i>
                                                <?php } ?>
                                            </li>
                                                <li class="rtrs-author-link">by: 
                                                   <?php echo $ureview->name;?>
                                                </li>
                                                <li class="rtrs-review-date"><i class="rtrs-calendar"></i> 
                                                   <?php echo time_elapsed_string_header($rev->created_at);?>       
                                                </li>
                                        </ul>
                                        <h4 class="rtrs-review-title"><?php echo $rev->title;?></h4>
                                        <p>
                                            <?php echo $rev->review;?>
                                        </p>
                                        <div class="rtrs-action-area">
                                        </div>
                                    </div>
                            </div>   
                        </li><!-- #comment-## -->      
                    <?php } ?>
                </ul>
            </div> 
        <?php } ?>

        <?php
             $checkUserReview = $this->db->where('user_id', user_info()->id)->where('order_id', $row->id)->get('order_reviews')->num_rows();
        ?>  

    <?php if($row->uID  != user_info()->id){ ?>
        <?php if($checkUserReview == 0){ ?>
        <div id="respond" class="comment-respond rtrs-review-form">
           <h2 id="reply-title" class="rtrs-form-title">Leave Feedback</h2>
           <?php 
        //    if(isset($_SESSION['LISTYLOGIN'])){
            ?>
           <form action="<?php echo base_url();?>nepstate/do_submit_review" method="post" id="comment_form" class="rtrs-form-box">
              <div class="rtrs-form-group rtrs-hide-reply"><input id="rt_title" required class="rtrs-form-control" placeholder="Title" name="rt_title" type="text" value="" size="30"></div>
              <div class="rtrs-form-group"><textarea id="message" class="rtrs-form-control" required placeholder="Write your review* " name="comment" required="required" rows="6" cols="45"></textarea></div>
              <input type="hidden" id="gRecaptchaResponse" name="gRecaptchaResponse" value="">
              <div class="rtrs-form-group rtrs-hide-reply">
                 <ul class="rtrs-rating-category" style="">
                    <li>
                       <div class="rtrs-category-text">Rating</div>
                       <div class="rtrs-rating-container">
                          <input type="radio" id="rt-rating-5" name="rt_rating" value="5"><label for="rt-rating-5">5</label>
                          <input type="radio" id="rt-rating-4" name="rt_rating" value="4"><label for="rt-rating-4">4</label>
                          <input checked=""  type="radio" id="rt-rating-3" name="rt_rating" value="3"><label for="rt-rating-3">3</label>
                          <input type="radio" id="rt-rating-2" name="rt_rating" value="2"><label for="rt-rating-2">2</label>
                          <input type="radio" id="rt-rating-1" name="rt_rating" value="1"><label for="rt-rating-1">1</label>
                       </div>
                    </li>
                 </ul>
              </div>
              <div class="rtrs-form-group rtrs-hide-reply">
                 <div class="rtrs-preview-imgs"></div>
              </div>
              <div class="rtrs-form-group">
                <input name="submit" type="submit" id="submit" class="rtrs-submit-btn rtrs-review-submit" value="Submit Review"> 
                <input type="hidden" name="post_id" value="<?php echo $row->id;?>" id="post_id">
              </div>
           </form>
       <?php
    //  } else {
         ?>
            <!-- <div class="text-center">
                Please login to post a review!
            </div> -->
       <?php
    //  }
      ?>
        </div>

        <?php } } ?>
        <!-- #respond -->
                            
            
          
    <script>
        jQuery( document ).ready(function($) {
            $('#comment_form').removeAttr('novalidate');
        });
    </script>
</div> 
    </div>
</div>


<div class="modal fade rtcl-bs-modal" id="rtcl-report-abuse-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="rtcl-report-abuse-form" class="form-vertical">
                <div class="modal-header">
                    <h5 class="modal-title" id="rtcl-report-abuse-modal-label">Report Abuse</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="<?php echo $assets;?>assets/images/cross.svg" alt="Cross"></span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="rtcl-report-abuse-message">Your Complaint                            <span class="rtcl-star">*</span></label>
                        <textarea class="form-control" name="message" id="rtcl-report-abuse-message" rows="3" placeholder="Message... " required></textarea>
                    </div>
                    <div id="rtcl-report-abuse-g-recaptcha"></div>
                    <div id="rtcl-report-abuse-message-display"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
        </div>
                  
<!-- Seller / User Information -->
<div id="sticky_sidebar" class="col-lg-4 order-2">
    <div class="listing-sidebar">
        
        <?php if($json->ticket_link != ""){?>
            <a href="<?php echo $json->ticket_link;?>" target="_blank" class="wd100">
                <button class="ff-btn ff-btn-submit ff-btn-md item-btn wd100 custom_link custom_button_ticket">
                    Get your tickets here 
                </button>
            </a>
        <?php } ?>
        <?php /* ?>
    <div class="rtcl-listing-user-info chat-form">
        <div class="need-to-logedin">
            <a class="rtcl-chat-link rtcl-no-contact-seller" href="my-account.php" data-listing_id="7613">
                <i class="fa-brands fa-rocketchat"></i>
                Please login for Chat           </a>
        </div>
    </div>

    <div class="rtcl-listing-user-info contact-form">
        <div class="rtcl-do-email list-group-item">
            <div class="media">
                <span class="rtcl-icon rtcl-icon-mail"></span>
                <div class="media-body">
                    <a class="rtcl-do-email-link" href="#">
                        Message to Seller                   </a>
                </div>
            </div>
            <form id="rtcl-contact-form" class="form-vertical">
    <div class="form-group">
        <input type="text" name="name" class="form-control" id="rtcl-contact-name" placeholder="Name *" required>
    </div>
    <div class="form-group">
        <input type="email" name="email" class="form-control" id="rtcl-contact-email" placeholder="Email*" required>
    </div>
    <div class="form-group">
        <textarea class="form-control" name="message" id="rtcl-contact-message" rows="3" placeholder="Message*" required></textarea>
    </div>

    <div id="rtcl-contact-g-recaptcha"></div>
    <p id="rtcl-contact-message-display"></p>

    <button type="submit" class="btn btn-primary">Submit    </button>
</form>
        </div>
    </div>
<?php */ ?>
<?php if($json->latitude != "" && $json->longitude != ""){?>
 <figure class="listingDetails-map">
        <!-- Map -->
        <div class="product-map" id="map">
                <div class="embed-responsive embed-responsive-16by9 mt-3">
        <div class="rtcl-map embed-responsive-item" data-options="[]">
            <div class="marker" data-latitude="<?php echo $json->latitude; ?>" data-longitude="<?php echo $json->longitude; ?>" data-address="<?php echo $json->address; ?>">
                <?php echo $json->address; ?>
            </div>
        </div>
    </div>
        </div>
    </figure>
<?php } ?>

<div class="rtcl-listing-user-info">

            <div class="rtcl-listing-side-title">
            <h3>Contact Details</h3>
        </div>


        <div class="list-group">
                        <!-- <div class="listing-author"> -->
                <!-- <div class="author-logo-wrapper">
                          <div class="directory-block__poster__thumb">
              <a class="directory-block__poster__link--image">
           <img src="<?php echo $user->profile_pic == 'dummy_image.png' ? base_url()."resources/uploads/profiles/".$user->profile_pic : $user->profile_pic;?>" class="attachment-80x80 size-80x80" alt="" decoding="async" title="" style="height: 70px; width: 80px;">        </a> -->
              <!-- </div> -->
                    <!-- </div> -->
                <!-- <h4 class="author-name">
                            <a class="author-link" href="#">
                                 <?php echo $user->name;?>                      
                             </a>
                            
                 </h4> -->
            <!-- </div> -->
                        <ul class="info-list">
                            <?php if($json->address != ""){?>
                                      <li>
                            <svg width="14" height="16" viewbox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.62225 6.83378C4.62225 5.42809 5.7614 4.28894 7.16709 4.28894C8.57215 4.28894 9.71114 5.42825 9.71114 6.83378C9.71114 8.23868 8.572 9.37783 7.16709 9.37783C5.76156 9.37783 4.62225 8.23884 4.62225 6.83378ZM7.16709 5.48894C6.42414 5.48894 5.82225 6.09083 5.82225 6.83378C5.82225 7.57578 6.42398 8.17783 7.16709 8.17783C7.90925 8.17783 8.51114 7.57594 8.51114 6.83378C8.51114 6.09067 7.9091 5.48894 7.16709 5.48894Z" fill="#FF3C48"></path>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.16596 1.59999C4.28028 1.59999 1.933 3.96056 1.933 6.88255C1.933 8.7379 3.04199 10.6278 4.34853 12.0989C4.99287 12.8244 5.6623 13.4216 6.21812 13.8328C6.4967 14.0389 6.73773 14.1915 6.9255 14.2896C7.06206 14.3609 7.13847 14.3862 7.16596 14.3951C7.19345 14.3862 7.26987 14.3609 7.40647 14.2896C7.59426 14.1915 7.83532 14.0388 8.11393 13.8328C8.66983 13.4216 9.33935 12.8244 9.98379 12.0989C11.2905 10.6278 12.3997 8.73787 12.3997 6.88255C12.3997 3.96067 10.0517 1.59999 7.16596 1.59999ZM0.733002 6.88255C0.733002 3.30752 3.60788 0.399994 7.16596 0.399994C10.7239 0.399994 13.5997 3.30742 13.5997 6.88255C13.5997 9.17675 12.258 11.3455 10.8809 12.8958C10.1835 13.681 9.45283 14.3351 8.82751 14.7976C8.51552 15.0283 8.22071 15.2181 7.96204 15.3532C7.7325 15.4731 7.44058 15.6 7.16596 15.6C6.89132 15.6 6.59941 15.4731 6.36989 15.3532C6.11123 15.2181 5.81645 15.0283 5.50449 14.7975C4.87924 14.335 4.14869 13.681 3.45132 12.8958C2.07442 11.3455 0.733002 9.17671 0.733002 6.88255Z" fill="#FF3C48"></path>
        </svg>                          <?php echo $json->address;?>                     </li>
    <?php } ?>
    <?php if($json->contact_number != ""){?>
        <li>
                      <a class="rtcl-phone-link" href="tel:<?php echo $json->contact_number;?>" target="_blank">
                            <svg width="16" height="16" viewbox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M14.6468 12.22C14.6468 12.46 14.5935 12.7067 14.4802 12.9467C14.3668 13.1867 14.2202 13.4133 14.0268 13.6267C13.7002 13.9867 13.3402 14.2467 12.9335 14.4133C12.5335 14.58 12.1002 14.6667 11.6335 14.6667C10.9535 14.6667 10.2268 14.5067 9.46016 14.18C8.6935 13.8533 7.92683 13.4133 7.16683 12.86C6.40016 12.3 5.6735 11.68 4.98016 10.9933C4.2935 10.3 3.6735 9.57334 3.12016 8.81334C2.5735 8.05334 2.1335 7.29334 1.8135 6.54001C1.4935 5.78001 1.3335 5.05334 1.3335 4.36001C1.3335 3.90668 1.4135 3.47334 1.5735 3.07334C1.7335 2.66668 1.98683 2.29334 2.34016 1.96001C2.76683 1.54001 3.2335 1.33334 3.72683 1.33334C3.9135 1.33334 4.10016 1.37334 4.26683 1.45334C4.44016 1.53334 4.5935 1.65334 4.7135 1.82668L6.26016 4.00668C6.38016 4.17334 6.46683 4.32668 6.52683 4.47334C6.58683 4.61334 6.62016 4.75334 6.62016 4.88001C6.62016 5.04001 6.5735 5.20001 6.48016 5.35334C6.3935 5.50668 6.26683 5.66668 6.10683 5.82668L5.60016 6.35334C5.52683 6.42668 5.4935 6.51334 5.4935 6.62001C5.4935 6.67334 5.50016 6.72001 5.5135 6.77334C5.5335 6.82668 5.5535 6.86668 5.56683 6.90668C5.68683 7.12668 5.8935 7.41334 6.18683 7.76001C6.48683 8.10668 6.80683 8.46001 7.1535 8.81334C7.5135 9.16668 7.86016 9.49334 8.2135 9.79334C8.56016 10.0867 8.84683 10.2867 9.0735 10.4067C9.10683 10.42 9.14683 10.44 9.1935 10.46C9.24683 10.48 9.30016 10.4867 9.36016 10.4867C9.4735 10.4867 9.56016 10.4467 9.6335 10.3733L10.1402 9.87334C10.3068 9.70668 10.4668 9.58001 10.6202 9.50001C10.7735 9.40668 10.9268 9.36001 11.0935 9.36001C11.2202 9.36001 11.3535 9.38668 11.5002 9.44668C11.6468 9.50668 11.8002 9.59334 11.9668 9.70668L14.1735 11.2733C14.3468 11.3933 14.4668 11.5333 14.5402 11.7C14.6068 11.8667 14.6468 12.0333 14.6468 12.22Z" stroke="#FF3C48" stroke-width="1.2" stroke-miterlimit="10"></path>
        </svg>                          <?php echo $json->contact_number;?>                     </a>
                 </li>
             <?php } ?>
                                              
            </ul>

            <?php if($row->uID != user_info()->id) { ?>
                 <a href="<?php echo base_url().'chat/'.$row->id.'?slug='. $row->slug.'';?>" class="ff-btn ff-btn-submit ff-btn-md item-btn wd100 custom_link custom_button_ticket">Chat Now</a>
            <?php } ?>
            <?php /* ?>
            <div class="rtcl-social-profile-wrap">
                <div class="rtcl-social-profile-label">
                Follow Us On:            </div>
                <div class="rtcl-social-profiles">
                        <a href="https://example.com/" class="icon-facebook" target="_blank" title="Facebook"><i class="rtcl-icon rtcl-icon-facebook"></i></a>
                                <a href="https://example.com/" class="icon-twitter" target="_blank" title="Twitter"><i class="rtcl-icon rtcl-icon-twitter"></i></a>
                                <a href="https://example.com/" class="icon-instagram" target="_blank" title="Instagram"><i class="rtcl-icon rtcl-icon-instagram"></i></a>
                    </div>
</div>      
<?php */?>
</div>

    </div>


    <?php 
        $expireCondition = 'AND expiry_date > CURRENT_DATE';
        $similar = $this->db->query("SELECT * FROM products WHERE category = '".$row->category."' ".$country_city_ConditionQuery_classified." ".$expireCondition." ORDER BY RAND() LIMIT 4")->result_object();
        if(!empty($similar)){
    ?>
        <div class="rtcl-listing-user-info sidebar-widget widget widget_listygo_post widget-recent">
            <div class="rtcl-listing-side-title">
                <h3>Similar Services</h3>
            </div>

            <ul class="recent-post">
                <?php 
                    foreach($similar as $k=>$srow){
                        $images = $this->db->query("SELECT * FROM product_images WHERE product_id = ".$srow->id)->result_object();
                ?>
                    <li class="media" style="display: flex !important;">
                        <div class="item-img">
                                <a href="<?php echo base_url();?>classified/detail/<?php echo $srow->slug;?>" class="item-figure">
                                    <img src="<?php echo $images[0]->image;?>" class="attachment-thumbnail size-thumbnail wp-post-image" alt="" decoding="async" title="">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="item-title"><a href="<?php echo base_url();?>classified/detail/<?php echo $srow->slug;?>"><?php echo $srow->title;?></a></h4>
                            <span>
                                <img src="<?php echo $assets;?>assets/images/icon-calendar.png" alt="Calendar">
                                <?php echo date("F d, Y", strtotime($srow->created_at));?>
                            </span>
                        </div>
                    </li>
                <?php } ?>
                                               
            </ul>
        </div>
    <?php } ?>

            <aside class="sidebar-widget">
                <?php 
                  $get_blog_sidebar = $this->db->query("SELECT * FROM products_ads WHERE ad_for = 'cat_right' ".$country_ConditionQuery." AND ad_location = 'right_banner' AND category = '".$category->slug."' AND status = 1 ORDER BY id DESC LIMIT 1")->result_object()[0]; 
                  // echo $this->db->last_query();
                     if($get_blog_sidebar->link==""){
                        $link_to_display = $get_blog_sidebar->image;
                     } else {
                        $link_to_display = $get_blog_sidebar->link;
                     }
               ?>
               <?php if(!empty($get_blog_sidebar)){?>
                <div id="media_image-5" class="p0 sidebar-add-img widget widget_media_image sidebar-widget" style="background:transparent;">
                    <a href="<?php echo $link_to_display;?>" data-lightbox="image-<?php echo $k;?>" target="_blank">
                        <div class="">
                            <b style="margin-bottom: 10px; float: left; color: #2a2a2a;">Sponsored Ad</b>
                        <img width="320" height="420" src="<?php echo $get_blog_sidebar->image;?>" class="image wp-image-3499  attachment-medium size-medium" alt="" decoding="async" style="max-width: 100%; height: auto;" srcset="<?php echo $get_blog_sidebar->image;?> 320w, <?php echo $get_blog_sidebar->image;?> 350w" sizes="(max-width: 320px) 100vw, 320px" title="">
                       
                    </div>
                    </a>
                </div>   
                <?php } else { ?>
                    <div id="media_image-4" class="p0 sidebar-add-img widget widget_media_image sidebar-widget">
                      <a href="<?php echo base_url();?>promote" class="ad_right_box">
                           <p>
                               Promote Your Business <br>Post your Ad Here (Ad # 5)
                           </p>
                           <span>Click Me!</span>
                       </a>
                    </div>
                <?php } ?> 
                 <div class="google_ad" id="dummy-ad">
                  <div class="ad_inner">
                     
                     <span>Google Ad</span><br>
                     <span> 350x400</span>
                  </div>
               </div>        
            </aside>
        
    </div>
</div>
              </div>
    </div>
        
</div>        </div>
      </div>
    </div>
      </div>
</section>
<!-- listing Details End -->   
</div>

</main></div>
</div>

<?php include("common/footer.php"); ?>