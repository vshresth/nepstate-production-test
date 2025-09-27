
<?php
   $countryId = userCountryId();
?>


<?php include("common/header.php"); 
if(!isset($_SESSION['LISTYLOGIN'])){
    $_SESSION['RETURN'] = "forums"; 
} 
?>
<style type="text/css">
    .rtcl .rtcl-grid-view {
        grid-column-gap: 10px;
    }
</style>
<div data-elementor-type="wp-page" data-elementor-id="10" class="elementor elementor-10" style="margin-top: 20px;">
   <?php include("common/header_full.php"); ?>
   <div class="container-fluid custom-padding">
       <div class="blog_posting_div" onclick="do_show_popup_blog_post()">
       <?php 
            
            $image_append = base_url()."resources/uploads/profiles/";
            
            if(!isset($_SESSION['LISTYLOGIN'])){
                $image_user = $image_append."dummy_image.png";
            } else {

                if(user_info()->profile_pic == "dummy_image.png"){
                    $image_user = $image_append."dummy_image.png";
                }else{

                    $image_user = user_info()->profile_pic;
                }
                // if(user_info()->g_id != ""){
                // } else  {
                //     $image_user = user_info()->profile_pic;
                // }
            }
            ?>
            <img src="<?php echo $image_user; ?>">
            <div class="blog_posting_text">
                <?php if(isset($_SESSION['LISTYLOGIN'])){?>Post your Forum....<?php } else { echo "<span style='color:red'>Login to post your Forum....</span>"; } ?>
           </div>
        </div>
    </div>

<!--=====================================-->
<!--=         Inner Banner Start        =-->
<!--=====================================-->

