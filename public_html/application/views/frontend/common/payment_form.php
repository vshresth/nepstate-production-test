<?php
 $segment = $this->uri->segment(1);
?>

<div class="form-group">
    <label>Choose Plan:</label>
    <select name="plan" required class="form-control" onchange="do_get_banners(this, '<?php echo $this->uri->segment(1); ?>')">
        
        <option value="">--Choose Plan--</option>
        <?php foreach ($plans_listing as $key => $parent) { ?>
             <?php 
                if($segment == 'promote') {
                    if($parent->is_free_plan == 1) {
                        continue;
                    }
                }else{
                    if($parent->is_free_plan == 1) {

                        $countFreeListing = $parent->free_listings_count;

                        if(user_info()->free_listings_count >= $countFreeListing) {
                            continue;
                        }


                        if($parent->cID == '') {
                            continue;
                        }else if($parent->cID != '') {
                            $categoryIds = explode(',', $parent->cID);
                            if(!in_array($category->id , $categoryIds)) {
                                continue;
                            }
 
                        }

                    }
                }     
            ?>
            <option data-id="<?php echo $parent->amount;?>" value="<?php echo $parent->id?>" <?php echo $json->plan==$parent->id?"SELECTED":""; ?> data-title="<?php echo $parent->title;?> (<?php echo $parent->months;?> Months)" ><?php echo $parent->title;?> (<?php echo $parent->months;?> Months)</option>
        <?php } ?>
    </select>
</div>

<div id="ads-boxes">

</div>

<!-- <div class="form-group wd100">
    <div class="banner_display" style="display: none;">
       <?php 
           
            // $list = '<label class="wd100">Classified Display (Website Banners):</label>';
            //  $list .= '<div class="radio-button">
            //       <input type="checkbox" id="ban_3" data-con="website_home_banner" data-amount="'.$row->website_home_banner.'" value="website_home_banner" class="payment_banner" name="banner_type[]">
            //       <label for="ban_3">Post on Website home page banner   (AD # 1) ($'.$row->website_home_banner.')</label>
            // </div>';

            // if($this->uri->segment(1) == "promote"){
            // $list .=  '<div class="radio-button">
            //       <input type="checkbox" id="ban_4" data-con="home_middle" data-amount="'.$row->home_middle.'" value="home_middle" class="payment_banner" name="banner_type[]">
            //       <label for="ban_4"> (AD # 2) ($'.$row->home_middle.')</label>
            // </div>
            // <div class="radio-button">
            //       <input type="checkbox" id="ban_5" data-con="web_footer" data-amount="'.$row->web_footer.'" value="web_footer" class="payment_banner" name="banner_type[]">
            //       <label for="ban_5"> (AD # 3) ($'.$row->web_footer.')</label>
            // </div>
           
            
            
            // ';
        // }

        //     $list .= '
        //     <div class="radio-button">
        //       <input type="checkbox" id="ban_1" data-con="category_home_page" data-amount="'.$row->category_home_page.'" value="category_home_page" class="payment_banner" name="banner_type[]">
        //       <label for="ban_1">Post on '.$cat_final_title.' home page  (AD # 4) ($'.$row->category_home_page.')</label>
        //     </div>';
        //    if($this->uri->segment(1) != "promote"){

        //     $list .= '<div class="radio-button">
        //           <input type="checkbox" id="ban_2" data-con="website_home_category_section" data-amount="'.$row->website_home_category_section.'" value="website_home_category_section" class="payment_banner" name="banner_type[]">
        //           <label for="ban_2">Post on Website home page  '.$cat_final_title.' section  ($'.$row->website_home_category_section.')

        //           <small><br>Choose this option to showcase your event post prominently at the Forefront of the Events section on our homepage.</small>
        //           </label>
        //     </div>';
        //    }
          

        //     $list .= '<div class="radio-button">
        //           <input type="checkbox" id="ban_8" data-con="cat_right" data-amount="'.$row->cat_right.'" value="cat_right" class="payment_banner" name="banner_type[]">
        //           <label for="ban_8">Post on Category right side (AD # 5) ($'.$row->cat_right.')</label>
        //     </div>';

        //     if($this->uri->segment(1) == "promote"){



        //     $list .=  '
            
        //     <div class="radio-button">
        //           <input type="checkbox" id="ban_7" data-con="blog" data-amount="'.$row->blog.'" value="blog" class="payment_banner" name="banner_type[]">
        //           <label for="ban_7">Blog Ad (AD # 6) ($'.$row->blog.') </label>
        //         </div>


        //     <div class="radio-button">
        //       <input type="checkbox" id="ban_11" data-con="forum" data-amount="'.$row->forum.'" value="forum" class="payment_banner" name="banner_type[]">
        //       <label for="ban_11">Forum Ad (AD # 7) ($'.$row->forum.') </label>
        //     </div>

        //     <div class="radio-button">
        //       <input type="checkbox" id="ban_10" data-con="confession" data-amount="'.$row->confession.'" value="confession" class="payment_banner" name="banner_type[]">
        //       <label for="ban_10">Confession Ad (AD # 8) ($'.$row->confession.') </label>
        //     </div>
            
        //     ';
        // }

        //    echo $list;
       ?>
    </div>
