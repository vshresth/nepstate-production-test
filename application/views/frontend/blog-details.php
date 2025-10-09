<?php
if (!isset($_SESSION['LISTYLOGIN'])) {
    $segments = [];
    for ($i = 1; $i <= 3; $i++) {
        $segment = $this->uri->segment($i);
        if (!empty($segment)) {
            $segments[] = $segment;
        }
    }
    if (!empty($segments)) {
        $_SESSION['RETURN'] = implode('/', $segments);
    }
}

 
?>

<?php 
	if($this->uri->segment(1)== "confession"){
		$table_name = 'confessions';
		$c_table_name = 'confession_comment';
		$show_image = 0;
		$url_comment_post = 'post_comment_confession';
	} else if($this->uri->segment(1)== "blog"){
		$table_name = 'blogs';
		$c_table_name = 'blog_comment';
		$show_image = 1;
		$url_comment_post = 'post_comment_blog';
	}
	else if($this->uri->segment(1)== "forum"){
		$table_name = 'confessions';
		$c_table_name = 'confession_comment';
		$show_image = 1;
		$url_comment_post = 'post_comment_confession';
	}

	$row = $this->db->query("SELECT * FROM ".$table_name." WHERE slug = '".$slug."' AND (status =  1 OR status = 0)")->result_object()[0];

	if(empty($row)) {
		redirect(base_url());
	}

	// Set SEO variables for Open Graph (social media sharing) - BEFORE header include
	// Determine content type and set appropriate titles and URLs
	if($this->uri->segment(1) == "confession"){
		$content_type = 'Confession';
		$content_type_lower = 'confession';
		$canonical_url = base_url() . 'confession/details/' . $row->slug;
		$default_keywords = 'Nepalese confessions, Nepal community, Nepali stories';
	} else if($this->uri->segment(1) == "forum"){
		$content_type = 'Forum';
		$content_type_lower = 'forum';
		$canonical_url = base_url() . 'forum/details/' . $row->slug;
		$default_keywords = 'Nepalese forums, Nepal discussions, Nepali community';
	} else {
		$content_type = 'Blog';
		$content_type_lower = 'blog';
		$canonical_url = base_url() . 'blog/details/' . $row->slug;
		$default_keywords = 'Nepalese blog, Nepal news, Nepali community';
	}
	
	$page_title = htmlspecialchars($row->title) . ' - NepState ' . $content_type;
	$meta_description = !empty($row->description) ? htmlspecialchars(strip_tags($row->description)) : htmlspecialchars(substr(strip_tags($row->content), 0, 160) . '...');
	$meta_keywords = !empty($row->tags) ? htmlspecialchars($row->tags) : $default_keywords;
	
	// Add cache-busting parameter for social media scraping
	$cache_buster = '?v=' . time();
	
	// Enhanced image handling for Open Graph
	$og_image = '';
	if (!empty($row->image)) {
		$raw_image = trim($row->image);
		
		// For social media compatibility, use a simple approach
		if (preg_match('/^https?:\/\//', $raw_image)) {
			// Keep the admin domain but fix URL encoding for special characters
			$og_image = str_replace(' ', '%20', $raw_image);
			$og_image = str_replace('(', '%28', $og_image);
			$og_image = str_replace(')', '%29', $og_image);
			
			// Add cache buster to force Facebook to re-scrape
			$og_image .= '?v=' . time();
			
			// Test if the encoded image is accessible (without cache buster for testing)
			$test_url = str_replace('?v=' . time(), '', $og_image);
			$headers = @get_headers($test_url);
			$is_accessible = $headers && strpos($headers[0], '200') !== false;
			
			if (!$is_accessible) {
				// If encoded image not accessible, use fallback
				$og_image = 'https://nepstate.com/images/logo/1739511638.png';
			}
		} else {
			// If it's a relative path, make it absolute
			$og_image = base_url() . ltrim($raw_image, '/');
		}
	} else {
		// Fallback to working logo - Facebook doesn't support data URIs
		// Use the admin logo which we know works and meets size requirements
		$og_image = 'https://admin.nepstate.com/images/logo/1739511638.png';
	}
	
	// Set Open Graph type based on content type
	$og_type = ($content_type_lower == 'confession') ? 'article' : 'article';
	
	// Test if image is accessible (for debugging)
	$image_accessible = false;
	if (!empty($og_image) && filter_var($og_image, FILTER_VALIDATE_URL)) {
		$headers = @get_headers($og_image);
		$image_accessible = $headers && strpos($headers[0], '200') !== false;
	}
	
	// DEBUG: Show final OG image URL
	echo "<!-- FINAL OG IMAGE URL: " . $og_image . " -->";