<!--=====================================-->
<!--=              Blog Start           =-->
<!--=====================================-->
<section class="blog-posts-layout bg--accent" style="padding-top:65px">

    
    <div class="listing-breadcrumb listing-archive-page" style="padding-bottom: 15px">
      <div class="container-fluid custom-padding">
         <div class="breadcrumb-area">
            <div class="entry-breadcrumb">
               <!-- Breadcrumb NavXT 7.2.0 -->
               <span property="itemListElement" typeof="ListItem">
                  <a property="item" typeof="WebPage" title="" href="<?php echo base_url();?>" class="home"><span property="name">Home</span></a>
                  <meta property="position" content="1">
               </span>
               <?php if($this->uri->segment(2)=="tags"){?>
                   &gt; 
                  <a href="<?php echo base_url();?>forums" property="itemListElement" typeof="ListItem">
                     <span property="name" class="archive post-rtcl_listing-archive current-item">Forums</span>
                  </a>
               <?php } ?>
               &gt; 
               <a href="<?php echo base_url();?>forums"  property="itemListElement" typeof="ListItem">
                  <span property="name" class="archive post-rtcl_listing-archive current-item"><?php echo $title_show;?></span>
               </a>
               <?php if($this->uri->segment(2)=="tags"){?>
                  &gt; 
                  <span property="itemListElement" typeof="ListItem">
                     <span property="name" class="archive post-rtcl_listing-archive current-item"><?php echo $this->uri->segment(3);?></span>
                  </span>
               <?php } ?>
            </div>
         </div>
      </div>
   </div>

  <div class="container">
    <div class="row justify-content-center gutters-40">
        <div class="col-lg-12 order-lg-1">
          <div class="rtcl-listings-actions">
                  <div class="rtcl-result-count">
                    Showing <?php echo count($blogs);?> result(s)
                  </div>
                  <select name="orderby" class="orderby" aria-label="Blog order" onchange="do_show_order_by_sort(this.value)" style="width:25%">
                           <option value="" <?php if(!isset($_GET['sort'])){echo "SELECTED";}?>> Recent </option>
                           <option value="date-asc" <?php echo isset($_GET['sort']) && $_GET['sort'] == "date-asc"?"SELECTED":"";?>>Oldest</option>
                           <option value="viewed" <?php echo isset($_GET['sort']) && $_GET['sort'] == "viewed"?"SELECTED":"";?>>Most Viewed</option>
                           <option value="liked" <?php echo isset($_GET['sort']) && $_GET['sort'] == "liked"?"SELECTED":"";?>>Most Liked</option>
                          <!--  <option value="title-asc" <?php echo isset($_GET['sort']) && $_GET['sort'] == "title-asc"?"SELECTED":"";?>>A to Z ( title )</option>
                           <option value="title-desc" <?php echo isset($_GET['sort']) && $_GET['sort'] == "title-desc"?"SELECTED":"";?>>Z to A ( title )</option> -->
                           <option value="nsfw" <?php echo isset($_GET['sort']) && $_GET['sort'] == "nsfw"?"SELECTED":"";?>>NSFW Content</option>
                           
                   </select>
            </div>
         </div>
        <div class="col-lg-8 order-lg-1">

            <div class="categories_forums">
               <?php 
                  $cat_forums = $this->db->query("SELECT * FROM forum_categories WHERE status = 1 ORDER BY id ASC")->result_object();
                  foreach($cat_forums as $kf => $rf){
               ?>
                  <a href="<?php echo base_url();?>forums?cat=<?php echo $rf->slug;?>" class="form_cat_div <?php echo $rf->slug==$_GET['cat']?"active":"";?>">
                     <?php echo $rf->title; ?>
                  </a>
               <?php } ?>
            </div>
                        <div class=" row-cols-1 row-cols-lg-1 row-cols-md-1">

 <?php 
   if(empty($blogs)){
      echo '<div class="rtcl-listings-actions text-center" style="justify-content: center;
    color: #f00;">No Forum found!</div>';
   }
   $all_products = $blogs;
   ?>
   <div class="list_forum_custom_grd">
        <?php 
            include("common/forums.php");
        ?>
    </div> 
   <?php 
   foreach($blogs as $key => $blog) {
      $total_comments = $this->db->query("SELECT * FROM confession_comment WHERE bID = ".$blog->id)->num_rows();
      $user = $this->db->query("SELECT * FROM users WHERE id = ".$blog->uID)->result_object()[0];
      if($user->g_id!=""){
         $url_image = $user->profile_pic;
      } else {
         $url_image = $user->profile_pic;
      }
   ?>



<?php /* ?>
<div class="col"  onclick="<?php if($blog->nsfw ==1){?>show_nsfw_content('<?php echo base_url();?>forum/details/<?php echo $blog->slug;?>');<?php } else { ?>window.location.href='<?php echo base_url();?>forum/details/<?php echo $blog->slug;?>' <?php } ?>" style="cursor: pointer;">
<article id="post-3728" class="blog-box-layout1 blog-list  post-3728 post type-post status-publish format-standard has-post-thumbnail hentry category-shopping-mall tag-cafe tag-travel have-post-thumb">
        <div class="post-thumb custom_blog_thumb"  >
            <a href="<?php echo base_url();?>forum/details/<?php echo $blog->slug;?>"><img width="860" height="460" src="<?php echo $uploads;?>classified-listing/<?php echo $blog->image;?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" decoding="async" srcset="<?php echo $uploads;?>classified-listing/<?php echo $blog->image;?> 860w, <?php echo $uploads;?>classified-listing/<?php echo $blog->image;?> 350w" sizes="(max-width: 860px) 100vw, 860px" title=""></a>
            
         </div>
        <div class="post-content">
              <ul class="entry-meta conf_" style="display: flex; align-items: center;"> 
             
                <li class="entry-admin">
                    <?php if($blog->author != "Anonymous"){ ?>
                      <span class="meta-icon custom_icon_blog"><img alt="" src="<?php echo $url_image;?>" srcset="<?php echo $url_image;?>" class="avatar avatar-25 photo" height="25" width="25" decoding="async"></span>
                  <?php } ?>
                  <span>by</span><a><?php echo $blog->author;?></a>
                </li>
                <li class="entry-date">
                    <div>
                         <span class="meta-icon"><i class="far fa-clock"></i></span><?php echo date("F, d Y", strtotime($blog->created_at));?>   (<small><?php echo time_elapsed_string_header($blog->created_at); ?></small>)
                     </div>
                     
                 </li>
                 <li><?php if($blog->nsfw == 1){ ?>
                        <div class="nsfw_text">NSFW</div>
                    <?php } ?></li>
              </ul>
              <div class="code_nfc" style="background: #fff;
    padding: 8px 18px;
    border-radius: 100px;">#NSC<?php echo $blog->id;?></div>
            <h3 class="post-title"><a href="<?php echo base_url();?>forum/details/<?php echo $blog->slug;?>"><?php echo $blog->title;?></a></h3>
        <div class="content">
            <?php if($blog->nsfw == 1){?>
                <div class="nfsv_content">
                   <span class="bold_nssn"> NSFW content </span>
                   <span style="font-size: 14px;">Click to View</span>
                </div>
            <?php } else { ?>
            <p><?php 
                  $tags_strip = strip_tags($blog->description);
                  echo substr($tags_strip,0,200)."...";?>
            </p>
            <?php } ?>
        </div>
        <div class="btn-wrap btn-v2" style="margin-bottom:0; padding-bottom: 0;">
            <div class="button_box">
                <div class="icon_box_wrap">
                    <div class="icon_thumbup">
                        <?php 
                            $likes = $this->db->query("SELECT * FROM confession_likes WHERE likebg = 1 AND bID = ".$blog->id)->num_rows();
                        ?>
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M323.8 34.8c-38.2-10.9-78.1 11.2-89 49.4l-5.7 20c-3.7 13-10.4 25-19.5 35l-51.3 56.4c-8.9 9.8-8.2 25 1.6 33.9s25 8.2 33.9-1.6l51.3-56.4c14.1-15.5 24.4-34 30.1-54.1l5.7-20c3.6-12.7 16.9-20.1 29.7-16.5s20.1 16.9 16.5 29.7l-5.7 20c-5.7 19.9-14.7 38.7-26.6 55.5c-5.2 7.3-5.8 16.9-1.7 24.9s12.3 13 21.3 13L448 224c8.8 0 16 7.2 16 16c0 6.8-4.3 12.7-10.4 15c-7.4 2.8-13 9-14.9 16.7s.1 15.8 5.3 21.7c2.5 2.8 4 6.5 4 10.6c0 7.8-5.6 14.3-13 15.7c-8.2 1.6-15.1 7.3-18 15.2s-1.6 16.7 3.6 23.3c2.1 2.7 3.4 6.1 3.4 9.9c0 6.7-4.2 12.6-10.2 14.9c-11.5 4.5-17.7 16.9-14.4 28.8c.4 1.3 .6 2.8 .6 4.3c0 8.8-7.2 16-16 16H286.5c-12.6 0-25-3.7-35.5-10.7l-61.7-41.1c-11-7.4-25.9-4.4-33.3 6.7s-4.4 25.9 6.7 33.3l61.7 41.1c18.4 12.3 40 18.8 62.1 18.8H384c34.7 0 62.9-27.6 64-62c14.6-11.7 24-29.7 24-50c0-4.5-.5-8.8-1.3-13c15.4-11.7 25.3-30.2 25.3-51c0-6.5-1-12.8-2.8-18.7C504.8 273.7 512 257.7 512 240c0-35.3-28.6-64-64-64l-92.3 0c4.7-10.4 8.7-21.2 11.8-32.2l5.7-20c10.9-38.2-11.2-78.1-49.4-89zM32 192c-17.7 0-32 14.3-32 32V448c0 17.7 14.3 32 32 32H96c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32H32z"/></svg>
                        <div class="text_icon_conf"><?php echo $likes; ?></div>
                    </div>
                    <div class="icon_thumbup">
                        <?php $dislikes = $this->db->query("SELECT * FROM confession_likes WHERE likebg = 2 AND bID = ".$blog->id)->num_rows(); ?>
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M323.8 477.2c-38.2 10.9-78.1-11.2-89-49.4l-5.7-20c-3.7-13-10.4-25-19.5-35l-51.3-56.4c-8.9-9.8-8.2-25 1.6-33.9s25-8.2 33.9 1.6l51.3 56.4c14.1 15.5 24.4 34 30.1 54.1l5.7 20c3.6 12.7 16.9 20.1 29.7 16.5s20.1-16.9 16.5-29.7l-5.7-20c-5.7-19.9-14.7-38.7-26.6-55.5c-5.2-7.3-5.8-16.9-1.7-24.9s12.3-13 21.3-13L448 288c8.8 0 16-7.2 16-16c0-6.8-4.3-12.7-10.4-15c-7.4-2.8-13-9-14.9-16.7s.1-15.8 5.3-21.7c2.5-2.8 4-6.5 4-10.6c0-7.8-5.6-14.3-13-15.7c-8.2-1.6-15.1-7.3-18-15.2s-1.6-16.7 3.6-23.3c2.1-2.7 3.4-6.1 3.4-9.9c0-6.7-4.2-12.6-10.2-14.9c-11.5-4.5-17.7-16.9-14.4-28.8c.4-1.3 .6-2.8 .6-4.3c0-8.8-7.2-16-16-16H286.5c-12.6 0-25 3.7-35.5 10.7l-61.7 41.1c-11 7.4-25.9 4.4-33.3-6.7s-4.4-25.9 6.7-33.3l61.7-41.1c18.4-12.3 40-18.8 62.1-18.8H384c34.7 0 62.9 27.6 64 62c14.6 11.7 24 29.7 24 50c0 4.5-.5 8.8-1.3 13c15.4 11.7 25.3 30.2 25.3 51c0 6.5-1 12.8-2.8 18.7C504.8 238.3 512 254.3 512 272c0 35.3-28.6 64-64 64l-92.3 0c4.7 10.4 8.7 21.2 11.8 32.2l5.7 20c10.9 38.2-11.2 78.1-49.4 89zM32 384c-17.7 0-32-14.3-32-32V128c0-17.7 14.3-32 32-32H96c17.7 0 32 14.3 32 32V352c0 17.7-14.3 32-32 32H32z"/></svg>
                        <div class="text_icon_conf"><?php echo $dislikes; ?></div>
                    </div>
                </div>
                <div class="icon_box_wrap">
                    <div class="text_icon_conf"><?php echo $total_comments; ?></div>
                    <div class="svg_conf">
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M160 368c26.5 0 48 21.5 48 48v16l72.5-54.4c8.3-6.2 18.4-9.6 28.8-9.6H448c8.8 0 16-7.2 16-16V64c0-8.8-7.2-16-16-16H64c-8.8 0-16 7.2-16 16V352c0 8.8 7.2 16 16 16h96zm48 124l-.2 .2-5.1 3.8-17.1 12.8c-4.8 3.6-11.3 4.2-16.8 1.5s-8.8-8.2-8.8-14.3V474.7v-6.4V468v-4V416H112 64c-35.3 0-64-28.7-64-64V64C0 28.7 28.7 0 64 0H448c35.3 0 64 28.7 64 64V352c0 35.3-28.7 64-64 64H309.3L208 492z"/></svg>
                    </div>
                </div>
                <div class="icon_box_wrap">
                    <div class="svg_conf">
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M352 0c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9L370.7 96 201.4 265.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L416 141.3l41.4 41.4c9.2 9.2 22.9 11.9 34.9 6.9s19.8-16.6 19.8-29.6V32c0-17.7-14.3-32-32-32H352zM80 32C35.8 32 0 67.8 0 112V432c0 44.2 35.8 80 80 80H400c44.2 0 80-35.8 80-80V320c0-17.7-14.3-32-32-32s-32 14.3-32 32V432c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16H192c17.7 0 32-14.3 32-32s-14.3-32-32-32H80z"/></svg>
                    </div>
                    <div class="text_icon_conf">Share</div>
                </div>
            </div>
        </div>
    </div>
    </article>
</div>

<?php if($key % 2 == 0){?>
            <div class="ad-container col" id="dummy-ad" style="margin-bottom:25px">
                <img src="https://via.placeholder.com/1050x190" alt="Dummy Ad"  style="border-radius:10px">
            </div>
<?php } ?>
<?php if($key == 5){?>
            <div class="ad-container col" id="dummy-ad" style="margin-bottom:20px">
                <img src="https://via.placeholder.com/1050x190" alt="Dummy Ad"  style="border-radius:10px">
            </div>
<?php } ?>
<?php */ ?>
<?php } ?>
</div>
<?php echo $links; ?>
                                </div>
         <div class="col-lg-4 order-lg-2">
            <?php include("common/blog_sidebar.php"); ?>
         </div>
    </div>
  </div>
