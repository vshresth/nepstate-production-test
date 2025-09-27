
<?php if($this->uri->segment(1)=="blog"){
   $url = "blog";
   $table = 'blogs';
   $text_ = 'Posts';
   $show_image_similar = 1;
   $details_url = 'blog';
   $adType = 6;
} else if($this->uri->segment(1)=="confessions" || $this->uri->segment(1)=="confession") {
   $url = "confessions";
   $table = 'confessions';
   $text_ = 'Confessions';
   $show_image_similar = 0;
   $details_url = 'confession';
   $adType = 8;
}
else if($this->uri->segment(1)=="forums" || $this->uri->segment(1)=="forum") {
   $url = "forums";
   $table = 'confessions';
   $text_ = 'Forums';
   $show_image_similar = 1;
   $details_url = 'forum';
   $adType = 7;
}
?>
<aside class="sidebar-widget-area right-sidebar">
               <div id="search-3" class="widget widget_search sidebar-widget">
                  <h3 class="widget-title">Search</h3>
                  <form role="search" method="post" class="search-form" action="<?php echo base_url();?><?php echo $url;?>">
                     <div class="input-group stylish-input-group">
                        <input onblur="do_check()" type="text" class="form-control" id="serhcj" placeholder="Search ..." value="<?php echo $_POST['s'];?>" required name="s" style="background: #fff; font-size: 13px; height: 50px;" autocomplete="off">
                        <span class="input-group-addon">
                           <button type="submit">
                              <svg width="20" height="20" viewbox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M9.58335 17.5C13.9556 17.5 17.5 13.9555 17.5 9.58329C17.5 5.21104 13.9556 1.66663 9.58335 1.66663C5.2111 1.66663 1.66669 5.21104 1.66669 9.58329C1.66669 13.9555 5.2111 17.5 9.58335 17.5Z" stroke="#6A6A6A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                 <path d="M18.3334 18.3333L16.6667 16.6666" stroke="#6A6A6A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                              </svg>
                           </button>
                        </span>
                     </div>
                  </form>
               </div>

               <?php if($this->uri->segment(1) == "confessions" || $this->uri->segment(1) == "confession"){ ?>
                 <div id="media_gallery-3" class="viewer-enabler widget widget_media_gallery sidebar-widget">
                  <h3 class="widget-title">Confession Rules</h3>
                  <div id="gallery-1" class="gallery galleryid-3732 gallery-columns-3 gallery-size-thumbnail confessionRulesBox">
                     <?php
                        $settings = $this->db->get('settings')->row();

                        echo $settings->confession_rules;
                     ?>
                  </div>
                  </div>
               <?php } ?>


               <?php
               if($this->uri->segment(1)=="blog"){

                 $similar = $this->db->query("SELECT * FROM blogs WHERE is_approved = 1 AND status = '1'  ".$blog_forum_confession_condition_query."  AND slug != '".$slug."' ORDER BY ID DESC LIMIT 4")->result_object();
              } else if($this->uri->segment(1)=="confessions" || $this->uri->segment(1)=="confession"){
               $similar = $this->db->query("SELECT * FROM confessions WHERE nsfw = 0 AND status = '1' ".$blog_forum_confession_condition_query." AND type ='confession' AND slug != '".$slug."' ORDER BY ID DESC LIMIT 4")->result_object();
              }
              else if($this->uri->segment(1)=="forums" || $this->uri->segment(1)=="forum"){
               $similar = $this->db->query("SELECT * FROM confessions WHERE nsfw = 0 AND status = '1' ".$blog_forum_confession_condition_query." AND type ='forum' AND slug != '".$slug."' ORDER BY ID DESC LIMIT 4")->result_object();
              }
                 if(!empty($similar)){
             ?>
               <div id="listygo_post-3" class="widget widget_listygo_post sidebar-widget">
                  <div class="widget-recent">
                     <h3 class="widget-title">Recent <?php echo $text_;?></h3>
                     <ul class="recent-post">
                        <?php 
                           foreach($similar as $k=>$srow){
                              $url_blog = base_url().$details_url."/details/".$srow->slug;
                        ?>
                        <li class="media" style="display: flex !important;">
                           <?php if($show_image_similar == 1){?>
                              <div class="item-img">
                                 <a href="<?php echo $url_blog;?>" class="item-figure">
                                 <img width="150" height="150" src="<?php  if($srow->image == ''){echo settings()->site_logo;}else{echo  $srow->image;}?>" class="attachment-thumbnail size-thumbnail wp-post-image"  alt=""  decoding="async" title="">
                                 </a>
                              </div>
                           <?php } ?>
                           <div class="media-body">
                              <h4 class="item-title"><a href="<?php echo $url_blog;?>"><?php echo substr($srow->title,0, 25)."...";?></a></h4>
                              <span>
                              <img src="<?php echo $assets;?>assets/images/icon-calendar.png" alt="Calendar">
                              <?php echo date("F, d Y", strtotime($srow->created_at));?>                              </span>
                           </div>
                        </li>
                        <?php } ?>
                     </ul>
                  </div>
               </div>
              <?php } ?>
             

               <?php 
                  if($this->uri->segment(1) == "confessions" || $this->uri->segment(1) == "confession"){
                     $table_name = 'confessions';
                     $type_for = " AND type = 'confession'";
                     $page_url = "confessions";
                  }  else  if($this->uri->segment(1) == "forums" || $this->uri->segment(1) == "forum"){
                     $table_name = 'confessions';
                     $type_for = " AND type = 'forum'";
                     $page_url = "forums";
                  } else if($this->uri->segment(1) == "blog"){
                     $table_name = 'blogs';
                     $type_for = " ";
                     $page_url = "blog";
                  }
                  $query_tags = "SELECT DISTINCT SUBSTRING_INDEX(SUBSTRING_INDEX(tags, ',', numbers.n), ',', -1) AS tag
                                  FROM (SELECT 1 AS n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4) numbers
                                  JOIN ".$table_name."
                                  WHERE CHAR_LENGTH(tags) - CHAR_LENGTH(REPLACE(tags, ',', '')) >= numbers.n - 1 ".$type_for;
                    $tags_list =  $this->db->query($query_tags)->result_object();
                    if(!empty($tags_list)){
               ?>
                  <div id="tag_cloud-3" class="widget widget_tag_cloud sidebar-widget">
                     <h3 class="widget-title">Popular Tag</h3>
                     <div class="tagcloud">
                        <?php 
                    
                          // echo $this->db->last_query();
                          foreach($tags_list as $key=>$rtag){
                           
                          
                        ?>
                              
                              <a href="<?php echo base_url();?><?php echo $page_url; ?>/tags/<?php echo $rtag->tag;?>" class="tag-cloud-link tag-link-29 tag-link-position-<?php echo $key;?>"><?php echo $rtag->tag;?></a> 
                              
                        <?php  } ?>
                     </div>
                  </div>
               <?php } ?>
               <?php 
                  if($this->uri->segment(1) == "confessions" || $this->uri->segment(1) == "confession"){
                     $ad_for = 'confession';
                  } else if($this->uri->segment(1) == "forums" || $this->uri->segment(1) == "forum"){
                     $ad_for = 'forum';
                  } 
                  else if($this->uri->segment(1) == "blog" || $this->uri->segment(1) == "blogs"){
                     $ad_for = 'blog';
                  }
                 
                  $get_blog_sidebar = $this->db->query("SELECT * FROM products_ads WHERE ad_for = '".$ad_for."' ".$country_ConditionQuery." AND ad_location = 'right_banner' AND status = 1 ORDER BY id DESC LIMIT 1")->result_object()[0]; 
                     if($get_blog_sidebar->link==""){
                        $link_to_display = $get_blog_sidebar->image;
                     } else {
                        $link_to_display = $get_blog_sidebar->link;
                     }
               ?>
               <?php if(!empty($get_blog_sidebar)){?>
               <div id="media_image-4" class="p0 sidebar-add-img widget widget_media_image sidebar-widget">
                  <a href="<?php echo $link_to_display;?>" data-lightbox="image-<?php echo $k;?>" target="_blank"><img width="320" height="420" src="<?php echo $get_blog_sidebar->image;?>" class="image wp-image-3499  attachment-medium size-medium" alt="" decoding="async" style="max-width: 100%; height: auto;" srcset="<?php echo $get_blog_sidebar->image;?> 350w" sizes="(max-width: 320px) 100vw, 320px" title=""></a></div>
               <?php } else { ?>
                  <div id="media_image-4" class="p0 sidebar-add-img widget widget_media_image sidebar-widget">
                  <a href="<?php echo base_url();?>promote" class="ad_right_box">
                       <p>
                           Promote Your Business <br>Post your Ad Here (Ad # <?php echo $adType; ?>)
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