?>

<?php include("common/header.php"); ?>
<div data-elementor-type="wp-page" data-elementor-id="10" class="elementor elementor-10" style="margin-top: 20px;">
	<?php include("common/header_full.php"); ?>

	<?php if($this->uri->segment(1) == "confession" || $this->uri->segment(1) == "forum" || $this->uri->segment(1) == "blog"){?>
		<div class="container-fluid custom-padding">
	       <div class="blog_posting_div" onclick="do_show_popup_blog_post()">
	            <?php 
	            $image_append = base_url()."resources/uploads/profiles/";
	            if(!isset($_SESSION['LISTYLOGIN'])){
	                $image_user = $image_append."dummy_image.png";
	            } else {
	                if(user_info()->g_id != ""){
	                    $image_user = user_info()->profile_pic;
	                } else  {
	                    $image_user = user_info()->profile_pic;
	                }
	            }
	            ?>
	            <img src="<?php echo $image_user; ?>">
	            <div class="blog_posting_text">
	                <?php if(isset($_SESSION['LISTYLOGIN'])){?>Post your <?php echo $this->uri->segment(1);?>....<?php } else { echo "<span style='color:red'>Login to post your ".$this->uri->segment(1)."....</span>"; } ?>
	           </div>
	        </div>
	    </div>
	<?php } ?>
</div>

<?php 
	$user = $this->db->query("SELECT * FROM users WHERE id = ".$row->uID)->result_object()[0];
	if($user->g_id!=""){
	   $url_image = $user->profile_pic;
	} else {
	   $url_image = $uploads."profiles/".$user->profile_pic;
	}
	$final_url = base_url()."blog/details/".$row->slug;
	$comments_count = $this->db->query("SELECT * FROM ".$c_table_name." WHERE bID = ".$row->id)->num_rows();

	$ip_address = getenv("REMOTE_ADDR");

	if($this->uri->segment(1)== "confession"){
		$bread_name = 'Confession';
		$url_bread = 'confessions';
		$name_bread_end = $row->title;
		$like_link = 'like_confession';
		$dislike_link = 'dislike_confession';
		$like_table = 'confession_likes';

		$add_view = $this->db->query("SELECT * FROM confession_views WHERE cID = '".$row->id."' AND ip_address = '".$ip_address."'")->num_rows();
		if($add_view == 0){
				$arr = array(
					'cID' => $row->id,
					'ip_address'=> $ip_address,
					'type' => 2
				);
				$this->db->insert('confession_views',$arr);
		}

	} else if($this->uri->segment(1)== "forum"){
		$bread_name = 'Forums';
		$url_bread = 'forums';
		$name_bread_end = $row->title;
		$like_link = 'like_forum';
		$like_table = 'confession_likes';
		$dislike_link = 'dislike_forum';

		$add_view = $this->db->query("SELECT * FROM confession_views WHERE cID = '".$row->id."' AND ip_address = '".$ip_address."'")->num_rows();
		if($add_view == 0){
				$arr = array(
					'cID' => $row->id,
					'ip_address'=> $ip_address,
					'type' => 1
				);
				$this->db->insert('confession_views',$arr);
		}
	} else if($this->uri->segment(1)== "blog"){
		$bread_name = 'Blog';
		$url_bread = 'blog';
		$name_bread_end = 'NSB#'.$row->id;
		$like_link = 'like';
		$like_table = 'blog_likes';
		$dislike_link = 'dislike';
	}
	
?>

