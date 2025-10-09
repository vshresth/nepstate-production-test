<?php 
// SEO Variables for Home Page
$page_title = "NepState - Connecting Nepalese Globally | Business Directory & Community";
$meta_description = "Join NepState, the largest Nepalese business directory worldwide. Find restaurants, jobs, events, and connect with the Nepalese diaspora. Discover authentic Nepali businesses near you.";
$meta_keywords = "Nepalese business directory, Nepal community, Nepali restaurants, jobs Nepal, events Nepal, diaspora connections, business listings Nepal";
$canonical_url = base_url();
include("common/header.php"); 
?>
<style>
   .bg-slider {
   background: #fff;
   }
   .advetise_button {
   }
</style>
<div data-elementor-type="wp-page" data-elementor-id="10" class="elementor elementor-10">
   <?php include("common/header_full.php"); ?>
</div>
<?php
   $url = 'https://keyvalue.hamropatro.com/kv/get/market_segment_gold::1690855810198';
   $jsonContent = file_get_contents($url);
   if ($jsonContent === false) {
       echo "Error fetching JSON content";
   } else {
       $data = json_decode($jsonContent, FALSE);
       if ($data === null) {
           echo "Error decoding JSON content";
       } else {
           $final_value = json_decode($data->list[0]->value, false);
       }
   }

   $today_dd = date("Y-m-d");
   $forex_url = 'https://www.nrb.org.np/api/forex/v1/rates?page=1&per_page=20&from='.$today_dd.'&to='.$today_dd.'';
   $jsonforex = file_get_contents($forex_url);
   $dataforex = json_decode($jsonforex, FALSE);
   $forex_display = $dataforex->data->payload[0]->rates;
   // echo "<pre>";
   // print_r($final_value);
   // echo "</pre>";
   
   ?>
