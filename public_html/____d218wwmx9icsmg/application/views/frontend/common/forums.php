<?php 
    foreach($all_products as $key=>$row){
        $total_comments = $this->db->query("SELECT * FROM confession_comment WHERE bID = ".$row->id)->num_rows();
         $user = $this->db->query("SELECT * FROM users WHERE id = ".$row->uID)->result_object()[0];
         if($user->g_id!=""){
            $url_image = $user->profile_pic;
         } else {
            $url_image = $user->profile_pic;
         }

         if($row->image == '') {
            $image_to_display = settings()->site_logo;
         }else{
            $image_to_display = $row->image;

         }

?>


<div style="cursor: pointer;" onclick="<?php if($row->nsfw ==1){?>show_nsfw_content('<?php echo base_url();?>forum/details/<?php echo $row->slug;?>');<?php } else { ?>window.location.href='<?php echo base_url();?>forum/details/<?php echo $row->slug;?>' <?php } ?>" class="listing-item rtcl-listing-item post-7613 status-publish is-sell rtcl_category-italian rtcl_location-los-angeles custom_cl_display my_custom_forum">

   

   <div class="product-box-custom dn-countdown">
      <div class="item-img bg--gradient-50">
      <?php if($row->nsfw == 1){?>
       <div class="nfsv_content">
          <span class="bold_nssn"> NSFW content </span>
          <span style="font-size: 14px;">Click to View</span>
       </div>
   <?php } ?>
         <div class="listing-thumb">
            <a href="<?php echo base_url();?>forum/details/<?php echo $row->slug;?>" class="rtcl-media grid-view-img"><img src="<?php echo $image_to_display;?>" class="rtcl-thumbnail" alt="r-5-min" title=""></a>
         </div>
         <?php /**/ ?>
         <div class="directory-block__poster">
            <div class="directory-block__poster__thumb">

               <?php if($row->author != "Anonymous"){ ?>
                  <a class="directory-block__poster__link--image">

                <img class="image_30" src="<?php echo $url_image;?>" class="attachment-40x40 size-40x40" alt="" decoding="async" title="">    
               </a>
                <?php } ?>

            </div>
            <div class="directory-block__poster__info">
               <span class="directory-block__poster__name">
               <a class="author-link">
               <?php if($row->author != "Anonymous"){ ?>

                    <?php echo $user->name; ?>               
                    <?php }else {
                        echo 'Anonymous';
                    } ?>

                  </a>
               </span>
            </div>

         </div>
         <?php /**/ ?>
      </div>
      <div class="item-content">
         <h3 class="listing-title rtcl-listing-title "><a href="<?php echo base_url();?>forum/details/<?php echo $row->slug;?>">
            <?php echo substr($row->title, 0, 16); ?> <?php echo strlen($row->title)>16?"...":""; ?>
         </a></h3>
         <p>
            <?php echo substr(strip_tags($row->description), 0, 20)."..."; ?>
         </p>
         
         <div class="forum_cism_bottom">
            <?php $segment = $this->uri->segment(2); ?>

            <span>
                #NSF<?php
                if($segment == null) {
                   echo $key +1;
               }else{
                  echo $segment + $key + 1;
               }

                 ?>
            </span>
            <span>
               <?php if($row->nsfw == 1){ ?>
                  <div class="nsfw_text">NSFW</div>
              <?php } ?>   
            </span>
         </div>
       
      </div>
   </div>
</div>


     <?php if ($key==3|| $key==7) { ?>
       <div class="ad-container " id="dummy-ad" style="margin-top: 10px">
       <?php include("common/google_ads_box.php"); ?>
       </div>
   <?php } ?>      

<?php } ?>