<section class="blog-details-page bg--accent">
	<div class="listing-breadcrumb listing-archive-page" style="margin-bottom: -15px;">
      <div class="container-fluid custom-padding">
         <div class="breadcrumb-area">
            <div class="entry-breadcrumb">
               <!-- Breadcrumb NavXT 7.2.0 -->
               <span property="itemListElement" typeof="ListItem">
                  <a property="item" typeof="WebPage" title="" href="<?php echo base_url();?>" class="home"><span property="name">Home</span></a>
                  <meta property="position" content="1">
               </span>
               &gt; 
               <span property="itemListElement" typeof="ListItem">
	               	<a href="<?php echo base_url();?><?php echo $url_bread; ?>">
	                  <span property="name" class="archive post-rtcl_listing-archive current-item"><?php echo $bread_name; ?></span>
	              	</a>
               </span>
               &gt; 
               <span property="itemListElement" typeof="ListItem">
	               	<a href="<?php echo base_url();?><?php echo $url_bread; ?>">
	                  <span property="name" class="archive post-rtcl_listing-archive current-item"><?php echo $name_bread_end;?></span>
	              	</a>
               </span>
            </div>
         </div>
      </div>
   </div>
    <div class="container" transform: none;>
        <div class="row  gutters-40" style="margin: 0 15px;">

<div class="col-lg-8 order-lg-1">
<h2 style="    width: 100%; font-size: 24px;
    clear: both;
    float: left;"><?php echo $row->title;?></h2>
</div>
        	
            <div class="col-lg-8 order-lg-1">

                <div id="main" class="site-main">

											