<!-- Missing CSS file - commented out to prevent 404 errors -->
<!-- <link rel="stylesheet" href="<?php echo $uploads;?>elementor/css/post-1731.css?ver=<?php echo time();?>" media="all"> -->
<!-- Missing CSS file - commented out to prevent 404 errors -->
<!-- <link rel="stylesheet" href="<?php echo $uploads;?>elementor/css/post-2827.css?time=<?php echo time();?>" media="all"> -->
<div data-elementor-type="wp-page" data-elementor-id="7919" class="elementor elementor-7919">
   <!-- SILVER GOLD -->
   <div class="container">
      <div class="wrapper">
         <div class="forex_slider">
            <?php 
               $y = date('Y', time()); //Getting Year
               $m = date('m', time()); //Getting Month
               $d = date('d', time()); //Getting Day
               require('nepali/nepali-date.php');
               $date = new nepali_date;
               $date = $date->get_nepali_date($y, $m, $d);
               //echo $date['y'].'-'.$date['m'].'-'.$date['d'].'-'.$date['l']; //Printing Date
               ?>
            <div class="col-md-1 bg_white_forex" onclick="do_open_modal()" style="cursor:pointer; padding: 0;">
               <div class="year_column">
                  <?php echo $date['y'];?>
               </div>
               <div class="forex_date_below">
                  <small class="">
                  <?php echo $date['M']; ?>
                  </small>
                  <div class="date_forex">
                     <?php echo $date['d']; ?>
                  </div>
                  <small class="">
                  <?php echo $date['l']; ?>
                  </small>
               </div>
            </div>
            <div class="ca">
               <div class="accordian_1 active gold_accordian" onclick="do_show_option('gold_accordian')">
                  Gold/Silver
               </div>
               <div class="accordian_1 forex_accordia"  onclick="do_show_option('forex_accordia')">
                  Forex
               </div>
            </div>
            <div class="forex_details_wrap" id="gold_accordian">
               <?php 
                  foreach($final_value->items as $key=>$gold){ 
                  ?>
               <div class="gold_box">
                  <img src="<?php echo $assets;?><?php echo $gold->iconURL;?>">
                  <div class="gold_details">
                     <h4><?php echo $gold->name;?></h4>
                     <small><?php echo $gold->symbol=="HALMARK"?$gold->prices[1]->name:$gold->prices[0]->name;?></small>
                     <div class="price_gold">
                        <?php echo $gold->symbol=="HALMARK"?$gold->prices[1]->price->price:$gold->prices[0]->price->price;?>
                     </div>
                  </div>
               </div>
               <?php } ?>
            </div>
            <div class="forex_details_wrap" id="forexxx_accordian" style="display: none;">
               <table  class="forex_table">
                  <tr>
                     <th>Currency</th>
                     <th>Unit</th>
                     <th>Buy</th>
                     <th>Sell</th>
                  </tr>
                  <?php 
                     foreach($forex_display as $fkey=>$frow){
                     	$new_color = $fkey % 2 == 1?"#f0f0f0":"#fff";
                     ?>
                  <tr style="background: <?php echo $new_color;?>">
                     <td><?php echo $frow->currency->name;?></td>
                     <td><?php echo $frow->currency->unit;?></td>
                     <td><?php echo $frow->buy;?></td>
                     <td><?php echo $frow->sell;?></td>
                  </tr>
                  <?php } ?>
               </table>
            </div>
         </div>
      </div>
   </div>

   <!-- WHAT WE DO  -->
   <!-- WHAT WE DO ENDS -->
   <!-- WHAT WE DO__ LISTING> -->
   <?php //include("common/what_we_do.php"); ?>
   <!-- WHAT WE DO__ LISTING ENDS -->
   <div class="ad-container mt-50" id="dummy-ad">
   <?php include("common/google_ads_box.php"); ?>
   </div>
   <!-- EXPLORE_CITIES LISTING> -->
   <?php //include("common/explore_cities.php"); ?>
   <!-- EXPLORE_CITIES LISTING ENDS -->
   <!-- <LATEST LISTING> -->
   <?php //include("common/latest_listing.php"); ?>
   <!-- LATEST LISTING ENDS -->
   <!-- <div class="ad-container" id="dummy-ad">
      <img src="https://via.placeholder.com/1050x190" alt="Dummy Ad">
      </div> -->
   <!-- CATEGORIES -->
   <!-- CATEGORIES SLIDER -->
   <!-- CATEGORIES SLIDER ENDS -->
   <?php 
      $cat_array = $this->db->query("SELECT * FROM categories WHERE parent_id = 0 ORDER BY id ASC")->result_object();
      // $ii = 3;
      foreach($cat_array as $key=>$row){
      	$cat_data = $row;
      ?>
   <?php 
      include("common/listing_design.php");
    ?>
   <?php
      }
      ?>
   <?php //include("common/ads_boxes.php"); ?>
   <!-- BLOG POSTS -->
   <section class="elementor-section elementor-top-section elementor-element elementor-element-56139ed elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no" data-id="56139ed" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
      <div class="elementor-container elementor-column-gap-default">
         <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-1745bc2" data-id="1745bc2" data-element_type="column">
            <div class="elementor-widget-wrap elementor-element-populated">
               <div class="elementor-element elementor-element-18287cb elementor-align-center elementor-widget elementor-widget-rt-title" data-id="18287cb" data-element_type="widget" data-widget_type="rt-title.default">
                  <div class="elementor-widget-container">
                     <div class="section-heading">
                        <div class="heading-subtitle">Tips and Inspiration</div>
                        <h2 class="heading-title">Latest Blog Posts</h2>
                        <p>Dive into thought-provoking articles covering a variety of topics.</p>
                     </div>
                  </div>
               </div>
               <div class="elementor-element elementor-element-7ade98e elementor-widget elementor-widget-rt-post" data-id="7ade98e" data-element_type="widget" data-widget_type="rt-post.default">
                  <div class="elementor-widget-container">
                     <div class="row row-cols-lg-3 row-cols-sm-2 row-cols-1  elementor-addon justify-content-center">
                        <?php 
                           $listOfBlogs = $this->db->query("SELECT * FROM blogs WHERE status = 1 AND is_approved = 1 ".$blog_forum_confession_condition_query. " ORDER BY id DESC limit 3")->result_object();
                           
                           
                           foreach($listOfBlogs as $blog) {
                           		
                           $datetime = new DateTime($blog->created_at);
                           $date = $datetime->format('jS F Y');
                           $title = $blog->title;
                           $description = $blog->description;
                           $image = $blog->image;
                           $author = $blog->author;
                           
                           $blogCommentCount = $this->db->where('bID', $blog->id)->get('blog_comment')->num_rows();
                           
                           ?>
                        <div class="col">
                           <article style="" id="post-3732" class="blog-box-layout1 v3  post-3732 post type-post status-publish format-standard has-post-thumbnail hentry category-travel tag-cafe tag-travel have-post-thumb">
                              <div class="post-thumb">
                                 <a href="<?php echo base_url();?>blog/details/<?php echo $blog->slug;?>"><img style="height:250px;"  src="<?php echo $image;?>" class="attachment-rtcl-gallery size-rtcl-gallery wp-post-image" alt="" decoding="async" title=""></a>
                                 <div class="blog-block__date">
                                    <?php echo $date; ?>                   
                                 </div>
                              </div>
                              <div class="post-content">
                                 <h3 class="post-title"><a href="<?php echo base_url();?>blog/details/<?php echo $blog->slug;?>">
                                    
                                 <?php 
                                          echo (strlen($title) > 25) ? substr($title, 0, 25) . "..." : $title;
                                 ?>
                                 </a></h3>
                                 <div class="content">
                                    <p></p>
                                 </div>
                                 <ul class="entry-meta">
                                    <li class="entry-admin">
                                       <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M16.3125 9.375C16.3125 6.99375 14.3813 5.0625 12 5.0625C9.61875 5.0625 7.6875 6.99375 7.6875 9.375C7.6875 11.7563 9.61875 13.6875 12 13.6875C14.3813 13.6875 16.3125 11.7563 16.3125 9.375ZM8.8125 9.375C8.8125 7.6125 10.2375 6.1875 12 6.1875C13.7625 6.1875 15.1875 7.6125 15.1875 9.375C15.1875 11.1375 13.7625 12.5625 12 12.5625C10.2375 12.5625 8.8125 11.1375 8.8125 9.375Z" fill="#797979"></path>
                                          <path d="M4.78125 20.2875C4.875 20.3438 4.96875 20.3625 5.0625 20.3625C5.25 20.3625 5.45625 20.2688 5.55 20.0813C6.8625 17.7563 9.3375 16.3125 12 16.3125C14.6625 16.3125 17.1375 17.7563 18.4688 20.0813C18.6188 20.3438 18.975 20.4375 19.2375 20.2875C19.5 20.1375 19.5938 19.7813 19.4438 19.5188C17.925 16.8563 15.075 15.1875 12 15.1875C8.925 15.1875 6.075 16.8563 4.55625 19.5188C4.40625 19.7813 4.5 20.1375 4.78125 20.2875Z" fill="#797979"></path>
                                       </svg>
                                       <span>
                                       <span>by</span> 
                                       <a href="<?php echo base_url();?>blog/details/<?php echo $blog->slug;?>"><?php echo $author; ?></a>
                                       </span>
                                    </li>
                                    <li class="entry-admin">
                                       <span class="meta-icon">
                                          <svg width="22" height="20" viewbox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M0.5 0.75V12.75H3.5V16.5705L4.71875 15.5858L8.258 12.75H15.5V0.75H0.5ZM2 2.25H14V11.25H7.742L7.53125 11.4142L5 13.4295V11.25H2V2.25ZM17 3.75V5.25H20V14.25H17V16.4295L14.258 14.25H8.633L6.758 15.75H13.742L18.5 19.5705V15.75H21.5V3.75H17Z" fill="#797979"></path>
                                          </svg>
                                       </span>
                                       <?php echo $blogCommentCount;?>                 
                                    </li>
                                 </ul>
                              </div>
                           </article>
                        </div>
                        <?php }?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- BLOG POSTS ENDS -->
   <!-- ANY QUESTION -->
   <div class="elementor-10">
      <section class="elementor-section elementor-top-section elementor-element elementor-element-0acdee9 elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no elementor-invisible" data-id="0acdee9" data-element_type="section" data-settings="{&quot;animation&quot;:&quot;fadeInUp&quot;}">
         <div class="elementor-container elementor-column-gap-default">
            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-79c51f3" data-id="79c51f3" data-element_type="column">
               <div class="elementor-widget-wrap elementor-element-populated">
                <?php
                if( settings()->event == 1){?>
                  <section class="elementor-section elementor-inner-section elementor-element elementor-element-3bdcd10 elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no" data-id="3bdcd10" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                     <div class="elementor-background-overlay"></div>
                     <div class="elementor-container elementor-column-gap-default">
                        <div class="elementor-column elementor-col-70 elementor-inner-column elementor-element elementor-element-e96590a" data-id="e96590a" data-element_type="column">
                           <div class="elementor-widget-wrap elementor-element-populated">
                              <div class="elementor-element elementor-element-21f7e1d elementor-align-left elementor-align-center elementor-widget elementor-widget-rt-title" data-id="21f7e1d" data-element_type="widget" data-widget_type="rt-title.default">
                                 <div class="elementor-widget-container">
                                    <div class="section-heading">
                                       <h2 class="heading-title"><?php echo settings()->mainheading; ?></h2>
                                       <?php echo settings()->subheading; ?>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="elementor-column elementor-col-30 elementor-inner-column elementor-element elementor-element-d2bf900" data-id="d2bf900" data-element_type="column">
                           <div class="elementor-widget-wrap elementor-element-populated">
                              <div class="elementor-element elementor-element-a4a3a61 elementor-align-right elementor-align-center elementor-widget elementor-widget-rt-button" data-id="a4a3a61" data-element_type="widget" data-widget_type="rt-button.default">
                                 <div class="elementor-widget-container">
                                    <div class="btn-wrap btn-v2">
                                       <a href="<?php echo base_url();?>contact-us" class="item-btn">
                                          <span class="btn__icon">
                                             <svg width="20" height="20" viewbox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.25 10C1.25 12.3206 2.17187 14.5462 3.81282 16.1872C5.45376 17.8281 7.67936 18.75 10 18.75C12.3206 18.75 14.5462 17.8281 16.1872 16.1872C17.8281 14.5462 18.75 12.3206 18.75 10C18.75 7.67936 17.8281 5.45376 16.1872 3.81282C14.5462 2.17187 12.3206 1.25 10 1.25C7.67936 1.25 5.45376 2.17187 3.81282 3.81282C2.17187 5.45376 1.25 7.67936 1.25 10ZM20 10C20 12.6522 18.9464 15.1957 17.0711 17.0711C15.1957 18.9464 12.6522 20 10 20C7.34784 20 4.8043 18.9464 2.92893 17.0711C1.05357 15.1957 0 12.6522 0 10C0 7.34784 1.05357 4.8043 2.92893 2.92893C4.8043 1.05357 7.34784 0 10 0C12.6522 0 15.1957 1.05357 17.0711 2.92893C18.9464 4.8043 20 7.34784 20 10ZM5.625 9.375C5.45924 9.375 5.30027 9.44085 5.18306 9.55806C5.06585 9.67527 5 9.83424 5 10C5 10.1658 5.06585 10.3247 5.18306 10.4419C5.30027 10.5592 5.45924 10.625 5.625 10.625H12.8663L10.1825 13.3075C10.1244 13.3656 10.0783 13.4346 10.0468 13.5105C10.0154 13.5864 9.99921 13.6678 9.99921 13.75C9.99921 13.8322 10.0154 13.9136 10.0468 13.9895C10.0783 14.0654 10.1244 14.1344 10.1825 14.1925C10.2406 14.2506 10.3096 14.2967 10.3855 14.3282C10.4614 14.3596 10.5428 14.3758 10.625 14.3758C10.7072 14.3758 10.7886 14.3596 10.8645 14.3282C10.9404 14.2967 11.0094 14.2506 11.0675 14.1925L14.8175 10.4425C14.8757 10.3844 14.9219 10.3155 14.9534 10.2395C14.9849 10.1636 15.0011 10.0822 15.0011 10C15.0011 9.91779 14.9849 9.83639 14.9534 9.76046C14.9219 9.68453 14.8757 9.61556 14.8175 9.5575L11.0675 5.8075C11.0094 5.74939 10.9404 5.70329 10.8645 5.67185C10.7886 5.6404 10.7072 5.62421 10.625 5.62421C10.5428 5.62421 10.4614 5.6404 10.3855 5.67185C10.3096 5.70329 10.2406 5.74939 10.1825 5.8075C10.1244 5.86561 10.0783 5.9346 10.0468 6.01052C10.0154 6.08644 9.99921 6.16782 9.99921 6.25C9.99921 6.33218 10.0154 6.41356 10.0468 6.48948C10.0783 6.5654 10.1244 6.63439 10.1825 6.6925L12.8663 9.375H5.625Z" fill="white"></path>
                                             </svg>
                                          </span>
                                          <span class="btn__text">Contact Us</span>
                                          <span class="btn__icon">
                                             <svg width="20" height="20" viewbox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.25 10C1.25 12.3206 2.17187 14.5462 3.81282 16.1872C5.45376 17.8281 7.67936 18.75 10 18.75C12.3206 18.75 14.5462 17.8281 16.1872 16.1872C17.8281 14.5462 18.75 12.3206 18.75 10C18.75 7.67936 17.8281 5.45376 16.1872 3.81282C14.5462 2.17187 12.3206 1.25 10 1.25C7.67936 1.25 5.45376 2.17187 3.81282 3.81282C2.17187 5.45376 1.25 7.67936 1.25 10ZM20 10C20 12.6522 18.9464 15.1957 17.0711 17.0711C15.1957 18.9464 12.6522 20 10 20C7.34784 20 4.8043 18.9464 2.92893 17.0711C1.05357 15.1957 0 12.6522 0 10C0 7.34784 1.05357 4.8043 2.92893 2.92893C4.8043 1.05357 7.34784 0 10 0C12.6522 0 15.1957 1.05357 17.0711 2.92893C18.9464 4.8043 20 7.34784 20 10ZM5.625 9.375C5.45924 9.375 5.30027 9.44085 5.18306 9.55806C5.06585 9.67527 5 9.83424 5 10C5 10.1658 5.06585 10.3247 5.18306 10.4419C5.30027 10.5592 5.45924 10.625 5.625 10.625H12.8663L10.1825 13.3075C10.1244 13.3656 10.0783 13.4346 10.0468 13.5105C10.0154 13.5864 9.99921 13.6678 9.99921 13.75C9.99921 13.8322 10.0154 13.9136 10.0468 13.9895C10.0783 14.0654 10.1244 14.1344 10.1825 14.1925C10.2406 14.2506 10.3096 14.2967 10.3855 14.3282C10.4614 14.3596 10.5428 14.3758 10.625 14.3758C10.7072 14.3758 10.7886 14.3596 10.8645 14.3282C10.9404 14.2967 11.0094 14.2506 11.0675 14.1925L14.8175 10.4425C14.8757 10.3844 14.9219 10.3155 14.9534 10.2395C14.9849 10.1636 15.0011 10.0822 15.0011 10C15.0011 9.91779 14.9849 9.83639 14.9534 9.76046C14.9219 9.68453 14.8757 9.61556 14.8175 9.5575L11.0675 5.8075C11.0094 5.74939 10.9404 5.70329 10.8645 5.67185C10.7886 5.6404 10.7072 5.62421 10.625 5.62421C10.5428 5.62421 10.4614 5.6404 10.3855 5.67185C10.3096 5.70329 10.2406 5.74939 10.1825 5.8075C10.1244 5.86561 10.0783 5.9346 10.0468 6.01052C10.0154 6.08644 9.99921 6.16782 9.99921 6.25C9.99921 6.33218 10.0154 6.41356 10.0468 6.48948C10.0783 6.5654 10.1244 6.63439 10.1825 6.6925L12.8663 9.375H5.625Z" fill="white"></path>
                                             </svg>
                                          </span>
                                       </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </section>
                <?php } ?>
               </div>
            </div>
         </div>
      </section>
   </div>
   <!-- REVIEWS -->
   <section class="elementor-section elementor-top-section elementor-element elementor-element-706b4f8 elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no mt-50" data-id="706b4f8" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
      <div class="elementor-container elementor-column-gap-default">
         <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-118037d" data-id="118037d" data-element_type="column">
            <div class="elementor-widget-wrap elementor-element-populated">
               <div class="elementor-element elementor-element-07fe8ac elementor-absolute elementor-invisible elementor-widget elementor-widget-image" data-id="07fe8ac" data-element_type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;,&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="image.default">
                  <div class="elementor-widget-container">
                     <img decoding="async" width="45" height="56" src="<?php echo $uploads;?>2022/09/vector-6.svg" class="attachment-full size-full wp-image-4383" alt="" title="">															
                  </div>
               </div>
               <div class="elementor-element elementor-element-8ba1383 elementor-widget elementor-widget-image" data-id="8ba1383" data-element_type="widget" data-widget_type="image.default">
                  <div class="elementor-widget-container">
                  <div class="swiper-container2 testimonial-layout" data-scroll>
                        <div class="swiper-container slider-content testimonial-content-wrap">
                           <div class="swiper-wrapper">
                           <?php
							 	$listOfTestimonials = $this->db->order_by('id', 'DESC')->get('testimonials')->result_object();
							  ?>
							  <?php foreach($listOfTestimonials as $testimonial){?>
                              <div class="swiper-slide">
                             <img decoding="async" width="421" height="502" src="<?php echo $testimonial->image; ?>" class="attachment-full size-full wp-image-4339" alt="" sizes="(max-width: 421px) 100vw, 421px" title="">															
                        
                           </div>
                       <?php } ?>    
                  </div>
                  </div>
                  </div>
                  </div>
               </div>
               <!-- <div class="elementor-element elementor-element-8066c7c elementor-absolute elementor-invisible elementor-widget elementor-widget-rt-count" data-id="8066c7c" data-element_type="widget" data-settings="{&quot;_position&quot;:&quot;absolute&quot;,&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="rt-count.default">
                  <div class="elementor-widget-container">
                     <div class="listing-count-content full_box">
                        <div class="listing-content__box">
                           <span class="listing-count-content__icon icon">
                              <svg xmlns="http://www.w3.org/2000/svg" width="56" height="29" viewbox="0 0 56 29" fill="none">
                                 <path d="M35.4774 18.251L42.5004 11.0354L32.8368 9.5555C32.5929 9.51834 32.3838 9.36247 32.28 9.14089L28 0L23.7201 9.14089C23.6162 9.36247 23.4076 9.51834 23.1632 9.5555L13.4996 11.0354L20.5227 18.251C20.6834 18.4159 20.7566 18.6461 20.7196 18.8731L19.0721 29L27.6396 24.2526C27.8605 24.1303 28.14 24.1303 28.3609 24.2526L36.928 29L35.28 18.8727C35.2434 18.6461 35.3166 18.4159 35.4774 18.251Z" fill="#FFCA43"></path>
                                 <path d="M46.9786 9.69461L43.2401 1.64031L39.76 9.13862L44.1303 9.80789C44.7002 9.89534 44.9594 10.614 44.5485 11.0354L36.7956 19.0004L37.8348 25.3859L42.9416 23.1502C43.1521 23.0591 43.4032 23.0709 43.6032 23.1823L51.0883 27.366L49.6454 18.4213C49.6092 18.1961 49.6815 17.9673 49.8405 17.8024L56 11.4192L47.5354 10.111C47.2906 10.0734 47.082 9.91709 46.9786 9.69461Z" fill="#FFCA43"></path>
                                 <path d="M19.2044 19L11.4515 11.0354C11.0415 10.6145 11.2994 9.89534 11.8697 9.80789L16.24 9.13862L12.7599 1.64031L9.02142 9.69461C8.918 9.91709 8.70936 10.0734 8.46458 10.111L0 11.4192L6.15955 17.8028C6.31852 17.9678 6.39078 18.1966 6.35465 18.4218L5.06981 26.3864L12.4609 23.1502C12.661 23.0632 12.8895 23.0677 13.0859 23.1628L18.1268 25.6224L19.2044 19Z" fill="#FFCA43"></path>
                              </svg>
                           </span>
                           <?php
                              $testimonialsCount = $this->db->count_all('testimonials');
                              ?>
                           <span class="listing-count-content__number number"><?php echo $testimonialsCount; ?></span>
                           <span class="listing-count-content__title title">Top Reviews    </span>
                        </div>
                     </div>
                  </div>
               </div> -->
            </div>
         </div>
         <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-3553007" data-id="3553007" data-element_type="column">
            <div class="elementor-widget-wrap elementor-element-populated">
               <div class="elementor-element elementor-element-9b984b8 elementor-align-left elementor-widget elementor-widget-rt-title" data-id="9b984b8" data-element_type="widget" data-widget_type="rt-title.default">
                  <div class="elementor-widget-container">
                     <div class="section-heading">
                        <h2 class="heading-title">Reviews from some of our recent clients</h2>
                        <div class="sce-head-icon">
                           <svg width="155" height="20" viewbox="0 0 155 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M1.77001 13.4143C2.28873 13.1363 2.59997 12.9509 3.01494 12.6729C3.42992 12.4876 3.74115 12.3022 4.15613 12.1169C4.88234 11.7462 5.71229 11.3754 6.4385 11.0047C7.99466 10.2633 9.55082 9.70728 11.0032 9.05855C14.1156 7.85376 17.2279 6.83433 20.4439 5.90757C26.7723 4.14672 33.3082 2.75658 39.7403 1.82983C46.38 0.903066 52.9158 0.34701 59.4517 0.161658C65.9876 -0.11637 72.5235 -0.0236942 79.0593 0.34701C80.7192 0.439686 82.2754 0.532362 83.9353 0.625038C85.5952 0.717714 87.1514 0.81039 88.8113 0.995741C92.0273 1.36645 95.2434 1.64447 98.4595 2.10785L103.335 2.75658L108.108 3.49799C111.324 3.96137 114.436 4.6101 117.652 5.25884C130.309 7.76109 142.758 11.0974 155 14.8971C142.551 11.6535 129.998 8.8732 117.237 7.01968C114.021 6.5563 110.909 6.09292 107.693 5.72222L102.92 5.16616L98.1482 4.79546C94.9322 4.51743 91.7161 4.33208 88.5001 4.14672C86.9439 4.05405 85.284 4.05405 83.7278 3.96137C82.1717 3.8687 80.5118 3.8687 78.9556 3.8687C66.1951 3.77602 53.3308 4.79546 40.9853 7.20503C34.7606 8.40982 28.7435 9.98531 22.8301 11.9315C19.9252 12.9509 17.0204 14.0631 14.2193 15.2678C12.8706 15.9166 11.4182 16.5653 10.1733 17.214C9.55082 17.5847 8.82461 17.8628 8.20215 18.2335C7.89091 18.4188 7.57968 18.6042 7.26845 18.7895C6.95722 18.9749 6.64598 19.1602 6.4385 19.2529C4.67485 20.4577 2.18499 20.1797 0.836317 18.6042C-0.512355 17.0287 -0.201123 14.8045 1.56253 13.5997C1.66627 13.507 1.66627 13.507 1.77001 13.4143Z" fill="#FF4A52"></path>
                           </svg>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="elementor-element elementor-element-d03cef1 elementor-widget elementor-widget-rt-testimonial" data-id="d03cef1" data-element_type="widget" data-widget_type="rt-testimonial.default">
                  <div class="elementor-widget-container">
                     <div class="swiper-container2 testimonial-layout" data-scroll>
                        <div class="swiper-container slider-content testimonial-content-wrap">
                           <div class="swiper-wrapper">
							  <?php
							 	$listOfTestimonials = $this->db->order_by('id', 'DESC')->get('testimonials')->result_object();
                         ?>
							  <?php foreach($listOfTestimonials as $testimonial){?>
                              <div class="swiper-slide">
                                 <div class="testimonial-content">
                                    <div class="rating" data-swiper-parallax-x="-100" data-swiper-parallax-duration="1000">
                                       <div class="item-rating">
									   <?php
											$stars = $testimonial->stars;
											for ($i = 0; $i < 5 ; $i++) {
												if ($i < $stars) { 
													echo '<i class="fa-solid fa-star active"></i>';
												} else {
													echo '<i class="fa-regular fa-star deactive"></i>';
												}
											}
											?>

                                       </div>
                                    </div>
                                    <div class="tes-desc" data-swiper-parallax-x="-150" data-swiper-parallax-duration="1200">
                                       <p><?php echo $testimonial->text; ?></p>
                                    </div>
                                    <div class="poster-info">
                                       <h3 class="item-title" data-swiper-parallax-x="-200" data-swiper-parallax-duration="1400"><?php echo $testimonial->name; ?></h3>
                                       <h5 class="item-designation" data-swiper-parallax-x="-250" data-swiper-parallax-duration="1600"><?php echo $testimonial->designation; ?></h5>
                                    </div>
                                    <div class="quote-icon">
                                       <svg width="154" height="122" viewbox="0 0 167 132" fill="EAEAEA" xmlns="http://www.w3.org/2000/svg">
                                          <path opacity="0.1" d="M92.8399 131V109.557L98.7332 108.396L98.7338 108.396C110.393 106.092 118.683 101.486 123.128 94.5568L123.128 94.5568L123.134 94.5469C125.396 90.9282 126.681 86.7949 126.865 82.5431L126.91 81.4999H125.866H100.184C98.2323 81.4999 96.3632 80.7333 94.9868 79.3724C93.6108 78.0119 92.8399 76.169 92.8399 74.2499V16.4999C92.8399 7.96304 99.8659 0.999878 108.527 0.999878H158.59C160.541 0.999878 162.41 1.76643 163.787 3.12734C165.163 4.48787 165.934 6.33073 165.934 8.24988V74.2499V74.35L165.945 74.4037C165.945 74.4075 165.945 74.4118 165.946 74.4165C165.949 74.4564 165.953 74.5179 165.958 74.6007C165.968 74.7657 165.98 75.0088 165.988 75.3236C166.005 75.953 166.009 76.865 165.965 78.0085C165.877 80.2962 165.593 83.5038 164.823 87.2246C163.283 94.6698 159.806 104.132 152.093 112.409C140.636 124.69 123.229 131 100.184 131H92.8399ZM1.00006 131V109.557L6.8934 108.396L6.89397 108.396C18.5528 106.092 26.8435 101.486 31.2882 94.5568L31.2883 94.5568L31.2944 94.5469C33.5564 90.9282 34.8412 86.7949 35.025 82.5431L35.0701 81.4999H34.0259H8.34383C6.39252 81.4999 4.52337 80.7333 3.14699 79.3724C1.771 78.0119 1.00006 76.169 1.00006 74.2499V16.4999C1.00006 7.96304 8.02602 0.999878 16.6876 0.999878H66.7502C68.7015 0.999878 70.5706 1.76643 71.947 3.12734C73.323 4.48787 74.094 6.33073 74.094 8.24988V74.2499V74.35L74.1049 74.4039C74.1052 74.4078 74.1056 74.4121 74.1059 74.4168C74.1078 74.4396 74.1101 74.4694 74.1126 74.5061C74.1144 74.5338 74.1165 74.5654 74.1186 74.601C74.1285 74.7661 74.14 75.0092 74.1486 75.324C74.1656 75.9533 74.1705 76.8653 74.1265 78.0088C74.0386 80.2964 73.7554 83.504 72.9862 87.2247C71.447 94.6699 67.97 104.132 60.2532 112.409C48.7958 124.69 31.389 131 8.34383 131H1.00006Z" stroke="#EAEAEA" stroke-width="2"></path>
                                       </svg>
                                    </div>
                                 </div>
                              </div>
                              
							  <?php } ?>
                           </div>
                        </div>
                        <div class="nav-wrap">
                           <div class="swiper-button-prev"><i class="fas fa-chevron-left"></i></div>
                           <div class="swiper-button-next"><i class="fas fa-chevron-right"></i></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<div class="outer_wrap" id="calendar_popup">
   <div class="outer_wrap_inner">
      <div class="center_white_outer" style="width: 750px; padding:10px">
         <div class="close_poup" onclick="close_popup()">
            <i class="fa fa-close"></i>
         </div>
         <iframe src="https://nepalicalendar.rat32.com/embed.php" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" style="border:none; overflow:hidden; width:100%; height:715px; border-radius:5px;padding:0px;margin:0px;" allowtransparency="true"></iframe>
         <!-- <iframe src="https://nepalicalendar.rat32.com/embed.php#zoom=100" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" style="border:none; overflow:hidden; height: 715px; width: 100%;" allowtransparency="true"></iframe> -->
      </div>
   </div>
