<?php

    foreach($all_products as $key=>$row){
        $category_name = $this->db->query("SELECT * FROM categories WHERE slug = '".$row->category."'")->result_object()[0];
        $user_details = $this->db->query("SELECT * FROM users WHERE id = ".$row->uID)->result_object()[0];
        if($user_details->g_id != null){
            $url_image = $user_details->profile_pic;
            $ex = explode("=", $url_image);
            $url_image = $ex[0];
        } else {
            $url_image = $user_details->profile_pic;
        }
        $json = json_decode($row->json_content, false);

        $images_product = $this->db->query("SELECT * FROM product_images WHERE product_id = ".$row->id)->result_object();
        $image_to_display = $uploads."classified-listing/no_products.png";
        if(!empty($images_product)){
            $image_to_display = $images_product[0]->image;
        }

        $total_rating = $this->db->query("SELECT * FROM order_reviews WHERE order_id = ".$row->id)->result_object();
        // echo $this->db->last_query();
      ?>
      <?php if($show_slider == 1){?>
      <div class="swiper-slide ">
      <?php } ?>


      <?php 

                           $rating___ = $this->db->query("SELECT p.id, COALESCE(SUM(O.rating), 0) AS total_rating , (COUNT(O.rating)) AS rate FROM products AS p LEFT JOIN order_reviews AS O ON p.id = O.order_id WHERE p.uID = ".$user_details->id." AND p.id = ".$row->id." GROUP BY p.id")->result_object()[0];
                           // echo $this->db->last_query();
                           if($rating___->total_rating != 0){
                              $final_rating = ($rating___->total_rating / $rating___->rate);
                              $percentage = ($final_rating / 5) * 100;
                           }
                        ?>

<div style="cursor: pointer;"  class="listing-item rtcl-listing-item post-7613 status-publish is-sell rtcl_category-italian rtcl_location-los-angeles custom_cl_display">
   <div class="product-box dn-countdown">
      <div class="item-img bg--gradient-50" onclick="do_redirect('<?php echo base_url();?>classified/detail/<?php echo $row->slug;?>')">
         <div class="rt-categories" onclick="do_redirect('<?php echo base_url();?>classified/detail/<?php echo $row->slug;?>')">
            <a href="<?php echo base_url();?>classifieds/<?php echo $category_name->slug;?>" class="category-list">
                <?php echo $category_name->title;?>        
            </a>
            <div class="rtcl-listing-badge-wrap"></div>
         </div>
         <div class="listing-thumb" onclick="do_redirect('<?php echo base_url();?>classified/detail/<?php echo $row->slug;?>')">
            <a href="<?php echo base_url();?>classified/detail/<?php echo $row->slug;?>" class="rtcl-media grid-view-img"><img width="370" height="240" src="<?php echo $image_to_display;?>" class="rtcl-thumbnail" alt="r-5-min" title=""></a>
            <a href="<?php echo base_url();?>classified/detail/<?php echo $row->slug;?>" class="rtcl-media list-view-img"><img width="350" height="270" src="<?php echo $image_to_display;?>" class="rtcl-thumbnail" alt="r-5-min" title=""></a>
         </div>
         <?php /**/ ?>
         <div class="directory-block__poster" onclick="do_redirect('<?php echo base_url();?>classified/detail/<?php echo $row->slug;?>')">
            <div class="directory-block__poster__thumb">
               <a class="directory-block__poster__link--image">
                <img class="image_40" src="<?php echo $url_image;?>" class="attachment-40x40 size-40x40" alt="" decoding="async" title="">    
            </a>
            </div>
            <div class="directory-block__poster__info">
               <span class="directory-block__poster__name">
               <a class="author-link">
                    <?php echo $user_details->name; ?>               
                </a>
               </span>

                <div class="directory-block__poster__ratings" style="margin-top: 5px;">
                   <div class="product-rating">
                       <div class="item-icon">
                        

                           <div class="star-rating"><span style="width:<?php echo $percentage;?>%"></span></div>                    </div>
                       <div class="item-text">(<span><?php echo count($total_rating); ?></span>)</div>
                   </div>
               </div>
            </div>

         </div>
         <?php /**/ ?>
      </div>
      <div class="item-content">
         <h3 class="listing-title rtcl-listing-title "><a href="<?php echo base_url();?>classified/detail/<?php echo $row->slug;?>">
            <?php echo substr($row->title, 0, 35); ?> <?php echo strlen($row->title)>35?"...":""; ?>
         </a></h3>
         <p style="word-break: break-all;">
         <?php 
$desc = strip_tags($json->description);
echo (strlen($desc) > 70) ? substr($desc, 0, 70) . "..." : substr($desc, 0, 70); 
?>
         </p>
         <ul class="contact-info" onclick="do_redirect('<?php echo base_url();?>classified/detail/<?php echo $row->slug;?>')">
            <?php if($json->address != "" && 2==3){ ?>
                <li class="meta-address">
                   <svg width="14" height="16" viewbox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M4.62225 6.83378C4.62225 5.42809 5.7614 4.28894 7.16709 4.28894C8.57215 4.28894 9.71114 5.42825 9.71114 6.83378C9.71114 8.23868 8.572 9.37783 7.16709 9.37783C5.76156 9.37783 4.62225 8.23884 4.62225 6.83378ZM7.16709 5.48894C6.42414 5.48894 5.82225 6.09083 5.82225 6.83378C5.82225 7.57578 6.42398 8.17783 7.16709 8.17783C7.90925 8.17783 8.51114 7.57594 8.51114 6.83378C8.51114 6.09067 7.9091 5.48894 7.16709 5.48894Z" fill="#FF3C48"></path>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M7.16596 1.59999C4.28028 1.59999 1.933 3.96056 1.933 6.88255C1.933 8.7379 3.04199 10.6278 4.34853 12.0989C4.99287 12.8244 5.6623 13.4216 6.21812 13.8328C6.4967 14.0389 6.73773 14.1915 6.9255 14.2896C7.06206 14.3609 7.13847 14.3862 7.16596 14.3951C7.19345 14.3862 7.26987 14.3609 7.40647 14.2896C7.59426 14.1915 7.83532 14.0388 8.11393 13.8328C8.66983 13.4216 9.33935 12.8244 9.98379 12.0989C11.2905 10.6278 12.3997 8.73787 12.3997 6.88255C12.3997 3.96067 10.0517 1.59999 7.16596 1.59999ZM0.733002 6.88255C0.733002 3.30752 3.60788 0.399994 7.16596 0.399994C10.7239 0.399994 13.5997 3.30742 13.5997 6.88255C13.5997 9.17675 12.258 11.3455 10.8809 12.8958C10.1835 13.681 9.45283 14.3351 8.82751 14.7976C8.51552 15.0283 8.22071 15.2181 7.96204 15.3532C7.7325 15.4731 7.44058 15.6 7.16596 15.6C6.89132 15.6 6.59941 15.4731 6.36989 15.3532C6.11123 15.2181 5.81645 15.0283 5.50449 14.7975C4.87924 14.335 4.14869 13.681 3.45132 12.8958C2.07442 11.3455 0.733002 9.17671 0.733002 6.88255Z" fill="#FF3C48"></path>
                   </svg>
                   <div class="li_classif">
                       <?php echo substr($json->address,0,32)."...";?>
                   </div>
                </li>
            <?php } ?>
            <?php if($json->contact_number != "" && 2==3){ ?>
            <li class="meta-phone">
               <a href="tel:012548963">
                  <svg width="16" height="16" viewbox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M14.6468 12.22C14.6468 12.46 14.5935 12.7067 14.4802 12.9467C14.3668 13.1867 14.2202 13.4133 14.0268 13.6267C13.7002 13.9867 13.3402 14.2467 12.9335 14.4133C12.5335 14.58 12.1002 14.6667 11.6335 14.6667C10.9535 14.6667 10.2268 14.5067 9.46016 14.18C8.6935 13.8533 7.92683 13.4133 7.16683 12.86C6.40016 12.3 5.6735 11.68 4.98016 10.9933C4.2935 10.3 3.6735 9.57334 3.12016 8.81334C2.5735 8.05334 2.1335 7.29334 1.8135 6.54001C1.4935 5.78001 1.3335 5.05334 1.3335 4.36001C1.3335 3.90668 1.4135 3.47334 1.5735 3.07334C1.7335 2.66668 1.98683 2.29334 2.34016 1.96001C2.76683 1.54001 3.2335 1.33334 3.72683 1.33334C3.9135 1.33334 4.10016 1.37334 4.26683 1.45334C4.44016 1.53334 4.5935 1.65334 4.7135 1.82668L6.26016 4.00668C6.38016 4.17334 6.46683 4.32668 6.52683 4.47334C6.58683 4.61334 6.62016 4.75334 6.62016 4.88001C6.62016 5.04001 6.5735 5.20001 6.48016 5.35334C6.3935 5.50668 6.26683 5.66668 6.10683 5.82668L5.60016 6.35334C5.52683 6.42668 5.4935 6.51334 5.4935 6.62001C5.4935 6.67334 5.50016 6.72001 5.5135 6.77334C5.5335 6.82668 5.5535 6.86668 5.56683 6.90668C5.68683 7.12668 5.8935 7.41334 6.18683 7.76001C6.48683 8.10668 6.80683 8.46001 7.1535 8.81334C7.5135 9.16668 7.86016 9.49334 8.2135 9.79334C8.56016 10.0867 8.84683 10.2867 9.0735 10.4067C9.10683 10.42 9.14683 10.44 9.1935 10.46C9.24683 10.48 9.30016 10.4867 9.36016 10.4867C9.4735 10.4867 9.56016 10.4467 9.6335 10.3733L10.1402 9.87334C10.3068 9.70668 10.4668 9.58001 10.6202 9.50001C10.7735 9.40668 10.9268 9.36001 11.0935 9.36001C11.2202 9.36001 11.3535 9.38668 11.5002 9.44668C11.6468 9.50668 11.8002 9.59334 11.9668 9.70668L14.1735 11.2733C14.3468 11.3933 14.4668 11.5333 14.5402 11.7C14.6068 11.8667 14.6468 12.0333 14.6468 12.22Z" stroke="#FF3C48" stroke-width="1.2" stroke-miterlimit="10"></path>
                  </svg>
                  <div class="li_classif">
                    <?php echo $json->contact_number;?>
                  </div>
               </a>
            </li>
            <?php } ?>
         </ul>
         <ul class="meta-item">
            <li class="meta-price">
               <div class="rtcl-price price-type-fixed">
                <span class="rtcl-price-amount amount">
                    <?php if($row->category=="events"){?>
                       <?php //echo $json->event_cost; ?>
                    <?php } else { ?>
                        <!-- <bdi><span class="rtcl-price-currencySymbol">&#36;</span>250</bdi> -->
                    <?php } ?>
                </span></div>
            </li>
            <li class="entry-meta">
               <ul>
                  <li class="tooltip-item meta-favourite" data-bs-toggle="Favourite" data-bs-placement="top" data-bs-trigger="hover" title="Favourite">
                     <a 
                        <?php if(isset($_SESSION['LISTYLOGIN'])){
                           $whishlist = $this->db->query("SELECT * FROM wishlist WHERE user_id = ".user_info()->id." AND product_id = ".$row->id)->result_object()[0];
                        }
                        ?>

                        <?php if(!empty($whishlist)){?> class="hover_heart"<?php } ?>
                        <?php if(isset($_SESSION['LISTYLOGIN'])){ ?>href="<?php echo base_url();?>do/favorite/<?php echo $row->id;?>"<?php } else {?>href="javascript:;" onclick="show_login_popup()"<?php } ?>>

                        <i class="rtcl-icon rtcl-icon-heart<?php echo !empty($whishlist)?"":"-empty";?>" <?php if(!empty($whishlist)){?>style="color: #fff; <?php } ?>"></i><span class="favourite-label">Favourite</span></a>        
                  </li>
               </ul>
            </li>
         </ul>
      </div>
   </div>
</div>
<?php if($show_slider == 1){?>
</div>
<?php } ?>

<?php } ?>