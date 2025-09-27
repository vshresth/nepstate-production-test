<?php include("common/header.php"); 
if(!isset($_SESSION['LISTYLOGIN'])){
    $_SESSION['RETURN'] = "blog"; 

    
} 


?>
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
                <?php if(isset($_SESSION['LISTYLOGIN'])){?>Post your Blog....<?php } else { echo "<span style='color:red'>Login to post your blog....</span>"; } ?>
           </div>
        </div>
    </div>
<?php /* ?>
<section class="breadcrumbs-banner">
   <div class="container">
      <div class="breadcrumbs-area">
         <h1 class="heading-title">Blog</h1>
      </div>
   </div>
</section>
<?php */ ?>
<section class="blog-posts-layout bg--accent" style="padding-top: 65px;">
   <div class="listing-breadcrumb listing-archive-page">
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
                  <a href="<?php echo base_url();?>blog" property="itemListElement" typeof="ListItem">
                     <span property="name" class="archive post-rtcl_listing-archive current-item">Blog</span>
                  </a>
               <?php } ?>
               &gt; 
               <a href="<?php echo base_url();?>blog"  property="itemListElement" typeof="ListItem">
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
     

      <div class="row justify-content-center gutters-40"  style="margin: 0 15px;">
         <div class="col-lg-12 order-lg-1">
          <div class="rtcl-listings-actions">
                  <div class="rtcl-result-count">
                    Showing <?php echo count($blogs);?> result(s)
                  </div>
                  <select name="orderby" class="orderby" aria-label="Blog order" onchange="do_show_order_by_sort(this.value)" style="width:25%">
                           <option value="" <?php if(!isset($_GET['sort'])){echo "SELECTED";}?>>Newest</option>
                           <option value="date-asc" <?php echo isset($_GET['sort']) && $_GET['sort'] == "date-asc"?"SELECTED":"";?>>Oldest</option>
                           <option value="title-asc" <?php echo isset($_GET['sort']) && $_GET['sort'] == "title-asc"?"SELECTED":"";?>>A to Z ( title )</option>
                           <option value="title-desc" <?php echo isset($_GET['sort']) && $_GET['sort'] == "title-desc"?"SELECTED":"";?>>Z to A ( title )</option>
                           
                   </select>
            </div>
         </div>
         <div class="col-lg-8 order-lg-1">
            <?php 
            if(empty($blogs)){
                  echo "<div class='no_blog'>
                        No Blog Found! Be the first one to post a blog!
                  </div>";
               }
            ?>
            <div class="row row-cols-1 row-cols-lg-1 row-cols-md-1">
               <?php 
               
               foreach($blogs as $key => $blog) {
                  $user = $this->db->query("SELECT * FROM users WHERE id = ".$blog->uID)->result_object()[0];
                  if($user->g_id!=""){
                     $url_image = $user->profile_pic;
                  } else {
                     $url_image = $user->profile_pic;
                  }
               ?>
                  <div class="col" onclick="window.location.href='<?php echo base_url();?>blog/details/<?php echo $blog->slug;?>'" style="cursor: pointer;">
                     <article id="post-3732" class="blog-box-layout1 blog-list  post-3732 post type-post status-publish format-standard has-post-thumbnail hentry category-travel tag-cafe tag-travel have-post-thumb">
                        <div class="post-thumb custom_blog_thumb"  >
                           <a href="<?php echo base_url();?>blog/details/<?php echo $blog->slug;?>"><img width="860" height="460" src="<?php echo $blog->image;?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" decoding="async" srcset="<?php echo $blog->image;?> 350w" sizes="(max-width: 860px) 100vw, 860px" title=""></a>
                           <div class="blog-block__tag">
                                 <a rel="category tag">NSB#
                                    <?php $segment =  $this->uri->segment(2); ?>
                                    <?php
                                     if($segment == null) {
                                        echo $key + 1;
                                    }else{
                                       echo $segment + $key + 1;
                                    } 
                                    ?></a>            
                           </div>
                        </div>
                        <div class="post-content">
                           <ul class="entry-meta">
                              <li class="entry-admin">
                                 <span class="meta-icon custom_icon_blog"><img alt="" src="<?php echo $url_image;?>" srcset="<?php echo $url_image;?> 2x" class="avatar avatar-25 photo" height="25" width="25" decoding="async"></span>
                                 <span>by</span><a><?php echo $blog->author;?></a>
                              </li>
                              <li class="entry-date">
                                 <span class="meta-icon"><i class="far fa-clock"></i></span><?php echo date("F, d Y", strtotime($blog->created_at));?>   (<small><?php echo time_elapsed_string_header($blog->created_at); ?></small>)
                              </li>
                              
                           </ul>
                           <h3 class="post-title" style="margin-top:18px"><a href="<?php echo base_url();?>blog/details/<?php echo $blog->slug;?>"><?php echo $blog->title;?></a></h3>
                           <div class="content">
                              <p><?php 
$tags_strip = strip_tags($blog->description);
echo (strlen($tags_strip) > 200) ? substr($tags_strip, 0, 200) . "..." : $tags_strip;
?>
</p>
                           </div>
                           <div class="btn-wrap btn-v2">
                              <a href="<?php echo base_url();?>blog/details/<?php echo $blog->slug;?>" class="item-btn">
                                 <span class="btn__icon">
                                    <svg width="20" height="20" viewbox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M1.25 10C1.25 12.3206 2.17187 14.5462 3.81282 16.1872C5.45376 17.8281 7.67936 18.75 10 18.75C12.3206 18.75 14.5462 17.8281 16.1872 16.1872C17.8281 14.5462 18.75 12.3206 18.75 10C18.75 7.67936 17.8281 5.45376 16.1872 3.81282C14.5462 2.17187 12.3206 1.25 10 1.25C7.67936 1.25 5.45376 2.17187 3.81282 3.81282C2.17187 5.45376 1.25 7.67936 1.25 10ZM20 10C20 12.6522 18.9464 15.1957 17.0711 17.0711C15.1957 18.9464 12.6522 20 10 20C7.34784 20 4.8043 18.9464 2.92893 17.0711C1.05357 15.1957 0 12.6522 0 10C0 7.34784 1.05357 4.8043 2.92893 2.92893C4.8043 1.05357 7.34784 0 10 0C12.6522 0 15.1957 1.05357 17.0711 2.92893C18.9464 4.8043 20 7.34784 20 10ZM5.625 9.375C5.45924 9.375 5.30027 9.44085 5.18306 9.55806C5.06585 9.67527 5 9.83424 5 10C5 10.1658 5.06585 10.3247 5.18306 10.4419C5.30027 10.5592 5.45924 10.625 5.625 10.625H12.8663L10.1825 13.3075C10.1244 13.3656 10.0783 13.4346 10.0468 13.5105C10.0154 13.5864 9.99921 13.6678 9.99921 13.75C9.99921 13.8322 10.0154 13.9136 10.0468 13.9895C10.0783 14.0654 10.1244 14.1344 10.1825 14.1925C10.2406 14.2506 10.3096 14.2967 10.3855 14.3282C10.4614 14.3596 10.5428 14.3758 10.625 14.3758C10.7072 14.3758 10.7886 14.3596 10.8645 14.3282C10.9404 14.2967 11.0094 14.2506 11.0675 14.1925L14.8175 10.4425C14.8757 10.3844 14.9219 10.3155 14.9534 10.2395C14.9849 10.1636 15.0011 10.0822 15.0011 10C15.0011 9.91779 14.9849 9.83639 14.9534 9.76046C14.9219 9.68453 14.8757 9.61556 14.8175 9.5575L11.0675 5.8075C11.0094 5.74939 10.9404 5.70329 10.8645 5.67185C10.7886 5.6404 10.7072 5.62421 10.625 5.62421C10.5428 5.62421 10.4614 5.6404 10.3855 5.67185C10.3096 5.70329 10.2406 5.74939 10.1825 5.8075C10.1244 5.86561 10.0783 5.9346 10.0468 6.01052C10.0154 6.08644 9.99921 6.16782 9.99921 6.25C9.99921 6.33218 10.0154 6.41356 10.0468 6.48948C10.0783 6.5654 10.1244 6.63439 10.1825 6.6925L12.8663 9.375H5.625Z" fill="white"></path>
                                    </svg>
                                 </span>
                                 <span class="btn__text">Read More</span>
                                 <span class="btn__icon">
                                    <svg width="20" height="20" viewbox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M1.25 10C1.25 12.3206 2.17187 14.5462 3.81282 16.1872C5.45376 17.8281 7.67936 18.75 10 18.75C12.3206 18.75 14.5462 17.8281 16.1872 16.1872C17.8281 14.5462 18.75 12.3206 18.75 10C18.75 7.67936 17.8281 5.45376 16.1872 3.81282C14.5462 2.17187 12.3206 1.25 10 1.25C7.67936 1.25 5.45376 2.17187 3.81282 3.81282C2.17187 5.45376 1.25 7.67936 1.25 10ZM20 10C20 12.6522 18.9464 15.1957 17.0711 17.0711C15.1957 18.9464 12.6522 20 10 20C7.34784 20 4.8043 18.9464 2.92893 17.0711C1.05357 15.1957 0 12.6522 0 10C0 7.34784 1.05357 4.8043 2.92893 2.92893C4.8043 1.05357 7.34784 0 10 0C12.6522 0 15.1957 1.05357 17.0711 2.92893C18.9464 4.8043 20 7.34784 20 10ZM5.625 9.375C5.45924 9.375 5.30027 9.44085 5.18306 9.55806C5.06585 9.67527 5 9.83424 5 10C5 10.1658 5.06585 10.3247 5.18306 10.4419C5.30027 10.5592 5.45924 10.625 5.625 10.625H12.8663L10.1825 13.3075C10.1244 13.3656 10.0783 13.4346 10.0468 13.5105C10.0154 13.5864 9.99921 13.6678 9.99921 13.75C9.99921 13.8322 10.0154 13.9136 10.0468 13.9895C10.0783 14.0654 10.1244 14.1344 10.1825 14.1925C10.2406 14.2506 10.3096 14.2967 10.3855 14.3282C10.4614 14.3596 10.5428 14.3758 10.625 14.3758C10.7072 14.3758 10.7886 14.3596 10.8645 14.3282C10.9404 14.2967 11.0094 14.2506 11.0675 14.1925L14.8175 10.4425C14.8757 10.3844 14.9219 10.3155 14.9534 10.2395C14.9849 10.1636 15.0011 10.0822 15.0011 10C15.0011 9.91779 14.9849 9.83639 14.9534 9.76046C14.9219 9.68453 14.8757 9.61556 14.8175 9.5575L11.0675 5.8075C11.0094 5.74939 10.9404 5.70329 10.8645 5.67185C10.7886 5.6404 10.7072 5.62421 10.625 5.62421C10.5428 5.62421 10.4614 5.6404 10.3855 5.67185C10.3096 5.70329 10.2406 5.74939 10.1825 5.8075C10.1244 5.86561 10.0783 5.9346 10.0468 6.01052C10.0154 6.08644 9.99921 6.16782 9.99921 6.25C9.99921 6.33218 10.0154 6.41356 10.0468 6.48948C10.0783 6.5654 10.1244 6.63439 10.1825 6.6925L12.8663 9.375H5.625Z" fill="white"></path>
                                    </svg>
                                 </span>
                              </a>
                           </div>
                        </div>
                     </article>
                  </div>
               <?php } ?>
               
            </div>

            <?php echo $links; ?>
            <!-- <div class="pagination">
               <ul>
                  <li class="active"><a href="<?php echo base_url();?>blog">1</a></li>
                  <li><a href="<?php echo base_url();?>blog">2</a></li>
                  <li><a href="<?php echo base_url();?>blog">3</a></li>
                  <li><a href="<?php echo base_url();?>blog">5</a></li>
                  <li class="next"><a href="<?php echo base_url();?>blog"><i class="fa-solid fa-angle-right" aria-hidden="true"></i></a></li>
               </ul>
            </div> -->
         </div>
         <div class="col-lg-4 order-lg-2">
            <?php include("common/blog_sidebar.php"); ?>
         </div>
      </div>
   </div>