</div> -->
<!-- Post on Website home middle section -->
<!-- Post on Website Footer section -->

<div class="show_div_all wd100" id="category_home_page">
    <h4><?php echo 'Post on '.$cat_final_title.' home page ($'.$row->category_home_page.')';?></h4>
    <div class="form-group wd100 url_custom_ad">
        <label>Enter URL</label>
        <input type="url"  placeholder="Enter full url eg: https://www.google.com" name="category_home_page_url" class="form-control"  style="background:#fff">
    </div>
    <div id="category_home_page_1">
        <div class="form-group wd100 url_custom_ad">
            <?php $al_cat = $this->db->query("SELECT * FROM categories WHERE parent_id = 0")->result_object(); ?>
            <label>Category</label>
            <select name="category_home_page" style="background:#fff">
                <option value="">--Choose Category--</option>
                <?php foreach($al_cat as $akey=>$all){?>
                    <option value="<?php echo $all->slug;?>"><?php echo $all->title;?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group wd100 url_custom_ad" style="display:none;">
            <?php $al_cat = array("top_banner"=>"Top Banner"); ?>
            <label>Ad Location</label>
            <select name="location_ad_category" style="background:#fff" >
                <?php foreach($al_cat as $akey=>$all){?>
                    <option value="<?php echo $akey;?>"><?php echo $all;?></option>
                <?php } ?>
            </select>
        </div>
        <label><small style="color: grey">Don't have same size, use this : <a href="https://imageresizer.com/" target="_blank">Click here</a></small></label>
        <div class="form-group wd100" id="">
            <input type="file" id="input-file-disable-remove logo" class="dropify" data-show-errors="true" data-show-loader="true" data-errors-position="outside" data-show-remove="false" name="category_home_page" data-allowed-file-extensions="png jpg jpeg gif" data-default-file="" data-min-width="999" data-min-height="399"/>
        </div>
    </div>

    <p><small>Minimum Image Size: 1000px x 400px</small></p>
</div>


<!-- CAT RIGHJT SECTION -->
<div class="show_div_all wd100" id="cat_right">
    <h4><?php echo 'Post on Category right side ($'.$row->cat_right.')';?></h4>
    <div class="form-group wd100 url_custom_ad">
        <label>Enter URL</label>
        <input type="url"  placeholder="Enter full url eg: https://www.google.com" name="cat_right_section_url" class="form-control"  style="background:#fff">
    </div>
    <div id="cat_right_1">
        <div class="form-group wd100 url_custom_ad">
            <?php $al_cat = $this->db->query("SELECT * FROM categories WHERE parent_id = 0")->result_object(); ?>
            <label>Category</label>
            <select name="cat_right_section" style="background:#fff" id="categoryType">
                <option value="">--Choose Category--</option>
                <?php foreach($al_cat as $akey=>$all){?>
                    <option value="<?php echo $all->slug;?>"><?php echo $all->title;?></option>
                <?php } ?>
            </select>
        </div>

        <label><small style="color: grey">Don't have same size, use this : <a href="https://imageresizer.com/" target="_blank">Click here</a></small></label>
        <div class="form-group wd100" id="">
            <input type="file" id="input-file-disable-remove logo" class="dropify" data-show-errors="true" data-show-loader="true" data-errors-position="outside" data-show-remove="false" name="cat_right" data-allowed-file-extensions="png jpg jpeg gif" data-default-file="" data-max-width="351" data-min-height="399"  />
        </div>
    </div>

    <p><small>Maximum Image Size: 350px x 400px</small></p>
</div>

<div class="show_div_all wd100" id="website_home_banner">
    <h4><?php echo 'Post on Website home page banner ($'.$row->website_home_banner.')';?></h4>
     <div class="form-group wd100 url_custom_ad">
        <label>Enter URL</label>
        <input type="url"  placeholder="Enter full url eg: https://www.google.com" name="website_home_banner_url" class="form-control"  style="background:#fff">
    </div>
    <label><small style="color: grey">Don't have same size, use this : <a href="https://imageresizer.com/" target="_blank">Click here</a></small></label>
    <div class="form-group wd100" id="website_home_banner_1">
        <input type="file" id="input-file-disable-remove logo" class="dropify" data-show-errors="true" data-show-loader="true" data-errors-position="outside" data-show-remove="false" name="website_home_banner" data-allowed-file-extensions="png jpg jpeg gif" data-default-file="" data-min-width="999" data-min-height="399" />
    </div>
     <p><small>Minimum Image Size: 1000px x 400px</small></p>
</div>

<div class="show_div_all wd100" id="home_middle">
    <h4><?php echo 'Post on Website Home Middle section ($'.$row->home_middle.')';?></h4>
    <div class="form-group wd100 url_custom_ad">
        <label>Enter URL</label>
        <input type="url"  placeholder="Enter full url eg: https://www.google.com" name="home_middle_url" class="form-control"  style="background:#fff">
    </div>
    <label><small style="color: grey">Don't have same size, use this : <a href="https://imageresizer.com/" target="_blank">Click here</a></small></label>
    <div class="form-group wd100" id="home_middle_1">
        <!-- <input type="file" id="input-file-disable-remove logo" class="dropify" data-show-errors="true" data-show-loader="true" data-errors-position="outside" data-show-remove="false" name="home_middle" data-allowed-file-extensions="png jpg jpeg" data-max-width="549"  /> -->
        <input type="file" id="input-file-disable-remove logo" class="dropify" data-show-errors="true" data-show-loader="true" data-errors-position="outside" data-show-remove="false" name="home_middle" data-allowed-file-extensions="png jpg jpeg gif"  data-max-width="550" />
    </div>
     <p><small>Image Size: 550px x 250px</small></p>
</div>

<div class="show_div_all wd100" id="web_footer">
    <h4><?php echo 'Post on Website home Footer Section ($'.$row->web_footer.')';?></h4>
    <div class="form-group wd100 url_custom_ad">
        <label>Enter URL</label>
        <input type="url" placeholder="Enter full url eg: https://www.google.com" name="web_footer_url" class="form-control" style="background:#fff">
    </div>
    <label><small style="color: grey">Don't have same size, use this : <a href="https://imageresizer.com/" target="_blank">Click here</a></small></label>
    <div class="form-group wd100" id="web_footer_1">
        <input type="file" id="input-file-disable-remove logo" class="dropify" data-show-errors="true" data-show-loader="true" data-errors-position="outside" data-show-remove="false" name="web_footer" data-allowed-file-extensions="png jpg jpeg gif"  data-max-width="350" />
        <!-- <input type="file" id="input-file-disable-remove logo" class="dropify" data-show-errors="true" data-show-loader="true" data-errors-position="outside" data-show-remove="false" name="web_footer" data-allowed-file-extensions="png jpg jpeg" data-max-width="349" data-min-height="249" data-max-height="350" /> -->
    </div>
     <p><small>Image Size: 350px x 250px</small></p>
</div>

<div class="show_div_all wd100" id="blog">
    <h4><?php echo 'Blog Ad ($'.$row->blog.')';?></h4>
    <div class="form-group wd100 url_custom_ad">
        <label>Enter URL</label>
        <input type="url"  placeholder="Enter full url eg: https://www.google.com" name="blog_url" class="form-control" style="background:#fff">
    </div>
    <div class="form-group wd100 url_custom_ad">
        <?php $al_cat = array("top_banner"=>"Top Banner", "right_banner"=>"Right Banner"); ?>
        <label>Ad Location</label>
        <select name="location_ad_blog" style="background:#fff" onchange="do_change_div('blog')" id="blogLocation">
            <option value="">--Choose Ad Location--</option>
            <?php foreach($al_cat as $akey=>$all){?>
                <option value="<?php echo $akey;?>"><?php echo $all;?></option>
            <?php } ?>
        </select>
    </div>
    
    <label><small style="color: grey">Don't have same size, use this : <a href="https://imageresizer.com/" target="_blank">Click here</a></small></label>
    <div id="blogTopSideImageBox" style="display:none;">
        <div class="form-group wd100" id="blog_1">
                <input type="file" id="input-file-disable-remove-remove logo" class="dropify" data-show-errors="true" data-show-loader="true" data-errors-position="outside" data-show-remove="false" name="blogTopBanner" data-allowed-file-extensions="png jpg jpeg gif"  data-min-width="449" data-min-height="249"  />
                <p><small>Image Size: 1000px x 400px</small></p>
        </div>
    </div>
   

    <div id="blogRightSideImageBox" style="display:none;">
        <div class="form-group wd100" id="blog_1">
                <input type="file" id="input-file-disable-remove logo" class="dropify" data-show-errors="true" data-show-loader="true" data-errors-position="outside" data-show-remove="false" name="blog" data-allowed-file-extensions="png jpg jpeg gif"  data-max-width="351" data-min-height="399"  />
                <p><small>Image Size: 350px x 400px</small></p>
        </div>
    </div>
     
</div>


<div class="show_div_all wd100" id="confession">
    <h4><?php echo 'Confession Ad ($'.$row->confession.')';?></h4>
    <div class="form-group wd100 url_custom_ad">
        <label>Enter URL</label>
        <input type="url"  placeholder="Enter full url eg: https://www.google.com" name="confession_url" class="form-control" style="background:#fff">
    </div>
    <div class="form-group wd100 url_custom_ad">
        <?php $al_cat = array("top_banner"=>"Top Banner", "right_banner"=>"Right Banner"); ?>
        <label>Ad Location</label>
        <select name="location_ad_confession" style="background:#fff" onchange="do_change_div('confession')" id="confessionLocation">
            <option value="">--Choose Ad Location--</option>
            <?php foreach($al_cat as $akey=>$all){?>
                <option value="<?php echo $akey;?>"><?php echo $all;?></option>
            <?php } ?>
        </select>
    </div>
    <label><small style="color: grey">Don't have same size, use this : <a href="https://imageresizer.com/" target="_blank">Click here</a></small></label>
    
    <div id="topConfessionImageBox" style="display:none;">
        <div class="form-group wd100" id="confession_1">
                <input type="file" id="input-file-disable-remove logo" class="dropify" data-show-errors="true" data-show-loader="true" data-errors-position="outside" data-show-remove="false" name="confessionTopBanner" data-allowed-file-extensions="png jpg jpeg gif"  data-min-width="449" data-min-height="249"  />
                <p><small>Image Size: 1000px x 400px</small></p>
        </div>
    </div>


    <div id="rightConfessionImageBox" style="display:none;">
        <div class="form-group wd100" id="confession_1">
                <input type="file" id="input-file-disable-remove logo" class="dropify" data-show-errors="true" data-show-loader="true" data-errors-position="outside" data-show-remove="false" name="confession" data-allowed-file-extensions="png jpg jpeg gif"  data-max-width="351" data-min-height="399"   />
                <p><small>Image Size: 350px x 400px</small></p>
        </div>
    </div>
     
</div>

<div class="show_div_all wd100" id="forum">
    <h4><?php echo 'Forum Ad ($'.$row->forum.')';?></h4>
    <div class="form-group wd100 url_custom_ad">
        <label>Enter URL</label>
        <input type="url"  placeholder="Enter full url eg: https://www.google.com" name="forum_url" class="form-control" style="background:#fff">
    </div>
    <div class="form-group wd100 url_custom_ad">
        <?php $al_cat = array("top_banner"=>"Top Banner", "right_banner"=>"Right Banner"); ?>
        <label>Ad Location</label>
        <select name="location_ad_forum" style="background:#fff" onchange="do_change_div('forum')" id="forumLocation">
            <option value="">--Choose Ad Location--</option>
            <?php foreach($al_cat as $akey=>$all){?>
                <option value="<?php echo $akey;?>"><?php echo $all;?></option>
            <?php } ?>
        </select>
    </div>
    <label><small style="color: grey">Don't have same size, use this : <a href="https://imageresizer.com/" target="_blank">Click here</a></small></label>
    
    <div id="topForumImageBox" style="display:none;">
    <div class="form-group wd100" id="forum_1">
            <input type="file" id="input-file-disable-remove logo" class="dropify" data-show-errors="true" data-show-loader="true" data-errors-position="outside" data-show-remove="false" name="forumTopBanner" data-allowed-file-extensions="png jpg jpeg gif"  data-min-width="449" data-min-height="249"  />
            <p><small>Image Size: 1000px x 400px</small></p>
    </div>
    </div>
    
    <div id="rightForumImageBox" style="display:none;">
    <div class="form-group wd100" id="forum_1">
            <input type="file" id="input-file-disable-remove logo" class="dropify" data-show-errors="true" data-show-loader="true" data-errors-position="outside" data-show-remove="false" name="forum" data-allowed-file-extensions="png jpg jpeg gif"  data-max-width="351" data-min-height="399"  />
            <p><small>Image Size: 350px x 400px</small></p>
    </div>
    </div>
    
     
</div>