</div>
<?php include("common/footer.php"); ?>
<script>
   function do_open_modal(){
   	jQuery("#calendar_popup").show();
   }
   function do_show_option(val){
   	jQuery("#gold_accordian").hide();
   	jQuery("#forexxx_accordian").hide();
   	jQuery(".gold_accordian").removeClass("active");
   	jQuery(".forex_accordia").removeClass("active");
   	if(val == "gold_accordian"){
   		jQuery("#gold_accordian").show();
   		jQuery(".gold_accordian").addClass("active");
   	} else {
   		jQuery("#forexxx_accordian").show();
   		jQuery(".forex_accordia").addClass("active");
   	}
   }
</script>
<script>
   function initAutocomplete() {
      const countrySelect = document.getElementById('countrySelect2');
      const cityZipInput = document.getElementById('cityZipInput2');
      const updateButton = document.getElementById('updateLocationButton2');
   
   
     
      cityZipInput.addEventListener('input', function() {
        // Disable the update button when user types manually
      });
   
                                    
         
      const autocompleteOptions = {
        types: ['(regions)'], // Restrict to regions (city names and ZIP codes)
      };
   
      // Initialize Autocomplete for city name or ZIP code input
      const autocomplete = new google.maps.places.Autocomplete(cityZipInput, autocompleteOptions);
      autocomplete.setFields(['address_components', 'geometry']);
   
      // Update autocomplete when country selection changes
      countrySelect.addEventListener('change', function() {
       
        autocompleteOptions.componentRestrictions = { country: countrySelect.value };
        autocomplete.setOptions(autocompleteOptions);
                 cityZipInput.value = '';
         });
   
            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();
                console.log('Selected Place:', place.formatted_address);
                console.log('Place Details:', place);
   
                // Get the long name of the selected city
                let cityName = '';
                const addressComponents = place.address_components;
                for (let i = 0; i < addressComponents.length; i++) {
                const component = addressComponents[i];
                if (component.types.includes('locality') || component.types.includes('political') || component.types.includes('country') || component.types.includes('administrative_area_level_2') || component.types.includes('administrative_area_level_1') || component.types.includes('sublocality')) {
                   cityName = component.long_name;
                   break;
                }

                }
                document.getElementById('userCityText2').value = cityName;
                console.log('Selected City (Short Name):', cityName);
            });
            }
               
               // Initialize the autocomplete feature when the page loads
               google.maps.event.addDomListener(window, 'load', initAutocomplete);
</script>