</section>
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
                           <div class="">
                              <h2 class="text-center">POST BLOG</h2>
                              <div class="text_blog_div">
                                <p>
                                  We kindly request the submission of your blog for potential feature of you blog on our website. All submitted blogs will undergo a comprehensive review process to ensure they adhere to our content guidelines. Please be aware that our administrative team retains the exclusive authority to decide whether to publish or remove submitted blogs.
                                </p>
                                <p>
                                    To proceed with the submission process, please select "Post your blog" to access the next section, where you can either type your blog directly or copy and paste it, including any accompanying images, into the comment section.
                                </p>
                                <p>
                                    Upon completion of the administrative review, your blog will either be published on our platform or declined based on its content. Should adjustments be necessary, we may communicate via email to guide you through the necessary revisions.
                                </p>
                                <p>
                                    Once your blog is successfully published, we will credit your authorship by tagging your name within the blog, and you will receive notifications accordingly. Thank you for considering the opportunity to contribute to our platform.
                                </p>
                              </div>
                              <div class="button_blog">
                                  <button onclick="close_popup()" class="ff-btn ff-btn-submit ff-btn-md  ff_btn_no_style custom_bord_conf btn ">I'll do it later</button>
                                      <a href="<?php echo base_url();?>post-blog" class="ff-btn ff-btn-submit ff-btn-md item-btn ff_btn_no_style btn btn-primary wd60">Post Your Blog</a>
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
           window.location.href = "<?php echo base_url();?>blog";
        } else {
           window.location.href = "<?php echo base_url();?>blog?sort="+val;
        }
    }

    function do_check(){
      if(jQuery("#serhcj").val() == ""){
         window.location.href = '<?php echo base_url();?>blog';
      }
    }
</script>