<article id="post-3732" class="single-blog-wrap post-3732 post type-post status-publish format-standard has-post-thumbnail hentry category-travel tag-cafe tag-travel have-post-thumb">
     	<?php if($show_image == 1){ ?>
	        <div class="single-blog-thumb custom_blog_thumb"><img width="860" height="460" src="<?php if($row->image == ''){echo settings()->site_logo;} else { echo $row->image;}?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" decoding="async" srcset=" <?php if($row->image == ''){echo settings()->site_logo;} else { echo $row->image;}?> 350w" sizes="(max-width: 860px) 100vw, 860px" title="">
	        	<?php if($this->uri->segment(1)== "blog"){ ?>
	        	<div class="blog-block__tag">
	                     <a rel="category tag">NSB#<?php echo $row->id;?></a>            
	               </div>
	           <?php } ?>
	        </div>
	    <?php } ?>


        <div class="single-content-wrap">
        	 
        <div class="single-blog-entry">
	       	<ul class="entry-meta"> 
		        <li class="entry-admin">
		        	<?php if($this->uri->segment(1) != "confession"){ ?>
			          <span class="meta-icon custom_icon_blog"><img alt="" src="<?php echo $url_image;?>" srcset="<?php echo $url_image;?> 2x" class="avatar avatar-25 photo"  decoding="async"></span>
			      <?php } ?>
		          <span>by</span><a><?php echo $row->author;?></a>
		        </li>
		        <li class="entry-date">
		          <span class="meta-icon"><i class="far fa-clock"></i></span><?php echo date("F, d Y", strtotime($row->created_at));?>   (<small><?php echo time_elapsed_string_header($row->created_at); ?></small>)
		      	</li>
		        <li class="entry-comments">
		          <span class="meta-icon"><i class="far fa-comments"></i></span><?php echo $comments_count; ?> Comment<?php echo $comments_count==1?"":"s";?>        
		      	</li>
		      	
	        </ul>
        </div>
        <div class="single-blog-details">
			<?php echo $row->description; ?>        		
        </div>

        <div class="like_flex">
        	<?php 
        		$class_show = "";
        		$likes = $this->db->query("SELECT * FROM ".$like_table." WHERE likebg = 1 AND bID = ".$row->id)->num_rows(); 
        		if(isset($_SESSION['LISTYLOGIN'])){
	        		$likes_user = $this->db->query("SELECT * FROM ".$like_table." WHERE likebg = 1 AND uID = ".user_info()->id." AND bID = ".$row->id)->num_rows(); 
	        		$dislikes_user = $this->db->query("SELECT * FROM ".$like_table." WHERE likebg = 2 AND uID = ".user_info()->id." AND bID = ".$row->id)->num_rows(); 
	        		if($likes_user == 1){
	        			$class_show = "orange";
	        		}
	        		if($dislikes_user == 1){
	        			$class_show_dis = "orange";
	        		}
	        	}
        		$dislikes = $this->db->query("SELECT * FROM ".$like_table." WHERE likebg = 2 AND bID = ".$row->id)->num_rows(); 
        	?>
    		<a href="<?php echo base_url().'nepstate/'.$like_link.'/'.$row->id;?>" class="<?php echo $class_show; ?>">
        		<i class="fa-regular fa-thumbs-up"></i> (<?php echo $likes; ?>)
        	</a>
        	<a href="<?php echo base_url().'nepstate/'.$dislike_link.'/'.$row->id;?>" class="<?php echo $class_show_dis; ?>">
        		<i class="fa-regular fa-thumbs-down"></i> (<?php echo $dislikes; ?>)
        	</a>
			<a href="javascript:void(0)" class="share-link"><div class="icon_box_wrap" onclick="do_show_share(<?php echo $row->id;?>)">
                    <div class="svg_conf">
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><path d="M352 0c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9L370.7 96 201.4 265.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L416 141.3l41.4 41.4c9.2 9.2 22.9 11.9 34.9 6.9s19.8-16.6 19.8-29.6V32c0-17.7-14.3-32-32-32H352zM80 32C35.8 32 0 67.8 0 112V432c0 44.2 35.8 80 80 80H400c44.2 0 80-35.8 80-80V320c0-17.7-14.3-32-32-32s-32 14.3-32 32V432c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16H192c17.7 0 32-14.3 32-32s-14.3-32-32-32H80z"/></svg>
                    </div>
                     <div class="text_icon_conf" >Share</div>
				
    		</div></a>

			<div class="show_share_button_<?php echo $row->id;?>" style="visibility: hidden; margin-left: 2px;">
                    <div class="sharethis-inline-share-buttons" data-title="<?php echo $row->slug;?>" data-url="<?php echo base_url();?><?php echo $this->uri->segment(1);?>/details/<?php echo $row->slug;?>"></div>
                </div>

        </div>

        <div class="single-blog-footer  ">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="blog-tags">
                    	<?php $tags = explode(",", $row->tags);
                    	foreach ($tags as $key => $tg) {
                    	?>
	                        <a href="#" rel="tag" style="text-transform: capitalize;"><?php echo $tg; ?></a> 
	                    <?php } ?>
                    </div>
                </div>
   			</div>
    	</div>  
	</div>
    
            <div class="blog-comment-form">
        <div id="comments" class="comments-area single-blog-form">
        <link rel="stylesheet" type="text/css" href="<?php echo $assets;?>assets/css/app.css?ver=1686243998">
    
        <div class="reply-separator"></div>
        	<?php $reviews = $this->db->query("SELECT * FROM ".$c_table_name." WHERE bID = ".$row->id)->result_object(); ?>
        	<div class="comments_div">
        		
        		<?php if(!empty($reviews)){?>
        			<h3>Comments</h3>
		            <div class="rtrs-review-box">
		                <ul class="rtrs-review-list"> 
		                    <?php 
		                        foreach($reviews as $rk => $rev){
		                            $ureview = $this->db->query("SELECT * FROM users WHERE id = ".$rev->uID)->result_object()[0];
		                    ?>
		                        <li class="review even thread-even depth-1  rtrs-main-review" id="div-comment-12"> 
		                            <div class="rtrs-each-review  "> 
		                                    <div class="rtrs-review-imgholder">
		                                        <img src="<?php echo $ureview->g_id!=""?$ureview->profile_pic: $ureview->profile_pic;?>" alt="" class="image_64">
		                                    </div> 
		                                    <div class="rtrs-review-body"> 
		                                        <ul class="rtrs-review-meta">  
	                                                <li class="rtrs-author-link">
	                                                   <?php echo $ureview->name;?>
	                                                </li>
	                                                <li class="rtrs-review-date"><i class="rtrs-calendar"></i> 
	                                                   <?php echo time_elapsed_string_header($rev->created_at);?>       
	                                                </li>
		                                        </ul>
		                                        <p class="blog_comemnt_des">
		                                            <?php echo $rev->comment;?>
		                                        </p>
		                                    </div>
		                            </div>   
		                        </li><!-- #comment-## -->      
		                    <?php } ?>
		                </ul>
		            </div> 
		        <?php } ?>
        	</div>
	    	<div id="respond" class="comment-respond">
				<h3 id="reply-title" class="comment-reply-title">Leave a Comment </h3>
				
				<!-- 
				<?php
				//  if(isset($_SESSION['LISTYLOGIN'])){
					?>
					 -->
					<form action="<?php echo base_url();?>nepstate/<?php echo $url_comment_post; ?>" method="post" id="commentform" class="comment-form">
							<p class="comment-notes"><span id="email-notes">Your email address will not be published.</span> </span></p>
							<div class="form-group comment-form-comment">
								<textarea id="comment" name="comment" required placeholder="Your Comment..." class="textarea form-control" ></textarea>
							</div>
							<div class="form-submit">
								<div class="form-btn"><button type="submit" class="custom_button_popup">Post Comment</button></div> 
								<input type="hidden" name="post_id" value="<?php echo $row->id;?>" id="post_id">
								<input type="hidden" name="post_type" value="<?php echo $url_bread;?>" id="post_type">
							</div>
					</form>	
				<!-- <?php
			//  } else {
				 ?>
					<div class="text-center" style="margin-top:40px">
		                Please login to post a comment!
		            </div>
				<?php 
			// }
			 ?> -->

			</div>