</section>
</div>

<?php include("common/footer.php"); ?>

<!-- SIGNUP POPUP -->
<div class="outer_wrap" id="blog_popup">
   <div class="outer_wrap_inner">
      <div class="center_wd_custom">
         <div class="close_poup" onclick="close_popup()">
            <i class="fa fa-close"></i>
         </div>
         <main id="main" class="site-main">
            <article id="post-8" class="post-8 page type-page status-publish hentry">
               <div class="">
                  <div class="entry-content">
                     <div class="rtcl">
                        <div class="row registration-disable registration-not-separate" id="rtcl-user-login-wrapper">
                           <div class="wd100">
                              <h2 class="text-center">POST FORUM</h2>
                              <div class="text_blog_div">
                                <?php
                                        $settings = $this->db->get('settings')->row();
                                        echo $settings->forum_rules;
                                ?>
                              </div>
                              <div class="button_blog">
                                  <button onclick="close_popup()" class="ff-btn ff-btn-submit ff-btn-md  ff_btn_no_style custom_bord_conf btn ">I'll do it later</button>
                                      <a href="<?php echo base_url();?>post-forum" class="ff-btn ff-btn-submit ff-btn-md item-btn ff_btn_no_style btn btn-primary wd60 postForumBtn">Post Your Forum</a>
                                  </a>
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
<!-- SIGNUP POPUP ENDS -->