<!-- #respond -->
	</div>  
    </div>
    </article>									</div>
            </div>
            <div class="col-lg-4 order-lg-2">
				<?php include("common/blog_sidebar.php"); ?>
			</div>
        </div>
    </div>

<?php 
if($this->uri->segment(1)=="blog"){
                	$qry_related = "";
                	if($row->tags != ""){
                		$tags_related = explode(",",$row->tags); 
                		$qry_related .=  " AND (";
                		foreach($tags_related as $rk=>$tr){
                			$t = $rk>0?" OR ":"";
                			$qry_related .= $t." FIND_IN_SET('".$tr."', tags) > 0 ";
                		}
                		$qry_related .=  " )";

                	}
                	$related_blog = $this->db->query("SELECT * FROM blogs WHERE status = '1' ".$blog_forum_confession_condition_query." AND slug != '".$slug."' ".$qry_related." ORDER BY RAND() LIMIT 3")->result_object();
                	
					
					
					// echo $this->db->last_query();
                	if(!empty($related_blog)){
                ?>
<div class="related-post-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="related-listing-header">
                    <div class="section-heading">
                        <h4>Related Blogs</h4>    
                    </div>
                </div>

                

                <div class="section-title-wrapper">
                    <div class="row">
                    	<?php foreach ($related_blog as $key => $rblog) { 
                    		 $user = $this->db->query("SELECT * FROM users WHERE id = ".$rblog->uID)->result_object()[0];
                    	?>
            			<div class="col-lg-4 col-md-6">
            				<article id="post-3719" class="blog-box-layout2 blog-grid  post-3719 post type-post status-publish format-standard has-post-thumbnail hentry category-travel tag-cafe tag-travel have-post-thumb">
                                <div class="blog-block">
                                                                            <figure class="blog-block__figure">
                                            <a class="blog-block__link--image" href="#">
                                                <img width="350" height="420" src="<?php echo $rblog->image;?>" class="attachment-listygo-size-3 size-listygo-size-3 wp-post-image" alt="" decoding="async" title="">                                            </a>
                                        </figure>
                                        <div class="blog-block__content">
                                       
                                        <h3 class="blog-block__heading text-white bold-underline">
                                            <a href="<?php echo base_url();?>blog/details/<?php echo $rblog->slug;?>"><?php echo $rblog->title;?></a>
                                        </h3>
                                        <div class="blog-block__meta">
                                            <ul>
                                                <li>
                                                    <svg width="16" height="16" viewbox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.3125 4.375C12.3125 1.99375 10.3813 0.0625 8.00002 0.0625C5.61877 0.0625 3.68751 1.99375 3.68751 4.375C3.68751 6.75625 5.61877 8.6875 8.00002 8.6875C10.3813 8.6875 12.3125 6.75625 12.3125 4.375ZM4.81251 4.375C4.81251 2.6125 6.23752 1.1875 8.00002 1.1875C9.76252 1.1875 11.1875 2.6125 11.1875 4.375C11.1875 6.1375 9.76252 7.5625 8.00002 7.5625C6.23752 7.5625 4.81251 6.1375 4.81251 4.375Z" fill="white"></path>
													<path d="M0.781254 15.2877C0.875004 15.3439 0.968754 15.3627 1.0625 15.3627C1.25 15.3627 1.45625 15.2689 1.55 15.0814C2.8625 12.7564 5.3375 11.3126 8 11.3126C10.6625 11.3126 13.1375 12.7564 14.4688 15.0814C14.6188 15.3439 14.975 15.4377 15.2375 15.2877C15.5 15.1377 15.5938 14.7814 15.4438 14.5189C13.925 11.8564 11.075 10.1876 8 10.1876C4.925 10.1876 2.075 11.8564 0.556254 14.5189C0.406254 14.7814 0.500004 15.1377 0.781254 15.2877Z" fill="white"></path></svg>                                                    <span>
                                                        <a ><?php echo $user->name;?></a>
                                                    </span>
                                                </li>
                                                <li>
                                                    <svg width="17" height="19" viewbox="0 0 17 19" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M1.07715 7.17038H15.9304" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
													<path d="M12.2017 10.4248H12.2094" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
													<path d="M8.50384 10.4248H8.51156" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
													<path d="M4.79828 10.4248H4.806" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
													<path d="M12.2017 13.6635H12.2094" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
													<path d="M8.50384 13.6635H8.51156" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
													<path d="M4.79828 13.6635H4.806" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
													<path d="M11.8698 1V3.74232" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
													<path d="M5.13795 1V3.74232" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
													<path fill-rule="evenodd" clip-rule="evenodd" d="M12.0319 2.31592H4.9758C2.52856 2.31592 1 3.6792 1 6.18511V13.7265C1 16.2718 2.52856 17.6666 4.9758 17.6666H12.0242C14.4791 17.6666 16 16.2954 16 13.7895V6.18511C16.0077 3.6792 14.4868 2.31592 12.0319 2.31592Z" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
													</svg>                                                    <span><?php echo date("F, d Y", strtotime($rblog->created_at));?></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php } ?>
                                                
                                             
                                            </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }} ?>



</section>
<?php include("common/footer.php"); ?>

<script>
// Auto-scroll to blog content on page load (skip the banner ad at top)
jQuery(document).ready(function() {
    // Scroll to the main blog content section smoothly
    var blogSection = jQuery('.blog-details-page');
    if (blogSection.length) {
        jQuery('html, body').animate({
            scrollTop: blogSection.offset().top - 80 // 80px offset for fixed header if any
        }, 800); // 800ms smooth scroll duration
    }
});

function  do_show_share(val) {
        // jQuery(".show_share_button_"+val).css('visibility', 'visible');
        var shareButtonContainer = jQuery(".show_share_button_" + val);
        if (shareButtonContainer.is(":visible")) {
            shareButtonContainer.css('visibility', 'visible');
        } else {
            shareButtonContainer.css('visibility', 'hidden');
        }
    }

	function do_show_popup_blog_post(){
        <?php if(!isset($_SESSION['LISTYLOGIN'])){ ?>
            jQuery("#signup_popup").show();
        <?php } else { ?>
        	<?php if($this->uri->segment(1)=="confession"){
        		$url_submit = 'post-confession';
        	
			} else if($this->uri->segment(1) == 'blog') {
        		$url_submit = 'post-blog';
        	
			}else if($this->uri->segment(1) == 'forum') {
        		$url_submit = 'post-forum';
        	}
        	?>
            window.location.href="<?php echo base_url().$url_submit;?>";
        <?php } ?>
    }
</script>