<!-- SIGNUP POPUP -->
<div class="outer_wrap" id="confession_nsfw">
   <div class="outer_wrap_inner">
      <div class="center_wd_custom">
         <div class="close_poup" onclick="close_popup()">
            <i class="fa fa-close"></i>
         </div>
         <main id="main" class="site-main">
            <article id="post-8" class="post-8 page type-page status-publish hentry">
               <div class="abc_ccc">
                  <div class="entry-content">
                     <div class="rtcl">
                        <div class="tencomtent">
                            <img src="<?php echo base_url();?>18plus.svg">
                            <span class="headig_mature">Mature Content</span>
                        </div>
                        <div class="center_msfw_tex">
                            This page may contain mature or adult content. To continue, log in to your account or confirm you’re over 18.
                        </div>
                        <div class="center_msfw_tex">
                            By continuing, you also agree that use of this site constitutes acceptance of NepState User Agreement and acknowledgement of our Privacy Policy.
                        </div>

                        <div class="button_blog" style="margin-top:40px; margin-bottom: 20px;">
                            <button onclick="window.location.href='<?php echo base_url();?>'" class="btn_conf">Home</button>
                            <a class="id_btn_nsfw" href=""><button class="btn_conf">Yes, I’m Over 18</button></a>
                          </a>
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

<script type="text/javascript">
    function do_show_popup_blog_post(){
        <?php if(!isset($_SESSION['LISTYLOGIN'])){ ?>
            jQuery("#signup_popup").show();
        <?php } else { ?>
            jQuery("#blog_popup").show();
        <?php } ?>
    }

    function do_show_order_by_sort(val){
        if(val == ""){
           window.location.href = "<?php echo base_url();?>forums";
        } else {
           window.location.href = "<?php echo base_url();?>forums?sort="+val;
        }
    }

    function do_check(){
      if(jQuery("#serhcj").val() == ""){
         window.location.href = '<?php echo base_url();?>forums';
      }
    }

    function show_nsfw_content(url) {
        jQuery(".outer_wrap").hide();
        jQuery("#confession_nsfw").show();
        jQuery(".id_btn_nsfw").attr("href", url);
    }
</script>